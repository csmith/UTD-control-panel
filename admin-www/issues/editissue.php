<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 if (!isset($_GET['n']) || !ctype_digit($_GET['n'])) {
   header('Location: '.CP_PATH);
 }

 $categories = getCategories();
 $admins = getAdmins();

 $sql  = 'SELECT i.i_id, i.icat_id, c.icat_name, i.i_title, i.i_status, u1.user_name AS i_assignee,
 u2.user_name AS i_submitter, i.i_priority, i.i_added, i.i_deadline, i.i_updated, i.i_text, i.i_extensiveness
 FROM issues_issues AS i
 LEFT JOIN issues_categories AS c ON i.icat_id = c.icat_id
 LEFT JOIN users AS u1 ON i.i_assignee = u1.user_id
 LEFT JOIN users AS u2 ON i.i_submitter = u2.user_id
 WHERE i_id = '.m($_GET['n']);
 
 $viewIssueRes = mysql_query($sql) or die(mysql_error().'<br />'.$sql);

 if (mysql_num_rows($viewIssueRes) == 0) {
   header('Location: '.CP_PATH);
 }

 $viewIssueData = mysql_fetch_assoc($viewIssueRes);

 if (isset($_POST['submit'])) {
  if ($_POST['deadline'] == 'none') {
   $_POST['deadline'] = 0;
  }
  if ($_POST['assignee'] == '') {
    $_POST['assignee'] = 0;
  }
  if ($_POST['assignee'] != '' && $_POST['status'] != 'closed') {
   $_POST['status'] = 'assigned';
  }
  $changed = false;
  if ($_POST['assignee'] != $viewIssueData['i_assignee']) {
   $changed = true;
   $sql = 'INSERT INTO issues_logs
           VALUES (0, '.m($_GET['n']).', '.time().', \''.m(getUserID($_SERVER['REDIRECT_REMOTE_USER'])).'\', \'assignee\', \''.m($viewIssueData['i_assignee']).'\', \''.m($_POST['assignee']).'\')';
   mysql_query($sql) or die($sql."<br>".mysql_error());
  }
  if ($_POST['status'] != $viewIssueData['i_status']) {
   $changed = true;
   $sql = 'INSERT INTO issues_logs
           VALUES (0, '.m($_GET['n']).', '.time().', \''.m(getUserID($_SERVER['REDIRECT_REMOTE_USER'])).'\', \'status\', \''.m($viewIssueData['i_status']).'\', \''.m($_POST['status']).'\')';
   mysql_query($sql) or die($sql."<br>".mysql_error());
  }
  if ($_POST['title'] != $viewIssueData['i_title']) {
   $changed = true;
   $sql = 'INSERT INTO issues_logs
           VALUES (0, '.m($_GET['n']).', '.time().', \''.m(getUserID($_SERVER['REDIRECT_REMOTE_USER'])).'\', \'title\', \''.m($viewIssueData['i_title']).'\', \''.m($_POST['title']).'\')';
   mysql_query($sql) or die($sql."<br>".mysql_error());
  }
  if ($_POST['text'] != $viewIssueData['i_text']) {
   $changed = true;
   $sql = 'INSERT INTO issues_logs
           VALUES (0, '.m($_GET['n']).',  '.time().', \''.m(getUserID($_SERVER['REDIRECT_REMOTE_USER'])).'\', \'text\', \''.m($viewIssueData['i_text']).'\', \''.m($_POST['text']).'\')';
   mysql_query($sql) or die($sql."<br>".mysql_error());
  }
  if ($_POST['category'] != $viewIssueData['icat_id']) {
   $changed = true;
   $sql = 'INSERT INTO issues_logs
           VALUES (0, '.m($_GET['n']).',  '.time().', \''.m(getUserID($_SERVER['REDIRECT_REMOTE_USER'])).'\', \'category\', \''.m($viewIssueData['icat_id']).'\', \''.m($_POST['category']).'\')';
   mysql_query($sql) or die($sql."<br>".mysql_error());
  }
  if ($_POST['priority'] != $viewIssueData['i_priority']) {
   $changed = true;
   $sql = 'INSERT INTO issues_logs
           VALUES (0, '.m($_GET['n']).',  '.time().', \''.m(getUserID($_SERVER['REDIRECT_REMOTE_USER'])).'\', \'priority\', \''.m($viewIssueData['i_priority']).'\', \''.m($_POST['priority']).'\')';
   mysql_query($sql) or die($sql."<br>".mysql_error());
  }
  if (strtotime($_POST['deadline']) != $viewIssueData['i_deadline']) {
   $changed = true;
   $sql = 'INSERT INTO issues_logs
           VALUES (0, '.m($_GET['n']).',  '.time().', \''.m(getUserID($_SERVER['REDIRECT_REMOTE_USER'])).'\', \'deadline\', \''.m($viewIssueData['i_deadline']).'\', \''.m(strtotime($_POST['deadline'])).'\')';
   mysql_query($sql) or die($sql."<br>".mysql_error());
  }
  if ($_POST['extensiveness'] != $viewIssueData['i_extensiveness']) {
   $changed = true;
   $sql = 'INSERT INTO issues_logs
           VALUES (0, '.m($_GET['n']).',  '.time().', \''.m(getUserID($_SERVER['REDIRECT_REMOTE_USER'])).'\', \'extensiveness\', \''.m($viewIssueData['i_extensiveness']).'\', \''.m(strtotime($_POST['extensiveness'])).'\')';
   mysql_query($sql) or die($sql."<br>".mysql_error());
  }
  if ($changed) {
   $sql = 'UPDATE issues_issues
           SET i_title = \''.m($_POST['title']).'\', i_status = \''.m($_POST['status']).'\',
               i_assignee = \''.m($_POST['assignee']).'\', i_text = \''.m($_POST['text']).'\',
               i_updated = '.time().', icat_id = '.m($_POST['category']).', i_priority = \''.m($_POST['priority']).'\',
               i_deadline = '.m(strtotime($_POST['deadline'])).', i_extensiveness = \''.m($_POST['extensiveness']).'\' 
          WHERE i_id = '.m($_GET['n']);
   $res = mysql_query($sql) or die($sql."<br>".mysql_error());
   logger::log('Issue tracker: issue edited: '.getCategoryName($_POST['category']).': '.$_POST['title'], getUserID($_SERVER['REDIRECT_REMOTE_USER']), logger::information);
  }
  header('Location: '.CP_PATH.'viewissue/'.$_GET['n']);
  return;
 }

 define('TITLE', 'Issue tracker :: Edit Issue :: '.h($viewIssueData['i_title']));

 addDashboardItem('Actions', 'Raise new issue', 'addissue');
 addDashboardItem('Actions', 'Edit', 'editissue/'.$_GET['n']);
 addDashboardItem('Actions', 'Reply', 'addreply/'.$_GET['n']);
 addDashboardItem('Actions', 'View Log', 'viewlog/'.$_GET['n']);

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');
 
 require_once('pages/editissue.php');

 require_once('lib/footer.php');


?>
