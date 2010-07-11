<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');
 require_once('lib/account.php');

 checkAccess(HAS_HOSTING);
 
 define('TITLE', 'Add site');
 
 addDashboardItem('Useful links', 'Support center', 'support');
  
 function meep () {
  if (!isset($_POST['docroot']) || !isset($_POST['domain'])) {
   return;
  }
  if (!ctype_digit($_POST['domain'])) {
   define('MESSAGE', 'Invalid domain name');
   return;
  }
  $path = '/home/'.USER.'/'.$_POST['docroot'];
  $path = preg_replace('#/(.*?)/\.\./#','/',$path);
  $path = preg_replace('#//+#','/',$path);
  $path = preg_replace('#/\./#', '/', $path);
  if (substr($path, 0, strlen('/home/'.USER.'/')) != '/home/'.USER.'/') {
   logger::log('Potential attack; attempted to create site with doc root "'.$_POST['docroot'].'"',logger::normal);
   define('MESSAGE', 'Invalid document root');
   return;
  }
  if (substr($path,-1) == '/') { $path = substr($path,0,-1); }
  $sql = 'SELECT user_id, domain_name FROM domains WHERE domain_id = '.m($_POST['domain']);
  $res = mq($sql, __FILE__, __LINE__);
  if (mysql_num_rows($res) == 0) {
   define('MESSAGE', 'No such domain name');
   return;
  }
  $row = mysql_fetch_array($res);
  if ($row['user_id'] != UID) {
   logger::log('Potential attack; attempted to create site with domain name "'.$row['domain_name'].'" (belongs to another user)', logger::normal);
   define('MESSAGE', 'No such domain name');
   return;
  }
  $sql = 'SELECT record_value FROM records WHERE domain_id = '.m($_POST['domain']).' AND record_type = \'UTD\'';
  $re2 = mq($sql, __FILE__, __LINE__);
  if (mysql_num_rows($re2) > 0) {
   define('MESSAGE', 'Domain name is already associated with another site.');
   return;
  }
  $sql = 'INSERT INTO sites (user_id, site_name, site_docroot, site_curdocroot) VALUES ('.UID.', \''.m($row['domain_name']).'\',\''.m($path).'\',\''.m($path).'\')';
  $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  $id = mysql_insert_id();
  $sql = 'INSERT INTO records (record_type, domain_id, record_value) VALUES (\'UTD\', '.m($_POST['domain']).', \''.m($id).'\')';
  mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

  $sql  = 'INSERT INTO actions (user_id, action_type, action_value) VALUES (';
  $sql .= UID . ', \'updateconf\', \'bind\')';
  mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

  logger::log('Added site: '.$row['domain_name'].' ['.$path.']', logger::info);
  header('Location: '.CP_PATH.'editsite/'.$id);
  exit;
 }

 meep();


 require_once('lib/header.php');
 
 require_once('pages/addsite.php');
 
 require_once('lib/footer.php');


?>
