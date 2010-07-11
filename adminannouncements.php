<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');

 checkAccess(ADMIN);
 
 define('TITLE', 'Admin - Announcements');

 require_once('admin.menu.php');

 if (get_magic_quotes_gpc()) {
  foreach ($_POST as $k => $v) {
   $_POST[$k] = stripslashes($v);
  }
 }

 if (isset($_POST['title']) && isset($_POST['type']) && isset($_POST['body'])) {
  if (isset($_POST['preview'])) {
   define('MESSAGE_TITLE', $_POST['title']);
   define('MESSAGE_TYPE', 'preview: ' . $_POST['type']);
   define('MESSAGE_TIME', time());  
   define('MESSAGE_BODY', $_POST['body']);

   require_once('lib/header.php');
   require_once('pages/viewmessage.php');
  } else {
   $sql  = 'INSERT INTO messages (message_type, message_title, message_time,';
   $sql .= ' message_body) VALUES (\'' . m($_POST['type']) . '\', \'';
   $sql .= m($_POST['title']) . '\', ' . time() . ', \'' . m($_POST['body']);
   $sql .= '\')';

   mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

   if ($_POST['type'] == 'announcement') {
    require_once('/home/utd/common/messagemail.php');
    messagemail(mysql_insert_id());  
   }

   header('Location: ' . CP_PATH . 'adminannouncements');
   exit();
  }
 } else {
  require_once('lib/header.php');
  require_once('pages/admin.announcements.php');
 }
 require_once('pages/admin.addannouncement.php');
 
 require_once('lib/footer.php');


?>
