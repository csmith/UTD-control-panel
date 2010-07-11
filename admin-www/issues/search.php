<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 $admins = getAdmins();
 $categories = getCategories();
 if (isset($_POST['search'])) {
  $_POST = repairPost($_POST);
  $search = $_POST;
 } elseif (isset($_GET['n']) && ctype_digit($_GET['n'])) {
  $sql = 'SELECT isea_name, user_id, isea_options FROM issues_searches WHERE isea_id = '.m($_GET['n']).';';
  $res = mysql_query($sql) or die(mysql_error());
  if (mysql_num_rows($res) > 0) {
   $data = mysql_fetch_assoc($res);
   $search = unserialize($data['isea_options']);
   $search['title'] = $data['isea_name'];
   foreach($search as $key => $value) {
     if ($value == '<<me>>') {
       $search[$key] = getUserID($_SERVER['REDIRECT_REMOTE_USER']);
     }
   }
  }
 }
 if (isset($search)) {
  if (!isset($search['categories'])) {
    $search['categories'] = array();
  }
  if ($search['categories'] == 'all') {
   $search['categories'] = array_keys($categories);
  }
  if (!is_array($search['categories'])) {
    $search['categories'] = array($search['categories']);
  }
  if (!isset($search['priority'])) {
    $search['priority'] = array();
  }
  if ($search['priority'] == 'all') {
    $search['priority'] = array('urgent', 'high', 'normal', 'low');
  }
  if (!is_array($search['priority'])) {
    $search['priority'] = array($search['priority']);
  }
  if (!isset($search['status'])) {
    $search['status'] = array();
  }
  if ($search['status'] == 'all') {
    $search['status'] = array('open', 'assigned', 'closed', 'reopened');
  }
  if (!is_array($search['status'])) {
    $search['status'] = array($search['status']);
  }
 } else {
  $search = array();
  $search['keywords'] = '';
  $search['keywordloc'] = 'both';
  $search['submitter'] = 'any';
  $search['assignee'] = 'any';
  $search['added'] = 'any';
  $search['updated'] = 'any';
  $search['deadline'] = 'any';
  $search['priority'] = array('urgent', 'high', 'normal', 'low');
  $search['status'] = array('open', 'assigned', 'closed', 'reopened');
  $search['categories'] = array_keys($categories);
  $search['order'] = 'added';
  $search['limit'] = 20;
 }

 define('TITLE', 'Issue tracker :: Search');

 addDashboardItem('Actions', 'Raise new issue', 'addissue');

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');

 require_once('pages/searchform.php');
 require_once('pages/searchresults.php');
 
 require_once('lib/footer.php');


?>
