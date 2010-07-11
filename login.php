<?PHP

 require_once('lib/common.php');
 require_once('lib/database.php');
 require_once('lib/dashboard.php');
 
 define('NOLOGINREF', true); // So we don't go round in circles

 require_once('lib/account.php');

 if (isset($_POST['username']) && isset($_POST['password'])) {
   
   $pass = md5($_POST['username'].$_POST['password']);
   $user = mysql_real_escape_string($_POST['username']);

   $sql = 'SELECT user_id FROM users WHERE user_name = \''.$user.'\' AND user_pass = \''.$pass.'\'';
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

   if (mysql_num_rows($res) == 1) {
     $row = mysql_fetch_array($res);
     $uid = $row['user_id'];
     $sip = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);

     $sql  = 'INSERT INTO sessions (user_id, session_ip, session_start, session_last';
     $sql .= ',session_ident) VALUES ('.$uid.', \''.$sip.'\', '.time().', '.time();
     $sql .= ', \'null\')';
     mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

     $id = mysql_insert_id();

     $sid = md5($uid.$sip.$id);

     $sql = 'UPDATE sessions SET session_ident = \''.$sid.'\' WHERE session_id = '.$id;
     mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

     setcookie('utdsid', $sid, time()+60*60*24, '/');
     logger::log('Login from '.$_SERVER['REMOTE_ADDR'],$uid,logger::information);
 
     header('Location: '.CP_PATH);
   } else {
     $sql = 'SELECT user_pass FROM users WHERE user_name = \''.m($_POST['username']).'\'';
     $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
     $row = mysql_fetch_array($res);
     if ($row['user_pass']{0} == '!') {
      define('MESSAGE', 'This account is locked. Please contact support@utd-hosting.com for assistance.');
      logger::log('Log in attempt for locked account '.$_POST['username'].' by '.$_SERVER['REMOTE_ADDR'], logger::normal);
     } else {
      define('MESSAGE', 'Invalid username/password combination');
      logger::log('Invalid login attempt for user '.$_POST['username'].' by '.$_SERVER['REMOTE_ADDR'], logger::normal); 
      bfc($_SERVER['REMOTE_ADDR']);
     }
   }
   
 }
 
 addDashboardItem('Useful links', 'Recover password', 'recoverpw');
 addDashboardItem('Frequently asked questions', 'Can I give other users access to my control panel?', 'support/006');
 addDashboardItem('Frequently asked questions', 'What do I do if I forget my username?', 'support/007');
 addDashboardItem('Frequently asked questions', 'Can I file support requests without using the control panel?', 'support/005');

 define('TITLE', 'Login');
 
 require_once('lib/header.php');
 require_once('pages/login.php');
 require_once('lib/footer.php');

?>
