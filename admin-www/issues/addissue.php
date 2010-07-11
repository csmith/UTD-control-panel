<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 if (isset($_POST['submit'])) {
  $_POST['title'] = trim($_POST['title']);
  $_POST['text'] = trim($_POST['text']);
  if (empty($_POST['title']) || empty($_POST['text'])) {
   header('Location: '.CP_PATH);
   return;
  }
  if ($_POST['deadline'] == 'none') {
   $_POST['deadline'] = 0;
  }
  if ($_POST['assignee'] != '') {
   $_POST['status'] = 'assigned';
  } else {
   $sql = 'SELECT icat_assign FROM issues_categories WHERE icat_id = '.m($_POST['category']).'';
   $catRes = mysql_query($sql);
   $catData = mysql_fetch_assoc($catRes);
   if ($catData['icat_assign'] != 0) {
    $_POST['status'] = 'assigned';
    $_POST['assignee'] = $catData['icat_assign'];
   } else {
    $_POST['status'] = 'open';
   }
  }
  $sql = 'INSERT INTO issues_issues
            (i_id, icat_id, i_submitter, i_assignee, i_priority, i_added, i_updated, i_deadline, i_title, i_status, i_text, i_extensiveness)
            VALUES(\'0\', \''.m($_POST['category']).'\', \''.m(getUserID($_SERVER['REDIRECT_REMOTE_USER'])).'\',
             \''.m($_POST['assignee']).'\', \''.m($_POST['priority']).'\', \''.time().'\', \''.time().'\', 
             '.(($_POST['deadline'] == 0) ? '0' : strtotime($_POST['deadline'])).',  \''.m($_POST['title']).'\',
             \''.m($_POST['status']).'\', \''.m($_POST['text']).'\', \''.m($_POST['extensiveness']).'\')';

  $res = mysql_query($sql) or die(mysql_error().'<br />'.$sql);
  logger::log('Issue tracker: issue added: '.getCategoryName($_POST['category']).': '.$_POST['title'], getUserID($_SERVER['REDIRECT_REMOTE_USER']), logger::information);
  header('Location: http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF'])).'/viewissue/'.mysql_insert_id());
  return;
 }

 $categories = getCategories();
 $admins = getAdmins();

 define('TITLE', 'Issue tracker :: Add Issue');

 addDashboardItem('Actions', 'Raise new issue', 'addissue');

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');

 require_once('pages/addissue.php');

 require_once('lib/footer.php');


?>
