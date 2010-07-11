<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 
 define('TITLE', 'Bandwidth breakdown');
 
 addDashboardItem('Useful links', 'Account overview', '');
 addDashboardItem('Useful links', 'View extended site details', 'sites');
 
 addDashboardItem('Frequently asked questions', 'What does KiB/MiB/GiB mean?', 'support/003');

 require_once('lib/header.php');
 
 require_once('pages/bandwidthgraph.php');
 require_once('pages/bandwidthtable.php');
 
 require_once('lib/footer.php');


?>
