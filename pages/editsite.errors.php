<div class="block">
 <h2>Recent errors</h2>
 <table class="innerblock">
  <tr>
   <th>Time</th>
   <th>Type</th>
   <th>Client</th>
   <th>Message</th>
  </tr>
<?PHP
 $file = '/usr/local/apache/logs/'.str_pad(SITE_ID,3,'0',STR_PAD_LEFT).'-error_log';
 if (file_exists($file) && ($size = filesize($file)) > 0) {
  $fh = fopen($file,'r');
  if ($size < 1024*50) { $size = 1024*50; }
  fseek($fh, $size - 1024*50);
  $lines = array();
  while (!feof($fh)) {
   $lines[] = fgets($fh);
  } 
  array_shift($lines); // Could be incomplete
  $lines = array_reverse($lines);
  $lines = array_slice($lines, 0, 10);
  $i = 0;
  foreach ($lines as $line) {
   if (preg_match('/^\[(.*?)\] \[(.*?)\]( \[client (.*?)\])? (.*)$/', $line, $matches)) {
    echo '<tr'.(($i == 1)?' class="odd"':'').'><td>'.$matches[1].'</td><td>'.$matches[2].'</td><td>'.$matches[4].'</td><td>'.$matches[5].'</td></tr>';
    $i = 1 - $i;
   }
  }
  fclose($fh);
 } else {
  echo '<tr><td colspan="4" style="font-style: italic; text-align: center;">No errors</td></tr>';
 }
?>
 </table>
</div>
