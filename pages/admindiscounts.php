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
   <th>Message</th>
  </tr>
<?PHP

 $i = 0;

 $sql = 'SELECT u.user_name, l.* FROM log AS l, users AS u WHERE u.user_id = l.user_id ORDER BY l.log_time DESC LIMIT 0,20';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 while ($row = mysql_fetch_array($res)) {
  echo '<tr class="'.(($i != 0) ? 'odd':'even').'"><td>'.gmdate('r',$row['log_time']).'</td><td><a href="'.CP_PATH.'checkuser/'.$row['user_id'].'">';
  echo $row['user_name'].'</a></td><td>'. $row['log_message'].'</td></tr>';

  $i = 1 - $i;
 }

?>    
 </table>
</div>
