<?PHP
 require_once('lib/database.php');
 require_once('lib/common.php'); 
?>
<div class="block" id="users">
 <h2>ADMIN: IP Bans</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>IP</th>
   <th>Reason</th>
   <th>Expires in</th>
   <th>Actions</th>
  </tr>
<?PHP

 $i = 0;
 $n = 0; 
 $sql = 'SELECT ipban_id, ipban_ip, ipban_expires, ipban_message FROM ipbans';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

 if (mysql_num_rows($res) == 0) {
  echo '<tr><td colspan="5" style="text-align: center; font-style: italic;">';
  echo 'No IP bans</td></tr>';
 }
 
 while ($row = mysql_fetch_array($res)) {
  $n++;
?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $n; ?>.</td>
   <td><?PHP echo h($row['ipban_ip']); ?></td>
   <td><?PHP echo h($row['ipban_message']); ?></td>
<?PHP
 if ($row['ipban_expires'] < time()) { 
  echo '<td style="color: red;">Expired</td><td>';
 } else {
  echo '<td>'.duration($row['ipban_expires'] - time()).'</td>'; 
?>
   <td>
    <a href="?n=<?PHP echo $row['ipban_id']; ?>">
     Remove
    </a> or
<?PHP
 }
?>
    <a href="?d=<?PHP echo $row['ipban_id']; ?>">Delete</a>
   </td>
  </tr>
<?PHP
   $i = 1 - $i;
 }

?>    
 </table>
</div>
