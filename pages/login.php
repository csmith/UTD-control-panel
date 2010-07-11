<div class="block">
 <h2>Login</h2>
 <div class="innerblock">
  <p class="blurb">
   Enter your UTD-Hosting username and password.
  </p>
  <form name="login" action="<?PHP echo CP_PATH; ?>login" method="post" onSubmit="return validateLoginForm();">
   <table class="form leftpad">
    <tr>
     <th><label for="username">Username</label></th>
     <td><input class="inflat" type="text" name="username" id="username"></td>
     <td><span id="usernamevalid" class="validation"></span></td>
    </tr>
    <tr>
     <th><label for="password">Password</label></th>
     <td><input class="inflat" type="password" name="password" id="password"></td>
     <td><span id="passwordvalid" class="validation"></span></td>
    </tr>
    <tr>
     <td colspan="2" style="text-align: right;">
      <input type="submit" value="Login">
     </td>
     <td style="width: 100%;">
      &nbsp;
     </td>
    </tr>
   </table>
  </form>
 </div>
</div>
