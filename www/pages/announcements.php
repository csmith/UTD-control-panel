<?PHP
 require_once('lib/profiler.php');
 require_once('lib/database.php');
 require_once('lib/common.php');
?>
<div class="block">
 <h2>Announcements and messages</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>Title</th>
   <th>View</th>
   <th>Type</th>
   <th>Date</th>
  </tr>
<?PHP

 $sql = 'SELECT message_id, message_type, message_title, message_time FROM messages WHERE message_time > ' . strtotime('-6 months');
 if (!defined('ADMIN')) { $sql .= ' AND message_type <> \'admin\''; }
 $sql .= ' ORDER BY message_time LIMIT 0,5';
 
 $res = mq($sql) or mf(__FILE__, __LINE__, $sql);
 
 $i = 0;
 $n = 0;

 if (mysql_num_rows($res) == 0) {
  echo '<tr><td colspan="5" style="font-style: italic; text-align: center;">';
  echo 'There are no current announcements</td></tr>';
 }
  
 while ($row = mysql_fetch_array($res)) {
  $n++;
?>
  <tr<?PHP if ($i == 1) { echo ' class="odd"'; } ?>>
   <td><?PHP echo $n; ?>.</td>
   <td><?PHP echo $row['message_title']; ?></td>
   <td><a href="<?PHP echo CP_PATH; ?>viewmessage/<?PHP echo $row['message_id']; ?>">View</a></td>
   <td><?PHP echo ucfirst($row['message_type']); ?></td>
   <td><?PHP echo substr(gmdate('r', $row['message_time']),0,-6); ?></td>
  </tr>
 <?PHP
  $i = 1 - $i;
 }

?>  
 </table>
</div>
