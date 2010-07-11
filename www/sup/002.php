<?PHP

 define('SUPPORT_TITLE', 'What do I do if my site isn\'t working?');
 
 define('SUPPORT_BTITLE', 'What do I do if my site isn\'t working?');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }
 
 addDashboardItem('Useful links', 'Site overview', 'sites');
 
 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }
 
 addDashboardItem('Related articles', 'How to raise a ticket', 'support/010');
 addDashboardItem('Related articles', 'HTTP error messages', 'support/012');
 addDashboardItem('Related articles', 'What does the status column mean?', 'support/004');
 
 $sbody = <<<SUPPORT
<p>
 If you cannot access your website, there are a number of steps you can follow
 to try and locate the source of the problem. If you are unable to follow these
 steps, please raise a ticket, and a member of the UTD-Hosting staff will
 investigate the problem for you.
</p>
<p>
 The first thing to determine is what type of problem is occuring. If you see
 an error message from the web server (and not your browser) when you try to
 access your website, then the cause is probably an invalid setting, or a
 problem with a .htaccess file. To further diagnose this problem, please refer
 to the <em>HTTP error messages</em> article (linked on the right hand side),
 or raise a support ticket.
</p>
<p>
 If you can access your site, but you are receiving a UTD-Hosting error page
 instead of the site you requested, please raise a ticket and a member of staff
 will investigate. If you can access the site, but are receiving a non-HTTP
 error message (or are receiving any data that is not expected), it's probable
 that the error is due to a badly coded or configured script. If you are unable
 to track down the problem, raise the ticket and a member of staff will try to
 diagnose it.
</p>
<p>
 Finally, if you can not access your site at all, there are a few things that
 you can check. On the <em>account overview</em> page, the status column for
 the site you are trying to access should say 'OK'. If it displays 'DNS Error'
 or another error message, please refer to the <em>What does the status column
 mean?</em> article for an explanation of the error and the solution. If this
 does not solve the problem, or you are suffering from a problem not covered in
 this document, please raise a ticket and we will investigate.
</p>
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
