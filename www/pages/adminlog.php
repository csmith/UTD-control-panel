<?PHP
 if (!defined('LIB_DATABASE')) { require_once('lib/database.php'); }
 if (!defined('LIB_COMMON')) { require_once('lib/common.php'); }
 if (!defined('ADMIN') || !ADMIN) { die('Admins only'); }
?>
<div class="block" id="log">
 <h2>ADMIN: Control panel log</h2>
 <table class="innerblock">
  <tr>
   <th>Time</th>
   <th>User</th>
   <th>Level</th>
   <th>Message</th>
  </tr>
<?PHP

 $i = 0;

 $sql  = 'SELECT user_id, user_name, log_level, log_time, log_message FROM log ';
 $sql .= 'NATURAL JOIN users ORDER BY log_time DESC LIMIT 0,25';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 while ($row = mysql_fetch_array($res)) {
  echo '<tr class="'.(($i != 0) ? 'odd':'even').'"><td>'.gmdate('r',$row['log_time']).'</td><td><a href="'.CP_PATH.'checkuser/'.$row['user_id'].'">';
  echo $row['user_name'].'</a></td>';
  
   switch($row['log_level']) {
  case 'critical':
   echo '<td style="color: red; font-weight: bold;">Critical</td>';
   break;
  case 'important':
   echo '<td style="font-weight: bold;">Important</td>';
   break;
  case 'normal':
  case 'unknown':
   echo '<td>'.ucfirst($row['log_level']).'</td>';
   break;
  case 'info':
   echo '<td style="color: gray">Information</td>';
 }
  
  echo '<td>'. $row['log_message'].'</td></tr>';

  $i = 1 - $i;
 }

?>
 </table>
</div>
