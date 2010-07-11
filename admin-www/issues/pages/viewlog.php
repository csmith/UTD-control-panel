<?php
 if (count($issueChanges) == 0) {
  ?>
  <div class="block">
  <h2>Changes</h2>
  <div class="innerblock" style="text-align: center; font-style: italic;">No Changes</div>
  </div>
  <?php
  return;
 }

 echo '<div class="block nobottomdiv">';
 echo '<h2>Changes</h2>';
 foreach($issueChanges as $id => $change) {
   ?>
     <table class="innerblock righthead bottomdiv">
      <tr>
       <th>ID</th><td><?php echo h($change['ilog_id']); ?></td>
      </tr><tr>
       <th>Time</th><td><?php echo d('Y-m-d H:m:s', $change['ilog_time']); ?></td>
      </tr><tr>
       <th>User</th><td><?php echo n($change['user_name']); ?></td>
      </tr><tr>
       <th>Field</th><td><?php echo h($change['ilog_field']); ?></td>
      </tr><tr>
       <th>Old Value</th><td><?php echo h($change['ilog_old']); ?></td>
      </tr><tr>
       <th>New Value</th><td><?php echo h($change['ilog_new']); ?></td>
      </tr>
     </table>
   <?php
 }
 echo '</div>';
?>