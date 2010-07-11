<?PHP

 function messagemail ($message) {
  $sql  = 'SELECT message_id, message_title, message_time, message_body, ';
  $sql .= 'message_type FROM messages WHERE message_id = '.$message;
  
  $res = mysql_query($sql);
  $row = mysql_fetch_array($res);

  $sql  = 'SELECT user_email FROM users WHERE mail_announce = 1';
  if ($row['message_type'] == 'admin') {
   $sql .= ' AND user_admin = 1';
  }
  
  $res = mysql_query($sql);
  
  while ($usr = mysql_fetch_array($res)) { 
   $to = $usr['user_email'];
   $subject = 'UTD-Hosting announcement: '.$row['message_title'];
   $body  = 'This is an automated message. A new UTD-Hosting announcement ';
   $body .= 'has been posted. The announcement is displayed below for your ';
   $body .= 'convenience. To opt out of these messages, please log into the ';
   $body .= 'control panel at https://secure.utd-hosting.com/control/ and ';
   $body .= 'select the "User preferences" link.'."\n\n";
   $body .= ' ============ '.$row['message_title'].' ============';
   $body .= "\n\n".$row['message_body']."\n\n";
   $body .= ' ============ End of message ========= '."\n\n";
   $body .= "\n\n-- UTD-Hosting support";
   mail($to, $subject, $body, 'From: support@utd-hosting.com (UTD-Hosting support)'); 
  }
 }

?>
