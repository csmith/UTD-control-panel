<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 
 define('TITLE', 'File manager demo');
 
 addDashboardItem('Useful links', 'Add a new site', 'addsite');
 addDashboardItem('Useful links', 'phpMyAdmin', 'phpMyAdmin');
 addDashboardItem('Useful links', 'Historic bandwidth/hdd usage', 'history');
 addDashboardItem('Useful links', 'View or raise tickets', 'tickets');
 addDashboardItem('Useful links', 'View extended site details', 'sites');
 
 addDashboardItem('Frequently asked questions', 'What do I do if my site isn\'t working?', 'support/002');
 addDashboardItem('Frequently asked questions', 'What does KiB/MiB/GiB mean?', 'support/003');
 addDashboardItem('Frequently asked questions', 'How do I configure PHP for my site?', 'support/001');
 addDashboardItem('Frequently asked questions', 'How do I pay outstanding bills?', 'support/008');
 addDashboardItem('Frequently asked questions', 'What does the status column mean?', 'support/004');

 require_once('lib/header.php');
 
 require_once('pages/fileman.php');
 
 require_once('lib/footer.php');


?>
