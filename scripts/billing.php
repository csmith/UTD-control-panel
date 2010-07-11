#!/usr/bin/php -q
<?PHP

 chdir('/home/utd/control');
 require_once('lib/database.php');
 require_once('lib/log.php');
 require_once('lib/common.php');
 chdir('/home/utd/scripts');

 // First off, let's disable anything that's not been paid
 $sql  = 'SELECT user_id, user_email, package_name, up_expires, up_cost, ';
 $sql .= 'up_id FROM userpackages NATURAL JOIN packages NATURAL JOIN ';
 $sql .= 'users WHERE up_active = 1 AND up_expires < '.time();

 $res  = mysql_query($sql);

 while ($row = mysql_fetch_array($res)) {
  $user = $row['user_id'];
  $addr = $row['user_email'];
  $name = $row['package_name'];
  $date = $row['up_expires'];
  $upid = $row['up_id'];
  $cost = $row['up_cost'];
  
  $subj  = 'UTD-Hosting package cancellation: '.$name;
  $body  = 'This is an automatic notifcation. The "'.$name.'" package has now ';
  $body .= 'been disabled on your account. You will no longer have access to ';
  $body .= 'services provided as a part of this package. If you have no other ';
  $body .= 'active packages, your account will be automatically closed within ';
  $body .= '14 days.'."\n\n".'If you wish to retrieve data stored in your ';
  $body .= 'account, or wish to renew a package, or have any enquiries about ';
  $body .= 'this message, please e-mail support@utd-hosting.com.'."\n\n";
  $body .= ' -- UTD-Hosting support';
  $head  = 'From: UTD-Hosting support <support@utd-hosting.com>';
 
  mail($addr, $subj, $body, $head); 

  $sql = 'UPDATE userpackages SET up_active = 0 WHERE up_id = '.$upid;

  mysql_query($sql);

  logger::log("Package '$name' cancelled (no payment)", $user, logger::info);
 }

 // Now select anything that's outstanding and doesn't have an invoice
 $inv  = array();

 $sql  = 'SELECT up_id, package_id, user_id, up_expires, up_cost FROM ';
 $sql .= 'userpackages WHERE up_invoice = 1 AND up_active = 1 AND up_expires ';
 $sql .= '< '.strtotime('+1 month');
 $res  = mysql_query($sql) or print(mysql_error()."\n".$sql);

 while ($row = mysql_fetch_assoc($res)) {
  $sql  = 'SELECT bill_id FROM billitems NATURAL JOIN bills WHERE user_id = ';
  $sql .= $row['user_id'].' AND up_id = '.$row['up_id'].' AND bill_paid = 0';
  $re2  = mysql_query($sql);
  
  if (mysql_num_rows($re2) > 0) {
   continue;
  }

  if (!isset($inv[$row['user_id']])) {
   $inv[$row['user_id']] = array();
  }

  $inv[$row['user_id']][] = array($row['up_id'], $row['up_cost']);
 }

 // And now iterate through any invoices we need to make
 foreach ($inv as $user => $items) {
  $sql  = 'SELECT user_email FROM users WHERE user_id = '.$user;
  $res  = mysql_query($sql);
  $row  = mysql_fetch_assoc($res);
 
  $tot  = 0;

  foreach ($items as $data) {
   $tot += $data[1];
  }

  // Add it to the db
  $sql  = 'INSERT INTO bills (user_id, bill_due, bill_generated, bill_total) ';
  $sql .= 'VALUES ('.$user.', '.strtotime('+1 month').', '.time().', '.$tot.')';
  $res  = mysql_query($sql);
  $bil  = mysql_insert_id();

  // And the items
  foreach ($items as $data) {
   list($pid, $cst) = $data;

   $sql  = 'INSERT INTO billitems (bill_id, up_id, bi_cost) VALUES ('.$bil.', ';
   $sql .= $pid.', '.$cst.')';
   $res  = mysql_query($sql);
  }

  $tot  = sprintf('%01.2f', $tot/100);
  $pkg  = count($items).' package'.(count($items) != 1 ? 's' : '');

  // And send them mail
  $to   = $row['user_email'];
  $subj = 'UTD-Hosting invoice notification';
  $msg  = 'This is an automatic notification. An invoice for £'.$tot.' has ';
  $msg .= 'been issued to you. This is for the extension of '.$pkg.' due to ';
  $msg .= 'expire within the next month.'."\n\n";
  $msg .= 'You may view and pay this invoice via the UTD-Hosting control panel';
  $msg .= ' at the following address: https://secure.utd-hosting.com/control/';
  $msg .= 'viewinvoice/'.$bil.' or you can log in normally and follow the ';
  $msg .= '"My Invoices" link in the main menu.'."\n\n";
  $msg .= 'If you have any queries about this invoice, please contact ';
  $msg .= 'sales@utd-hosting.com.'."\n\n".' -- UTD-Hosting';
  $head = 'From: UTD-Hosting accounts <sales@utd-hosting.com>';

  mail($to, $subj, $msg, $head); 

  logger::log("Bill issued for £$tot", $user, logger::normal);
 }
  
?>
