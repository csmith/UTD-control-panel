<?PHP

if (defined('LIB_DASHBOARD')) { return; }

$dbitems = array();

function addDashboardItem ($category, $title, $url) {
  global $dbitems;
  
  if (!isset($dbitems[$category])) {
    $dbitems[$category] = array();
  }
  
  $dbitems[$category][$title] = $url;
}

function generateDashboard () {
  global $dbitems;
  
  ksort($dbitems);
  
  foreach ($dbitems as $k => $v) { ksort($dbitems[$k]); }
  
  echo '<div id="dashboard">';
  
  foreach ($dbitems as $category => $data) {
    echo '<h2>'.$category.'</h2><ul>';  
    foreach ($data as $title => $url) {
      if ($url[0] != '#' && substr($url,0,7) != 'http://') { 
	    $url = CP_PATH.$url;
      }
      echo '<li><a href="'.htmlspecialchars($url).'">'.$title.'</a></li>';
    }
    echo '</ul>';
  }
  
  echo '</div>';
}

define('LIB_DASHBOARD', true);

?>
