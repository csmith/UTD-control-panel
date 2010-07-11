<?PHP

 if (isset($_POST['type']) && ($_POST['type'] == 'newuser' || $_POST['type'] == 'olduser')) {
  $_SESSION['stage'] = 2;
  $_SESSION['type'] = $_POST['type'];
  header('Location: /signup/2');
  exit; 
 }


?>
<p>
 Welcome to UTD-Hosting. Please select the type of package you wish to purchase.
</p>
<form action="/signup/1" method="post">
<ul id="main">
 <li>
  <dl>
   <dt><input type="radio" name="type" value="newuser" checked="checked"> New user</dt>
   <dd>If you are new to UTD-Hosting, or wish to open an additional completely seperate account, select this option.</dd>
  </dl>
 </li>
 <li>
  <dl>
   <dt><input type="radio" name="type" value="olduser"> Existing user</dt>
   <dd>If you already have a UTD-Hosting account and wish to purchase
    additional bandwidth/hdd space, select this option.</dd>
  </dl>
 </li>
</ul>
<input type="submit" value="Next" style="float: right;">
</form>
