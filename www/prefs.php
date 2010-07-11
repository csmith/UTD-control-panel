<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 
 define('TITLE', 'User preferences');
 
 addDashboardItem('Useful links', 'Account overview', '');

 if (isset($_POST['curpass']) && isset($_POST['pass1']) && isset($_POST['pass2'])) {
  if ($_POST['pass1'] == $_POST['pass2']) {
   if (md5(USER.$_POST['curpass']) == PASS) {
    if (($error = validPass($_POST['pass1'])) === true) {
     changePass(UID, $_POST['pass1']);     
     l('Changed password.');
     define('MESSAGE', 'Password updated.');
    } else {
     define('MESSAGE', $error);
    }
   } else {
    define('MESSAGE', 'Incorrect password. Please enter your current password.');
   }
  } else {
   define('MESSAGE', 'Your passwords do not match. Please re-enter your new password.');
  }
 }
 
 require_once('lib/header.php');
 
 require_once('pages/prefs.php');
 require_once('pages/pass.php');
 
 require_once('lib/footer.php');


?>
