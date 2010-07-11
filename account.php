<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');
 require_once('lib/database.php');
 require_once('lib/account.php');
 
 define('TITLE', 'My Account');
 
 addDashboardItem('Frequently asked questions', 'How do I pay outstanding bills?', 'support/008');
 addDashboardItem('Useful links', 'Change password', 'changepass');
 addDashboardItem('Useful links', 'Apply discount', 'discount');
 addDashboardItem('Useful links', 'My invoices', 'invoices');
 addDashboardItem('Useful links', 'Referrals', 'ref');

 require_once('lib/header.php');
 
 require_once('pages/prefs.php');
 require_once('pages/packages.php');
  
 require_once('lib/footer.php');


?>
