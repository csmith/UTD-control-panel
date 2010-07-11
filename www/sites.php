<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 require_once('lib/common.php');

 checkAccess(HAS_HOSTING);
 
 define('TITLE', 'Sites');
 
 addDashboardItem('Useful links', 'Support center', 'support');
 addDashboardItem('Useful links', 'Bandwidth breakdown', 'bandwidth');
 addDashboardItem('Useful links', 'Historical bandwidth/hdd usage', 'history');
  
 addDashboardItem('Frequently asked questions', 'What do I do if my site isn\'t working?', 'support/002');
 addDashboardItem('Frequently asked questions', 'What does KiB/MiB/GiB mean?', 'support/003');
 addDashboardItem('Frequently asked questions', 'How do I configure PHP for my site?', 'support/001');
 addDashboardItem('Frequently asked questions', 'What does the status column mean?', 'support/004');

 require_once('lib/header.php');
 
 require_once('pages/siteoverview.php');
 require_once('pages/addsite.php');
 
 require_once('lib/footer.php');


?>
