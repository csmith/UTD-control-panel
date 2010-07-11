<form name="ticket" action="<?PHP echo CP_PATH; ?>doticket" method="post" onSubmit="return validateTicketForm();">
<input type="hidden" name="thread" value="<?PHP echo TICKET_ID; ?>">
<div class="block">
 <h2>Raise a new ticket</h2>
 <div class="innerblock">
  <p class="blurb">
   If you have previously raised a ticket about the same issue, please reopen
   that ticket instead of raising a new one.
  </p>
  <table class="form leftpad"> 
   <tr>
    <th>Subject</th>
    <td><input type="text" name="subject" id="subject" class="inflat"></td>
    <td><span id="subjectvalid" class="validation"></span></td>
   </tr><tr>
    <th>Message</th>
    <td><textarea name="body" id="body" class="inflat"></textarea></td>
    <td><span id="messagevalid" class="validation"></span></td>
   </tr><tr>
     <td colspan="2" style="text-align: right;">
      <input type="submit" value="Raise new ticket">
     </td>
     <td style="width: 100%;">
      &nbsp;
     </td>
   </tr>
  </table>
 </div>
</div>
</form>
