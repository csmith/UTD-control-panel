<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 define('TITLE', 'Issue tracker :: 404 - Page not found');

 addDashboardItem('Actions', 'Raise new issue', 'addissue');

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');
 
 require_once('pages/404.php');
 
 require_once('lib/footer.php');


?>
