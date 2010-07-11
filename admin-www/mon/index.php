<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 require_once('lib/database.php');
 
 define('TITLE', 'Service monitoring');

 if (isset($_GET['silence']) && isset($_GET['serv']) && isset($_GET['svc'])) {
  mysql_query('UPDATE servserv SET ss_silenced = 1 WHERE server_id = '.$_GET['serv'].' AND service_id = '.$_GET['svc']);
  define('MESSAGE', 'Service silenced.');
 }

 require_once('lib/header.php');
 
 require_once('pages/servers.php');
 require_once('pages/status.php');
 
 require_once('lib/footer.php');


?>
