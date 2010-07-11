<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 require_once('lib/common.php');

 if (!isset($_GET['n']) || !ctype_digit($_GET['n']) || $_GET['n'] < 1 || $_GET['n'] > 5) {
  header('Location: '.CP_PATH.'account');
  exit;
 }

 $fields = array(1=>'users.user_email', 2=>'', 3=>'userdetails.ud_name',
                4=>'userdetails.ud_address', 5=>'userdetails.ud_telephone');

 $prefs = array(1=>'e-mail address', 3=>'full name', 4=>'address',
                5=>'telephone number');

 if (isset($_POST['value'])) {
  list($table, $col) = explode('.', $fields[($_GET['n'])]);
  
  if ($table == 'userdetails') {
   $sql = 'SELECT user_id FROM userdetails WHERE user_id = '.UID;
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   if (mysql_num_rows($res) == 0) {
    $sql = 'INSERT INTO userdetails (user_id) VALUES ('.UID.')';
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   } 
  }
  
  $sql  = 'UPDATE '.$table.' SET '.$col.' = \''.m($_POST['value']).'\' WHERE ';
  $sql .= 'user_id = '.UID;
  logger::log('Changed '.$prefs[($_GET['n'])].' to '.$_POST['value'],logger::information);
  mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  header('Location: '.CP_PATH.'account');
  exit;
 }

 if (isset($_POST['mail'])) {
  $m = array('mail_announce'=>'announcement','mail_tickets'=>'ticket reply',
		'mail_warning'=>'warning','mail_over'=>'overring');
  $sql  = 'SELECT mail_announce, mail_tickets, mail_warning, mail_over FROM ';
  $sql .= 'users WHERE user_id = '.UID;
  $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  $row = mysql_fetch_assoc($res);
  foreach ($row as $key => $value) {
   if ($value == 1 && !isset($_POST[$key])) {
    logger::log('Opted out of '.$m[$key].' e-mail.', logger::information);
    $sql = 'UPDATE users SET '.$key.' = 0 WHERE user_id = '.UID;
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   }
   if ($value == 0 && isset($_POST[$key])) {
    logger::log('Opted to receive '.$m[$key].' e-mail.',logger::information);
    $sql = 'UPDATE users SET '.$key.' = 1 WHERE user_id = '.UID;
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   }
  }
  header('Location: '.CP_PATH.'account');
  exit;
 }
 
 define('TITLE', 'Edit User preferences');
 
 addDashboardItem('Useful links', 'Account overview', '');
 
 require_once('lib/header.php');

 require_once('pages/editpref.php');
 
 require_once('lib/footer.php');


?>
