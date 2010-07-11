<div class="block">
 <h2>DEVELOPMENT: Profiler output</h2>
 <table class="innerblock">
  <tr><th>Query</th><th>Location</th><th>Time (ms)</th></tr>
<?PHP

 function foo($a, $b) {
  if ($a[1] < $b[1]) { return +1; }
  if ($a[1] > $b[1]) { return -1; }
  return 0;
 }

 usort($_queries, 'foo');

 foreach ($_queries as $query) {
  echo '<tr><td>' . $query[0] . '</td>';
  echo '<td>'. substr($query[2], strlen('/home/utd/control-dev/')) . ':' . $query[3] . '</td>';
  echo '<td>' . ($query[1] * 1000) . '</td></tr>';
 }

?>
 </table>
</div>
