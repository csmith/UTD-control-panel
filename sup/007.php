<?PHP

 define('SUPPORT_TITLE', 'What do I do if I forget my username?');
 
 define('SUPPORT_BTITLE', 'Retrieving a lost username');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }

 addDashboardItem('Related articles', 'Raising support requests via e-mail', 'support/005');
 
 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }
 
 $sbody = <<<SUPPORT
<p>
 Your utd-hosting username is included in your welcome e-mail, which you should
 have received when your account was created. Your username is the same for
 FTP access, this control panel, and is also forms the name for your default
 site &mdash; <em>http://username.utd-hosting.com/</em>.
</p>
<p>
 In the unlikely event that you have forgotten your username, please e-mail
 UTD-Hosting support with as many identifying details as possible (such as
 your real name, address/telephone number if they're on file, names of any
 databases/database users, the names of any sites you have), but <span 
 style="font-weight: bold;">not</span> your password.
</p>
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
