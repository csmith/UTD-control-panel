<form action="<?PHP echo CP_PATH; ?>email" method="post">
<div class="block">
 <h2>Add e-mail address</h2>
 <div class="innerblock">
  <p class="blurb">
   This will associated an e-mail address with an existing mailbox. 
  </p>
  <table class="form leftpad">
   <tr>
    <th>E-Mail address</th>
    <td><input type="text" name="email_user" class="inflat"> @
<select name="email_domain" class="inflat">
<?PHP

 $sql = 'SELECT domain_name, domain_id FROM domains WHERE user_id = '.UID.' AND domain_enabled = 1 ORDER BY domain_name';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 $found = false;
 while ($row = mysql_fetch_array($res)) {
  $found = true;
  echo '<option value="'.$row['domain_id'].'">'.h($row['domain_name']).'</option>';
 }
 if (!$found) { echo '<option value="err">&lt;No domains&gt;</option>'; }

?>
    </select></td>
   </tr>
   <tr>
    <th>Mailbox</th>
    <td><select name="email_mailbox" class="inflat">
<?PHP

 $sql = 'SELECT mailbox_id, mailbox_user, domain_name FROM mailboxes NATURAL JOIN domains WHERE user_id = '.UID.' ORDER BY mailbox_user, domain_name';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 
 if (mysql_num_rows($res) == 0) {
  echo '<option value="err">&lt;No mailboxes&gt;</option>'; 
 } else {
  while ($row = mysql_fetch_assoc($res)) {
   echo '<option value="'.$row['mailbox_id'].'">';
   echo h($row['mailbox_user'] . '@' . $row['domain_name']);
   echo '</option>';
  }
 }

?>
    </select></td>
   </tr>
   <tr>
    <th>Actions</th>
    <td><input type="submit" value="Add"> <input type="reset" value="Cancel"></td>
    <td></td>
   </tr>
  </table>
 </div>
</div>
</form>
