<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 require_once('lib/database.php');

 checkAccess(HAS_HOSTING || HAS_DNS);

 function meep() {
  if (isset($_POST['action'])) {
   if ($_POST['action'] == 'deldom' && isset($_POST['domain']) && preg_match('/^[0-9]+$/',$_POST['domain'])) {
    $sql = 'SELECT user_id, domain_name FROM domains WHERE domain_id = '.$_POST['domain'];
    $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    if (mysql_num_rows($res) == 0) {
     define('MESSAGE', 'No such domain!');
     return;
    }
    $row = mysql_fetch_array($res);
    $dn = $row['domain_name'];
    if (!defined('ADMIN') && $row['user_id'] != UID) {
     define('MESSAGE', 'You do not control that domain.');
     return;
    }
    $sql = 'SELECT s.site_name FROM sites AS s, records AS r WHERE r.domain_id = '.m($_POST['domain']).' AND r.record_type = \'UTD\' AND s.site_id = r.record_value';
    $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    if (mysql_num_rows($res) > 0) {
     $row = mysql_fetch_array($res);
     define('MESSAGE', 'That domain is associated with the site '.$row['site_name'].' and thus cannot be deleted.');
     return;
    }

    $sql = 'SELECT domain_parent FROM domains WHERE domain_id = '.$_POST['domain'];
    $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    $row = mysql_fetch_assoc($res);

    $sql = 'UPDATE domains SET domain_parent = '.$row['domain_parent'].' WHERE';
    $sql .= ' domain_parent = '.$_POST['domain'];
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

    $sql = 'DELETE FROM domains WHERE domain_id = '.$_POST['domain'];
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

    $sql = 'DELETE FROM records WHERE domain_id = '.$_POST['domain'];
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

    define('MESSAGE', 'The domain \''.$dn.'\' has been deleted.');
    logger::log('Domain deleted: '.$dn,logger::information);    
   } elseif ($_POST['action'] == 'add' && isset($_POST['domain'])) {
    if (!preg_match('/^[a-z][a-z0-9\-\.]*\.[a-z]{2,}$/i', $_POST['domain'])) {
     define('MESSAGE', 'Invalid domain name. Must start with a letter and contain only letters, numbers, hyphens and periods.'); 
     return;
    } 

    $parts = explode('.', $_POST['domain']);
    $string = '';
    while (count($parts) > 0) {
     if ($string != '') { $string = '.'.$string; }
     $string = array_pop($parts).$string;
     $sql = 'SELECT domain_name FROM domains WHERE domain_name = \''.m(strtolower($string)).'\'';
     $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
     if (mysql_num_rows($res) > 0) {
      define('MESSAGE', 'That domain, or a parent domain, is already registered. Please contact UTD-Hosting support.');
      return;
     }
    }

    $sql  = 'INSERT INTO domains (user_id, domain_name, domain_enabled) VALUES ('.UID.', \'';
    $sql .= m($_POST['domain']).'\', 0)';
    $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

    logger::log('Added domain: '.$_POST['domain'],logger::information);

    // Hacky!
    $_POST['subject'] = 'New domain: '.$_POST['domain'];
    $_POST['body'] = 'The user has requested to have the domain name '.$_POST['domain'].' associated with their account.';
    require('doticket.php');
    exit;
    // Add ticket

   } elseif ($_POST['action'] == 'addsub' && isset($_POST['subdomain']) && isset($_POST['subdomaind'])) {
    if (!preg_match('/^[0-9]+$/',$_POST['subdomaind'])) { return; }

    $sql = 'SELECT user_id, domain_name, domain_enabled FROM domains WHERE domain_id = '.m($_POST['subdomaind']);
    $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    if (mysql_num_rows($res) == 0) {
     define('MESSAGE', 'Invalid domain');
     return;
    }
    $row = mysql_fetch_array($res);
    $dn = $row['domain_name'];
    if ($row['domain_enabled'] == '0') {
     define('MESSAGE', 'That domain hasn\'t been enabled yet.');
     return;
    }
    if (!defined('ADMIN') && $row['user_id'] != UID) {
     define('MESSAGE', 'You do not control that domain.');
     return;
    }
    if (!preg_match('/^[a-z][a-z0-9\-]*$/i', $_POST['subdomain'])) {
     define('MESSAGE', 'Invalid subdomain. Must start with a letter and contain only letters, numbers and \'-\'.');
     return;
    }
    $target = strtolower($_POST['subdomain'].'.'.$dn);
    $sql = 'SELECT domain_name FROM domains WHERE domain_name = \''.$target.'\'';
    $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    if (mysql_num_rows($res) != 0) {
     define('MESSAGE', 'That domain already exists!');
     return;
    }
    $sql = 'INSERT INTO domains (user_id, domain_name, domain_enabled';
    $sql .= ', domain_parent) VALUES ('.UID.',\''.$target.'\',1,'.m($_POST['subdomaind']).')';
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    logger::log('Added subdomain: '.$target, logger::information);
    define('MESSAGE', 'Added new domain \''.$target.'\''); 
   }
  }
 }

 meep();
 
 define('TITLE', 'Domains');

 addDashboardItem('Frequently asked questions', 'How do I register a domain name?', 'support/200');
 addDashboardItem('Useful links', 'Create a new site', 'addsite');
 
 require_once('lib/header.php');
 
 require_once('pages/domains.list.php');
 require_once('pages/domains.addsubdomain.php');
 require_once('pages/domains.adddomain.php');
 
 require_once('lib/footer.php');


?>
