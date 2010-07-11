<?PHP

 define('SUPPORT_TITLE', 'Ticket reply time promise');
 
 define('SUPPORT_BTITLE', 'Ticket reply time promise');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }

 addDashboardItem('Related articles', 'How to raise a ticket', 'support/010');
 
 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }
 
 $sbody = <<<SUPPORT
<p>
 We aim to reply to all tickets within twenty four hours of them being
 opened. If you open a ticket and haven't received a response within
 seventy two hours, we'll automatically credit your account with a 
 month's free hosting to attempt to compensate you for the inconvenience
 caused.
</p>
<p>
 While we aim to answer all support requests as quickly as possible,
 we cannot guarentee that those submitted via e-mail or IRC will be
 dealt with within this timeframe. Where at all possible, support 
 requests should be made via the ticket system.
</p>
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
