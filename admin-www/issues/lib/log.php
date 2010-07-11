<?PHP

 require_once('lib/database.php');

 class logger {

  const unknown = "'unknown'";
  const critical = "'critical'";
  const important = "'important'";
  const normal = "'normal'";
  const information = "'info'";
  const info = "'info'";

  static function log ($message, $uid = false, $level = logger::unknown) {
   if ($uid !== false && !ctype_digit($uid)) {
    $temp = $level;
    $level = $uid;
    $uid = $temp;
   }

   if ($uid === false || !ctype_digit($uid)) {
    if (defined('UID')) { $uid = UID; } else { $uid = 5; }
   }

   $sql  = 'INSERT INTO log (user_id, log_level, log_time, log_message) ';
   $sql .= 'VALUES('.$uid.', '.$level.', '.time().', \''.m($message).'\')';
   mysql_query($sql);

   $botmsg = '';
   switch ($level) {
    case self::critical:
     $botmsg = chr(2).chr(3).'4CRITICAL:'.chr(3).chr(2); break;
    case self::important:
     $botmsg = chr(2).'IMPORTANT:'.chr(2); break;
    case self::normal:
     $botmsg = 'NORMAL:'; break;
    case self::unknown:
     $botmsg = 'UNKNOWN:'; break;
    case self::information:
     $botmsg = chr(3).'14INFORMATION:'.chr(3); break;
   }

   if ($uid != 5) {
    $sql = 'SELECT user_name FROM users WHERE user_id = '.$uid;
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    $botmsg .= ' User '.$row['user_name'].':';
   }

   $botmsg .= ' '.$message;

   if ($fh = @fsockopen('207.150.170.50',7530,$errno,$errstr,0.1)) {
    fputs($fh, '...'.$botmsg."\r\n");
    fclose($fh);
   }
  }
 }

?>
