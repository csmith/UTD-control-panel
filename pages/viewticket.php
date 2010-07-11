<?PHP
 if (!isset($error)) {
?>
<div class="block">
 <h2>Original ticket</h2>
 <table class="innerblock righthead bottomdiv">
  <tr>
   <th>Title</th>
   <td><?PHP echo h(TICKET_TITLE); ?></td>
  </tr>
  <tr>
   <th>Author</th>
   <td><?PHP echo h(TICKET_USER); ?></td>
  </tr>
  <tr>
   <th>Status</th>
   <td><?PHP echo ucfirst(TICKET_STATUS); ?></td>
  </tr>
  <tr>
   <th>Date</th>
   <td><?PHP echo date('r',TICKET_TIME); ?></td>
  </tr>
 </table>
 <div class="innerblock">
  <?PHP echo h(TICKET_BODY); ?>
 </div>
</div>
<?PHP

 while ($row = mysql_fetch_array(TICKET_RES)) {

?>
<div class="block">
 <h2>Reply</h2>
 <table class="innerblock righthead bottomdiv">
  <tr>
   <th>Author</th>
   <td><?PHP echo $row['ud_name']; if ($row['user_admin'] == '1') { echo ' (UTD Staff)'; } ?></td>
  </tr>
  <tr>
   <th>Date</th>
   <td><?PHP echo date('r',$row['ticket_time']); ?></td>
  </tr>
 </table>
 <div class="innerblock">
  <?PHP echo h($row['ticket_body']); ?>
 </div>
</div>
<?PHP
	 
 }
 
?>
<form action="<?PHP echo CP_PATH; ?>doticketreply" method="post">
<input type="hidden" name="thread" value="<?PHP echo TICKET_ID; ?>">
<div class="block">
 <h2>Post a new reply</h2>
 <table class="innerblock righthead bottomdiv">
  <tr>
   <th>Status</th>
   <td>
    <select name="status" style="width: 100%;" class="inflat">
     <option value="<?PHP echo TICKET_STATUS; ?>"><?PHP echo ucfirst(TICKET_STATUS); ?> (Leave unchanged)</option>
<?PHP
 $o = array();
 $s = TICKET_STATUS;
 if ($s == 'new' || $s == 'reopened') {
  $o['closed'] = true;
  if (defined('ADMIN')) { $o['assigned'] = true; }
 }
 if ($s == 'assigned') {
  $o['closed'] = true;
 }
 if ($s == 'closed') {
  $o['reopened'] = true;
 }
?>
     <?PHP if (isset($o['closed'])) { ?><option value="closed">Closed</option><?PHP } ?>
     <?PHP if (isset($o['assigned'])) { ?><option value="assigned">Assigned</option><?PHP } ?>
     <?PHP if (isset($o['reopened'])) { ?><option value="reopened">Reopened</option><?PHP } ?>
    </select>
   </td>
  </tr>
 </table>
 <div class="innerblock">
  <textarea name="message" class="inflat" style="width: 98%; height: 100px; "></textarea><br>
  <input type="submit" value="Add reply" style="float: right; margin: 10px;">
  <br style="clear: right;">
 </div>
</div>
</form>
<?PHP
 } else {
  echo '<div id="message"><div>'.$error.'</div></div>';
 }	 
?>
