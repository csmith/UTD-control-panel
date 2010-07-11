<?PHP

 if (!defined('ADMIN') || !ADMIN) { die('Admins only!'); }

?><div class="block" id="bills">
 <h2>ADMIN: Live bandwidth</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>User</th>
   <th>In</th>
   <th>Out</th>
   <th>Total</th> 
  </tr>
<?PHP

 $sql = 'SELECT * FROM iptdata ORDER BY ipt_user';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 $i = 1;
 while ($row = mysql_fetch_array($res)) {
  $i = 1 - $i;
  ?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $row['ipt_id']; ?>.</td>
   <td><?PHP echo $row['ipt_user']; ?></td>
   <td><?PHP echo NiceSize($row['ipt_in']); ?></td>
   <td><?PHP echo NiceSize($row['ipt_out']); ?></td>
   <td><?PHP echo NiceSize($row['ipt_in']+$row['ipt_out']); ?></td>
  </tr>
  <?PHP
 }
?> 
 </table>
</div>
