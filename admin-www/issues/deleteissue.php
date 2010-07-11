<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 if (!isset($_GET['n']) || !ctype_digit($_GET['n'])) {
   header('Location: '.CP_PATH);
 }
 $sql  = 'SELECT i_id, i_title FROM issues_issues WHERE i_id = '.m($_GET['n']);

 $viewIssueRes = mysql_query($sql) or die(mysql_error().'<br />'.$sql);

 if (mysql_num_rows($viewIssueRes) == 0) {
   header('Location: '.CP_PATH);
 }
 
 $viewIssueData = mysql_fetch_assoc($viewIssueRes);
 
 if (isset($_POST['confirm'])) {
   $sql = 'DELETE FROM issues_issues WHERE i_id = '.m($_GET['n']);
   mysql_query($sql);
   $sql = 'DELETE FROM issues_replies WHERE i_id = '.m($_GET['n']);
   mysql_query($sql);
   $sql = 'DELETE FROM issues_logs WHERE i_id = '.m($_GET['n']);
   mysql_query($sql);
   logger::log('Issue tracker: issue deleted: '.$viewIssueData['i_title'], getUserID($_SERVER['REDIRECT_REMOTE_USER']), logger::information);
   header('Location: '.CP_PATH);
   return;
 }

 $sql  = 'SELECT COUNT(*) FROM issues_replies WHERE i_id = '.m($_GET['n']);
 $viewIssueRepliesRes = mysql_query($sql) or die(mysql_error());
 $viewIssueRepliesData = mysql_fetch_array($viewIssueRepliesRes);
 
 $sql  = 'SELECT COUNT(*) FROM issues_logs WHERE i_id = '.m($_GET['n']);
 $viewIssueChangesRes = mysql_query($sql) or die(mysql_error());
 $viewIssueChangesData = mysql_fetch_array($viewIssueChangesRes);


 define('TITLE', 'Issue tracker :: Delete Issue :: '.h($viewIssueData['i_title']));

 addDashboardItem('Actions', 'Raise new issue', 'addissue');

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');
 
 require_once('pages/deleteissue.php');

 require_once('lib/footer.php');


?>