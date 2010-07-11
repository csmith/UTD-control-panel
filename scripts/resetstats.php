#!/usr/local/php-stable/bin/php -q
<?PHP

 foreach ($argv as $v) {
  if ($v == '--debug') {
   define('DEBUG', true);
  }
 }

 mysql_connect('localhost', 'admin', 'admin7521');
 mysql_select_db('admin');

 $sql = 'SELECT user_id, user_limitstarts, user_limitends, band_used, hdd_used FROM users WHERE ';
 $sql .= ' user_limitends < '.time();

 $res = mysql_query($sql);

 while ($row = mysql_fetch_array($res)) {
  $sql = 'INSERT INTO historic_user (user_id, hu_start, hu_end, hu_hdd, hu_bw)';
  $sql .= ' VALUES ('.$row['user_id'].', '.$row['user_limitstarts'].', ';
  $sql .= time().', '.$row['hdd_used'].', '.$row['band_used'].')';

  mysql_query($sql) or die(mysql_error());
  
  $sql = 'UPDATE users SET user_limitstarts = '.time().', user_limitends = ';
  $sql .= (time() + 2629728).', band_used = 0 WHERE user_id = ';
  $sql .= $row['user_id'];

  mysql_query($sql) or die(mysql_error());

  $sql = 'UPDATE sites SET site_bandin = 0, site_bandout = 0 WHERE user_id = ';
  $sql .= $row['user_id'];

  mysql_query($sql) or die(mysql_error());
 
 }

?>
