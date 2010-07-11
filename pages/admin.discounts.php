<?PHP
 require_once('lib/database.php');
 require_once('lib/common.php'); 
?>
<div class="block" id="log">
 <h2>ADMIN: Discounts</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>Code</th>
   <th>Time</th>
   <th>Money</th>
   <th>Type</th>
   <th>Package</th>
   <th>Start</th>
   <th>End</th>
  </tr>
<?PHP

 $i = 0;
 $n = 0;

 $sql  = 'SELECT discount_id, discount_code, discount_time, discount_money, ';
 $sql .= 'discount_type, discount_start, discount_end, package_name FROM ';
 $sql .= 'discounts NATURAL JOIN packages ORDER BY discount_end';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

 while ($row = mysql_fetch_array($res)) {
  $n++;
  echo '<tr class="'.(($i != 0) ? 'odd':'even').'">';
  echo ' <td>' . $n . '.</td>';
  echo ' <td style="font-family: monospace;">' . h($row['discount_code']) . '</td>';
  echo ' <td>' . duration($row['discount_time']) . '</td>';
  echo ' <td>&pound;' . ($row['discount_money'] / 100) . '</td>';
  echo ' <td>' . ucfirst($row['discount_type']) . '</td>';
  echo ' <td>' . h($row['package_name']) . '</td>';
  echo ' <td' . ($row['discount_start'] > time() ? ' style="color: red"' : '') . '>';
  echo substr(date('r', $row['discount_start']), 0, -15) . '</td>';
  echo ' <td' . ($row['discount_end'] < time() ? ' style="color: red"' : '') . '>';
  echo substr(date('r', $row['discount_end']), 0, -15) . '</td>';
  echo '</tr>';
  $i = 1 - $i;
 }

?>    
 </table>
</div>
