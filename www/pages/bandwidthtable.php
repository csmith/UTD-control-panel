<div class="block">
 <h2>Bandwidth usage</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>Site</th>
   <th>Bandwidth in</th>
   <th>Bandwidth out</th>
   <th>Bandwidth total</th>
  </tr>
<?PHP

 $sql = 'SELECT site_id, site_name, site_bandin, site_bandout FROM sites WHERE user_id = '.UID.' ORDER BY (site_bandin + site_bandout) DESC';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 $i = 0;
 $n = 0;
 while ($row = mysql_fetch_array($res)) {
  $n++;

  echo '<tr class="';
  if ($i) { echo 'odd'; } else { echo 'even'; }
  echo '"><td>'.$n.'.</td>';
  echo '<td>'.$row['site_name'].'</td>';
  echo '<td>'.NiceSize($row['site_bandin']).'</td>';
  echo '<td>'.NiceSize($row['site_bandout']).'</td>';
  echo '<td>'.NiceSize($row['site_bandin'] + $row['site_bandout']).'</td>';
  echo '</tr>';
  $i = 1 - $i;
 }

?>
 </table>
</div>
