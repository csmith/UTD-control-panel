<?PHP
 require_once('lib/database.php');
 require_once('lib/common.php');
?>
<div class="block">
 <h2>My E-mail Addresses</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>Address</th>
   <th>Mailbox</th>
  </tr>
<?PHP

 $i = 0;
 
 $sql = 'SELECT email_id, domain_name, email_user, mailbox_user FROM email NATURAL JOIN domains NATURAL JOIN mailboxes WHERE user_id = '.UID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 
 if (mysql_num_rows($res) == 0) {
  echo '<tr><td colspan="3" style="font-style: italic; text-align: center;">';
  echo 'You have no e-mail addresses set up.</td></tr>';
 }
 
 while ($row = mysql_fetch_array($res)) {
?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $row['email_id']; ?>.</td>
   <td><?PHP echo htmlentities($row['email_user'].'@'.$row['domain_name']); ?></td>
   <td><?PHP echo htmlentities($row['mailbox_user'].'@'.$row['domain_name']); ?></td>
  </tr>
<?PHP
   $i = 1 - $i;
 }

?>    
 </table>
</div>
