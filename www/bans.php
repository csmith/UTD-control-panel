<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 
 define('TITLE', 'Admin - Ban management');

 addDashboardItem('Other admin tools', 'Overview', 'admin');
 addDashboardItem('Other admin tools', 'Sites', 'adminsites');
 addDashboardItem('Other admin tools', 'Reports', 'reports');
 addDashboardItem('Other admin tools', 'Discounts', 'discounts');
 addDashboardItem('External tools', 'Wiki', 'http://admin.utd-hosting.com/wiki'
);
 addDashboardItem('External tools', 'Service monitor', 'http://admin.utd-hostin
g.com/mon');
 addDashboardItem('External tools', 'Finances', 'http://admin.utd-hosting.com/f
inances');

 if (defined('ADMIN') && isset($_GET['n']) && ctype_digit($_GET['n'])) {
  $sql  = 'SELECT ipban_ip, ipban_expires FROM ipbans WHERE ipban_id = ';
  $sql .= $_GET['n'];
  $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  $row = mysql_fetch_array($res);
  logger::log('Expiring ban on '.$row['ipban_ip'].' (expirary: '.duration($row[
'ipban_expires'] - time()).'; id: '.$_GET['n'].')', logger::normal);
  $sql = 'UPDATE ipbans SET ipban_expires = 0 WHERE ipban_id = '.$_GET['n'];
  mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  header('Location: '.CP_PATH.'bans');
  exit;
 }
 if (defined('ADMIN') && isset($_POST['ip'])) {
  $sql  = 'INSERT INTO ipbans (ipban_ip, ipban_message, ipban_expires) VALUES ';
  $sql .= '(\''.m($_POST['ip']).'\', \''.m($_POST['reason']).'\', ';
  $sql .= strtotime($_POST['expirary']).')';
  logger::log('Placing ban on '.$_POST['ip'].' (reason: '.$_POST['reason'].'; expirary: '.duration(strtotime($_POST['expirary'])-time()).')', logger::normal);
  mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  header('Location: '.CP_PATH.'bans');
  exit;
 }

 
 require_once('lib/header.php');

 if (defined('ADMIN') && ADMIN) {
  require_once('pages/adminipbans.php');
  require_once('pages/adminaddipban.php');
 } else {
  define('ERROR', 'You\'re no admin!');
 }
 
 require_once('lib/footer.php');


?>
