<?PHP
 require_once('lib/database.php'); 
 require_once('lib/common.php'); 
?>
<div class="block">
<form action="<?PHP echo CP_PATH; ?>database" method="post">
<input type="hidden" name="action" value="edituser">
 <h2>MySQL user accounts</h2>
 <table class="innerblock bottomdiv">
  <tr>
   <th>&nbsp;</th>
   <th>Name</th>
   <th>Host</th>
   <th></th>
  </tr>
<?PHP

 $i = 0;
 
 $sql  = 'SELECT dbuser_id, dbuser_name FROM db_users WHERE user_id = '.UID;
 $sql .= ' ORDER BY dbuser_name';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 
 while ($row = mysql_fetch_array($res)) {
?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><input type="checkbox" name="user<?PHP echo $row['dbuser_id']; ?>" id="user<?PHP echo $row['dbuser_id']; ?>"<?PHP if (isset($_POST['userdelete'])) { if(isset($_POST['user'.$row['dbuser_id']])) { echo ' checked="checked"'; }; echo ' disabled="disabled"'; } ?>>
   <td><?PHP echo $row['dbuser_name']; ?></td>
   <td>localhost</td>
<?PHP if (isset($_POST['userdelete']) && isset($_POST['user'.$row['dbuser_id']])) { ?>
   <input type="hidden" name="user<?PHP echo $row['dbuser_id']; ?>" value="delete">
   <td style="color: red;">This user will be deleted</td>
<?PHP } else { ?>
    <td></td>
<?PHP } ?>
  </tr>
<?PHP
   $i = 1 - $i;
 }

?>    
 </table>
 <div class="innerblock">
  <p>With selected:</p>
  <blockquote>
<?PHP if (isset($_POST['userdelete']) && !isset($_POST['confirm'])) { ?>
   <input type="hidden" name="confirm" value="confirm">
   <input type="submit" name="userdelete" value="Confirm deletion">
   <input type="submit" name="cancel" value="Cancel">
<?PHP } else { ?>
   <input type="submit" name="userdelete" value="Delete"><!--<span style="margin: 0px 20px;">or</span>
   <input type="password" name="pass"><input type="submit" name="cpass" value="Change password">-->
<?PHP } ?>
  </blockquote>
 </div>
 </form>
 <div class="innerblock" style="margin-top: 0px; padding-top: 0px;">
 <form action="<?PHP echo CP_PATH; ?>database" method="post">
  <input type="hidden" name="action" value="adduser">
  <p>Add new user:</p>
  <blockquote>
  <label for="dbuser">Username:</label>
  <?PHP echo USER; ?>_<input type="text" name="dbuser">
  <label for="dbpass">Password:</label>
  <input type="password" name="dbpass">
  <input type="submit" value="Add">
  </blockquote>
 </form>
 </div>
</div>
