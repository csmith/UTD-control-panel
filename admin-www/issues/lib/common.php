<?PHP

 if (defined('LIB_COMMON')) { return; }

 require_once('lib/database.php');
 //require_once('lib/account.php');
 require_once('lib/log.php');
 
 define('CP_PATH', '/issues/');

 function stripSlashesDeep($value) {
    $value = is_array($value) ? array_map('stripslashesDeep', $value) : (isset($value) ? stripslashes($value) : null);
    return $value;
  }

 function stripSlashesOnInput() {
    if (get_magic_quotes_gpc()) {
      $_POST = stripSlashesDeep($_POST);
      $_GET = stripSlashesDeep($_GET);
      $_COOKIE = stripSlashesDeep($_COOKIE);
    }
  }

 function repairPost($data) {
  $rawpost = "&".file_get_contents("php://input");
   while(list($key,$value)= each($data)) {
    $pos = preg_match_all("/&".$key."=([^&]*)/i",$rawpost, $regs, PREG_PATTERN_ORDER);
    if((!is_array($value)) && ($pos > 1)) {
     $qform[$key] = array();
     for($i = 0; $i < $pos; $i++) {
      $qform[$key][$i] = urldecode($regs[1][$i]);
     }
    } else {
    $qform[$key] = $value;
   }
  }
  return $qform;
 }

 function getAdmins() {
  $sql = 'SELECT user_id, user_name FROM users WHERE user_admin = 1 AND user_pass != \'invalid\' ORDER BY user_name';
  $adminsRes = mysql_query($sql);
  if (mysql_num_rows($adminsRes) == 0) {
   return array();
  }
  while ($adminsData = mysql_fetch_assoc($adminsRes)) {
   $admins[$adminsData['user_id']] = $adminsData['user_name'];
  }
  return $admins;
 }

 function getCategories() {
  $sql = 'SELECT icat_id, icat_name, icat_assign FROM issues_categories ORDER BY icat_name';
  $categoriesRes = mysql_query($sql);
  if (mysql_num_rows($categoriesRes) == 0) {
   return array();
  }
  $categories = array();
  while ($categoriesData = mysql_fetch_assoc($categoriesRes)) {
   $categories[$categoriesData['icat_id']] = $categoriesData['icat_name'];   
  }
  return $categories;
 }
 
 function getCategoriesInfo() {
  $sql = 'SELECT icat_id, icat_name, icat_assign FROM issues_categories ORDER BY icat_name';
  $categoriesRes = mysql_query($sql);
  if (mysql_num_rows($categoriesRes) == 0) {
   return array();
  }
  $categories = array();
  while ($categoriesData = mysql_fetch_assoc($categoriesRes)) {
   $categories[$categoriesData['icat_id']] = array('name'=>$categoriesData['icat_name'], 'assign'=>$categoriesData['icat_assign']);
  }
  return $categories;
 }

 function getUserID($name) {
   $sql = 'SELECT user_id FROM users WHERE user_name = \''.m($name).'\'';
   $res = mysql_query($sql);
   if (mysql_num_rows($res) == 0) {
     return 0;
   }
   $result = mysql_fetch_assoc($res);
   return $result['user_id'];
 }

function getUserName($id) {
   $sql = 'SELECT user_name FROM users WHERE user_id = '.m($id);
   $res = mysql_query($sql);
   if (mysql_num_rows($res) == 0) {
     return 'Unknown';
   }
   $result = mysql_fetch_assoc($res);
   return $result['user_name'];
 }
 
 function getCategoryID($name) {
   $sql = 'SELECT icat_id FROM issues_categories WHERE icat_name = \''.m($name).'\'';
   $res = mysql_query($sql);
   if (mysql_num_rows($res) == 0) {
     return 0;
   }
   $result = mysql_fetch_assoc($res);
   return $result['icat_id'];
 }

 function getCategoryName($id) {
   $sql = 'SELECT icat_name FROM issues_categories WHERE icat_id = '.m($id);
   $res = mysql_query($sql);
   if (mysql_num_rows($res) == 0) {
     return 'Unknown';
   }
   $result = mysql_fetch_assoc($res);
   return $result['icat_name'];
 }
 
 function getIssueTitle($id) {
  $sql = 'SELECT i_title FROM issues_issues WHERE i_id = '.m($id);
  $res = mysql_query($sql);
  if (mysql_num_rows($res) == 0) {
   return 'Unknown';
  }
  $result = mysql_fetch_assoc($res);
  return $result['i_title'];
 }

 function getIssueInfo($id) {
  $sql = 'SELECT i_title, icat_name FROM issues_issues NATURAL JOIN issues_categories WHERE i_id = '.m($id);
  $res = mysql_query($sql);
  if (mysql_num_rows($res) == 0) {
   return 'Unknown : Unknown';
  }
  $result = mysql_fetch_assoc($res);
  return $result['icat_name'].': '.$result['i_title'];
 }
 
 function NiceSize($bytes) {
  $sizes = array();
  $sizes[1024] = ' <abbr title="Kibibytes">KiB</abbr>';
  $sizes[(1024*1024)] = ' <abbr title="Mebibytes">MiB</abbr>';
  $sizes[(1024*1024*1024)] = ' <abbr title="Gibibytes">GiB</abbr>';
  krsort($sizes);
  foreach ($sizes as $val => $name) {
   if ($bytes > ($val * 1.2)) {
    return round($bytes/$val, 2).$name;
   }
  }
  return $bytes.' <abbr title="Bytes">B</abbr>';
 }
 
 function h ($text) { return htmlspecialchars($text); } 
 function m ($a) { return mysql_real_escape_string($a); }

 function n ($user) {
  if (strtolower($user) == strtolower($_SERVER['REDIRECT_REMOTE_USER'])) {
   return '<strong>You</strong>';
  } elseif ($user == '') {
   return '<span style="font-style: italic;">None</span>';
  } else {
   return h($user);
  }
 }
 
 function d($format, $timestamp) {
   if ($timestamp == 0) {
     return '<span style="font-style: italic;">None</span>';
   }
   return date($format, $timestamp);
 }

 function duration($seconds=0, $max_periods=7)
 {
  if (empty($seconds)) {
    return '0 seconds';
  }
  $periods = array("year" => 31536000, "month" => 2419200, "week" => 604800, "day" => 86400, "hour" => 3600, "minute" => 60, "second" => 1);
  $i = 1;
  foreach ( $periods as $period => $period_seconds )
  {
   $period_duration = floor($seconds / $period_seconds);
   $seconds = $seconds % $period_seconds;
   if ( $period_duration == 0 )
   {
    continue;
   }
   $duration[] = "{$period_duration} {$period}" . ($period_duration > 1 ? 's' : '');
   $i++;
   if ( $i >  $max_periods )
   {
    break;
   }
  }
  return implode(' ', $duration);
 }
 
 stripSlashesOnInput();

 define('LIB_COMMON', true);

?>
