<?PHP

 define('SUPPORT_TITLE', 'Can I file support requests without using the control panel?');
 
 define('SUPPORT_BTITLE', 'Filing support requests by e-mail');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }

 addDashboardItem('Related articles', 'Reply time promise', 'support/013');
 addDashboardItem('Related articles', 'How to raise a ticket', 'support/010');
 
 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }
 
 $sbody = <<<SUPPORT
<p>
 You can file support requests by sending e-mail to
 <em>support@utd-hosting.com</em>. Note that when you submit support requests
 via e-mail, they are exempt from our <a href="013">reply time promise</a>.
 Please make sure that you include your UTD-Hosting username with your query.
 For certain requests we may require that you log into the control panel to
 verify your identity.
</p>
<p style="font-weight: bold;">
 UTD-Hosting will never ask for your password by e-mail or any other method of
 communication.
</p>
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
