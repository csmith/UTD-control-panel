<?PHP

 if (strpos(__FILE__, 'control-dev') !== false) {
  define('CP_PATH', '/dev/');
  define('DEVELOPMENT', True);
 } else {
  define('CP_PATH', '/control/');
  define('DEVELOPMENT', False);
 }

 require_once('lib/database.php');
 require_once('lib/log.php');
 
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
 function l ($message, $uid = false) { 
  logger::log($message, $uid);
 }

 function botlog ($message) {
  logger::log($message);
 }

 function bfc ($ip) {
  if (file_exists('/home/utd/bruteforce.dat')) {
   $data = unserialize(file_get_contents('/home/utd/bruteforce.dat'));
  } else {
   $data = array();
  }
  foreach ($data as $uip => $attempts) {
   foreach ($attempts as $id => $time) {
    if ($time < time()-1800) { unset($data[$uip][$id]); }
   }
   if (count($data[$uip]) == 0) { unset($data[$uip]); }
  }
  if (!isset($data[$ip])) { $data[$ip] = array(); }
  $data[$ip][] = time();
  file_put_contents('/home/utd/bruteforce.dat', serialize($data));
  if (count($data[$ip]) > 4) {
   $sql  = 'INSERT INTO ipbans (ipban_ip, ipban_expires, ipban_message) ';
   $sql .= 'VALUES (\''.m($ip).'\', '.(time()+60*60*24).', \'Too many login';
   $sql .= ' attempts.\')';
   mysql_query($sql);
   logger::log('Placing IP ban on '.$ip.' for bruteforcing',logger::important);
   header('Location: '.CP_PATH.'403');
   exit;
  }
 }

 function duration ($secs, $dopast = false) {
  $res = '';
  $times = array();
  $times['year'] = (60*60*24*365);
  $times['month'] = (60*60*24*30);
  $times['week'] = (60*60*24*7);
  $times['day'] = (60*60*24);
  $times['hour'] = (60*60);
  if ($secs < $times['hour']) { $times['minute'] = 60; }
  if ($secs < $times['minute']) { $times['second'] = 1; }

  foreach ($times as $name => $val) {
   if ($secs >= $val) {
    $years = floor($secs/$val);
    $res .= ', '.$years.' '.$name.(($years!=1)?'s':'');
    $secs = $secs % $val;
   }
  }

  $res = substr($res, 2);

  if ($res == '' && $dopast === true) {
   $res = 'now';
  } elseif ($res == '' && $dopast == '0') {
   $res = '0 seconds';
  }

  return $res;
 }
 
 define('LIB_COMMON', true);

?>
