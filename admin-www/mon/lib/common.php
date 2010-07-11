<?PHP

 if (defined('LIB_COMMON')) { return; }

 require_once('lib/database.php');
 
 define('CP_PATH', '/mon/');
 
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
  if ($uid === false ){ $uid = UID; }; mysql_query('INSERT INTO log (log_time, user_id, log_message) VALUES ('.time().', '.$uid.', \''.m($message).'\')') or print(mysql_error());
  $sql = 'SELECT user_name FROM users WHERE user_id = '.$uid;
  $res = mysql_query($sql);
  $row = mysql_fetch_array($res);
  botlog('User '.chr(2).$row[0].chr(2).': '.$message);
 }

 function botlog ($message) {
  if ($fh = @fsockopen('soren.dataforce.org.uk',7530,$errno,$errstr,0.2)) {
   fputs($fh, 'ZOMGutdSTAFF '.$message."\r\n");
   fclose($fh);
  }
 }
 
 define('LIB_COMMON', true);

?>
