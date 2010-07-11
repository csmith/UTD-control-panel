<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/account.php');

 checkAccess(HAS_HOSTING);

 if (!isset($_GET['n']) || !preg_match('/^[0-9]+$/',$_GET['n']) && !isset($error)) {
   $error = 'Invalid site ID!';
   die($error);
   define('TITLE', 'Error');
 } elseif (!defined('UID')) {
   $error = 'You must be logged in to view site statistics.';
   die($error);
   define('TITLE', 'Error');
 } else {
   $site = $_GET['n'];
   $sql = 'SELECT site_id, user_id, site_name, site_docroot FROM sites WHERE site_id = '.$site;
   $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
   
   if (mysql_num_rows($res) == 0) {
     $error = 'There is no such site with that ID.';
     die($error);
     define('TITLE', 'Error');
   } else {
   
    $row = mysql_fetch_array($res);
   
    if ($row['user_id'] != UID && !defined('ADMIN')) {
	  $error = 'You do not own this site.';
      die($error);
	  define('TITLE', 'Error');
    } else {
      define('SITE_ID', $row['site_id']);
      define('SITE_NAME', $row['site_name']);
      define('SITE_DOCROOT', $row['site_docroot']);
      define('TITLE', 'Edit site: '.$row['site_name']);
    }
   }
 } 

 if (!isset($_GET['f'])) { header('Location: /control/sitestats/'.SITE_ID.'/'); }

 if (empty($_GET['f'])) { $_GET['f'] = 'index.html'; }

 $file = '/home/utd/stats/'.str_pad(SITE_ID,3,'0',STR_PAD_LEFT).'/'.$_GET['f'];
 
 if (dirname(realpath($file)) != '/home/utd/stats/'.str_pad(SITE_ID,3,'0',STR_PAD_LEFT)) {
  die('Invalid path');
 }

 if (!file_exists($file)) { die('Invalid path'); }

 if (substr($file, -3) == 'png') { header('Content-type: image/png'); }

 readfile($file);

?>
