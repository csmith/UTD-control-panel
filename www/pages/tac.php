<div class="block">
 <h2>UTD-Hosting terms and conditions</h2>
 <div class="innerblock longtext" style="text-align: justify;">
  <p class="blurb">
   Please review these updated terms and conditions. Sections that
   have been added since the previews version of these conditions are
   coloured blue. Sections that have been modified are coloured red.
  </p>
  <?PHP
   $diff = `diff -e /home/utd/common/tac-old.txt /home/utd/common/tac.txt`;

   $changes = array();

   $status = 0;
   foreach (explode("\n", $diff) as $line) {
    if ($status === 0) {
     $status = substr(trim($line), -1);
    } else if (trim($line) == '.') {
     $status = 0;
    } else {
     $changes[trim($line)] = $status;
    }
   }

   $stuff = file('/home/utd/common/tac.txt');
   $meep = trim(array_shift($stuff));

   foreach ($stuff as $line) {
    $line = trim($line);
    if (empty($line)) { continue; }

    if (isset($changes[$line])) {
     echo '<div class="change_' . $changes[$line] . '">' . $line . '</div>';
    } else {
     echo $line;
    }
    echo "\n";
   }
  ?>
 </div>
</div>
<div class="block">
 <h2>Acceptance</h2>
 <div class="innerblock">
  <p class="blurb">
   If you agree to these Terms and Conditions, please type the phrase 'I AGREE'
   into the text box below, and click on the 'Confirm' button. If you do not
   agree with these terms, please
   contact UTD-Hosting support (support@utd-hosting.com) immediately.
  </p>
  <div style="margin-top: 20px;">
   <form action="<?PHP echo CP_PATH; ?>tac" method="post">
    <input type="hidden" name="version" value="<?PHP echo $meep; ?>">
    <input type="text" name="agree"><input type="submit" value="Confirm">
   </form>
  </div>
 </div>
</div>
