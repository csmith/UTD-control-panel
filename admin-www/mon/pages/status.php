<?PHP

 $sql = 'SELECT result_result, result_time, server_name, service_name, results.server_id, results.service_id FROM results NATURAL JOIN servers, services WHERE results.service_id = services.service_id AND result_last = 1 ORDER BY server_name, service_name';
 $last = 0;
 $res = mysql_query($sql);
 while ($row = mysql_fetch_array($res)) {
  if ($row['server_name'] !== $last) {
   if ($last !== 0) { echo '</table></div>'; }
   $i = 1;
?>
   <div class="block" id="<?PHP echo $row['server_name']; ?>">
    <h2><?PHP echo $row['server_name']; ?></h2>
    <table class="innerblock">
     <tr>
      <th>Service</th>
      <th>Status</th>
      <th>Time</th>
      <th>Last up</th>
      <th>Observed Uptime</th>
      <th>Silence</th>
     </tr>
<?PHP
   $last = $row['server_name'];
  }
  $i = 1 - $i;
  echo '<tr class="'.($i == 0 ? 'even' : 'odd').'"><td>'.$row['service_name'].'</td><td';
  if ($row['result_result'] == 'up') {
   echo ' style="color: green;"';
  } else {
   echo ' style="color: red;"';
  }
  echo '>'.ucfirst($row['result_result']).'</td>';
  echo '<td>'.date('r',$row['result_time']).'</td>';
  $sql = 'SELECT MAX(result_time) FROM results WHERE server_id = '.$row['server_id'].' AND service_id = '.$row['service_id'].' AND result_result = \'up\'';
  $re2 = mysql_query($sql);
  $ro2 = mysql_fetch_array($re2);
  echo '<td>'.date('r',$ro2[0]).'</td>';
  $sql = 'SELECT COUNT(*), result_result FROM results WHERE server_id = '.$row['server_id'].' AND service_id = '.$row['service_id'].' GROUP BY result_result';
  $re2 = mysql_query($sql) or print(mysql_error());
  $uptime = array('up'=>0,'down'=>0);
  while ($ro2 = mysql_fetch_array($re2)) {
   $uptime[($ro2[1])] = $ro2[0];
  }
  echo '<td>'.round(100*$uptime['up']/($uptime['up']+$uptime['down']),3).'%</td>';
  $re2 = mysql_query('SELECT ss_silenced FROM servserv WHERE server_id = '.$row['server_id'].' AND service_id = '.$row['service_id']) or print(mysql_error());
  $ro2 = mysql_fetch_array($re2);
  if ($ro2[0] == '1') {
   echo '<td style="color: red;">Silenced</td>';
  } else {
   echo '<td><a href="?silence&amp;serv='.$row['server_id'].'&amp;svc='.$row['service_id'].'">Silence</a></td>';
  }
  echo '</tr>';
 }

?>
</div>
