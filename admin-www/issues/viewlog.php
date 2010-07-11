<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 if (!isset($_GET['n']) || !ctype_digit($_GET['n'])) {
   header('Location: '.CP_PATH);
 }
 
 $sql  = 'SELECT i_title FROM issues_issues WHERE i_id = '.m($_GET['n']);
 
 $viewIssueRes = mysql_query($sql) or die(mysql_error().'<br />'.$sql);
 
 if (mysql_num_rows($viewIssueRes) == 0) {
   header('Location: '.CP_PATH);
 }

 $viewIssueData = mysql_fetch_assoc($viewIssueRes);

 $sql  = 'SELECT ilog_id, ilog_time, user_name, ilog_field, ilog_old, ilog_new';
 $sql .= ' FROM issues_logs NATURAL JOIN users';
 $sql .= ' WHERE i_id = '.m($_GET['n']);
 $sql .= ' ORDER BY ilog_time';
 
 $viewIssueChangesRes = mysql_query($sql) or die(mysql_error());

 $issueChanges = array();
 while ($viewIssueChangesData = mysql_fetch_assoc($viewIssueChangesRes)) {
   $issueChanges[$viewIssueChangesData['ilog_id']] = $viewIssueChangesData;
 }

 define('TITLE', 'Issue tracker :: View Issue Changes :: '.h($viewIssueData['i_title']));

 addDashboardItem('Actions', 'Raise new issue', 'addissue');
 addDashboardItem('Actions', 'Edit', 'editissue/'.$_GET['n']);
 addDashboardItem('Actions', 'Reply', 'addreply/'.$_GET['n']);
 addDashboardItem('Actions', 'View Log', 'viewlog/'.$_GET['n']);
 
 include_once('res/commonDashboard.php');

 require_once('lib/header.php');
 
 require_once('pages/viewlog.php');

 require_once('lib/footer.php');


?>