<form name="md" action="<?PHP echo CP_PATH; ?>domains" method="post" onSubmit="return validateDomainForm();">
<input type="hidden" name="action" value="add">
<div class="block">
 <h2>Add a new domain</h2>
 <div class="innerblock">
  <p class="blurb">
   Before you can use a new domain, a UTD-Hosting staff member will have to confirm that the
   domain belongs to you.
  </p>
  <table class="form leftpad">
   <tr>
    <td><input type="text" name="domain" id="domain" class="inflat" style="width: 120px;"></td>
    <td style="width:100%;"><span id="domainerr" class="validation"></span></td>
   </tr>
   <tr><td style="text-align: right;">
    <input type="submit" value="Add">
   </td></tr>
  </table>
 </div>
</div>
</form>
