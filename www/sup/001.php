<?PHP

 define('SUPPORT_TITLE', 'How do I configure PHP for my site?');
 
 define('SUPPORT_BTITLE', 'How do I configure PHP for my site?');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }
 
 addDashboardItem('Useful links', 'Site overview', 'sites');
 
 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }
 
 addDashboardItem('Related articles', 'Description of PHP settings', 'support/009');
 
 $sbody = <<<SUPPORT
<p>
 The UTD-Hosting control panel allows you to configure various PHP options
 for each of your sites. To do this, you must login to the UTD-Hosting control
 panel, and perform the following actions:
</p> 
<ol>
 <li>Access the <em>site overview</em> page</li>
 <li>Click on the <em>settings</em> link next to the site you wish to edit</li>
 <li>Scroll down to the <em>PHP Settings</em> section</li>
</ol>
<p>
 Once you have finished changing the settings, click the <em>save</em> button
 at the bottom of the page. Please note that it may take up to five minutes for
 some changes to become active.
</p>
SUPPORT;

 define('SUPPORT_BODY', $sbody);
 define('MESSAGE', 'PHP settings currently aren\'t functional. Please raise a ticket to have them changed.');

?>
