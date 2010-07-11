#!/usr/bin/php -q
<?PHP

 chdir('/home/utd/control');
 require_once('lib/database.php');
 
 // Build the vmaildomains file
 $fh = fopen('/etc/postfix/vmaildomains','w');
 $sql = 'SELECT DISTINCT(domain_name) FROM email NATURAL JOIN domains';
 $res = mysql_query($sql);
 while ($row = mysql_fetch_assoc($res)) {
  fputs($fh, $row['domain_name']."\tplaceholder\n");
 } 
 fclose($fh);

 // Build the vmailbox file
 $fh = fopen('/etc/postfix/vmailbox','w');
 $sql  = 'SELECT email_user, e.domain_name AS ed, mailbox_user, m.domain_name AS md FROM ';
 $sql .= 'email, mailboxes, domains AS e, domains AS m WHERE mailboxes.mailbox_id = email.mailbox_id AND ';
 $sql .= 'e.domain_id = email.domain_id AND m.domain_id = mailboxes.domain_id';
 $res  = mysql_query($sql);
 while ($row = mysql_fetch_assoc($res)) {
  if ($row['email_user'] == '%') { $row['email_user'] = ''; }
  fputs($fh,$row['email_user'].'@'.$row['ed']."\t".$row['md'].'/'.$row['mailbox_user']."\n");
 }
 fclose($fh);

 // And write the password file
 $sql = 'SELECT mailbox_user, mailbox_password, domain_name FROM mailboxes NATURAL JOIN domains';
 $res = mysql_query($sql);
 $fhs = array();
 while ($row = mysql_fetch_array($res)) {
  $dir = $row['domain_name'];
  if (!is_dir('/etc/virtual/'.$dir)) {
   mkdir('/etc/virtual/'.$dir);
  }
  if (!isset($fhs[$dir])) {
   $fhs[$dir] = fopen('/etc/virtual/'.$dir.'/passwd','w');
  }
  fputs($fhs[$dir],$row['mailbox_user'].':'.$row['mailbox_password']."\n");
 }
 foreach ($fhs as $fh) { fclose($fh); }

 $sql = 'INSERT INTO actions (action_type, action_value, user_id) VALUES (\'restart\', \'postfix\', 5)';
 mysql_query($sql);
?>
