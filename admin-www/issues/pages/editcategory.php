<div class="block">
 <h2>Edit Category</h2>
 <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
 <table class="innerblock righthead">
  <tr><th>Name</th><td><input type="text" name="name" value="<?php echo $data['icat_name']; ?>" size="50" /></td></tr>
  <tr><th>Auto-Assignee</th><td>
    <select name="assignee">
     <option value="0">(None)</option>
     <?php
       foreach($admins as $id => $username) {
         echo '<option value="'.$id.'"'.(($data['icat_assign'] == $id) ? ' selected="true"' : '').'>'.$username.'</option>'."\r\n";
       }
     ?>
    </select>
   </td></tr>
  <tr><th>Actions</th><td>
   <input type="submit" name="submit" value="Submit" />&nbsp;<input type="reset" value="Reset" />
  </td></tr>
 </table>
 </form>
</div>
