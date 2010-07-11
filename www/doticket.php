<?PHP

 require_once('lib/account.php');
 require_once('lib/dashboard.php');
 require_once('lib/database.php');

 if (get_magic_quotes_gpc() == 1) {
  foreach ($_POST as $k => $v) { $_POST[$k] = stripslashes($v); }
 }

 if (isset($_POST['body']) && isset($_POST['subject'])) {
  if (USER == 'demo') {
   define('MESSAGE','Sorry. The demo account can\'t raise tickets.');
  } elseif (strlen($_POST['body']) < 10) {
   define('MESSAGE', 'Please enter a complete description of the problem.');
  } elseif (strlen($_POST['subject']) < 5) {
   define('MESSAGE', 'Please enter a complete subject.');
  } else {

   $sql  = 'INSERT INTO tickets (user_id, ticket_title, ticket_body, ';
   $sql .= 'ticket_time, ticket_status) VALUES ('.UID.', \''.m($_POST['subject']).'\', ';
   $sql .= '\''.m($_POST['body']).'\', '.time().', \'new\')';
   mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   
   $id = mysql_insert_id();
   $sql = 'UPDATE tickets SET ticket_thread = '.$id.' WHERE ticket_id = '.$id;
   mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

   require('../common/ticketmail.php');

   adminTicketMail($id);
   logger::log('Raised ticket: '.$_POST['subject'], logger::normal);

   header('Location: '.CP_PATH.'viewticket/'.$id);
   die;
  }
 } else {
  define('MESSAGE', 'No ticket data submitted');	 
 }
 
 define('TITLE', 'Error');
 
 addDashboardItem('Useful links', 'Support center', 'support');
 addDashboardItem('Useful links', 'Raise a new ticket', 'tickets');
 
 addDashboardItem('Frequently asked questions', 'Can I file support requests without using the control panel?', 'support/005'); 
 
 require_once('lib/header.php');
 require_once('lib/footer.php');

?>
