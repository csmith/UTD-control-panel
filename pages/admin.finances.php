<div class="block" id="overview">
 <h2>Overview</h2>
 <table class="innerblock">
  <tr>
   <th>ID</th>
   <th>Date</th>
   <th>Description</th>
   <th>User</th>
   <th>Receipts</th>
   <th>Payments</th>
   <th>Balance</th>
  </tr>
<?PHP

 function fn($n, $hl = false) {
  $r = '&pound;'.abs(intval($n/100)).'.'.str_pad(abs($n%100),2,'0',STR_PAD_LEFT);
  if ($n < 0) { $r = '-'.$r; }
  if ($hl && $n < 0) {
   $r = '<span style="color: red;">'.$r.'</span>';
  }
  return $r;
 }

 $sql  = 'SELECT finance_id, finance_time, finance_desc, user_name, ';
 $sql .= 'finance_receipts, finance_payments, finance_balance FROM ';
 $sql .= 'finances NATURAL JOIN users ORDER BY finance_time';
 $res = mysql_query($sql) or print(mysql_error());
 $i = 0;
 $n = 0;
 while ($row = mysql_fetch_assoc($res)) {
  $i = 1 - $i;
  $n++;
?>
  <tr class="<?PHP echo ($i == 1) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $n; ?>.</td>
   <td><?PHP echo date('Y-m-d', $row['finance_time']); ?></td>
   <td><?PHP echo htmlentities($row['finance_desc']); ?></td>
   <td>
    <?PHP
     if ($row['user_name'] != 'admin') {
      echo $row['user_name'];
     } else {
      echo '---';
     }
    ?>
   </td>
   <td><?PHP echo fn($row['finance_receipts']); ?></td>
   <td><?PHP echo fn($row['finance_payments']); ?></td>
   <td><?PHP echo fn($row['finance_balance'],true); ?></td>
  </tr>
<?PHP
 }

?>
 </table>
</div>
