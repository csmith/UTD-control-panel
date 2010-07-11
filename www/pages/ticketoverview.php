<?PHP
 if (!defined('LIB_DATABASE')) { require_once('lib/database.php'); }
 if (!defined('LIB_COMMON')) { require_once('lib/common.php'); } 
?>
<div class="block">
 <h2>My tickets opened in the past month</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>Title</th>
   <th>View</th>
   <th>Date</th>
   <th>Replies</th>
   <th>Status</th>
  </tr>
<?PHP

 $i = 0;
 $n = 0;
 
 $sql = 'SELECT ticket_id, ticket_status, ticket_title, ticket_time FROM tickets WHERE ticket_thread = ticket_id AND ticket_time > '.(time() - 60*60*24*31).' AND user_id = '.UID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

 if (mysql_num_rows($res) == 0) {
  echo '<tr><td colspan="6" style="font-style: italic; text-align: center;">No tickets opened recently</td></tr>';
 }
 
 while ($row = mysql_fetch_array($res)) {
   $n++;

   $sql2 = 'SELECT COUNT(*) FROM tickets WHERE ticket_thread = '.$row['ticket_id'];
   $res2 = mysql_query($sql2) or mf(__FILE__, __LINE__, $sql2);
   $num = mysql_fetch_array($res2); $num = (int)$num[0] - 1;
?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $n; ?>.</td>
   <td><?PHP echo htmlspecialchars($row['ticket_title']); ?></td>
   <td><a href="<?PHP echo CP_PATH; ?>viewticket/<?PHP echo $row['ticket_id']; ?>">View</a></td>
   <td><?PHP echo substr(gmdate('r', $row['ticket_time']),0,-6); ?></td>
   <td><?PHP echo $num; ?></td>
<?PHP

 if ($row['ticket_status'] == 'new' || $row['ticket_status'] == 'reopened') {
   echo '<td class="err">'.ucfirst($row['ticket_status']).'</td>';
 } else {
   echo '<td>'.ucfirst($row['ticket_status']).'</td>';
 }

?>
  </tr>
<?PHP
   $i = 1 - $i;
 }

?>    
 </table>
</div>
