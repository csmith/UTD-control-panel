<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 if (isset($_POST['submit'])) {
  $_POST['name'] = trim($_POST['name']);
  if (empty($_POST['name'])) {
   header('Location: '.CP_PATH.'categories');
   return;
  }

  $sql = 'INSERT INTO issues_categories
          (icat_id, icat_name) VALUES(\'0\', \''.m($_POST['name']).'\')';

  $res = mysql_query($sql) or die(mysql_error().'<br />'.$sql);
  logger::log('Issue tracker: category added: '.$_POST['name'], getUserID($_SERVER['REDIRECT_REMOTE_USER']), logger::information);
  header('Location: '.CP_PATH.'categories');
  return;
 }

 define('TITLE', 'Issue tracker :: Add Category');

 addDashboardItem('Actions', 'Add Category', 'addcategory');

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');

 require_once('pages/addcategory.php');

 require_once('lib/footer.php');


?>