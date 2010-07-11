<?PHP
 if (!isset($error)) {
?>
<div class="block">
 <h2>Message</h2>
 <table class="innerblock righthead bottomdiv">
  <tr>
   <th>Title</th>
   <td><?PHP echo h(MESSAGE_TITLE); ?></td>
  </tr>
  <tr>
   <th>Type</th>
   <td><?PHP echo ucfirst(MESSAGE_TYPE); ?></td>
  </tr>
  <tr>
   <th>Date</th>
   <td><?PHP echo date('r',MESSAGE_TIME); ?></td>
  </tr>
 </table>
 <div class="innerblock">
  <?PHP echo nl2br(h(MESSAGE_BODY)); ?>
 </div>
</div>
<?PHP
 } else {
  echo '<div id="message"><div>'.$error.'</div></div>';
 }	 
?>
