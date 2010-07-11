<?PHP

 chdir('..'); // So all our includes work right
 
 require('ext/pie.php');

 require('lib/common.php');
 require('lib/database.php');
 require('lib/account.php');
 
 $total = 0;
 
 $sql = 'SELECT site_name, site_bandin, site_bandout FROM sites WHERE user_id = '.UID;
 $res = mysql_query($sql); 
 $stuf = array();
 
 while ($row = mysql_fetch_array($res)) {
  $stuff[($row['site_name'])] = ((int)$row['site_bandin'] + (int)$row['site_bandout']	) ;
  $total += $stuff[($row['site_name'])];
 }
 
  $im = doPie('Bandwidth usage', $stuff); 
 
 header('Content-type: image/png');
 imagepng($im);

?>
