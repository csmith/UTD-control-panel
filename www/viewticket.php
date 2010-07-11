<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 
 if (!isset($_GET['n']) || !preg_match('/^[0-9]+$/',$_GET['n'])) {
   $error = 'Invalid ticket ID!';
   define('TICKET_TITLE', 'Error');
 } elseif (!defined('UID')) {
   $error = 'You must be logged in to view tickets.';
   define('TICKET_TITLE', 'Error');
 } else {
   $ticket = $_GET['n'];
   $sql = 'SELECT t.ticket_id, t.ticket_status, t.ticket_body, t.ticket_title, t.ticket_time, u.user_admin, u.user_id, u.user_name, ud.ud_name FROM tickets AS t, users AS u, userdetails AS ud WHERE ud.user_id = u.user_id AND t.ticket_thread = '.$ticket.' AND u.user_id = t.user_id ORDER BY t.ticket_id ASC';
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   
   if (mysql_num_rows($res) == 0) {
     $error = 'There is no such ticket with that ID.';
   } else {
   
    $row = mysql_fetch_array($res);
   
    if ($row['user_id'] != UID && !defined('ADMIN')) {
	  $error = 'You did not raise this ticket.';   
    } else {
      define('TICKET_TITLE', $row['ticket_title']);
      define('TICKET_STATUS', $row['ticket_status']);
      define('TICKET_ID', $row['ticket_id']);
      define('TICKET_BODY', $row['ticket_body']);
      define('TICKET_TIME', $row['ticket_time']);
      define('TICKET_USER', $row['ud_name'].' ['.$row['user_name'].']');
      define('TICKET_RES', $res);
    }
   }
 }
 
 define('TITLE', 'View ticket :: '.TICKET_TITLE);
 
 addDashboardItem('Useful links', 'Support center', 'support');
 addDashboardItem('Useful links', 'Raise a new ticket', 'tickets');
 
 addDashboardItem('Frequently asked questions', 'Can I file support requests without using the control panel?', 'support/005');

 require_once('lib/header.php');
 
 require_once('pages/viewticket.php');
 
 require_once('lib/footer.php');


?>
