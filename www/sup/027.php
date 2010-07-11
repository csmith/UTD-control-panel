<?PHP

 define('SUPPORT_TITLE', 'Mailboxes and e-mail addresses');
 
 define('SUPPORT_BTITLE', 'Mailboxes and e-mail addresses');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }

// addDashboardItem('Related articles', 'How to add a site', 'support/019');
 
 if (!defined('UID')) {
  addDashboardItem('Useful links', 'Login', 'login');
 }
 
 $sbody = "
<p>
 An e-mail account on UTD-Hosting consists of two parts: a mailbox and one or
 more e-mail addresses that point to that mailbox. A mailbox is a container
 that stores your messages until your e-mail client downloads them (like a
 letter box holds letters until you fetch them). You can have one or more 
 e-mail addresses pointing to each mailbox, and any e-mail sent to these
 addresses is placed in the mailbox.
</p>
<p>
 For example, if you own the domain <em>example.com</em>, and want to set up
 e-mail accounts for two users, bob and alice, you would set up two mailboxes
 and two e-mail addresses. The mailboxes could be called <em>bob@example.com</em>
 and <em>alice@example.com</em> (although it's not really that important), and
 the e-mail addresses will be the same:
</p>
<img src=\"".CP_PATH."res/mbox1.png\" alt=\"Mailbox diagram\">
<p>
 Now suppose that bob also wants to receive e-mail sent to
 <em>admin@example.com</em>. You create another e-mail address, but map it to
 the same mailbox as his other e-mail address:
</p>
<img src=\"".CP_PATH."res/mbox2.png\" alt=\"Mailbox diagram\">
<p>
 Now when bob's e-mail client connects to his mailbox, he will receive mail
 sent to both e-mail addresses.
</p>
";
 
 define('SUPPORT_BODY', $sbody);

?>
