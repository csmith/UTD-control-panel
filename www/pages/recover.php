<div class="block">
 <h2>Recover password</h2>
 <div class="innerblock">
  <p class="blurb">
   Please enter your details and a new password.
  </p>
  <form name="recover" action="<?PHP echo CP_PATH; ?>recoverpw" method="post">
   <table class="form leftpad">
    <tr>
     <th><label for="username">Username</label></th>
     <td><input class="inflat" type="text" name="username" id="username"></td>
    </tr>
    <tr>
     <th><label for="email">E-mail</label></th>
     <td><input class="inflat" type="text" name="email" id="email"></td>
    </tr>
    <tr>
     <th><label for="phone">Telephone number</label></th>
     <td><input class="inflat" type="text" name="phone" id="phone"></td>
    </tr>
    <tr>
     <th><label for="pass1">New password</label></th>
     <td><input class="inflat" type="password" name="pass1" id="pass1"></td>
    </tr>
    <tr>
     <th><label for="pass2">New password (again)</label></th>
     <td><input class="inflat" type="password" name="pass2" id="pass2"></td>
    </tr>
    <tr>
     <td colspan="2" style="text-align: right;">
      <input type="submit" value="Reset password">
     </td><td style="width: 50%;"> </td>
    </tr>
   </table>
  </form>
 </div>
</div>
