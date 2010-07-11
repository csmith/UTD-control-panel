<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');

 checkAccess(HAS_HOSTING);

 if (isset($_POST['site'])) { $_GET['n'] = $_POST['site']; }

 $errors = array();

 function foo () {
  global $errors;

  if (!isset($_POST['task'])) { return; }

  if (isset($_POST['site']) && preg_match('/^[0-9]+$/', $_POST['site'])) {
   $sql  = 'SELECT user_name, users.user_id FROM sites NATURAL JOIN users ';
   $sql .= 'WHERE site_id = '.$_POST['site'];
   $res  = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   $row  = mysql_fetch_array($res);

   if ($row['user_id'] != UID && !defined('ADMIN')) {
    $errors[] = 'You do not control that site.';
    return;
   }

   if ($row['user_id'] != UID && defined('ADMIN') && ADMIN) {
    define('SUID', $row['user_id']);
    define('SUSER', $row['user_name']);
   }

   if ($_POST['task'] == 'domains') {
    $sql  = 'DELETE FROM records WHERE record_type = \'UTD\' AND ';
    $sql .= 'record_value = '.$_POST['site'];
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

    foreach ($_POST as $key => $val) {
     if (substr($key,0,6) == 'domain') {
      $dom = (int)substr($key,6);
      $sql = 'SELECT domain_name, user_id FROM domains WHERE domain_id = '.$dom;
      $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
      $row = mysql_fetch_array($res);

      if ($row['user_id'] != UID && !defined('ADMIN')) {
       $errors[] = 'You do not control the domain \''.$row['domain_name'].'\'';
       continue;
      }

      $sql = 'SELECT * FROM records WHERE record_type = \'UTD\' AND domain_id = '.$dom;
      $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
      if (mysql_num_rows($res) > 0) {
       $errors[] = 'The domain \''.$row['domain_name'].'\' is already associated with another site.';
       continue;
      }

      $sql = 'INSERT INTO records (domain_id, record_type, record_value) VALUES ('.$dom.', \'UTD\', \''.$_POST['site'].'\')';
      mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
     }
    } 

    $sql  = 'INSERT INTO actions (user_id, action_type, action_value) VALUES (';
    $sql .= UID . ', \'updateconf\', \'bind\')';
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

   } elseif ($_POST['task'] == 'webserver') {
    $update = false;

    $sql  = 'SELECT site_php, site_index, site_htaccess FROM sites';
    $sql .= ' WHERE site_id = ' . $_POST['site'];
    $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    $row = mysql_fetch_assoc($res);

    if ($row['site_php'] != $_POST['phpversion']) {
     $update = true;
     $sql  = 'UPDATE sites SET site_php = \''. m($_POST['phpversion']);
     $sql .= '\' WHERE site_id = ' . $_POST['site'];
     mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    }

    $index = isset($_POST['index']) ? '1' : '0';
    $htaccess = isset($_POST['htaccess']) ? '1': '0';
 
    if ($row['site_index'] != $index || $row['site_htaccess'] != $htaccess) {
     $update = true;
     $sql  = 'UPDATE sites SET site_index = '.$index.', site_htaccess = ';
     $sql .= $htaccess.' WHERE site_id = '.$_POST['site'];
     mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    }

    if ($update) {
     $sql  = 'INSERT INTO actions (user_id, action_type, action_value) ';
     $sql .= 'VALUES (' . UID . ', \'updateconf\', \'apache\')';
     mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    }
   } else {
    return;
   }
  }
 }

 foo();

 if (count($errors) > 0) {
  $error = 'The following errors were encountered:<ul><li>'.implode('<li>',$errors).'</ul>';
  define('TITLE', 'Error');
 } elseif (!isset($_GET['n']) || !preg_match('/^[0-9]+$/',$_GET['n'])) {
   $error = 'Invalid site ID!';
   define('TITLE', 'Error');
 } else {
   $site = $_GET['n'];
   $sql = 'SELECT site_id, users.user_id, user_name,  site_name, site_docroot FROM sites NATURAL JOIN users WHERE site_id = '.$site;
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   
   if (mysql_num_rows($res) == 0) {
     $error = 'There is no such site with that ID.';
     define('TITLE', 'Error');
   } else {
   
    $row = mysql_fetch_array($res);
   
    if ($row['user_id'] != UID && !defined('ADMIN')) {
	  $error = 'You do not own this site.';
	  define('TITLE', 'Error');
    } else {
     if ($row['user_id'] != UID && defined('ADMIN') && ADMIN) {
      define('SUID', $row['user_id']);
      define('SUSER', $row['user_name']);
     }

      define('SITE_ID', $row['site_id']);
      define('SITE_NAME', $row['site_name']);
      define('SITE_DOCROOT', $row['site_docroot']);
      define('TITLE', 'Edit site: '.$row['site_name']);
    }
   }
 } 
 
 addDashboardItem('Useful links', 'Support center', 'support');
 addDashboardItem('Useful links', 'Site overview', 'sites');
  
 addDashboardItem('Frequently asked questions', 'What do I do if my site isn\'t working?', 'support/002');
 addDashboardItem('Frequently asked questions', 'What does \'document root\' mean?', 'support/015');
 addDashboardItem('Frequently asked questions', 'What does KiB/MiB/GiB mean?', 'support/003');
 addDashboardItem('Frequently asked questions', 'How do I configure PHP for my site?', 'support/001');

 if (isset($error)) {
  define('MESSAGE', $error);
 }

 require_once('lib/header.php');

 if (!defined('SUSER')) { define('SUSER', USER); define('SUID', UID); }
 
 if (!isset($error)) {
  require_once('pages/editsite.overview.php');
  require_once('pages/editsite.webserver.php');
  require_once('pages/editsite.domains.php');
  require_once('pages/editsite.errors.php');
 }
 
 require_once('lib/footer.php');

?>
