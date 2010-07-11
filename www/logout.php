<?PHP
 
 define('NOLOGINREF', true); // So we don't go round in circles
 define('NOTACREF', true);

 require_once('lib/common.php');
 require_once('lib/database.php');
 require_once('lib/account.php');

 if (defined('SPOOF')) {
  $sql  = 'UPDATE sessions SET session_spoof = 0 WHERE session_ident = \'';
  $sql .= m($_COOKIE['utdsid']).'\'';
  mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  logger::log('Stopped spoofing user '.USER, logger::normal, SPOOF);
  header('Location: '.CP_PATH);
  exit;
 } else {
  logger::log('Manual logout',logger::info);
  setcookie('utdsid','', time()-24*24*60, '/');
  header('Location: '.CP_PATH.'login');
  exit;
 }
 
?>
