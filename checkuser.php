<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');

 checkAccess(ADMIN);
 
 define('TITLE', 'Check user');

 addDashboardItem('Other admin tools', 'Overview', 'admin');
 addDashboardItem('Other admin tools', 'Reports', 'reports');
 
 require_once('lib/header.php');

 if (defined('ADMIN') && ADMIN) {
  require_once('pages/adminculog.php');
 } else {
  define('ERROR', 'You\'re no admin!');
 }
 
 require_once('lib/footer.php');


?>
