<div class="block">
 <h2>User Statistics</h2>
 <table class="innerblock stats">
  <tr>
   <th rowspan="2">User</th>
   <th rowspan="2">Raised</th>
   <th rowspan="2">Assigned</th>
   <th colspan="5">Closed</th>
   <th rowspan="2">Average Resolution Time</th>
  </tr>
  <tr>
   <th>All time</th>
   <th>Past year</th>
   <th>Past month</th>
   <th>Past week</th>
   <th>Past day</th>
  </tr>
<?PHP

 $admins = getAdmins();

 $i = -1;
 foreach ($admins as $id => $admin) {
  $i++;
  echo '<tr '.($i % 2 == 0 ? 'class="even"':'class="odd"').'>';
  echo '<td>'.h($admin).'</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_submitter = \''.m(getUserID($admin))."'";
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'assigned\' AND i_assignee = \''.m(getUserID($admin))."'";
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND i_assignee = \''.m(getUserID($admin))."'";
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND i_assignee = \''.m(getUserID($admin))."' AND i_updated > ".strtotime('-1 year');
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND i_assignee = \''.m(getUserID($admin))."' AND i_updated > ".strtotime('-1 month');
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND i_assignee = \''.m(getUserID($admin))."' AND i_updated > ".strtotime('-1 week');
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND i_assignee = \''.m(getUserID($admin))."' AND i_updated > ".strtotime('-1 day');
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td>';
  echo '<td>';
  $sql = 'SELECT AVG(i_updated - i_added) FROM issues_issues WHERE i_status = \'closed\' AND i_assignee = \''.m(getUserID($admin))."'";
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo (($row[0] != 0) ? duration($row[0]) : 'None');
  echo '</td></tr>';
 }
 $i++;

  echo '<tr '.($i % 2 == 0 ? 'class="even"':'class="odd"').'>';
  echo '<td>Total:</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues';
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'assigned\'';
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\'';
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND i_updated > '.strtotime('-1 year');
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND i_updated > '.strtotime('-1 month');
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND i_updated > '.strtotime('-1 week');
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND i_updated > '.strtotime('-1 day');
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  echo '</td><td>';
  $sql = 'SELECT AVG(i_updated - i_added) FROM issues_issues WHERE i_status = \'closed\' AND i_assignee != 0';
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo (($row[0] != 0) ? duration($row[0]) : 'None');
  echo '</td></tr>';
?>

 </table>
</div>

<div class="block">
 <h2>Category Statistics</h2>
 <table class="innerblock stats">
  <tr>
   <th rowspan="2">Category</th>
   <th rowspan="2">New</th>
   <th rowspan="2">Assigned</th>
   <th colspan="5">Closed</th>
   <th rowspan="2">Average Resolution Time</th>
  </tr>
  <tr>
   <th>All time</th>
   <th>Past year</th>
   <th>Past month</th>
   <th>Past week</th>
   <th>Past day</th>
  </tr>
<?PHP

 $totals = array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0);

 $categories  = getCategories();

 $i = -1;
 foreach ($categories as $id => $category) {
  $i++;
  echo '<tr '.($i % 2 == 0 ? 'class="even"':'class="odd"').'>';
  echo '<td>'.h($category).'</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE (i_status = \'open\' OR i_status = \'reopened\') AND icat_id = \''.m($id)."'";
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  $totals[0] += $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'assigned\' AND icat_id = \''.m($id)."'";
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  $totals[1] += $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND icat_id = \''.m($id)."'";
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  $totals[2] += $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND icat_id = \''.m($id)."' AND i_updated > ".strtotime('-1 year');
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  $totals[3] += $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND icat_id = \''.m($id)."' AND i_updated > ".strtotime('-1 month');
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  $totals[4] += $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND icat_id = \''.m($id)."' AND i_updated > ".strtotime('-1 week');
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  $totals[5] += $row[0];
  echo '</td><td class="number">';
  $sql = 'SELECT COUNT(*) FROM issues_issues WHERE i_status = \'closed\' AND icat_id = \''.m($id)."' AND i_updated > ".strtotime('-1 day');
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo $row[0];
  $totals[6] += $row[0];
  echo '</td><td>';
  $sql = 'SELECT AVG(i_updated - i_added) FROM issues_issues WHERE i_status = \'closed\' AND icat_id = \''.m($id).'\'';
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo (($row[0] != 0) ? duration($row[0]) : 'None');
  echo '</td></tr>';
 }
 $i++;

?>
  <tr <?php echo ($i % 2 == 0 ? 'class="even"':'class="odd"'); ?>><td>Total:</td>
  <?PHP foreach ($totals as $v) { echo '<td class="number">'.$v.'</td>'; } ?>
  <td>
  <?php
  $sql = 'SELECT AVG(i_updated - i_added) FROM issues_issues WHERE i_status = \'closed\'';
  $res = mysql_query($sql); $row = mysql_fetch_array($res); echo (($row[0] != 0) ? duration($row[0]) : 'None');
  ?>
  </td>
  </tr>
 </table>
 </div>

