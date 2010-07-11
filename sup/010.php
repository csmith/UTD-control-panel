<?PHP

 define('SUPPORT_TITLE', 'How to raise a ticket');
 
 define('SUPPORT_BTITLE', 'How to raise a ticket');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }

 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }

 addDashboardItem('Related articles', 'Getting support via e-mail', 'support/006');
 addDashboardItem('Related articles', 'How to reopen a ticket', 'support/014');
 
 $sbody = <<<SUPPORT
<p>UTD-Hosting's primary method of support is via our ticket system. To raise
 a new ticket, follow the following steps:</p>
<ul>
 <li>Log in to the control panel</li>
 <li>Click on 'Tickets' in the main menu, or 'View or raise tickets' in the 
  sidebar</li>
 <li>At the bottom of the tickets page, enter a subject and message</li>
 <li>Press the 'Raise new ticket' button</li>
 <li>Your ticket has been raised, and it will now be displayed</li>
</ul>
<p>
 If you have problems raising a ticket, you can contact UTD-Hosting support
 <a href="005">by e-mail</a>.
</p>
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
