<div class="block">
 <h2>Edit Issue</h2>
  <table class="innerblock righthead bottomdiv">
   <tr><th>ID</th><td><?php echo h($viewIssueData['i_id']); ?></td></tr>
   <tr><th>Title</th><td><?php echo h($viewIssueData['i_title']); ?></td></tr>
   <tr><th>Category</th><td><?php echo h($viewIssueData['icat_name']); ?></td></tr>
   <tr><th>Status</th><td><?php echo h($viewIssueData['i_status']); ?></td></tr>
   <tr><th>Submitter</th><td><?php echo n($viewIssueData['i_submitter']); ?></td></tr>
   <tr><th>Assignee</th><td><?php echo n($viewIssueData['i_assignee']); ?></td></tr>
   <tr><th>Priority</th><td><?php echo h($viewIssueData['i_priority']); ?></td></tr>
   <tr><th>Extensiveness</th><td><?php echo h($viewIssueData['i_extensiveness']); ?></td></tr>
   <tr><th>Added</th><td><?php echo d('Y-m-d H:i:s', $viewIssueData['i_added']) ?></td></tr>
   <tr><th>Updated</th><td><?php echo d('Y-m-d H:i:s', $viewIssueData['i_updated']) ?></td></tr>
   <tr><th>Deadline</th><td>
    <?PHP
     if ($viewIssueData['i_deadline'] == 0) {
      echo '<span style="text-style: italic">None</span>';
     } elseif ($viewIssueData['i_deadline'] - time() < 0) {
      echo '<span style="color: red">Overdue by '.duration(time()-$viewIssueData['i_deadline']).'</span>';
     } else {
      echo duration(time()-$viewIssueData['i_deadline']);
     }
    ?>
   </td></tr>
  </table>
  <div class="innerblock">
   <?php echo nl2br(htmlentities($viewIssueData['i_text'])); ?>
  </div>
</div>

<?php
 if (count($issueReplies) == 0) {
  ?>
  <div class="block">
  <h2>Replies</h2>
  <div class="innerblock" style="text-align: center; font-style: italic;">No Replies</div>
  </div>
  <?php
  return;
 }

 echo '<div class="block nobottomdiv">';
 echo '<h2>Replies</h2>';
 foreach($issueReplies as $id => $reply) {
   ?>
     <table class="innerblock righthead bottomdiv">
      <tr>
       <th>User</th><td><a href="#<?php echo $reply['irep_id']; ?>" /><?php echo $reply['irep_user']; ?></td>
      </tr>
      <tr>
       <th>Time</th><td><?php echo date('Y-m-d H:i:s', $reply['irep_time']); ?></td>
      </tr>
      <tr>
       <th>Actions</th><td><a href="<?php echo CP_PATH; ?>deletereply/<?php echo $id; ?>" title="Delete">Delete</a></td>
      </tr>
     </table>
     <div class="innerblock bottomdiv">
      <?PHP echo nl2br(htmlentities($reply['irep_text'])); ?>
     </div>
   <?php
 }
 echo '</div>';
?>
