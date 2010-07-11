<?PHP

 define('SUPPORT_TITLE', 'What does the status column mean?');
 
 define('SUPPORT_BTITLE', 'What does the status column mean?');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }
 
 addDashboardItem('Useful links', 'Site overview', 'sites');
 addDashboardItem('Related articles', 'Paying outstanding bills', 'support/008');
 
 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }
 

 $sbody = <<<SUPPORT
<p>
 The status column in the <em>site overview</em> page indicates the current
 status of your site. If everything is OK and your site should be working, 
 the status column will display <em>OK</em>.
</p>
<p>
 If there is a problem with your account, the status of your sites will show
 as <em>disabled</em>, with a brief reason. If you have exceeded your monthly
 bandwidth limit, you will see <em>Disabled - bandwidth exceeded</em>; if you
 are currently using more disk space than your package permits, you'll see
 <em>Disabled - disk quota exceeded</em>. Finally, if you have missed a payment
 on your account your sites will display <em>Disabled - unpaid bill</em>.
</p>
<p>
 Finally, if the <a href="015">document root</a> of your site is invalid, you 
 will see a message saying <em>invalid docroot</em>. To solve this error, you
 need to create the appropriate directory for the site in your user directory.
 To view the site's current docroot, click on the 'settings' link in the
 overview. If you need further support, please raise a ticket.
</p>
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
