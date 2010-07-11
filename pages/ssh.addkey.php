<form action="<?PHP echo CP_PATH; ?>ssh" method="post">
<div class="block">
 <h2>Add SSH key</h2>
 <div class="innerblock">
  <p class="blurb">
   It may take a few minutes for new SSH keys to become usable.
   Only RSA keys may be used with this system.
  </p>
  <table class="form leftpad">
   <tr>
    <th>Comment</th>
    <td><input type="text" name="comment" class="inflat"></td>
   </tr>
   <tr>
    <th>Key</th>
    <td>
     <textarea name="key" class="inflat"></textarea>
    </td>
   </tr>
   <tr>
    <th>Actions</th>
    <td><input type="submit" name="add" value="Add"> <input type="reset" value="Cancel"></td>
    <td></td>
   </tr>
  </table>
 </div>
</div>
</form>
