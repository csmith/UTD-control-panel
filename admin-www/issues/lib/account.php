<?php
$authInfo = base64_decode(substr($_SERVER["REDIRECT_REMOTE_USER"],6));
unset($_SERVER['REDIRECT_REMOTE_USER']);
if ($authInfo != "") {
list($user, $password) = explode(':', $authInfo);
$_SERVER['REDIRECT_REMOTE_USER'] = $user;
$_SERVER['PHP_AUTH_PW'] = $password;
}
while (!isset($_SERVER['REDIRECT_REMOTE_USER']) || $_SERVER['REDIRECT_REMOTE_USER'] == "" ) {
 if ( (strlen($authInfo) == 0) || ( strcasecmp($authInfo, ":" )  == 0 )) {
  header('WWW-Authenticate: Basic realm="UTD-Hosting"');
  header('HTTP/1.0 401 Unauthorized');
  die('<div class="block">Authorisation failed.</div>');
  return;
 } else {
 $sql = 'SELECT user_name FROM users
   WHERE user_name = \''.m($_SERVER['REDIRECT_REMOTE_USER']).'\'
   AND user_pass = \''.m(md5($_SERVER['REDIRECT_REMOTE_USER'].$_SERVER['PHP_AUTH_PW'])).'\' AND user_admin = 1';
 $res = mysql_query($sql) or die(mysql_error());
 if (mysql_num_rows($res) > 0) {
   $result = mysql_fetch_assoc($res);
 }
 }
}
?>