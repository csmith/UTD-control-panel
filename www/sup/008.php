<?PHP

 define('SUPPORT_TITLE', 'How do I pay outstanding bills?');
 
 define('SUPPORT_BTITLE', 'Paying outstanding bills');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }

 addDashboardItem('Useful links', 'Billing', 'billing');
 
 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }
 
 $sbody = <<<SUPPORT
<p>
 After you have been notified of an outstanding bill by e-mail, you can log 
 in to the control panel to pay it. To do this, log in and select the 
 'Billing' option on the right hand side of the main menu. In the 'Bills'
 section, you should see the current bill (and any previously issued bills).
 In the right hand column ('status') there will be a link to pay using paypal.
</p>
<p>
 Once you have paid using paypal, it make take up to twenty four hours after
 the payment has cleared for the bill status to be updated. For this reason,
 please ensure that you pay any bills at least one day before the date they're
 due on, to ensure uninterrupted service.
</p>
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
