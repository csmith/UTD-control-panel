<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 
 define('TITLE', 'Discounts');

 addDashboardItem('Other admin tools', 'Reports', 'reports');
 addDashboardItem('Other admin tools', 'Overview', 'admin');
 addDashboardItem('Other admin tools', 'Sites', 'adminsites');
 addDashboardItem('Other admin tools', 'Bans', 'bans');

  addDashboardItem('External tools', 'Wiki', 'http://admin.utd-hosting.com/wiki'
);
  addDashboardItem('External tools', 'Service monitor', 'http://admin.utd-hostin
g.com/mon');
  addDashboardItem('External tools', 'Finances', 'http://admin.utd-hosting.com/f
inances');

 
 require_once('lib/header.php');

 if (defined('ADMIN') && ADMIN) {
  require_once('pages/admindiscounts.php');
 } else {
  define('ERROR', 'You\'re no admin!');
 }
 
 require_once('lib/footer.php');


?>
