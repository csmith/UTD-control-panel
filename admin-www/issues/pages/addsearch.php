<div class="block">
 <h2>Search Options</h2>
 <div class="innerblock">
 <form action="<?php $_SERVER['REQUEST_URI']; ?>" method="post">
  <div class="searchrow">
   <label for="name">Title: </label>
   <input type="text" name="title" value="" />
  </div>
  <div class="searchrow">
   <label for="keywords">Keywords:</label>
   <input type="text" name="keywords" class="search" value="">

   <label for="keywordloc">Search in:</label>
   <select name="keywordloc">
    <option value="both">Titles And Notes</option>
    <option value="title">Titles</option>
    <option value="notes">Notes</option>
   </select>
  </div>
  <div class="searchrow">
   <label for="submitter">Submitter:</label>
   <select name="submitter">
    <option value="any">Any</option>
    <?php
      foreach($admins as $id => $username) {
        echo '<option value="'.$id.'">'.$username.'</option>'."\r\n";
      }
    ?>
   </select>

   <label for="assignee">Assignee:</label>
   <select name="assignee">
    <option value="any">Any</option>
    <?php
      foreach($admins as $id => $username) {
        echo '<option value="'.$id.'">'.$username.'</option>'."\r\n";
      }
    ?>
   </select>
  </div>
  <div class="searchrow">
   <label for="added">Added:</label>
   <select name="added">
    <option value="any">Any time</option>
    <option value="day">Past day</option>
    <option value="week">Past week</option>
    <option value="month">Past month</option>
   </select>

   <label for="updated">Updated:</label>
   <select name="updated">
    <option value="any">Any time</option>
    <option value="day">Past day</option>
    <option value="week">Past week</option>
    <option value="month">Past month</option>
   </select>

   <label for="deadline">Deadline:</label>
   <select name="deadline">
    <option value="any">Any time</option>
    <option value="day">Tomorrow</option>
    <option value="week">Next week</option>
    <option value="month">Next month</option>
   </select>
  </div>
  <div class="searchrow">
   <label for="status" style="vertical-align: top">Status: </label>
   <select name="status" multiple="true" size="4">
    <option value="open">Open</option>
    <option value="assigned">Assigned</option>
    <option value="closed">Closed</option>
    <option value="reopened">Re-Opened</option>
   </select>

   <label for="priority" style="vertical-align: top">Priority: </label>
   <select name="priority" multiple="true" size="4">
    <option value="urgent">Urgent</option>
    <option value="high">High</option>
    <option value="normal">Normal</option>
    <option value="low">Low</option>
   </select>

   <label for="categories" style="vertical-align: top">Category: </label>
   <select name="categories" multiple="true" size="4">
    <option value="all">All</option>
    <?php
      foreach($categories as $id => $name) {
        echo '<option value="'.$id.'">'.$name.'</option>'."\r\n";
      }
    ?>
   </select>

   <label for="order" style="vertical-align: top">Order: </label>
   <select name="order" size="4">
    <option value="added">Added</option>
    <option value="updated">Updated</option>
    <option value="status">Status</option>
    <option value="priority">Priority</option>
    <option value="category">Category</option>
    <option value="deadline">Deadline</option>
    <option value="title">Title</option>
   </select>
  </div>
  <div class="searchrow">
   <label for="limit">Limit: </label>
   <input type="text" name="limit" value="" />
  </div>
  <div class="searchrow">
   <input type="submit" name="add" value="Add">
  </div>
 </form>
 </div>
</div>
