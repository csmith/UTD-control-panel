<?PHP

 require_once('lib/common.php');
 require_once('lib/profiler.php');
 require_once('lib/database.php');

 // Check IP bans
 $sql  = 'SELECT ipban_message, ipban_expires FROM ipbans WHERE ipban_ip = \'';
 $sql .= m($_SERVER['REMOTE_ADDR']).'\' AND ipban_expires > '.time();
 $res = mq($sql, __FILE__, __LINE__);
 
 if (mysql_num_rows($res) > 0) {
  if (!defined('FORBIDDEN')) {
   header('Location: '.CP_PATH.'403');
   exit;
  } else {
   $row = mysql_fetch_array($res);
   define('REASON', $row['ipban_message']);
   define('EXPIRES', $row['ipban_expires']);
  }
 }

 // Check to see if they're logged in
 if (!isset($_COOKIE['utdsid']) && !defined('NOLOGINREF')) {
  header('Location: '.CP_PATH.'login');
  exit;
 }
 
 // Prune old sessions
 $sql  = 'DELETE FROM sessions WHERE session_last < '.(time()-60*60);
 $sql .= ' OR session_start < '.(time()-60*60*24);
 mq($sql, __FILE__, __LINE__); 

 // Select the user's session
 $sql  = 'SELECT user_id, user_pass, user_name, user_admin, user_tac, ';
 $sql .= 'session_spoof FROM sessions NATURAL JOIN users WHERE session_ident ';
 $sql .= '= \''.m($_COOKIE['utdsid']).'\'';

 $res = mq($sql, __FILE__, __LINE__);

 // Make sure it exists
 if (mysql_num_rows($res) <> 1  && !defined('NOLOGINREF')) {
  header('Location: '.CP_PATH.'login');
  exit;
 } elseif (mysql_num_rows($res) == 1) {
  $row = mysql_fetch_array($res);

  // Read the first line of the T&C (the version number)
  $fh = fopen('/home/utd/common/tac.txt','r');
  $tac = trim(fgets($fh));
  fclose($fh);

  // Check they've agreed to it
  if ((int)$tac > (int)$row['user_tac'] && !defined('NOTACREF')) {
   header('Location: '.CP_PATH.'tac');
   exit;
  }
  
  // Check to see if it's an admin spoofing a user
  if ($row['session_spoof'] != '0' && $row['user_admin'] == '1') {
   $sql  = 'SELECT user_id, user_pass, user_name, user_admin, user_tac FROM ';
   $sql .= 'users WHERE user_id = '.m($row['session_spoof']);
   $res  = mq($sql, __FILE__, __LINE__);
   define('SPOOF', $row['user_id']);
   $row  = mysql_fetch_array($res);
  }

  // Define some nice constants
  define('USER', $row[2]);
  define('PASS', $row[1]);
  define('UID', $row[0]);
  define('TAC', $row[4]);
  if ($row[3] == '1') { define('ADMIN', True); }

  // Let's see what packages they have access to
  $sql  = 'SELECT package_type FROM userpackages NATURAL JOIN packages WHERE ';
  $sql .= 'user_id = '.UID.' AND up_active = 1';
  $res  = mq($sql, __FILE__, __LINE__);
  $packages = array('hosting'=>false,'dns'=>false,'backup'=>false,'ssh'=>false);
  while ($row = mysql_fetch_array($res)) {
   $packages[($row['package_type'])] = true;
  }
  foreach ($packages as $key=>$value) {
   define('HAS_'.strtoupper($key),$value);
  }
 }

 // Function to change a user's password
 function changePass ($uid, $newpass) {
  $sql = 'SELECT user_name FROM users WHERE user_id = '.m($uid);
  $res = mq($sql, __FILE__, __LINE__);
  $row = mysql_fetch_array($res);
  $uname = $row[0];

  $sql  = 'UPDATE users SET user_pass = \''.md5($uname.$newpass).'\' WHERE '; 
  $sql .= 'user_name = \''.m($uname).'\'';
  mq($sql) or mf(__FILE__, __LINE__, $sql);

  $sql  = 'SET PASSWORD FOR \''.m($uname).'\'@\'localhost\' = PASSWORD(\'';
  $sql .= md5($uname.$newpass).'\')';
  $l = mysql_connect('localhost', 'root', 'mysql32159');;
  mysql_select_db('admin', $l);
  mq($sql,$l) or mf(__FILE__, __LINE__, $sql);
  mysql_close($l);
  $_redodb = true; require('/home/utd/control/lib/database.php'); unset($_redodb);

  $sql  = 'INSERT INTO actions (user_id, action_type, action_value) VALUES (';
  $sql .= m($uid).', \'pass\', \''.m($newpass).'\')';
  mq($sql) or mf(__FILE__, __LINE__, $sql);
 }

 function addUser ($username, $email, $pass, $tac, $slots = 1) {
  if (!ctype_digit($slots) || $slots < 1 || $slots > 3) {
   $slots = 1;
  }

  $sql  = 'INSERT INTO users (user_name, user_pass, user_email, user_tac, ';
  $sql .= 'band_total, hdd_total) VALUES (\''.m($username).'\', \'invalid\'';
  $sql .= ', \''.m($email).'\', '.((int)$tac).', '.(50000000000*$slots).', ';
  $sql .= (3500000000*$slots).')';
  mq($sql) or mf(__FILE__, __LINE__, $sql);
  $uid = mysql_insert_id();

  $sql  = 'GRANT USAGE ON *.* TO \''.m($username).'\'@\'localhost\' IDENTIFIED';
  $sql .= 'BY \'dummypass123445\'';
  $l = mysql_connect('localhost', 'root', 'mysql32159');;
  mysql_select_db('admin', $l);
  mq($sql,$l) or mf(__FILE__, __LINE__, $sql);
  mysql_close($l);
  $_redodb = true; require('/home/utd/control/lib/database.php'); unset($_redodb);

  $fqdn = m($username.'.utd-hosting.com');

  $sql  = 'INSERT INTO domains (user_id, domain_name, domain_enabled, domain_parent) VALUES (';
  $sql .= (int)$uid.', \''.$fqdn.'\', 1, 16)';
  mq($sql) or mf(__FILE__, __LINE__, $sql);
  $domain = mysql_insert_id();

  $docroot = m('/home/'.$username.'/public_html');
  $sql  = 'INSERT INTO sites (user_id, site_name, site_docroot, ';
  $sql .= 'site_curdocroot) VALUES ('.(int)$uid.', \''.$fqdn;
  $sql .= '\', \''.$docroot.'\', \''.$docroot.'\')';
  mq($sql) or mf(__FILE__, __LINE__, $sql);
  $site = mysql_insert_id();

  $sql  = 'INSERT INTO records (domain_id, record_type, record_value) VALUES (';
  $sql .= (int)$domain.', \'UTD\', \''.(int)$site.'\')';
  mq($sql) or mf(__FILE__, __LINE__, $sql);

  $sql  = 'INSERT INTO billing (bill_due, user_id, bill_paid, bill_amount) ';
  $sql .= ' VALUES ('.time().', '.(int)$uid.', 1, '.(3500*$slots).')';
  mq($sql) or mf(__FILE__, __LINE__, $sql);

  $sql  = 'INSERT INTO actions (user_id, action_type, action_value) VALUES (';
  $sql .= (int)$uid.', \'create\', \'...\')';
  mq($sql) or mf(__FILE__, __LINE__, $sql);

  changePass($uid, $pass);
 }

 // Returns true if $pass is complex enough, or an error message if not
 function validPass ($pass) {
  if (preg_match('/[a-z]/',$pass)) {
   if (preg_match('/[A-Z]/',$pass)) {
    if (preg_match('/[0-9]/', $pass)) {
     if (strlen($pass) < 5 || strlen($pass) > 20) {
      return 'Please ensure your password is 5-20 characters long';
     } else {
      return true;
     }
    } else {
     return 'Please ensure your password includes some numbers';
    }
   } else {
    return 'Please ensure your password includes some uppercase letters';
   }
  } else {
   return 'Please ensure your password includes some lowercase letters';
  }
 }

 function checkAccess($conditions) {
  if ($conditions !== true) {
   define('REASON', 'Insufficient access'); 
   require('403.php');
   exit(); 
  }
 }
 
 define('LIB_ACCOUNT', true);

?>
