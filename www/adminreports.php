<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');

 checkAccess(ADMIN);
 
 define('TITLE', 'Admin - Reports');

 require_once('admin.menu.php'); 
 require_once('lib/header.php');

 require_once('pages/reports/bigfiles.php');
 
 require_once('lib/footer.php');


?>
