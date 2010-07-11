<?PHP

 if (!defined('ADMIN') || !ADMIN) { die('Admins only!'); }

?><div class="block" id="bills">
 <h2>ADMIN: All bills</h2>
<!--
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="chris87@gmail.com">
<input type="hidden" name="item_name" value="UTD-Hosting one year slot">
<input type="hidden" name="item_number" value="UID">
<input type="hidden" name="amount" value="35.00">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="GBP">
<input type="hidden" name="bn" value="PP-BuyNowBF">
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but02.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=chris87%40gmail%2ecom&item_name=UTD%2dHosting%20one%20year%20slot&item_number=UID&amount=35%2e00&no_shipping=1&no_note=1&currency_code=GBP&bn=PP%2dBuyNowBF&charset=UTF%2d8
-->
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>User</th>
   <th>Type</th>
   <th>Amount</th>
   <th>Due on</th> 
   <th>Status</th>
  </tr>
<?PHP

 $sql = 'SELECT bill_id, bill_due, package_name, bill_amount, user_name, users.user_id, bill_paid FROM billing NATURAL JOIN users, packages WHERE packages.package_id = billing.package_id ORDER BY bill_due';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 $status = array(2=>'Paid',1=>'DUE',0=>'Future');
 $i = 1;
 while ($row = mysql_fetch_array($res)) {
  $i = 1 - $i;
  ?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $row['bill_id']; ?>.</td>
   <td><a href="<?PHP echo CP_PATH.'checkuser/'.$row['user_id']; ?>"><?PHP echo $row['user_name']; ?></a></td>
   <td><?PHP echo $row['package_name']; ?></td>
   <td>&pound;<?PHP echo money_format('%i',$row['bill_amount']/100); ?></td>
   <td><?PHP echo date('r',$row['bill_due']); ?></td>
   <td>
    <?PHP echo $status[($row['bill_paid'])]; ?>
   </td>
  </tr>
  <?PHP
 }
?> 
 </table>
</div>
