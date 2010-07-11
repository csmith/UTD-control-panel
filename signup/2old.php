<?PHP

 if (isset($_POST['back'])) {
  $_SESSION['stage'] = 1;
  header('Location: /signup/1');
  exit;
 }

 if (isset($_POST['user']) && isset($_POST['pass'])) {
  require_once('../control/lib/database.php');
  $pass = md5($_POST['user'].$_POST['pass']);
  $user = mysql_real_escape_string($_POST['user']);
  $sql = 'SELECT user_id FROM users WHERE user_name = \''.$user.'\' AND user_pass = \''.$pass.'\'';
  $res = mysql_query($sql);
  if (mysql_num_rows($res) != 1) {
   echo '<div id="message">Invalid username or password</div>';
  } else {
   $row = mysql_fetch_array($res);
   $_SESSION['UID'] = $row[0];
   $_SESSION['stage'] = 3;
   header('Location: /signup/3');
   exit;
  }
 }


?>
<p>
 Please enter your existing UTD-Hosting username and password.
</p>
<form action="/signup/2" method="post">
<table style="margin-bottom: 20px;">
 <tr>
  <th>Username:</th>
  <td><input type="text" name="user"<?PHP if (isset($_POST['user'])) { echo ' value="'.htmlentities($_POST['user']).'"'; } ?>></td>
 </tr>
 <tr>
  <th>Password:</th>
  <td><input type="password" name="pass"></td>
 </tr>
</table>
<input type="submit" name="forward" value="Next" style="float: right;">
</form>
<form action="/signup/2" method="post">
 <input type="submit" name="back" value="Previous">
</form>
