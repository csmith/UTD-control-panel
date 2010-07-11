<?php

 require_once('lib/common.php');

 if (DEVELOPMENT) {
  $_queries = array();
 }

 function mq($sql, $file = '/home/utd/control-dev/Unknown', $line = 'Unknown') {
  if (DEVELOPMENT) {
   $start = microtime(true);
  }

  $res = mysql_query($sql) or mf($file, $line, $sql);

  if (DEVELOPMENT) {
   $end = microtime(true);
   
   global $_queries;
   $_queries[] = array($sql, $end - $start, $file, $line);
  }

  return $res;
 }

?>
