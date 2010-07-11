<?PHP

 if (isset($_POST['back'])) {
  $_SESSION['stage'] = 1;
  header('Location: /signup/1');
  exit;
 }

 if (isset($_SESSION['data']) && !isset($_POST['user'])) {
  $_POST = $_SESSION['data'];
 }

 function moo() {
  if (!isset($_POST['user'])) {
   return;
  }
  if (!ctype_alnum($_POST['user'])) {
   echo '<div id="message">Please choose a username that only contains letters and/or numbers.</div>';
   return;
  }
  if (!isset($_POST['pass1']) || !isset($_POST['pass2'])) {
   echo '<div id="message">Please enter a password.</div>';
   return;
  }
  if (($err = validPass($_POST['pass1'])) !== true) {
   echo '<div id="message">'.$err.'</div>';
   return;
  }
  if ($_POST['pass1'] != $_POST['pass2']) {
   echo '<div id="message">Passwords do not match. Please confirm your password.</div>'; 
   return;
  }
  if (strlen($_POST['name']) < 5 || strpos($_POST['name'],' ') === false) {
   echo '<div id="message">Please enter your full name.</div>';
   return;
  }
  if (empty($_POST['email']) || !preg_match('/^[^@]+@([^\.@:\[\]\(\)]+\.)+[a-z]{2,}$/i', $_POST['email'])) {
   echo '<div id="message">Please enter a valid e-mail address.</div>';
   return;
  }
 
  require_once('../control/lib/database.php');

  $sql = 'SELECT bu_name FROM banneduser';
  $res = mysql_query($sql);
  while ($row = mysql_fetch_array($res)) {
   $nick = $row[0];
   if (strpos(strtolower($_POST['user']), strtolower($nick)) !== false) {
    echo '<div id="message">That username is not permitted. Please chose another.</div>';
    return;
   }
  }

  $sql = 'SELECT user_id FROM users WHERE LCASE(user_name) = \''.mysql_real_escape_string(strtolower($_POST['user'])).'\'';
  $res = mysql_query($sql);
  if (mysql_num_rows($res) > 0) {
   echo '<div id="message">That username is in use. Please select another.</div>';
   return;
  }

  if (isset($_POST['proceed'])) {
   unset($_POST['proceed']);
   $_SESSION['data'] = $_POST; 
   $_SESSION['stage'] = 3;
   header('Location: /signup/3');
   exit;
  }

 }

 moo();


?>
<p>
 Your username and password will be the ones you use to log in to the control
 panel and FTP. Your password should be between 5 and 20 characters, and contain
 at least one upper case letter, one lower case letter, and one number.
</p>
<form action="/signup/2" method="post">
<input type="hidden" name="proceed" value="...">
<table>
 <tr>
  <th>Username:</th>
  <td><input type="text" name="user"<?PHP if (isset($_POST['user'])) { echo ' value="'.htmlentities($_POST['user']).'"'; } ?>></td>
 </tr>
 <tr>
  <th>Password:</th>
  <td><input type="password" name="pass1"<?PHP if (isset($_POST['pass1'])) { echo ' value="'.htmlentities($_POST['pass1']).'"'; } ?>></td>
 </tr>
 <tr>
  <th>Confirm password:</th>
  <td><input type="password" name="pass2"<?PHP if (isset($_POST['pass2'])) { echo ' value="'.htmlentities($_POST['pass2']).'"'; } ?>></td>
 </tr>
</table>
<p>
 The following basic contact information is required.
</p>
<table>
 <tr>
  <th>Full name:</th>
  <td><input type="text" name="name"<?PHP if (isset($_POST['name'])) { echo ' value="'.htmlentities($_POST['name']).'"'; } ?>></td>
 </tr>
 <tr>
  <th>E-mail address:</th>
  <td><input type="text" name="email"<?PHP if (isset($_POST['email'])) { echo ' value="'.htmlentities($_POST['email']).'"'; } ?>></td>
 </tr>
</table>
<p>
 Optional extended contact details.
</p>
<table style="margin-bottom: 10px;">
 <tr>
  <th>Telephone:</th>
  <td><input type="text" name="phone"<?PHP if (isset($_POST['phone'])) { echo ' value="'.htmlentities($_POST['phone']).'"'; } ?>></td>
 </tr>
 <tr>
  <th>Address:</th>
  <td><input type="text" name="addr"<?PHP if (isset($_POST['addr'])) { echo '
value="'.htmlentities($_POST['addr']).'"'; } ?>></td>
 </tr>
</table>
<p>
 Your personal information will be stored on this server (which is located in
 the United States of America), will not be disclosed to any third parties
 unless required by law,
 and will only be used by UTD-Hosting to contact you with regard to matters
 directly concerning your UTD-Hosting account. All resonable actions will be undertaken to safeguard this data from external access.
 If you do not agree to this,
 please discontinue the signup process.
</p>
<input type="submit" name="forward" value="Next" style="float: right;">
</form>
<form action="/signup/2" method="post">
 <input type="submit" name="back" value="Previous">
</form>
