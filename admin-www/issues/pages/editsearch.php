<div class="block">
 <h2>Search Options</h2>
 <div class="innerblock">
 <form action="<?php $_SERVER['REQUEST_URI']; ?>" method="post">
  <div class="searchrow">
   <label for="name">Title: </label>
   <input type="text" name="title" value="<?php echo $search['title']; ?>" />
  </div>
  <div class="searchrow">
   <label for="keywords">Keywords:</label>
   <input type="text" name="keywords" class="search" value="<?php echo $search['keywords']?>">

   <label for="keywordloc">Search in:</label>
   <select name="keywordloc">
    <option value="both"<?php echo (($search['keywordloc'] == 'both') ? ' selected="true"' : '' )?>>Titles And Notes</option>
    <option value="title"<?php echo (($search['keywordloc'] == 'title') ? ' selected="true"' : '' )?>>Titles</option>
    <option value="notes"<?php echo (($search['keywordloc'] == 'notes') ? ' selected="true"' : '' )?>>Notes</option>
   </select>
  </div>
  <div class="searchrow">
   <label for="submitter">Submitter:</label>
   <select name="submitter">
    <option value="any"<?php echo (($search['submitter'] == 'any') ? ' selected="true"' : '' )?>>Any</option>
    <?php
      foreach($admins as $id => $username) {
        echo '<option value="'.$id.'"'.(($search['submitter'] == $id) ? ' selected="true"' : '' ).'>'.$username.'</option>'."\r\n";
      }
    ?>
   </select>

   <label for="assignee">Assignee:</label>
   <select name="assignee">
    <option value="any"<?php echo (($search['assignee'] == 'any') ? ' selected="true"' : '' )?>>Any</option>
    <?php
      foreach($admins as $id => $username) {
        echo '<option value="'.$id.'"'.(($search['assignee'] == $id) ? ' selected="true"' : '' ).'>'.$username.'</option>'."\r\n";
      }
    ?>
   </select>
  </div>
  <div class="searchrow">
   <label for="added">Added:</label>
   <select name="added">
    <option value="any"<?php echo (($search['added'] == 'any') ? ' selected="true"' : '' )?>>Any time</option>
    <option value="day"<?php echo (($search['added'] == 'day') ? ' selected="true"' : '' )?>>Past day</option>
    <option value="week"<?php echo (($search['added'] == 'week') ? ' selected="true"' : '' )?>>Past week</option>
    <option value="month"<?php echo (($search['added'] == 'month') ? ' selected="true"' : '' )?>>Past month</option>
   </select>

   <label for="updated">Updated:</label>
   <select name="updated">
    <option value="any"<?php echo (($search['updated'] == 'any') ? ' selected="true"' : '' )?>>Any time</option>
    <option value="day"<?php echo (($search['updated'] == 'day') ? ' selected="true"' : '' )?>>Past day</option>
    <option value="week"<?php echo (($search['updated'] == 'week') ? ' selected="true"' : '' )?>>Past week</option>
    <option value="month"<?php echo (($search['updated'] == 'month') ? ' selected="true"' : '' )?>>Past month</option>
   </select>

   <label for="deadline">Deadline:</label>
   <select name="deadline">
    <option value="any"<?php echo (($search['deadline'] == 'any') ? ' selected="true"' : '' )?>>Any time</option>
    <option value="day"<?php echo (($search['deadline'] == 'day') ? ' selected="true"' : '' )?>>Tomorrow</option>
    <option value="week"<?php echo (($search['deadline'] == 'week') ? ' selected="true"' : '' )?>>Next week</option>
    <option value="month"<?php echo (($search['deadline'] == 'month') ? ' selected="true"' : '' )?>>Next month</option>
   </select>
  </div>
  <div class="searchrow">
   <label for="status" style="vertical-align: top">Status: </label>
   <select name="status" multiple="true" size="4">
    <option value="open"<?php echo ((in_array('open', $search['status'])) ? ' selected="true"' : '' )?>>Open</option>
    <option value="assigned"<?php echo ((in_array('assigned', $search['status'])) ? ' selected="true"' : '' )?>>Assigned</option>
    <option value="closed"<?php echo ((in_array('closed', $search['status'])) ? ' selected="true"' : '' )?>>Closed</option>
    <option value="reopened"<?php echo ((in_array('reopened', $search['status'])) ? ' selected="true"' : '' )?>>Re-Opened</option>
   </select>

   <label for="priority" style="vertical-align: top">Priority: </label>
   <select name="priority" multiple="true" size="4">
    <option value="urgent"<?php echo ((in_array('urgent', $search['priority'])) ? ' selected="true"' : '' )?>>Urgent</option>
    <option value="high"<?php echo ((in_array('high', $search['priority'])) ? ' selected="true"' : '' )?>>High</option>
    <option value="normal"<?php echo ((in_array('normal', $search['priority'])) ? ' selected="true"' : '' )?>>Normal</option>
    <option value="low"<?php echo ((in_array('low', $search['priority'])) ? ' selected="true"' : '' )?>>Low</option>
   </select>

   <label for="categories" style="vertical-align: top">Category: </label>
   <select name="categories" multiple="true" size="4">
    <option value="any"<?php echo (($search['categories'] == 'all') ? ' selected="true"' : '' )?>>All</option>
    <?php
      foreach($categories as $id => $name) {
        echo '<option value="'.$id.'"'.((in_array($id, $search['categories'])) ? ' selected="true"' : '' ).'>'.$name.'</option>'."\r\n";
      }
    ?>
   </select>

   <label for="order" style="vertical-align: top">Order: </label>
   <select name="order" size="4">
    <option value="added"<?php echo (($search['order'] == 'added') ? ' selected="true"' : '' )?>>Added</option>
    <option value="updated"<?php echo (($search['order'] == 'updated') ? ' selected="true"' : '' )?>>Updated</option>
    <option value="status"<?php echo (($search['order'] == 'status') ? ' selected="true"' : '' )?>>Status</option>
    <option value="priority"<?php echo (($search['order'] == 'priority') ? ' selected="true"' : '' )?>>Priority</option>
    <option value="category"<?php echo (($search['order'] == 'category') ? ' selected="true"' : '' )?>>Category</option>
    <option value="deadline"<?php echo (($search['order'] == 'deadline') ? ' selected="true"' : '' )?>>Deadline</option>
    <option value="title"<?php echo (($search['order'] == 'title') ? ' selected="true"' : '' )?>>Title</option>
   </select>
  </div>
  <div class="searchrow">
   <label for="limit">Limit: </label>
   <input type="text" name="limit" value="<?php echo $search['limit']?>" />
  </div>
  <div class="searchrow">
   <input type="submit" name="edit" value="Edit">
  </div>
 </form>
 </div>
</div>
