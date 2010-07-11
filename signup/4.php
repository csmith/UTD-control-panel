<?PHP
 if (isset($_POST['back'])) {
  $_SESSION['stage'] = 3;
  header('Location: /signup/3');
  exit;
 }
 if (isset($_POST['slot'])) {
  $_SESSION['slot'] = $_POST['slot'];
  $_SESSION['discount'] = $_POST['discount'];
  if ($_SESSION['type'] != 'newuser') {
   $_SESSION['action'] = 'deferred';
   mysql_query('INSERT INTO signups (signup_ip, signup_time, signup_data) VALUES (\''.$_SERVER['REMOTE_ADDR'].'\', '.time().', \''.mysql_real_escape_string(serialize($_SESSION)).'\')');
   logger::log('Deferred signup (type: '.$_SESSION['type'].'; slots: '.$_SESSION['slot'].')',logger::important);
  } else {
   addUser($_SESSION['data']['user'], $_SESSION['data']['email'], $_SESSION['data']['pass1'], $_SESSION['tac'], $_POST['slot']);
   logger::log('Autoprocessed signup for user '.$_SESSION['data']['user'].' ['.$_POST['slot'].' slots]',logger::normal);
   $name = $_SESSION['data']['name'];
   $user = strtolower($_SESSION['data']['user']);
   $message = "Dear $name,

Thank you for signing up for UTD-Hosting. Your account has been created, and as soon as you've paid you will be able to start uploading your website.

Your username is $user

To log in to the customer control panel, go to https://secure.utd-hosting.com/control (don't worry if your browser gives you an error message about the ssl certificate - the connection is still encrypted), and enter your username as it appears above, and the password you used during the signup procedure.

When you are ready to upload your site, use an FTP client to connect to asimov.utd-hosting.com, using your control panel login details. A default site has been created for you, which can be accessed via the address http://$user.utd-hosting.com/. To upload files to this site, navigate to the public_html directory once you are connected.

If you have any questions, please check the support section of the control panel at https://secure.utd-hosting.com/control/support. If you still have queries, please raise a ticket via the control panel, or e-mail support@utd-hosting.com.

-- UTD-Hosting support 

[ If you did not sign up to UTD-Hosting, please e-mail admins@utd-hosting.com and we will remove your e-mail address ]";
   mail($_SESSION['data']['email'], 'Your UTD-Hosting account', $message, "From: support@utd-hosting.com");
   $_SESSION['action'] = 'processed';
   mysql_query('INSERT INTO signups (signup_ip, signup_time, signup_data, signup_processed) VALUES (\''.$_SERVER['REMOTE_ADDR'].'\', '.time().', \''.mysql_real_escape_string(serialize($_SESSION)).'\', 1)');
  }
  $_SESSION['stage'] = 5;
  header('Location: /signup/5');
  exit;
 }
?>
<form action="/signup/4" method="post">
<p class="blurb">
 Please select the amount of
 <?PHP if ($_SESSION['type'] != 'newuser') { echo 'additional'; } ?>
 server slots you would like to purchase
</p>
<table>
 <tr>
  <td><input type="radio" name="slot" value="1" checked="checked"></td>
  <td>One slot</td>
  <td>£35 / year</td>
  <td>3.5 GB Storage</td>
  <td>50 GB Transfer / month</td>
 </tr>
 <tr>
  <td><input type="radio" name="slot" value="2"></td>
  <td>Two slots</td>
  <td>£70 / year</td>
  <td>7.0 GB Storage</td>
  <td>100 GB Transfer / month</td>
 </tr>
 <tr>
  <td><input type="radio" name="slot" value="3"></td>
  <td>Three slots</td>
  <td>£100 / year</td>
  <td>10.5 GB Storage</td>
  <td>150 GB Transfer / month</td>
 </tr>
</table>
<p class="blurb">
 If you have a discount code, please enter it in the text box below.
</p>
<input type="text" name="discount" style="width: 300px; margin: 10px;">
<br>
 <input type="submit" name="forward" value="Next" style="float: right;">
</form>
<form action="/signup/4" method="post">
 <input type="submit" name="back" value="Previous">
</form>
