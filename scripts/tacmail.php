#!/usr/bin/php -q
<?PHP

 chdir('/home/utd/control/');
 require_once('lib/database.php');

 function tacmail() {
  $sql  = 'SELECT user_email FROM users';
  
  $res = mysql_query($sql);
  
  while ($usr = mysql_fetch_array($res)) { 
   $to = $usr['user_email'];
   $subject = 'UTD-Hosting terms and conditions update'; 
   $body  = 'This is an automated message. The terms and conditions governing'; 
   $body .= ' your UTD-Hosting account have been updated. Please review these';
   $body .= ' changes by logging into the customer control panel, located at';
   $body .= ' https://secure.utd-hosting.com/control/. If you do not agree to';
   $body .= ' these new terms and conditions, please contact support@utd-hosting.com';
   $body .= ' within two weeks.';
   $body .= "\n\n-- UTD-Hosting support";
   mail($to, $subject, $body, 'From: support@utd-hosting.com (UTD-Hosting support)'); 
  }
 }

 tacmail();

?>
