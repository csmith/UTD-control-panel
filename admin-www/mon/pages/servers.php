<?PHP

 $sql = 'SELECT count(*) FROM services';
 $res = mysql_query($sql);
 $row = mysql_fetch_array($res);
 define('SERVICES', (int)$row[0]);

?>
<div class="block">
 <h2>Servers</h2>
 <table class="innerblock">
  <tr>
   <th>ID</th>
   <th>Name</th>
   <th>Host</th>
   <th>Status</th>
  </tr>
<?PHP

 $sql = 'SELECT server_id, server_name, server_host FROM servers';
 $res = mysql_query($sql);
 $i = 0;
 while ($row = mysql_fetch_assoc($res)) {
  $i = 1 - $i;
?>
  <tr class="<?PHP echo ($i == 1) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $row['server_id']; ?></td>
   <td><a href="#<?PHP echo $row['server_name']; ?>"><?PHP echo $row['server_name']; ?></a></td>
   <td><?PHP echo $row['server_host']; ?></td>
   <td>
<?PHP

 $sql = 'SELECT COUNT(*) FROM servserv WHERE server_id = '.$row['server_id'];
 $re2 = mysql_query($sql);
 $ro2 = mysql_fetch_array($re2);
 $services = $ro2[0];

 $sql = 'SELECT COUNT(*) FROM results WHERE server_id = '.$row['server_id'].' AND result_result = \'down\' AND result_last = 1';
 $re2 = mysql_query($sql);
 $ro2 = mysql_fetch_array($re2);
 if ((int)$ro2[0] > 0) {
  echo '<span style="color: red; font-weight: bold;">'.$ro2[0].' DOWN</span>';
 } 
 if ((int)$ro2[0] < $services) {
  if ((int)$ro2[0] > 0) { echo ' / '; }
  echo '<span style="color: green;">'.($services - (int)$ro2[0]).' UP</span>';
 }

?>
   </td>
  </tr>
<?PHP
 }

?>
 </table>
</div>
