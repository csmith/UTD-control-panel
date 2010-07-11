<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');

 checkAccess(ADMIN);
 
 define('TITLE', 'Admin - Ban management');

 if (isset($_GET['n']) && ctype_digit($_GET['n'])) {
  $sql  = 'SELECT ipban_ip, ipban_expires FROM ipbans WHERE ipban_id = ';
  $sql .= $_GET['n'];
  $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  $row = mysql_fetch_array($res);
  logger::log('Expiring ban on '.$row['ipban_ip'].' (expirary: '.duration($row[
'ipban_expires'] - time()).'; id: '.$_GET['n'].')', logger::normal);
  $sql = 'UPDATE ipbans SET ipban_expires = 0 WHERE ipban_id = '.$_GET['n'];
  mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  header('Location: '.CP_PATH.'adminbans');
  exit;
 }

 if (isset($_GET['d']) && ctype_digit($_GET['d'])) {
  $sql  = 'SELECT ipban_ip, ipban_expires FROM ipbans WHERE ipban_id = ';
  $sql .= $_GET['d'];
  $res  = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  $row  = mysql_fetch_assoc($res);

  logger::log('Deleting ban on '.$row['ipban_ip'].' (expirary: '.duration($row['ipban_expires'] - time(), true).'; id: '.$_GET['d'].')', logger::normal);

  $sql = 'DELETE FROM ipbans WHERE ipban_id = ' . $_GET['d'];
  $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  header('Location: '.CP_PATH.'adminbans');
  exit;
 }

 if (isset($_POST['ip'])) {
  $sql  = 'INSERT INTO ipbans (ipban_ip, ipban_message, ipban_expires) VALUES ';
  $sql .= '(\''.m($_POST['ip']).'\', \''.m($_POST['reason']).'\', ';
  $sql .= strtotime($_POST['expirary']).')';
  logger::log('Placing ban on '.$_POST['ip'].' (reason: '.$_POST['reason'].'; expirary: '.duration(strtotime($_POST['expirary'])-time()).')', logger::normal);
  mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  header('Location: '.CP_PATH.'adminbans');
  exit;
 }

 require_once('admin.menu.php');
 require_once('lib/header.php');

 require_once('pages/admin.ipbans.php');
 require_once('pages/admin.addipban.php');
 require_once('pages/admin.userbans.php');
 
 require_once('lib/footer.php');


?>
