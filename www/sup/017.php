<?PHP

 define('SUPPORT_TITLE', 'DNS Errors');
 
 define('SUPPORT_BTITLE', 'DNS Errors');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }
 
 addDashboardItem('Useful links', 'Site overview', 'sites');
 addDashboardItem('Useful links', 'My domains', 'domains');
 
 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }
 

 $sbody = <<<SUPPORT
<p>
 When you type a domain name in your browser, it is resolved to an IP address.
 This IP Address tells your computer where it needs to connect to in order to
 retrieve the site. For sites that are hosted on UTD-Hosting, this IP Address
 needs to be set to one of UTD-Hosting's. For support with changing the IP
 associated with a domain name, please contact your domain name provider.  
</p>
<p>
 Sites hosted on UTD-Hosting should resolve to 63.246.141.80, or can be
 CNAMEd to asimov.utd-hosting.com. If a domain does not resolve properly, a 
 'DNS Error' note will be displayed in the <a href="/control/domains">domains
 list</a>
</p>
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
