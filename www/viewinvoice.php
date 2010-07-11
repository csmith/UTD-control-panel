#!/usr/bin/php -q
<?PHP

 require_once('lib/account.php');
 require_once('lib/common.php');
 require_once('lib/database.php');

 if (!isset($_GET['n']) || !ctype_digit($_GET['n'])) {
  header('Location: '.CP_PATH.'invoices');
  exit;
 }

 $sql  = 'SELECT bill_due, bill_generated, bill_total, bill_paid FROM bills WHERE ';
 $sql .= 'bill_id = '.m($_GET['n']).' AND user_id = '.m(UID);
 $res  = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 
 if (mysql_num_rows($res) != 1) {
  header('Location: '.CP_PATH.'invoices');
  exit;
 }

 $row = mysql_fetch_array($res);

 define('INVOICEID', str_pad($_GET['n'],5,'0',STR_PAD_LEFT));
 define('PAID', $row['bill_paid']);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <title>UTD-Hosting :: Invoice <?PHP echo INVOICEID; ?></title>
  <style type="text/css">
   body {
    padding: 75px 150px;
    font-family: "DejaVu Serif", serif;
   }
   th {
    text-align: right;
   }
   table.item {
    width: 100%;
   }
   table.item th { text-align: left; }
   h3,h2 {
    border-bottom: 1px solid #ccc;
   }
  </style>
 </head>
 <body>
  <img src="<?PHP echo CP_PATH; ?>res/logo.png" alt="UTD-Hosting" id="logo">
  <h2>Invoice #<?PHP echo INVOICEID; ?></h2>
  <table>
   <tr>
    <th>Issued:</th>
    <td><?PHP echo date('r', $row['bill_generated']); ?></td>
   </tr>
   <tr>
    <th>Due:</th>
    <td><?PHP echo date('r', $row['bill_due']); ?></td>
   </tr>
   <tr>
    <th>Status:</th>
    <td><?PHP if ($row['bill_paid'] == 1) { echo 'Paid'; } else { echo 'Outstanding'; } ?></td>
   </tr> 
  </table>
  <h3>Itemisation</h3>
  <table class="item">
   <tr><th>Description</th><th>Cost</th></tr>
<?PHP
 $tot = 0;
 $sql = 'SELECT package_name, bi_cost FROM billitems NATURAL JOIN userpackages';
 $sql .= ' NATURAL JOIN packages WHERE bill_id = '.m($_GET['n']);
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 while ($row = mysql_fetch_array($res)) {
  echo '<tr><td>'.$row['package_name'].'</td><td>&pound;';
  echo money_format('%i',$row['bi_cost']/100); 
  $tot += $row['bi_cost'];
  echo '</td></tr>';
 }
?>
  </table>
  <h3>Total</h3>
  <p>The total cost of this invoice is 
   &pound;<?PHP echo money_format('%i',$tot/100); ?>.</p>
  <h3>Payment</h3>
<?PHP
 if (PAID != 1) {
?>
 <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="sales@utd-hosting.com">
<input type="hidden" name="item_name" value="UTD-Hosting invoice #<?PHP echo INVOICEID; ?>">
<input type="hidden" name="item_number" value="<?PHP echo INVOICEID; ?>">
<input type="hidden" name="amount" value="<?PHP echo money_format('%i',$tot/100); ?>">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="GBP">
<input type="hidden" name="bn" value="PP-BuyNowBF">
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but02.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" style="float: right;">
</form>
<?PHP  

  echo '<p>This invoice is outstanding. To pay this invoice using PayPal, ';
  echo 'please use the button to the right.';
 } else {
  echo '<p>This invoice has been paid. Thank you for using UTD-Hosting.';
 }
?>
  If you have any queries about this invoice, please e-mail
   sales@utd-hosting.com, including the invoice number and your account name.
  </p>
 </body>
</html>
