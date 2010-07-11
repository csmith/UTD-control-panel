<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 define('TITLE', 'Issue tracker :: Stats');

 addDashboardItem('Actions', 'Raise new issue', 'addissue');

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');
 
 require_once('pages/stats.php');
 
 require_once('lib/footer.php');

?>
