<?PHP

 if (!defined('ADMIN') || !ADMIN) { die('Admins only!'); }

?><div class="block" id="bills">
 <h2>ADMIN: All bills</h2>
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

/* $sql = 'SELECT bill_id, bill_due, package_name, bill_amount, user_name, users.user_id, bill_paid FROM billing NATURAL JOIN users, packages WHERE packages.package_id = billing.package_id ORDER BY bill_due';
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
 }*/
?> 
 </table>
</div>
