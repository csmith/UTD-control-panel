<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');
 
 $categories = getCategories();
 $admins = getAdmins();

 if (!isset($_GET['n'])) { $_GET['n'] = 'list'; }

 if ($_GET['n'] == 'add') {
  if (isset($_POST['add'])) {
   $_GET['n'] = 'list';
   unset($_POST['add']);
   $_POST = repairPost($_POST);
   print_r($_POST);
   if (!empty($_POST['title'])) {
    $sql = 'INSERT INTO issues_searches (user_id, isea_name, isea_options) 
            VALUES (0, \''.m($_POST['title']).'\', \''.m(serialize($_POST)).'\')';
    mysql_query($sql) or die(mysql_error().'<br />'.$sql);
   }
  } else {
   $title = ' :: Add search';
   $page = 'addsearch.php';
  }
 }
 elseif ($_GET['n'] == 'edit') {
  if (isset($_GET['m']) && ctype_digit($_GET['m'])) {
   $title = ' :: Edit Search';
   $page = 'editsearch.php';
   if (!isset($_POST['edit'])) {
    $sql = 'SELECT isea_id, isea_name, isea_options FROM issues_searches WHERE isea_id = '.$_GET['m'].';';
    $res = mysql_query($sql);
    if (mysql_num_rows($res) == 0) {
     $_GET['n'] = 'list';
    } else {
     $data = mysql_fetch_assoc($res);
     $search = unserialize($data['isea_options']);
     $search['title'] = $data['isea_name']; 
     foreach($search as $key => $value) {
      if ($value == '<<me>>') {
       $search[$key] = getUserID($_SERVER['REDIRECT_REMOTE_USER']);
      }
     }
    }
   } else {
    echo 'moo';
   }
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
  }
 }
 elseif ($_GET['n'] == 'delete') {
  if (isset($_GET['m']) && ctype_digit($_GET['m'])) {
   $title = ' :: Delete search';
   $page = 'deletesearch.php';
  }
 }
 if ($_GET['n'] == 'list') {
   $title = ' :: List searches';
   $page = 'listsearch.php';
   $sql = 'SELECT isea_id, isea_name, isea_options FROM issues_searches WHERE user_id =\''.m(getUserID($_SERVER['REDIRECT_REMOTE_USER'])).'\';';
   $res = mysql_query($sql);
   $savedsearches = array();
   if (mysql_num_rows($res) > 0) {
    while ($data = mysql_fetch_assoc($res)) {
     $savedsearches[] = $data;
    }
   }
   $sql = 'SELECT isea_id, isea_name, isea_options FROM issues_searches WHERE user_id =\'0\';';
   $res = mysql_query($sql);
   $globalsavedsearches = array();
   if (mysql_num_rows($res) > 0) {
    while ($data = mysql_fetch_assoc($res)) {
     $globalsavedsearches[] = $data;
    }
   }
 }

 define('TITLE', 'Issue tracker :: Manage searches'.$title);

 addDashboardItem('Actions', 'Add new saved search', 'searches/add');

 include('res/commonDashboard.php');

 require_once('lib/header.php');
 echo '<p>Incomplete</p>';
 require_once('pages/'.$page);

 require_once('lib/footer.php');

?>
