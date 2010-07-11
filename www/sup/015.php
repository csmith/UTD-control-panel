<?PHP

 define('SUPPORT_TITLE', 'What does \'document root\' mean?');
 
 define('SUPPORT_BTITLE', 'What does \'document root\' mean?');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }

 addDashboardItem('Related articles', 'How to add a site', 'support/019');
 
 if (!defined('UID')) {
  addDashboardItem('Useful links', 'Login', 'login');
 }
 
 $sbody = <<<SUPPORT
<p>
 The <em>document root</em> of a site is the directory in which the site
 resides. When your account is created, your default site (with the domain
 name <em>username.utd-hosting.com</em>) has a document root of 
 <em>/public_html</em>. When you connect to your FTP account, you will see the
 public_html directory. Any files you upload to that directory will be visible
 via your website.
</p>
<p>
 When you add a new site, you need to put in a new document root. Generally,
 you will want to create a new directory for this site (using your FTP client),
 and set the document root to that directory.
</p>
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
