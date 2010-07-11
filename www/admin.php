<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');

 checkAccess(ADMIN);

 if (count($_POST) > 0) {
  foreach ($_POST as $key => $value) {
   list($service, $action) = explode('_', $key);
   $sql  = 'INSERT INTO actions (user_id, action_type, action_value) VALUES (';
   $sql .= UID . ', \'' . m($action) . '\', \'' . m($service) . '\')';
   mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   define('MESSAGE', 'Action scheduled');
   break;
  }
 }

 require_once('admin.menu.php');
 
 define('TITLE', 'Admin');

 require_once('lib/header.php');

 require_once('pages/admin.menu.php');
 require_once('pages/admin.actions.php');
 
 require_once('lib/footer.php');


?>
