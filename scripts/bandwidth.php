#!/usr/local/php-stable/bin/php -q
<?PHP

 foreach ($argv as $v) {
  if ($v == '--force-update') {
   echo 'Forcing config update.'."\n";
   define('UPDATE', true);
  } elseif ($v == '--debug') {
   echo 'Debug mode enabled.'."\n";
   define('DEBUG', true);
  } elseif ($v == '--double-debug') {
   echo 'Double debug mode enabled.'."\n";
   define('DOUBLEDEBUG', true);
  }
 }

 chdir('/home/utd/control');
 require_once('lib/database.php');
 require_once('lib/common.php');
 require_once('lib/log.php');
 chdir('/home/utd/scripts');

 $sql  = 'SELECT site_bandin, site_bandout, site_logpos';
 $sql .= ', site_id, user_id FROM sites';

 $res = mysql_query($sql);

 $users = array();

 while ($row = mysql_fetch_array($res)) {
  if (defined('DEBUG')) { echo "Checking site ".$row['site_id']."\n"; }
  $number = str_pad($row['site_id'], 3, '0', STR_PAD_LEFT);

  if (file_exists('/usr/local/apache/logs/'.$number.'-access_log')) {
   $access = fopen('/usr/local/apache/logs/'.$number.'-access_log','r');
   if (defined('DEBUG')) { echo 'Opening /usr/local/apache/logs/'.$number.'-access_log for reading.'."\n"; }
   fseek($access, (float)$row['site_logpos']);
   while (!feof($access)) {
    $line = trim(fgets($access));
    if (defined('DOUBLEDEBUG') && $line != '') { echo "Read: $line\n"; }
    if (preg_match('/^.* ([0-9]+) ([0-9]+)$/', $line, $matches)) {
     list( , $in, $out) = $matches;
     $row['site_bandin'] += (float)$in;
     $row['site_bandout'] += (float)$out; 
    } elseif (trim($line) != '') {
     if (defined('DEBUG')) { echo "Unrecognised line: $line\n"; }
    } 
   }
   $pos = ftell($access); fclose($access);
  } else {
   $pos = $row['site_logpos'];
  }

  if (!isset($users[($row['user_id'])])) { $users[($row['user_id'])] = 0; }
  $users[($row['user_id'])] += $row['site_bandin'] + $row['site_bandout'];

  if ($pos > 1024*1024*10) {
   logger::log('Archiving /usr/local/apache/logs/'.$number.'-access_log (>10M)', logger::information);
   $dir = '/usr/local/apache/logs/archived/'.$number;
   if (!is_dir($dir)) {
    mkdir($dir);
    chown($dir, 'admin');
    chmod($dir, 0700);
   }
   $count = count(glob($dir.'/*.log'))+1;
   $target = $dir.'/'.str_pad($count,5,'0',STR_PAD_LEFT).'.log';
   $pos = 0;
   rename('/usr/local/apache/logs/'.$number.'-access_log', $target);
  }

  $sql  = 'UPDATE sites SET site_bandin = '.$row['site_bandin'];
  $sql .= ', site_bandout = '.$row['site_bandout'];
  $sql .= ', site_logpos = '.$pos.' WHERE site_id = ';
  $sql .= $row['site_id'];

  mysql_query($sql);
 }

 foreach ($users as $key => $val) {
  mysql_query('UPDATE users SET band_used = '.$val.' WHERE user_id = '.$key);
  if (defined('DEBUG')) { echo "User $key has used $val Bytes.\n"; }
 }

 $sql  = "UPDATE sites SET site_curdocroot = site_docroot WHERE ";
 $sql .= "site_curdocroot = '/usr/local/apache/htdocs/bandquota'";
 mysql_query($sql);

 $sql  = "UPDATE users AS u, sites AS s SET s.site_curdocroot = ";
 $sql .= "'/usr/local/apache/htdocs/bandquota' WHERE s.user_id = u.user_id AND ";
 $sql .= "u.band_used > u.band_total";

 mysql_query($sql);

 require('updateconf.php'); 

?>
