<?PHP
 require_once('lib/database.php');
?>
<div class="block">
 <h2>Users I've referred</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>User name</th>
   <th>Signup date</th>
  </tr>
<?PHP

 $i = 0;

 $sql = 'SELECT user_name, user_signup FROM users WHERE user_ref = '.UID; 
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

 if (mysql_num_rows($res) == 0) {
  echo '<tr><td colspan="3" style="font-style: italic; text-align: center;">No users referred</td></tr>';
 }
 
 while ($row = mysql_fetch_array($res)) {
?>
  <tr class="<?PHP echo ($i % 2 == 0) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $i+1; ?>.</td>
   <td><?PHP echo htmlspecialchars($row['user_name']); ?></td>
   <td><?PHP echo substr(gmdate('r', $row['user_signup']),0,-6); ?></td>
  </tr>
<?PHP
   $i++;
 }

?>    
 </table>
</div>
