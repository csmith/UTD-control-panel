<?PHP

 define('FORBIDDEN', true);
 define('NOLOGINREF', true);

 require_once('lib/common.php');
 require_once('lib/database.php');
 require_once('lib/dashboard.php');
 require_once('lib/account.php');

 define('TITLE', 'Forbidden');

 addDashboardItem('Useful links', 'Support section', 'support');

 if (!defined('REASON')) { header('Location: '.CP_PATH.'login'); }
 
 require_once('lib/header.php');
 require_once('pages/forbidden.php');
 require_once('lib/footer.php');

?>
