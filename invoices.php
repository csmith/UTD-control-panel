<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');
 require_once('lib/database.php');
 require_once('lib/account.php');
 
 define('TITLE', 'Invoices');
 
 addDashboardItem('Frequently asked questions', 'How do I pay outstanding invoices?', 'support/008');
 addDashboardItem('Useful links', 'Apply discount', 'discount');

 require_once('lib/header.php');
 
 require_once('pages/billing.php');
 require_once('pages/packages.php');
  
 require_once('lib/footer.php');

?>
