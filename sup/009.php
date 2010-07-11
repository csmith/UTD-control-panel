<?PHP

 define('SUPPORT_TITLE', 'Description of PHP settings');
 
 define('SUPPORT_BTITLE', 'Description of PHP settings');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }

 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }

 define('MESSAGE', 'PHP settings are currently not exposed in the control panel. Please raise a ticket for assistance.');
 
 $sbody = <<<SUPPORT
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
