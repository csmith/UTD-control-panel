<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 
 define('TITLE', 'Change password');
 
 addDashboardItem('Useful links', 'Account overview', '');
 addDashboardItem('Useful links', 'My account', 'account');

 if (isset($_POST['curpass']) && isset($_POST['pass1']) && isset($_POST['pass2'])) {
  if ($_POST['pass1'] == $_POST['pass2']) {
   if (md5(USER.$_POST['curpass']) == PASS) {
    if (($error = validPass($_POST['pass1'])) === true) {
     changePass(UID, $_POST['pass1']);     
     logger::log('Changed password.',logger::information);
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
 
 require_once('pages/pass.php');
 
 require_once('lib/footer.php');


?>
