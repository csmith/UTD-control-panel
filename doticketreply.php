<?PHP

 require_once('lib/account.php');
 require_once('lib/dashboard.php');
 require_once('lib/database.php');

 if (get_magic_quotes_gpc() == 1) {
  foreach ($_POST as $k => $v) { $_POST[$k] = stripslashes($v); }
 }

 if (isset($_POST['message']) && isset($_POST['status']) && isset($_POST['thread'])) {
  if (USER == 'demo') {
   define('MESSAGE','Sorry. The demo account can\'t reply to tickets.');
  } elseif (!preg_match('/^[0-9]+$/', $_POST['thread'])) {
   define('MESSAGE', 'Invalid ticket thread.');
  } else {

   $sql = 'SELECT user_id, ticket_status, ticket_title FROM tickets WHERE ticket_id = '.$_POST['thread'];
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   $row = mysql_fetch_array($res);
   define('TTITLE', $row['ticket_title']);
   if ((UID != $row[0]) && (!defined('ADMIN'))) {
    define('MESSAGE', 'You don\'t have access to reply to that ticket.');
   } else {

    $opts = array(); $opts[($row[1])] = true;
    switch ($row[1]) {
     case 'new': case 'reopened':
      $opts['closed'] = true;
      if (defined('ADMIN')) { $opts['assigned'] = true; }
     break;
     case 'assigned':
      $opts['closed'] = true;
      break;
     case 'closed':
      $opts['reopened'] = true;
      break;
    }
    
    if (!isset($opts[($_POST['status'])])) {
     define('MESSAGE', 'Invalid/unknown status');
    } else {
 
     $sql  = 'INSERT INTO tickets (user_id, ticket_title, ticket_body, ';
     $sql .= 'ticket_time, ticket_status, ticket_thread) VALUES ('.UID.', \'\', ';
     $sql .= '\''.m($_POST['message']).'\', '.time().', \'reply\', ';
     $sql .= $_POST['thread'].')';
     mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

     if (file_exists('/home/utd/common/ticketmail.php')) {
      require_once('/home/utd/common/ticketmail.php');
      ticketmail(mysql_insert_id());
      logger::log('Replied to ticket "'.TTITLE.'"', logger::normal);
     }

     $sql  = 'UPDATE tickets SET ticket_status = \''.$_POST['status'].'\' WHERE ticket_id = '.$_POST['thread'];
     mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

     header('Location: '.CP_PATH.'viewticket/'.$_POST['thread']);
     die;
    }
   }
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
