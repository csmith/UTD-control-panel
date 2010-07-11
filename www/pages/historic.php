<div class="block">
 <h2>Historic usage data</h2>
 <table class="innerblock">
  <tr>
   <th>Start</th>
   <th>End</th>
   <th>Bandwidth used</th>
   <th>HDD used</th>
  </tr>
<?PHP

 $sql = 'SELECT * FROM historic_user WHERE user_id = '.UID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 $i = 0;
 while ($row = mysql_fetch_array($res)) {
?>
  <tr<?PHP if ($i % 2 == 1) { echo ' class="odd"'; } ?>>
   <td><?PHP echo gmdate('d/M/Y',$row['hu_start']); ?></td>
   <td><?PHP echo gmdate('d/M/Y',$row['hu_end']); ?></td>
   <td><?PHP echo NiceSize($row['hu_bw']); ?></td>
   <td><?PHP echo NiceSize($row['hu_hdd']); ?></td>
  </tr>
<?PHP
  $i = 1 - $i;
 }

?>
 </table>
</div>
