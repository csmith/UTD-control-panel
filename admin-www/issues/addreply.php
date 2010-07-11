<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 if (!isset($_GET['n']) && !ctype_digit($_GET['n'])) {
   header('Location: '.CP_PATH.'viewissues');
 }
 
 $sql = 'SELECT i_id FROM issues_issues WHERE i_id = '.m($_GET['n']);
 $res = mysql_query($sql);
 if (mysql_num_rows($res) == 0) {
   header('Location: '.CP_PATH.'viewissues');
 }

 if (isset($_POST['submit'])) {
  if ($_POST['text'] == '') {
   header('Location: '.CP_PATH.'viewissue/'.$_GET['n']);
  }

  $sql = 'INSERT INTO issues_replies
            (irep_id, i_id, user_id, irep_time, irep_text)
             VALUES(\'0\', \''.m($_GET['n']).'\', \''.m(getUserID($_SERVER['REDIRECT_REMOTE_USER'])).'\',
             \''.time().'\', \''.m($_POST['text']).'\')';

  $res = mysql_query($sql) or die(mysql_error().'<br />'.$sql);
  $sql = 'UPDATE issues_issues SET i_updated = \''.time().'\' WHERE i_id = \''.$_GET['n'].'\';';
  $res = mysql_query($sql) or die(mysql_error().'<br />'.$sql);
  logger::log('Issue tracker: reply added to : '.getIssueInfo($_GET['n']), getUserID($_SERVER['REDIRECT_REMOTE_USER']), logger::information);
  header('Location: '.CP_PATH.'viewissue/'.$_GET['n'].'#'.mysql_insert_id());
  return;
 }

 $categories = getCategories();
 $admins = getAdmins();

 define('TITLE', 'Issue tracker :: Add Issue');

 addDashboardItem('Actions', 'Raise new issue', 'addissue');

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');

 require_once('pages/addreply.php');

 require_once('lib/footer.php');


?>
