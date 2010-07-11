<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');

 checkAccess(ADMIN);
 
 define('TITLE', 'Admin - Discount management');

 require_once('admin.menu.php');

 if (isset($_POST['from']) && isset($_POST['to']) && isset($_POST['timequant'])
	&& isset($_POST['timeunit']) && isset($_POST['money'])
	&& isset($_POST['type']) && isset($_POST['package'])
        && isset($_POST['code'])) {
  $message = isset($_POST['message']) ? m($_POST['message']) : '';
  $time = (int) $_POST['timeunit'] * (int) $_POST['timequant'];

  $sql  = 'INSERT INTO discounts (package_id, discount_code, discount_time, ';
  $sql .= 'discount_money, discount_type, discount_start, discount_end, ';
  $sql .= 'discount_message) VALUES (' . ((int) $_POST['package']) . ', \'';
  $sql .= m($_POST['code']) . '\', ' . $time . ', ' . ((int) $_POST['money']);
  $sql .= ', \'' . m($_POST['type']) . '\', ' . strtotime($_POST['from']);
  $sql .= ', '. strtotime($_POST['to']) . ', \'' . $message . ' \')';
  mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

  logger::log('Added discount code: ' . $_POST['code'] .' (' . duration($_POST['time'], 0) . ' / ' . $_POST['money'] . ')', logger::information);

  header('Location: ' . CP_PATH . 'admindiscounts');
  exit();
 }
 
 require_once('lib/header.php');

 require_once('pages/admin.discounts.php');
 require_once('pages/admin.adddiscount.php');
 
 require_once('lib/footer.php');


?>
