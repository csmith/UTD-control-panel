<div class="block">
 <h2>Edit Issue</h2>
 <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
  <table class="innerblock righthead">
   <tr><th>Title</th><td><input type="text" name="title" value="<?php echo h($viewIssueData['i_title']); ?>" size="50" /></td></tr>
   <tr><th>Category</th><td>
    <select name="category" size="1">
     <?php
       foreach($categories as $id => $name) {
         echo '<option value="'.$id.'"'.(($viewIssueData['icat_name'] == $name) ? ' selected="true"' : '').'>'.$name.'</option>'."\r\n";
       }
     ?>
   </td></tr>
   <tr><th>Status</th><td>
    <select name="status" size="1">
     <option value="open"<?php echo (($viewIssueData['i_status'] == 'open') ? ' selected="true"': '');?>>Open</option>
     <option value="assigned"<?php echo (($viewIssueData['i_status'] == 'assigned') ? ' selected="true"': '');?>>Assigned</option>
     <option value="closed"<?php echo (($viewIssueData['i_status'] == 'closed') ? ' selected="true"': '');?>>Closed</option>
     <option value="reopened"<?php echo (($viewIssueData['i_status'] == 'reopened') ? ' selected="true"': '');?>>Re-Open</option>
    </select>
   </td></tr>
   <tr><th>Assignee</th><td>
    <select name="assignee">
     <option value="">(None)</option>
     <?php
       foreach($admins as $id => $username) {
         echo '<option value="'.$id.'"'.(($viewIssueData['i_assignee'] == $username) ? ' selected="true"' : '').'>'.$username.'</option>'."\r\n";
       }
     ?>
    </select>
   </td></tr>
   <tr><th>Priority</th><td>
    <select name="priority" size="1">
     <option value="urgent"<?php echo (($viewIssueData['i_priority'] == 'urgent') ? ' selected="true"': '');?>>Urgent</option>
     <option value="high"<?php echo (($viewIssueData['i_priority'] == 'high') ? ' selected="true"': '');?>>High</option>
     <option value="normal"<?php echo (($viewIssueData['i_priority'] == 'normal') ? ' selected="true"': '');?>>Normal</option>
     <option value="low"<?php echo (($viewIssueData['i_priority'] == 'low') ? ' selected="true"': '');?>>Low</option>
    </select>
   </td></tr>
   <tr>
    <th>Extensiveness</th>
    <td>
     <select name="extensiveness" size="1">
      <option name="extensive"<?php echo (($viewIssueData['i_extensiveness'] == 'extensive') ? ' selected="true"': '');?>>Extensive</option>
      <option name="normal"<?php echo (($viewIssueData['i_extensiveness'] == 'normal') ? ' selected="true"': '');?>>Normal</option>
      <option name="trivial"<?php echo (($viewIssueData['i_extensiveness'] == 'trivial') ? ' selected="true"': '');?>>Trivial</option>
     </select>
    </td>
   </tr>
   <tr><th>Deadline</th><td>
    <input type="text" name="deadline" size="50" value="<?php echo date('Y-m-d H:i:s', $viewIssueData['i_deadline']);?>"/>
   </td></tr>
   <tr><th>Notes</th><td>
    <textarea name="text" cols="45" rows="10"><?php echo htmlentities($viewIssueData['i_text']); ?></textarea>
   </td></tr>
   <tr><th>Actions</th><td>
    <input type="submit" name="submit" value="Submit" />&nbsp;<input type="reset" value="Reset" />
   </td></tr>
  </table>
 </form>
</div>
