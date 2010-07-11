<?php
if ($data[0] == 0) {
  ?>
  <div class="block">
   <h2>Delete Category :: Confirmation</h2>
   <div class="innerblock">
    Are you sure you want to delete category #<?php echo $data['icat_id']; ?> (<?php echo $data['icat_name']; ?>)?
    <form action="<?php $_SERVER['REQUEST_URI']; ?>" method="post"><input type="submit" name="confirm" value="Yes" /></form>
   </div>
  </div>
  <?php
} else {
?>
<div class="block">
 <h2>Unable to delete category</h2>
 <div class="innerblock bottomdiv">
  You cannot delete a category which has active issues, please alter the issues below before proceeding.
 </div>
 <table class="innerblock">
  <tr>
   <th>ID</th><th>Title</th><th>Actions</th>
  </tr>
   <?php
   $i = -1;
   while($data = mysql_fetch_assoc($res)) {
     $i++;
    ?>
    <tr <?php echo ($i % 2 == 0 ? 'class="even"':'class="odd"'); ?>>
     <td><?php echo $data['i_id']; ?></td>
     <td><?php echo $data['i_title']; ?></td>
     <td><a href="<?php echo CP_PATH.'editissue/'.$data['i_id']; ?>" title="Edit">Edit</a> | <a href="<?php echo CP_PATH.'deleteissue/'.$data['i_id']; ?>" title="Delete">Delete</a></td>
    </tr>
    <?php
   }
   ?>
 </table>
</div>
<?php
}
?>