<?PHP

 require_once('lib/common.php');
 require_once('lib/database.php');

 // Log the transaction
 $count = count(glob('/home/utd/public_html/ipn/*.html'));
 $count++; $id = str_pad($count,5,'0',STR_PAD_LEFT); define('ID', $id);

 $data = '<html><head><title>IPN Transaction details</title></head><body>';
 $data .= '<h2>Post details</h2><table>';
 foreach ($_POST as $k => $v) {
  $data .= '<tr><td>'.htmlentities($k).'</td>';
  $data .= '<td>'.htmlentities($v).'</td></tr>';
 }
 $data .= '</table><h2>Server details</h2><table>';
 foreach ($_SERVER as $k => $v) {
  if (is_array($v)) { continue; }
  $data .= '<tr><td>'.htmlentities($k).'</td>';
  $data .= '<td>'.htmlentities($v).'</td></tr>';
 }
 $data .= '</table></html>';

 file_put_contents('/home/utd/public_html/ipn/'.ID.'.html', $data);

 // Read the post from PayPal system and add 'cmd'
 $req = 'cmd=_notify-validate';

 foreach ($_POST as $key => $value) {
  $value = urlencode(stripslashes($value));
  $req .= "&$key=$value";
 }

 // Post back to PayPal system to validate
 $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
 $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
 $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

 $sb = '';

 $fp = fsockopen ('www.'.$sb.'paypal.com', 80, $errno, $errstr, 30);
 if (!$fp) { fail('Unable to connect to paypal'); }

 // assign posted variables to local variables
 $item_name = $_POST['item_name'];
 $item_number = $_POST['item_number'];
 $payment_status = $_POST['payment_status'];
 $payment_amount = $_POST['mc_gross'];
 $payment_currency = $_POST['mc_currency'];
 $txn_id = $_POST['txn_id'];
 $receiver_email = strtolower($_POST['receiver_email']);
 $payer_email = $_POST['payer_email'];

 function fail($m) {
  logger::log(chr(2).'IPN'.chr(2).': Transaction '.ID.': Failure: '.$m, logger::important);
  exit;
 }
 
 if (!$fp) {
  fail('HTTP error when posting back: '.$errstr);
 } else {
  fputs ($fp, $header . $req);
  while (!feof($fp)) {
   $res = fgets ($fp, 1024);
   if (strcmp ($res, "VERIFIED") == 0) {
    // check the payment_status is Completed
    if ($payment_status != 'Completed') {
     fail('Payment status is '.$payment_status.' (expected "Completed")');
    }

    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    if ($receiver_email != 'chris87@gmail.com'
	 && $receiver_email != 'accounts@utd-hosting.com') {
     fail('Receiver is '.$receiver_email);
    }

    // check that payment_amount/payment_currency are correct
    if ($payment_currency != 'GBP') {
     fail('Invalid currency: '.$payment_currency);
    }

    $id = preg_replace('~^.*#([0-9]+)$~', '\1', $item_name);
    if (!is_numeric($id)) {
     fail('Unable to parse item_name: '.$item_name); 
    }

    $sql = 'SELECT user_id, user_name, bill_total, bill_paid';
    $sql .= ' FROM bills NATURAL JOIN users WHERE bill_id = '.$id; 
    $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    if (mysql_num_rows($res) == 1) {
     $row = mysql_fetch_array($res);
     $amount = $payment_amount * 100;
     if ($amount != $row['bill_total'] || $row['bill_paid'] == 1) {
      fail('bill_total is incorrect, or bill already paid'); 
     }  

     $sql = 'UPDATE bills SET bill_paid = 1 WHERE bill_id = '.$id;
     $res = mysql_query($sql) or fail('SQL error: '.mysql_error());

     $sql = 'UPDATE userpackages, billitems, packages SET up_cost = package_cost, up_expires = up_expires + package_duration WHERE bill_id = '.$id.' AND userpackages.up_id = billitems.up_id AND packages.package_id = userpackages.package_id';
     $res = mysql_query($sql) or fail('SQL error: '.mysql_error());

     $sql = 'SELECT finance_balance FROM finances ORDER BY finance_time DESC';
     $res = mysql_query($sql) or fail('SQL error: '.mysql_error());
     $ro2 = mysql_fetch_array($res); $balance = $ro2[0];
     $sql = 'INSERT INTO finances (finance_time, finance_desc, user_id,';
     $sql .= ' finance_receipts, finance_payments, finance_balance) VALUES (';
     $sql .= time().', \'Bill payment\', '.$row['user_id'].', ';
     $sql .= $row['bill_amount'].', '.($_POST['mc_fee']*100).', ';
     $sql .= ($balance+$row['bill_amount']-($_POST['mc_fee']*100)).')';
     $res = mysql_query($sql) or fail('SQL error: '.mysql_error());

     logger::log('User '.chr(2).$row['user_name'].chr(2).': Bill '.$id.' paid.', logger::normal);
    } else { 
     fail('Bill not found: '.$id);
    }
   } else if (strcmp ($res, "INVALID") == 0) {
    fail('INVALID REQUEST -- INVESTIGATE -- http://admin.utd-hosting.com/ipn/'.ID.'.html');
   }
  }
  fclose ($fp);
 }

?>
