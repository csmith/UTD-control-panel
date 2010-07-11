<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 if (!isset($_GET['n']) && !ctype_digit($_GET['n'])) {
  header('Location: '.CP_PATH.'categories');
 }

 if (isset($_POST['submit'])) {
  $_POST['name'] = trim($_POST['name']);
  if (empty($_POST['name'])) {
   header('Location: '.CP_PATH.'categories');
   return;
  }

  $sql = 'UPDATE issues_categories SET icat_name = \''.m($_POST['name']).'\', icat_assign = '.m($_POST['assignee']).' WHERE icat_id = '.m($_GET['n']);

  $res = mysql_query($sql) or die(mysql_error().'<br />'.$sql);
  logger::log('Issue tracker: category edited: '.getCategoryName($_GET['n']), getUserID($_SERVER['REDIRECT_REMOTE_USER']), logger::information);
  header('Location: '.CP_PATH.'categories');
  return;
 }

 $admins = getAdmins();
 $sql = 'SELECT icat_id, icat_name, icat_assign FROM issues_categories WHERE icat_id = \''.$_GET['n'].'\'';
 $res = mysql_query($sql);
 if (mysql_num_rows($res) == 0) {
  header('Location: '.CP_PATH.'categories');
 }
 $data = mysql_fetch_assoc($res);


 define('TITLE', 'Issue tracker :: Edit Category :: '.h($data['icat_name']));

 addDashboardItem('Actions', 'Add Category', 'addcategory');

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');

 require_once('pages/editcategory.php');

 require_once('lib/footer.php');


?>
