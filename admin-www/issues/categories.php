<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 $categories = getCategoriesInfo();

 define('TITLE', 'Issue tracker :: View Categories');

 addDashboardItem('Actions', 'Add Category', 'addcategory');

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');

 require_once('pages/viewcategories.php');

 require_once('lib/footer.php');


?>
