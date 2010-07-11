<form action="<?PHP echo CP_PATH; ?>adminannouncements" method="post">
<div class="block">
 <h2>ADMIN: Create message</h2>
 <div class="innerblock">
  <p class="blurb">
   You must preview announcements before submitting. Announcements
   will be e-mailed to users who have opted to receive them as soon as the
   announcement is submitted.
  </p>
  <table class="form leftpad"> 
   <tr>
    <th>Title</th>
    <td><input type="text" name="title" id="title" class="inflat"<?PHP if (isset($_POST['title'])) { echo ' value="'.h($_POST['title']).'"'; } ?>></td>
   </tr><tr>
    <th>Type</th>
    <td><select name="type" class="inflat">
     <option value="admin"<?PHP if ($_POST['type'] == 'admin') { echo ' selected="selected"'; } ?>>Admin</option>
     <option value="announcement"<?PHP if ($_POST['type'] == 'announcement') { echo ' selected="selected"'; } ?>>Announcement</option>
     <option value="information"<?PHP if ($_POST['type'] == 'information') { echo ' selected="selected"'; } ?>>Information</option>
    </select></td>
   </tr><tr>
    <th width="10%">Body</th>
    <td><textarea name="body" id="body" class="inflat"><?PHP
     if (isset($_POST['body'])) { echo h($_POST['body']); }
    ?></textarea></td>
   </tr><tr>
     <td colspan="2" style="text-align: right;">
      <input type="reset" value="Reset">
<?PHP if (defined('MESSAGE_BODY')) { ?>
      <input type="submit" name="submit" value="Submit">
<?PHP } else { ?>
      <input type="submit" name="preview" value="Preview">
<?PHP } ?>
     </td>
     <td width="100%">&nbsp;</td>
   </tr>
  </table>
 </div>
</div>
</form>
