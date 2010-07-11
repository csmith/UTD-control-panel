<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');

 checkAccess(HAS_HOSTING);
 
 define('TITLE', 'E-Mail settings');
 
 addDashboardItem('Useful links', 'Account overview', '');
 addDashboardItem('Frequently asked questions', 'How do mailboxes and e-mail addresses work?', 'support/027'); 
 
 define('MESSAGE', 'Sorry, this function hasn\'t been implemented yet. Please <a href="'.CP_PATH.'tickets">raise a ticket</a> for assistance.');

 require_once('lib/header.php');
 
 require_once('pages/email.php');
 require_once('pages/addemail.php');
 require_once('pages/mailbox.php');
 require_once('pages/addmailbox.php');
 
 require_once('lib/footer.php');


?>
