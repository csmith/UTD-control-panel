<?PHP

 function ticketmail ($ticket) {
  $sql  = 'SELECT t.ticket_thread, u.user_name, t.ticket_body FROM tickets AS';
  $sql .= ' t, users AS u WHERE t.ticket_id = '.$ticket.' AND u.user_id = ';
  $sql .= 't.user_id';
  
  $res = mysql_query($sql);
  $row = mysql_fetch_array($res);

  $sql  = 'SELECT u.user_email, u.mail_tickets, t.ticket_title FROM tickets AS';  $sql .= ' t, users AS u';
  $sql .= ' WHERE t.ticket_id = '.$row['ticket_thread'].' AND u.user_id = ';
  $sql .= ' t.user_id';
  
  $res = mysql_query($sql);
  $usr = mysql_fetch_array($res);

  if ($usr['mail_tickets'] == '1') {
   $to = $usr['user_email'];
   $subject = 'UTD-Hosting ticket: '.$usr['ticket_title'];
   $body  = 'This is an automated message. A reply has been made to one of';
   $body .= ' your tickets. A full copy of the message follows. ';
   $body .= 'You can view the entire thread and make replies at';
   $body .= ' https://secure.utd-hosting.com/control/viewticket/'.$row['ticket_thread'];
   $body .= ' and unsubscribe from these updates at ';
   $body .= 'https://secure.utd-hosting.com/control/prefs.'."\n\n";
   $body .= ' ============ Message from '.$row['user_name'].' ============';
   $body .= "\n\n".$row['ticket_body']."\n\n";
   $body .= ' ============ End of message ========= '."\n\n";
   $body .= "Please do not ";
   $body .= 'reply to this e-mail -- use the reply form at the URL above. ';
   $body .= "\n\n-- UTD-Hosting support";
   mail($to, $subject, $body, 'From: support@utd-hosting.com (UTD-Hosting support)'); 
  }
 }

 function adminTicketMail($ticket) {
  $sql  = 'SELECT t.ticket_title, t.ticket_thread, u.user_name, t.ticket_body FROM tickets AS';
  $sql .= ' t, users AS u WHERE t.ticket_id = '.$ticket.' AND u.user_id = ';
  $sql .= 't.user_id';

  $res = mysql_query($sql);
  $row = mysql_fetch_array($res);

  $sql = 'SELECT user_email FROM users WHERE user_admin = 1';

  $res = mysql_query($sql);

  while ($usr = mysql_fetch_array($res)) {
   $to = $usr['user_email'];
   $subject = 'UTD-Hosting ticket: '.$row['ticket_title'];
   $body  = 'This is an automated message. A new ticket has been posted. View it here: '; 
   $body .= ' https://secure.utd-hosting.com/control/viewticket/'.$row['ticket_thread']."\n\n";
   $body .= ' ============ Message from '.$row['user_name'].' ============';
   $body .= "\n\n".$row['ticket_body']."\n\n";
   $body .= ' ============ End of message ========= '."\n\n";
   $body .= "Please do not ";
   $body .= 'reply to this e-mail -- use the reply form at the URL above. ';
   $body .= "\n\n-- UTD-Hosting support";
   
   mail($to, $subject, $body, 'From: support@utd-hosting.com (UTD-Hosting support)');
  }

 }

?>
