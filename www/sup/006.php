<?PHP

 define('SUPPORT_TITLE', 'Can I give other users access to the control panel?');
 
 define('SUPPORT_BTITLE', 'Giving other users access to the control panel');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }

 addDashboardItem('Useful links', 'Terms &amp; Conditions', 'http://www.utd-hosting.com/terms');
 
 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }
 
 $sbody = <<<SUPPORT
<p>
 We currently have no plans to allow multiple users to manage a single site.
 You may give another person your login details so that they can manage your
 account, but this is strongly discouraged. UTD-Hosting cannot be held
 responsible for any action taken by any person to whom you gave your account
 details.
</p>
<p>
 Please also note that section 1.4 (Account ownership) of the Terms and
 Conditions forbits the resale of any UTD-Hosting service.
</p>
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
