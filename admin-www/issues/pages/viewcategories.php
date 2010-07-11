<?php
 if (count($categories) == 0) {
  ?>
  <div class="block">
  <h2>Categories</h2>
  <div class="innerblock" style="text-align: center; font-style: italic;">No Categories</div>
  </div>
  <?php
  return;
 }

 echo '<div class="block nobottomdiv">';
 echo '<h2>Categories</h2>';
 echo '<table class="innerblock bottomdiv">';
 echo '<tr>';
 echo '<th>ID</th><th>Name</th><th>Auto Assign</th><th>Actions</th>';
 echo '</tr>';
 foreach($categories as $id => $category) {
   ?>
      <tr>
       <td><?php echo h($id); ?></td>
       <td><?php echo h($category['name']); ?></td>
       <td><?php echo n((($category['assign'] == 0) ? 'None': getUserName($category['assign'])))?></td>
       <td><a href="<?php echo CP_PATH.'editcategory/'.$id; ?>" title="Edit">Edit</a> | <a href="<?php echo CP_PATH.'deletecategory/'.$id; ?>" title="Delete">Delete</a></td>
      </tr>

   <?php
 }
 echo '</table>';
 echo '</div>';
?>
