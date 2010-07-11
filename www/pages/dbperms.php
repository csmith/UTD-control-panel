<?PHP
 require_once('lib/database.php'); 
 require_once('lib/common.php'); 
?>
<div class="block">
 <h2>Database permissions</h2>
<form action="<?PHP echo CP_PATH; ?>database" method="post">
 <input type="hidden" name="action" value="perms">
 <table class="innerblock bottomdiv">
  <tr>
   <th>Database \ User</th>
<?PHP

 $sql = 'SELECT dbuser_id, dbuser_name FROM db_users WHERE user_id = '.UID.' ORDER BY dbuser_name';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 $users = array();
 while ($row = mysql_fetch_array($res)) {
  $users[] = $row[0];
  echo '<th>'.h(preg_replace('/^[^_]*_/','',$row[1])).'</th>';
 }

 $sql = 'SELECT db_perms.dbuser_id, db_id FROM db_perms NATURAL JOIN db_users WHERE user_id = '.UID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 $perms = array();
 while ($row = mysql_fetch_array($res)) {
  if (!isset($perms[($row[0])])) { $perms[($row[0])] = array(); }
  $perms[($row[0])][($row[1])] = true;
 }

?>
  </tr>
<?PHP

 $i = 0;
 
 $sql = 'SELECT db_id, db_name FROM db_dbs WHERE user_id = '.UID.' ORDER BY db_name';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql); 
 
 while ($row = mysql_fetch_array($res)) {
?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><?PHP echo h($row[1]); ?></td>
<?PHP
 foreach ($users as $uid) {
   echo '<td><input type="checkbox" name="dbp_'.$row['db_id'].'_'.$uid.'"';
   if (isset($perms[$uid][($row['db_id'])])) {
    echo ' checked="checked"';
   }
   echo '></td>';
 }
?>
  </tr>
<?PHP
   $i = 1 - $i;
 }

?>    
 </table>
 <div class="innerblock">
  <input type="submit" value="Update">
 </div>
 </form>
</div>
