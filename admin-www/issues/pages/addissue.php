<div class="block">
 <h2>Add Issue</h2>
 <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
 <table class="innerblock righthead">
  <tr><th>Title</th><td><input type="text" name="title" size="50" /></td></tr>
  <tr><th>Category</th><td>
   <select name="category" size="1">
    <?php
      foreach($categories as $id => $name) {
        echo '<option value="'.$id.'">'.$name.'</option>'."\r\n";
      }
    ?>
   </select>
  </td></tr>
  <tr><th>Assignee</th><td>
   <select name="assignee">
    <option value="">(None)</option>
    <?php
      foreach($admins as $id => $username) {
        echo '<option value="'.$id.'">'.$username.'</option>'."\r\n";
      }
    ?>
   </select>
  </td></tr>
  <tr><th>Priority</th><td>
   <select name="priority" size="1">
    <option value="urgent">Urgent</option>
    <option value="high">High</option>
    <option value="normal" selected="true">Normal</option>
    <option value="low">Low</option>
   </select>
  </tr><tr>
   <th>Extensiveness</th>
   <td>
    <select name="extensiveness" size="1">
     <option name="extensive">Extensive</option>
     <option name="normal" selected="true">Normal</option>
     <option name="trivial">Trivial</option>
    </select>
   </td>
  </tr> 
  <tr><th>Deadline</th><td><input type="text" name="deadline" size="50" value="none"/></td></tr>
  <tr><th>Notes</th><td>
  <textarea name="text" cols="45" rows="10"></textarea>
  </td></tr>
  <tr><th>Actions</th><td>
   <input type="submit" name="submit" value="Submit" />&nbsp;<input type="reset" value="Reset" />
  </td></tr>
 </table>
 </form>
</div>
