<?PHP

chdir('/home/utd/control');
define('NOLOGINREF', true);
require_once('lib/account.php');
require_once('lib/common.php');
require_once('lib/database.php');

chdir('/home/utd/signup');
require('inc/sessions.php');

ob_start();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <title>UTD-Hosting :: Signup</title>
  <style type="text/css">
   body {
    margin: 80px 200px;
    font-family: Tahoma, Arial, sans-serif; 
    background-color: #fff;
   }

   p.blurb { font-style: italic; }

   div.status {
    float: right;
    font-size: small;
    font-variant: small-caps;
    color: #aaa; 
    text-align: center;
    margin: 0px 10px;
    width: 60px;
   }
   div.status span {
    font-size: 60px;
    font-weight: bold;
   }
   div.past { color: #eee; }
   div.current { color: #000; } 

   div#content {
    clear: both;
    padding-top: 20px;
    font-size: small;
   }
   
   th { text-align: right; width: 150px; }

   ul#main {
    list-style-type: none;
    margin: 30px 0px;
   }
   dt { font-weight: bold; }
   dd { margin: 5px 0px 20px 30px; }
  
   p#footer { clear: both; padding-top: 20px; font-style: italic; font-size: x-small; text-align: center; } 
   
   img#logo { float: left; }

   hr { border: 0px; border-top: 1px solid #aaa; background-color: transparent; }

   div#message {
    border: 2px dashed #FAA;	
    background-color: #FEE;
    margin-bottom: 20px;
    padding: 10px;
   }
  </style>
 </head>
 <body>
  <img src="/control/res/logo.png" alt="UTD-Hosting" id="logo">
<?PHP

 $status = array(1=>'Signup type',2=>'Account details',3=>'Terms &amp; Conditions',4=>'Advanced details',5=>'Payment');

 for ($i = 5; $i > 0; $i--) {
  echo '<div class="status';
  if ($_SESSION['stage'] == $i) {
   echo ' current';
  } elseif ($_SESSION['stage'] > $i) {
   echo ' past';
  } else {
   echo ' future';
  }
  echo '"><span>'.$i.'</span><br>'.$status[$i].'</div>';
 }

?>
  <div id="content">
<?PHP

 if (file_exists($_SESSION['stage'].'.php')) {
  require_once($_SESSION['stage'].'.php');
 }

?> 
  </div>
  <p id="footer">
   Copyright (&copy;) UTD-Hosting, 2005-2006. All rights reserved.
   <br>PROBLEMS? E-mail <a href="mailto:support@utd-hosting.com">support@utd-hosting.com</a> for assistance.
  </p>
 </body>
</html>
<?PHP ob_end_flush(); ?>
