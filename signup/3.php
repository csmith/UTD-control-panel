<?PHP
 if (isset($_POST['back'])) {
  $_SESSION['stage'] = 2;
  header('Location: /signup/2');
  exit;
 }
 if (isset($_POST['agree'])) {
  if (strtoupper($_POST['agree']) == 'I AGREE') {
   $_SESSION['stage'] = 4;
   $_SESSION['tac'] = $_SESSION['TAC_L'];
   header('Location: /signup/4');
   exit;
  } else {
   echo '<div id="message">If you agree to the terms and conditions please type <code>I AGREE</code> into the text box.</div>';
  }
 }
?>
<p class="blurb">
 Please review the UTD-Hosting terms &amp; conditions. If you do not agree to
 these terms, please discontinue with the signup procedure.
</p>
<hr>
<?PHP

 $stuff = file_get_contents('../common/tac.txt');
 $_SESSION['TAC_L'] = substr($stuff,0,4);
 echo substr($stuff,4);

?>
<hr>
<p class="blurb">
 Please indicate your acceptance of these terms and conditions by typing 
 <code>I AGREE</code> in the box below.
</p>
<form action="/signup/3" method="post">
 <input type="text" name="agree" style="margin-bottom: 20px;">
 <input type="submit" name="forward" value="Next" style="float: right;">
</form>
<form action="/signup/3" method="post">
 <input type="submit" name="back" value="Previous">
</form>

