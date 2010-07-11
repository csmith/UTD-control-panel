#!/usr/bin/php -q
<?php
  mysql_connect('localhost', 'admin', 'admin7521');
  mysql_select_db('admin');
  $message = 'Time'."\t\t\t\t\t".'User                '."\t".'Level     '."\t".'Message'."\r\n";
  $message .= '----'."\t\t\t\t\t".'----               '."\t".'----     '."\t".'----'."\r\r";
  $sql  = 'SELECT user_name, log_level, log_time, log_message FROM log ';
  $sql .= 'NATURAL JOIN users WHERE log_time > UNIX_TIMESTAMP()-86400';
  $res = mysql_query($sql);
  while ($row = mysql_fetch_array($res)) {
    $message .= date('r', $row['log_time'])."\t\t".str_pad($row['user_name'],20)."\t".str_pad($row['log_level'], 10)."\t".$row['log_message']."\r\r";
  }
  echo $message;
?>
