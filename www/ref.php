<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 
 define('TITLE', 'Referral scheme');
 
 addDashboardItem('Useful links', 'Account overview', '');
 addDashboardItem('Useful links', 'Billing', 'billing');
 
 require_once('lib/header.php');
 
 require_once('pages/refinfo.php');
 require_once('pages/refusers.php');
 
 require_once('lib/footer.php');


?>
