<?PHP

 define('SUPPORT_TITLE', 'Downtime promise');
 
 define('SUPPORT_BTITLE', 'Downtime promise');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }

 addDashboardItem('Related articles', 'How to use discount codes', 'support/026');
 addDashboardItem('Useful links', 'Billing', 'billing');
 addDashboardItem('Useful links', 'Account overview', '');
 
 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }
 

 $sbody = <<<SUPPORT
<p>
 While we'd all like to have 100% uptime, in practice this rarely happens.
 In order to compensate our customers for any downtime we experience, 
 UTD-Hosting will issue discount codes that extend the current billing cycle
 by <em>twice</em> the length of the downtime. So if we're down for an hour,
 you get two hours for free.
</p>
<p>
 After a period of downtime, an informational message will be posted by a 
 UTD-Hosting staff member, explaining the cause of the downtime, the recorded
 duration, and listing the discount code. This code will be valid for a week
 after the end of the downtime.
</p> 
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
