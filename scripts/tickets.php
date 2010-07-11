#!/usr/local/php-stable/bin/php -q
<?PHP

 require('/home/utd/common/ticketmail.php');

 mysql_connect('', '', '');
 mysql_select_db('');

 $sql  = 'SELECT ticket_id, user_id FROM tickets WHERE ticket_status = \'new\'';
 $sql .= ' AND ticket_time <= '.(time()-60*60*24*3).' AND ticket_time > ';
 $sql .= (time()-60*60*24*2); 

 $res = mysql_query($sql);

 while ($row = mysql_fetch_array($res)) {
  $sql  = 'UPDATE billing SET bill_due = bill_due + 5356800 WHERE user_id = ';
  $sql .= $row['user_id'].' AND bill_paid < 2';
  mysql_query($sql);

  $sql  = 'INSERT INTO tickets (user_id, ticket_status, ticket_thread, ';
  $sql .= ' ticket_title, ticket_body, ticket_time) VALUES (5, \'reply\',';
  $sql .= ' '.$row['ticket_id'].', \'Apologies.\', \'This ticket has been ';
  $sql .= 'unaddressed for over 48 hours. Your account has been automatically';
  $sql .= ' credited with an extra two months hosting.'."\r\n\r\n".' We apologise';
  $sql .= ' for the inconvenience.\', '.time();
  $sql .= ')';

  mysql_query($sql);

  ticketmail(mysql_insert_id());
 }

?>
