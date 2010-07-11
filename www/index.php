<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 require_once('lib/profiler.php');
 
 define('TITLE', 'Account overview');
 
 if (HAS_HOSTING) {
  addDashboardItem('Useful links', 'Add a new site', 'addsite');
  addDashboardItem('Useful links', 'phpMyAdmin', 'phpMyAdmin');
  addDashboardItem('Useful links', 'Historic bandwidth/hdd usage', 'history');
 }
 if (HAS_DNS) {
  addDashboardItem('Useful links', 'DNS control panel', 'dns');
 }
 addDashboardItem('Useful links', 'View or raise tickets', 'tickets');
 addDashboardItem('Useful links', 'Support section', 'support');

 if (HAS_HOSTING) { 
  addDashboardItem('Frequently asked questions', 'What do I do if my site isn\'t working?', 'support/002');
  addDashboardItem('Frequently asked questions', 'What does KiB/MiB/GiB mean?', 'support/003');
  addDashboardItem('Frequently asked questions', 'How do I configure PHP for my site?', 'support/001');
 }
 addDashboardItem('Frequently asked questions', 'How do I pay outstanding invoices?', 'support/008');

 require_once('lib/header.php');
 
 require_once('pages/announcements.php');
 require_once('pages/ticketoverview.php');
 require_once('pages/supsearch.php');
 
 require_once('lib/footer.php');


?>
