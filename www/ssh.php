<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');
 require_once('lib/common.php');

 checkAccess(HAS_SSH);
 
 define('TITLE', 'SSH');

 addDashboardItem('Frequently asked questions', 'How do I create SSH keys?', 'support/028');

 if (isset($_POST['delete'])) {
  $keys = array();
  foreach ($_POST as $k => $v) {
   if (substr($k, 0, 4) == 'key_' && ctype_digit(substr($k, 4))) {
    $keys[] = (int)substr($k, 4);
   }
  }
  if (count($keys) > 0) {
   $sql = 'DELETE FROM sshkeys WHERE (user_id = '.UID.') AND (0';
   foreach ($keys as $key) {
    $sql .= ' OR key_id = ' . $key;
   }
   $sql .= ')';
   mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   logger::log('Deleted '.mysql_affected_rows().' SSH key(s)', logger::information);

   $sql  = 'INSERT INTO actions (user_id, action_type, action_value) VALUES (';
   $sql .= UID . ', \'updateconf\', \'sshkeys\')';
   mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

   header('Location: ' . CP_PATH . 'ssh');
   exit();
  }
 }

 if (isset($_POST['add'])) {
  $sql =  'INSERT INTO sshkeys (user_id, key_comment, key_key) VALUES (';
  $sql .= UID . ', \'' . m($_POST['comment']) . '\', \'' . m($_POST['key']);
  $sql .= '\')';
  mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

  logger::log('Added SSH key: ' .$_POST['comment'], logger::information);

  $sql  = 'INSERT INTO actions (user_id, action_type, action_value) VALUES (';
  $sql .= UID . ', \'updateconf\', \'sshkeys\')';
  mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

  header('Location: ' . CP_PATH . 'ssh');
  exit();
 }

 require_once('lib/header.php');
 
 require_once('pages/ssh.keys.php');
 require_once('pages/ssh.addkey.php');
 
 require_once('lib/footer.php');

?>
