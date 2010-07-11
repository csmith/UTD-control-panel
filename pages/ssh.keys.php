<?PHP
 require_once('lib/database.php');
 require_once('lib/common.php');
?>
<form action="<?PHP echo CP_PATH; ?>ssh" method="post">
<div class="block">
 <h2>My SSH Keys</h2>
 <table class="innerblock bottomdiv">
  <tr>
   <th>&nbsp;</th>
   <th>Comment</th>
   <th>Key</th>
  </tr>
<?PHP

 $i = 0;
 $n = 0; 
 
 $sql = 'SELECT key_id, key_comment, key_key FROM sshkeys WHERE user_id = '.UID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 
 if (mysql_num_rows($res) == 0) {
  echo '<tr><td colspan="3" style="font-style: italic; text-align: center;">';
  echo 'You have no SSH keys. Without a key you won\'t be able to access';
  echo ' UTD-Hosting SSH services. You may add a new key below.</td></tr>';
 }
 
 while ($row = mysql_fetch_array($res)) {
  $n++;
?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><input type="checkbox" name="key_<?PHP echo $row['key_id']; ?>"></td>
   <td><?PHP echo htmlentities($row['key_comment']); ?></td>
   <td style="font-family: monospace;">
    <?PHP echo htmlentities(substr($row['key_key'], 0, 25)); ?> &hellip;
    <?PHP echo htmlentities(substr($row['key_key'], -25, 25)); ?>
   </td>
  </tr>
<?PHP
   $i = 1 - $i;
 }

?>    
 </table>
 <div class="innerblock">
  <p>With selected:</p>
  <blockquote>
   <input type="submit" name="delete" value="Delete">
  </blockquote>
 </div>
</div>
</form>
