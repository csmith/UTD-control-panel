<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 if (!isset($_GET['n']) || !ctype_digit($_GET['n'])) {
   header('Location: '.CP_PATH);
 }
 $sql  = 'SELECT i.i_id, c.icat_name, i.i_title, i.i_status, u1.user_name AS i_assignee,
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
 
 $sql  = 'SELECT irep_id, u1.user_name AS irep_user, irep_time, irep_text';
 $sql .= ' FROM issues_replies NATURAL JOIN users as u1';
 $sql .= ' WHERE u1.user_id = user_id AND i_id = '.m($_GET['n']);
 $sql .= ' ORDER BY irep_time';

 $viewIssueRepliesRes = mysql_query($sql) or die(mysql_error());

 $issueReplies = array();
 while ($viewIssueRepliesData = mysql_fetch_assoc($viewIssueRepliesRes)) {
   $issueReplies[$viewIssueRepliesData['irep_id']] = $viewIssueRepliesData;
 }

 define('TITLE', 'Issue tracker :: View Issue :: '.h($viewIssueData['i_title']));

 addDashboardItem('Actions', 'Raise new issue', 'addissue');
 addDashboardItem('Actions', 'Delete', 'deleteissue/'.$_GET['n']);
 addDashboardItem('Actions', 'Edit', 'editissue/'.$_GET['n']);
 addDashboardItem('Actions', 'Reply', 'addreply/'.$_GET['n']);
 addDashboardItem('Actions', 'View Log', 'viewlog/'.$_GET['n']);

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');

 require_once('pages/viewissue.php');

 require_once('lib/footer.php');


?>
