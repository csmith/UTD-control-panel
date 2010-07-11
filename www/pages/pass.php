<div class="block">
 <h2>Change password</h2>
 <div class="innerblock">
  <p class="blurb">This will change both your control panel login and your FTP
  password. Your new password should be between 5 and 20 characters long, and should contain lower and upper case letters, and at least one digit.</p>
  <form action="<?PHP echo CP_PATH; ?>changepass" method="post">
   <table class="form leftpad">
    <tr>
     <th><label for="curpass">Current password</label></th>
     <td><input type="password" name="curpass" class="inflat"></td>
    </tr>
    <tr>
     <th><label for="pass1">New password</label></th>
     <td><input type="password" name="pass1" class="inflat"></td>
    </tr>
    <tr>
     <th><label for="pass2">New password (again)</label></th>
     <td><input type="password" name="pass2" class="inflat"></td>
    </tr>
    <tr>
     <td colspan="2">
      <input type="submit" value="Update">
     </td>
    </tr>
   </table>
  </form>
 </div>
</div>
