<?PHP
 if (!defined('LIB_DATABASE')) { require_once('lib/database.php'); }
 if (!defined('LIB_COMMON')) { require_once('lib/common.php'); } 
 if (!defined('ADMIN') || !ADMIN) { die('Admins only'); }
?>
<div class="block" id="bigfiles">
 <h2>ADMIN: Large files report</h2>
 <table class="innerblock">
  <tr>
   <th>File</th>
   <th>Size</th>
  </tr>
<?PHP

 $data = file('/home/utd/reports/bigfiles.txt');
 $i = 1;
 foreach ($data as $line) {
  list($file,$size) = explode(' ',trim($line));
  echo '<tr'.($i == 0 ? ' class="odd"' : ' class="even"').'><td>'.h($file).'</td><td>'.NiceSize($size).'</td></tr>';
  $i = 1 - $i;
 }

?>    
 </table>
</div>
