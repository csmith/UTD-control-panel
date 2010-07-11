<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');

 checkAccess(ADMIN);
 
 define('TITLE', 'Admin - Finances');

 require_once('admin.menu.php');
 
 require_once('lib/header.php');

 require_once('pages/admin.finances.php');
 require_once('pages/admin.addfinances.php');
 
 require_once('lib/footer.php');


?>
