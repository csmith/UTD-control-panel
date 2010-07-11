<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');

 $admins = getAdmins();
 $categories = getCategories();

 $search = array();
 $search['title'] = 'Recently updated issues';
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
 $search['order'] = 'updateddesc';
 $search['limit'] = 20;

 define('TITLE', 'Issue tracker');

 addDashboardItem('Actions', 'Raise new issue', 'addissue');

 include_once('res/commonDashboard.php');

 require_once('lib/header.php');

 require_once('pages/searchresults.php');
 
 require_once('lib/footer.php');


?>
