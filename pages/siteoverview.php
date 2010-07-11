<?PHP
 require_once('lib/database.php');
 require_once('lib/common.php');
?>
<div class="block">
 <h2>My Sites</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>Name</th>
   <th>Settings</th>
   <th>Stats</th>
   <th>Bandwidth</th>
   <th>Status</th>
  </tr>
<?PHP

 $i = 0;
 $n = 0; 
 /*
  /usr/local/apache/htdocs/bandquota - Bandwidth overing
  /usr/local/apache/htdocs/bill      - Unpaid bill
 */
 
 $sql = 'SELECT site_id, site_name, site_bandin, site_bandout, site_docroot, site_curdocroot FROM sites WHERE user_id = '.UID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 
 if (mysql_num_rows($res) == 0) {
  echo '<tr><td colspan="6" style="font-style: italic; text-align: center;">';
  echo 'You have no sites. Would you like to <a href="'.CP_PATH.'addsite">add one</a>?</td></tr>';
 }
 
 while ($row = mysql_fetch_array($res)) {
  $n++;
?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $n; ?>.</td>
   <td><?PHP echo $row['site_name']; ?></td>
   <td><a href="<?PHP echo CP_PATH; ?>editsite/<?PHP echo $row['site_id']; ?>">Settings</a></td>
   <td><a href="<?PHP echo CP_PATH; ?>sitestats/<?PHP echo $row['site_id']; ?>">Stats</a></td>
   <td><?PHP echo NiceSize($row['site_bandin'] + $row['site_bandout']); ?></td>
<?PHP

 /*if (!is_dir($row['site_docroot'])) {
   echo '<td class="err">Invalid docroot</td>';
 } else*/ if ($row['site_docroot'] == '/usr/local/apache/htdocs/bandquota') {
   echo '<td class="err">Disabled - bandwidth exceeded</td>';
 } elseif ($row['site_docroot'] == '/usr/local/apache/htdocs/hddquota') {
   echo '<td class="err">Disabled - disk quota exceeded</td>';
 } elseif ($row['site_docroot'] == '/usr/local/apache/htdocs/bill') {
   echo '<td class="err">Disabled - unpaid bill</td>';
 } else {
   echo '<td>OK</td>';
 }

?>
  </tr>
<?PHP
   $i = 1 - $i;
 }

?>    
 </table>
</div>
