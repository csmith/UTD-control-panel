<?PHP

 require_once('lib/common.php');
 require_once('lib/database.php');
 require_once('lib/dashboard.php');
 
 define('NOLOGINREF', true); // So we don't go round in circles
 
 require_once('lib/account.php');

 if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['pass1']) && isset($_POST['pass2'])) {
  if ($_POST['pass1'] == $_POST['pass2']) {
  if (($error = validPass($_POST['pass1'])) === true) {
   $sql = 'SELECT user_id, user_email, ud_telephone FROM users NATURAL JOIN ';
   $sql .= 'userdetails WHERE user_name = \''.m($_POST['username']).'\'';
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   if (mysql_num_rows($res) != 1) {
    l('Failed password recovery attempt [user '.$_POST['username'].'] from '.$_SERVER['REMOTE_ADDR']);
    define('MESSAGE', 'Invalid details. Please e-mail support@utd-hosting.com for assistance.');
    bfc($_SERVER['REMOTE_ADDR']);
   } else {
    $row = mysql_fetch_array($res);
    if (strtolower($row['user_email']) != strtolower($_POST['email'])) {
     l('Failed password recovery attempt [user '.$_POST['username'].', email '.$_POST['email'].'] from '.$_SERVER['REMOTE_ADDR']);
     define('MESSAGE', 'Invalid details. Please e-mail support@utd-hosting.com for assistance.');
     bfc($_SERVER['REMOTE_ADDR']);
    } else {
     $file = preg_replace('/[^0-9]/','',$row['ud_telephone']);
     $user = preg_replace('/[^0-9]/','',$_POST['phone']);
     if ($file != $user || strlen($user) < 1) {
      l('Failed password recovery attempt [user '.$_POST['username'].', telephone'.$_POST['phone'].'] from '.$_SERVER['REMOTE_ADDR']);
      define('MESSAGE', 'Invalid details. Please e-mail support@utd-hosting.com for assistance.');
     } else {
      changePass($row['user_id'], $_POST['pass1']);
      l('Password recovered by '.$_SERVER['REMOTE_ADDR'], $row['user_id']);
      define('MESSAGE', 'Password changed.');
     }
    }
   }
  } else {
   define('MESSAGE', 'Passwords must be 5-20 characters, and contain at least one upper case letter, one lower case letter, and one number.');
  }
  } else {
   define('MESSAGE', 'Your passwords do not match.');
  }
 }
 
 addDashboardItem('Useful links', 'Login', 'login');
 addDashboardItem('Frequently asked questions', 'Can I give other users access to my control panel?', 'support/006');
 addDashboardItem('Frequently asked questions', 'What do I do if I forget my username?', 'support/007');
 addDashboardItem('Frequently asked questions', 'Can I file support requests without using the control panel?', 'support/005');

 define('TITLE', 'Recover password');
 
 require_once('lib/header.php');
 require_once('pages/recover.php');
 require_once('lib/footer.php');

?>
