<?PHP

 require_once('lib/common.php');
 require_once('lib/database.php');
 require_once('lib/account.php');

 checkAccess(ADMIN);
 
 if (defined('ADMIN') && ADMIN) {
  $sql  = 'UPDATE sessions SET session_spoof = '.m($_GET['n']).' WHERE ';
  $sql .= 'session_ident = \''.m($_COOKIE['utdsid']).'\'';  
  mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  $sql = 'SELECT user_name FROM users WHERE user_id = '.m($_GET['n']);
  $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  $row = mysql_fetch_array($res);
  logger::log('Spoofing user '.$row['user_name'], logger::normal);
  header('Location: '.CP_PATH);
 } else {
  die('You\'re no admin!');
 }
 
?>
