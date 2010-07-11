<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 if (!isset($_GET['n']) || !ctype_digit($_GET['n'])) {
   header('Location: '.CP_PATH.'categories');
 }
 
 $categories = getCategories();

 if (!isset($categories[$_GET['n']])) {
   header('Location: '.CP_PATH.'categories');
   return;
 }
 
 $sql = 'SELECT COUNT(*) FROM issues_issues WHERE icat_id = '.m($_GET['n']);
 $res = mysql_query($sql);
 $data = mysql_fetch_array($res);
 
 if ($data[0] == 0) {
   if (isset($_POST['confirm'])) {
    $sql = 'DELETE FROM issues_categories WHERE icat_id = '.m($_GET['n']);
    mysql_query($sql);
    $sql = 'DELETE FROM issues_assigns WHERE icat_id = '.m($_GET['n']);
    mysql_query($sql);
    logger::log('Issue tracker: category deleted: '.getCategoryName($_POST['n']), getUserID($_SERVER['REDIRECT_REMOTE_USER']), logger::information);
    header('Location: '.CP_PATH.'categories');
    return;
   } else {
     $sql = 'SELECT icat_id, icat_name FROM issues_categories WHERE icat_id = '.m($_GET['n']);
     $res = mysql_query($sql);
     $data = mysql_fetch_assoc($res);
     $data[0] = 0;
   }
 } else {
  $sql = 'SELECT i_id, i_title FROM issues_issues WHERE icat_id = '.m($_GET['n']);
  $res = mysql_query($sql);
 }

 define('TITLE', 'Issue tracker :: Delete Category :: '.h($categories[$_GET['n']]));

 addDashboardItem('Actions', 'Raise new issue', 'addissue');

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');
 
 require_once('pages/deletecategory.php');

 require_once('lib/footer.php');


?>
