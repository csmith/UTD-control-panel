<?PHP

 define('SUPPORT_TITLE', 'Spam prevention');
 
 define('SUPPORT_BTITLE', 'Spam prevention');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }
 
 addDashboardItem('Useful links', 'E-mail settings', 'email');
 
 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }
 

 $sbody = <<<SUPPORT
<p>
 All mail received by UTD-Hosting's mail servers is ran through several filters
 to help prevent spam. These filters should never affect any legitimate mail.
</p>
<p>
 The checks performed on incoming mail reject messages from servers that do not
 identify themselves correctly when connecting. This stops around 45% of all
 spam messages sent to UTD-Hosting's servers. All legimate e-mail servers will
 identify themselves properly (and are required to do so by the protocol
 specifications).
</p>
<p>
 The address of the remote server is then checked against four blacklists -
 <a href="http://www.sorbs.net/">sorbs</a>, <a href="http://www.ordb.org/">ordb</a>, <a href="http://www.dsbl.org/">dsbl</a> and <a href="http://www.spamhaus.org/">spamhaus</a>. These blacklists block known spammers and vulnerable machines
 which may be used to relay spam. Again, legitimate e-mail servers rearely find
 their way on to spam blacklists (and when they do, there's a simple de-listing
 process), so legitimate mail shouldn't be stopped.
</p>
<p>
 In a sample of mail received over twenty four hours, these processes stopped 86% of spam mail, with 0 false positives.
</p> 
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
