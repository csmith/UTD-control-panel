<div class="block">
 <h2>My packages</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>Name</th>
   <th>Usual Price</th>
   <th>Next Price</th>
   <th>Next Invoice</th> 
   <th>Status</th>
   <th>Repeat</th>
  </tr>
<?PHP

 $sql  = 'SELECT package_name, up_cost, package_cost, up_expires, up_invoice, up_active ';
 $sql .= 'FROM userpackages NATURAL JOIN packages WHERE user_id = '.UID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 $i = 0;
 while ($row = mysql_fetch_array($res)) {
  $i++;
  ?>
  <tr class="<?PHP echo ($i % 2 == 1) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $i; ?>.</td>
   <td><?PHP echo $row['package_name']; ?></td>
   <td>&pound;<?PHP echo money_format('%i',$row['package_cost']/100); ?></td>
   <td>&pound;<?PHP echo money_format('%i',$row['up_cost']/100); ?></td>
   <td><?PHP echo date('r',$row['up_expires']); ?></td>
   <td><?PHP if ($row['up_active'] == 1) { echo 'Active'; } else { echo 'Inactive'; } ?></td>
   <td><?PHP if ($row['up_invoice'] == 1) { echo 'Yes'; } else { echo 'No'; } ?></td>
  </tr>
  <?PHP
 }
?> 
 </table>
</div>
