<div class="block">
 <h2>Delete Issue :: Confirmation</h2>
 <table class="innerblock righthead bottomdiv">
  <tr><th>Title</th><td><?php echo $viewIssueData['i_title']; ?></td></tr>
  <tr><th># Replies</th><td><?php echo $viewIssueRepliesData['0']; ?></td></tr>
  <tr><th># Changes</th><td><?php echo $viewIssueChangesData['0']; ?></td></tr>
 </table>
 <div class="innerblock">
  Are you sure you want to delete issue #<?php echo $viewIssueData['i_id']; ?>?
  <form action="<?php $_SERVER['REQUEST_URI']; ?>" method="post"><input type="submit" name="confirm" value="Yes" /></form>
 </div>
</div>