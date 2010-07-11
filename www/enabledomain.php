<?PHP

 require_once('lib/account.php');
 require_once('lib/dashboard.php');
 require_once('lib/database.php');

 checkAccess(ADMIN);

 if (isset($_GET['n']) && ctype_digit($_GET['n'])) {
  if (defined('ADMIN') && ADMIN) {
   $sql = 'UPDATE domains SET domain_enabled = 1 WHERE domain_id = '.m($_GET['n']);
   mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   header('Location: '.CP_PATH.'admin');
   exit;
  } else {
   define('MESSAGE', 'Insufficient access');
  }
 } else {
  define('MESSAGE', 'Invalid domain ID');	 
 }
 
 define('TITLE', 'Error');
 
 addDashboardItem('Useful links', 'Support center', 'support');
 addDashboardItem('Useful links', 'Raise a new ticket', 'tickets');
 
 addDashboardItem('Frequently asked questions', 'Can I file support requests without using the control panel?', 'support/005'); 
 
 require_once('lib/header.php');
 require_once('lib/footer.php');

?>
