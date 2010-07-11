<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 
 if (!isset($_GET['n']) || !preg_match('/^[0-9]+$/',$_GET['n'])) {
   $error = 'Invalid message ID!';
   define('TICKET_TITLE', 'Error');
 } elseif (!defined('UID')) {
   $error = 'You must be logged in to view announcements.';
   define('TICKET_TITLE', 'Error');
 } else {
   $ticket = $_GET['n'];
   $sql = 'SELECT message_id, message_type, message_title, message_time, message_body FROM messages WHERE message_id = '.$_GET['n'];
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   
   if (mysql_num_rows($res) == 0) {
     $error = 'There is no such message with that ID.';
   } else {
   
    $row = mysql_fetch_array($res);
   
    if ($row['message_type'] == 'admin' && !defined('ADMIN')) {
	  $error = 'You do not have permission to view this message.';
    } else {
      define('MESSAGE_TITLE', $row['message_title']);
      define('MESSAGE_TYPE', $row['message_type']);
      define('MESSAGE_TIME', $row['message_time']);
      define('MESSAGE_BODY', $row['message_body']);
    }
   }
 }
 
 define('TITLE', 'View message :: '.MESSAGE_TITLE);
 
 addDashboardItem('Useful links', 'Support center', 'support');
 addDashboardItem('Useful links', 'Raise a new ticket', 'tickets');
 
 require_once('lib/header.php');
 
 require_once('pages/viewmessage.php');
 
 require_once('lib/footer.php');


?>
