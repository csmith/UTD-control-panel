<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');
 require_once('lib/account.php');

 checkAccess(HAS_HOSTING);

 if (isset($_POST['action'])) {
  if ($_POST['action'] == 'adduser' && isset($_POST['dbuser']) && isset($_POST['dbpass'])) {
   if (strlen(USER.'_'.$_POST['dbuser']) <= 16) {
    $sql = 'INSERT INTO db_users (user_id, dbuser_name) VALUES ('.UID.', \'';
    $sql .= USER.'_'.m($_POST['dbuser']).'\')';
    $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    if (mysql_affected_rows() > 0) {
     //GRANT USAGE ON * . * TO 'test'@'localhost' IDENTIFIED BY '***' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 ;
     logger::log('Database user created: '.$_POST['dbuser'],logger::info);
     $sql = 'GRANT USAGE ON *.* to \''.USER.'_';
     $sql .= m($_POST['dbuser']).'\'@\'localhost\'';
     $sql .= ' IDENTIFIED BY \''.m($_POST['dbpass']).'\'';
     $sql .= ' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0';
     $sql .= ' MAX_UPDATES_PER_HOUR 0';
     $l = mysql_connect('localhost', 'root', 'mysql32159');;
     mysql_select_db('admin', $l);
     mysql_query($sql,$l) or mf(__FILE__, __LINE__, $sql);
     mysql_close($l);
     $_redodb = true; require('lib/database.php'); unset($_redodb);
    } else {
     define('MESSAGE', 'Unable to add. Please raise a ticket.');
    }
   } else {
    define('MESSAGE', 'The total length of MySQL usernames (including \''.USER.'_\') must be sixteen characters or under.');
   }
  } elseif ($_POST['action'] == 'adddb' && isset($_POST['newdb'])) {
   $sql = 'INSERT INTO db_dbs (user_id, db_name) VALUES ('.UID.', \'';
   $sql .= USER.'_'.m($_POST['newdb']).'\')';
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   if (mysql_affected_rows() > 0) {
    //GRANT ALL PRIVILEGES ON `admin` . * TO 'md87'@'localhost' WITH GRANT OPTION ;
    logger::log('Database created: '.$_POST['newdb'], logger::info);
    $sql = 'CREATE DATABASE `'.USER.'_'.m($_POST['newdb']).'`';
    $l = mysql_connect('localhost', 'root', 'mysql32159');;
    mysql_select_db('admin', $l);
    mysql_query($sql,$l) or mf(__FILE__, __LINE__, $sql);
    $sql = 'GRANT ALL PRIVILEGES ON `'.USER.'_'.m($_POST['newdb']).'`.* TO \''.USER.'\'@\'localhost\'';
    mysql_query($sql,$l) or mf(__FILE__, __LINE__, $sql);
    mysql_close($l);
    $_redodb = true; require('lib/database.php'); unset($_redodb);
   } else {
    define('MESSAGE', 'Unable to add. Please raise a ticket.');
   }
  } elseif ($_POST['action'] == 'perms') {
   $sql = 'SELECT dbuser_id, dbuser_name FROM db_users WHERE user_id = '.UID;
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   $users = array();
   while ($row = mysql_fetch_array($res)) {
    $users[($row[0])] = $row[1];
   }
   $sql = 'SELECT db_id, db_name FROM db_dbs WHERE user_id = '.UID;
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   $dbs = array();
   while ($row = mysql_fetch_array($res)) {
    $dbs[($row[0])] = str_replace('_','\_',$row[1]);
   }
   $sql = 'SELECT db_perms.dbuser_id, db_id FROM db_perms NATURAL JOIN db_users WHERE user_id = '.UID;
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   $perms = array();
   while ($row = mysql_fetch_array($res)) {
    if (!isset($perms[($row[0])])) { $perms[($row[0])] = array(); }
    $perms[($row[0])][($row[1])] = true;
   }
   $remove = $perms; $add = array();
   foreach ($_POST as $k => $v) {
    if ($v != 'on' && $v != 'checked') { continue; }
    $bits = explode('_', $k);
    if ($bits[0] != 'dbp') { continue; }
    if (!isset($dbs[($bits[1])])) { continue; }
    if (!isset($users[($bits[2])])) { continue; }
    if (isset($remove[($bits[2])][($bits[1])])) {
     unset($remove[($bits[2])][($bits[1])]);
    } else {
     if (!isset($add[($bits[2])])) { $add[($bits[2])] = array(); }
     $add[($bits[2])][($bits[1])] = true;
    }
   }
   $l = mysql_connect('localhost', 'root', 'mysql32159');;
   mysql_select_db('admin', $l);
   mysql_query($sql,$l) or mf(__FILE__, __LINE__, $sql);

   foreach ($remove as $user => $dat) {
    foreach ($dat as $db => $true) {
     $sql = 'DELETE FROM db_perms WHERE dbuser_id = '.$user.' AND db_id = '.$db;
     mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
     $sql = 'REVOKE ALL PRIVILEGES ON `'.$dbs[$db].'`.* FROM \''.$users[$user].'\'@\'localhost\'';
     mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
     logger::log('Revoked db permission: '.$users[$user].' on '.$dbs[$db],logger::info);
    }
   }

   foreach ($add as $user => $dat) {
    foreach ($dat as $db => $true) {
     $sql = 'INSERT INTO db_perms (dbuser_id, db_id) VALUES ('.$user.', '.$db.')';
     mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
     $sql = 'GRANT ALL PRIVILEGES ON `'.$dbs[$db].'`.* TO \''.$users[$user].'\'@\'localhost\'';
     mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
     logger::log('Added db permission: '.$users[$user].' on '.$dbs[$db], logger::info);
    }
   } 

   mysql_close($l);
   $_redodb = true; require('lib/database.php'); unset($_redodb);
   header('Location: '.CP_PATH.'database');
   exit;
  }
 }

 if (isset($_POST['delete'])) {
  if (isset($_POST['confirm'])) {
   $sql = 'SELECT db_id, db_name FROM db_dbs WHERE user_id = '.UID.' AND (0';
   foreach ($_POST as $k => $v) {
    if (substr($k,0,2) == 'db' && ctype_digit(substr($k,2))) {
     $sql .= ' OR db_id = '.m(substr($k,2));
    }
   }
   $sql .= ')';
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   $targets = array();
   while ($row = mysql_fetch_array($res)) {
    $sql = 'DELETE FROM db_perms WHERE db_id = '.$row['db_id'];
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    $sql = 'DELETE FROM db_dbs WHERE db_id = '.$row['db_id'];
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    logger::log('Deleted MySQL database: '.$row['db_name'], logger::info);
    $targets[] = $row['db_name'];
   }
   $l = mysql_connect('localhost', 'root', 'mysql32159');;
   mysql_select_db('admin', $l);
   foreach ($targets as $db) {
    $sql = 'DROP DATABASE `'.m($db).'`'; 
    mysql_query($sql,$l) or mf(__FILE__, __LINE__, $sql);
   }
   mysql_close($l);
   $_redodb = true; require('lib/database.php'); unset($_redodb);
   header('Location: '.CP_PATH.'database');
   exit;
  } else {
   define('MESSAGE', 'Please confirm database deletion');
  }
 } elseif (isset($_POST['userdelete'])) {
  if (isset($_POST['confirm'])) {
   $sql = 'SELECT dbuser_id, dbuser_name FROM db_users WHERE user_id = '.UID.' AND (0';
   foreach ($_POST as $k => $v) {
    if (substr($k,0,4) == 'user' && ctype_digit(substr($k,4))) {
     $sql .= ' OR dbuser_id = '.m(substr($k,4));
    }
   }
   $sql .= ')';
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   $targets = array();
   while ($row = mysql_fetch_array($res)) {
    $sql = 'DELETE FROM db_perms WHERE dbuser_id = '.$row['dbuser_id'];
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    $sql = 'DELETE FROM db_users WHERE dbuser_id = '.$row['dbuser_id'];
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    logger::log('Deleted MySQL user: '.$row['dbuser_name'], logger::info);
    $targets[] = $row['dbuser_name'];
   }
   $l = mysql_connect('localhost', 'root', 'mysql32159');;
   mysql_select_db('admin', $l);
   foreach ($targets as $db) {
    $sql = 'DROP USER \''.m($db)."'@'localhost'";
    mysql_query($sql,$l) or mf(__FILE__, __LINE__, $sql);
   }
   mysql_close($l);
   $_redodb = true; require('lib/database.php'); unset($_redodb);
   header('Location: '.CP_PATH.'database');
   exit;
  } else {
   define('MESSAGE', 'Please confirm user deletion');
  }
 }

 
 define('TITLE', 'Databases');
 
 addDashboardItem('Useful links', 'phpMyAdmin', 'phpMyAdmin');

 require_once('lib/header.php');
 
 require_once('pages/dbusers.php');
 require_once('pages/dbdbs.php');
 require_once('pages/dbperms.php');
 
 require_once('lib/footer.php');


?>
