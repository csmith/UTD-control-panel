<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');

 checkAccess(ADMIN);
 
 define('TITLE', 'Admin - Bandwidth');

  addDashboardItem('Other admin tools', 'Sites', 'adminsites');
  addDashboardItem('Other admin tools', 'Reports', 'reports');
  addDashboardItem('Other admin tools', 'Discounts', 'discounts');
  addDashboardItem('Other admin tools', 'Bans', 'bans');
  addDashboardItem('External tools', 'Wiki', 'http://admin.utd-hosting.com/wiki');
  addDashboardItem('External tools', 'Service monitor', 'http://admin.utd-hosting.com/mon');
  addDashboardItem('External tools', 'Finances', 'http://admin.utd-hosting.com/finances');
 
 require_once('lib/header.php');

 if (defined('ADMIN') && ADMIN) {
  require_once('pages/adminbw.php');
 } else {
  define('ERROR', 'You\'re no admin!');
 }
 
 require_once('lib/footer.php');


?>
