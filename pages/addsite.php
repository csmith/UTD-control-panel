<form action="<?PHP echo CP_PATH; ?>addsite" method="post">
<div class="block">
 <h2>Add site</h2>
 <div class="innerblock">
  <p class="blurb">
   This will create a new site. If your domain name (or subdomain) is not
   listed, please ensure that you have added it to the <a href="<?PHP echo CP_PATH; ?>domains">domains page</a>, and that it is not associated with an existing site.
  </p>
  <table class="form leftpad">
   <tr>
    <th>Primary domain</th>
    <td><select name="domain" class="inflat">
<?PHP

 $sql = 'SELECT domain_name, domain_id FROM domains WHERE user_id = '.UID.' AND domain_enabled = 1';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 $found = false;
 while ($row = mysql_fetch_array($res)) {
  $sql = 'SELECT record_value FROM records WHERE domain_id = '.$row['domain_id'].' AND record_type = \'UTD\'';
  $re2 = mysql_query($sql) or mf(__FILE__, __LINE__, $sql); 
  if (mysql_num_rows($re2) == 0) {
   $found = true;
   echo '<option value="'.$row['domain_id'].'">'.h($row['domain_name']).'</option>';
  }
 }
 if (!$found) { echo '<option value="err">&lt;No domains&gt;</option>'; }

?>
    </select></td>
    <td><a href="<?PHP echo CP_PATH; ?>support/018">Help</a></td>
   </tr>
   <tr>
    <th>Document root</th>
    <td><input type="text" name="docroot" value="/public_html" class="inflat"></td>
    <td><a href="<?PHP echo CP_PATH; ?>support/015">Help</a></td>
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
