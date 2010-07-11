<div class="block">
 <h2>Your saved searches</h2>
 <table class="innerblock">
  <tr><th>Name</th><th>Actions</th></tr>
  <?php
   if (count($savedsearches) == 0) {
    echo '<tr><td style="text-align: center; font-style: italic;" colspan="3">No Results Found</td></tr>';
   } else {
    foreach($savedsearches as $search) {
     echo '<tr><td><a href="'.CP_PATH.'search/'.$search['isea_id'].'" title="'.$search['isea_name'].'">'.$search['isea_name'].'</a></td>
           <td><a href="'.CP_PATH.'searches/edit/'.$search['isea_id'].'" title="Edit">Edit</a> |
           <a href="'.CP_PATH.'searches/delete/'.$search['isea_id'].'" title="Delete">Delete</a></td></tr>';
    }
   }
  ?>
 </table>
</div>

<div class="block">
 <h2>Global saved searches</h2>
 <table class="innerblock">
  <tr><th>Name</th><th>Actions</th></tr>
  <?php
   if (count($globalsavedsearches) == 0) {
    echo '<tr><td style="text-align: center; font-style: italic;" colspan="3">No Results Found</td></tr>';
   } else {
    foreach($globalsavedsearches as $search) {
     echo '<tr><td><a href="'.CP_PATH.'search/'.$search['isea_id'].'" title="'.$search['isea_name'].'">'.$search['isea_name'].'</a></td>
           <td><a href="'.CP_PATH.'searches/edit/'.$search['isea_id'].'" title="Edit">Edit</a> |
           <a href="'.CP_PATH.'searches/delete/'.$search['isea_id'].'" title="Delete">Delete</a></td></tr>';
    }
   }
  ?>
 </table>
</div>
