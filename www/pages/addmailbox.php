<form action="<?PHP echo CP_PATH; ?>email" method="post">
<div class="block">
 <h2>Add mailbox</h2>
 <div class="innerblock">
  <p class="blurb">
   This will create a new mailbox. For more information on how mailboxes and
   e-mail addresses work, see <a href="<?PHP echo CP_PATH; ?>support/027">this
   support article</a>. 
  </p>
  <table class="form leftpad">
   <tr>
    <th>Mailbox name</th>
    <td><input type="text" name="mailbox_user" class="inflat"> @
<select name="mailbox_domain" class="inflat">
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
    <th>Mailbox password</th>
    <td><input type="password" name="mailbox_pass1" class="inflat"></td>
   </tr>
   <tr>
    <th>Confirm password</th>
    <td><input type="password" name="mailbox_pass2" class="inflat"></td>
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
