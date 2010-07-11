<?PHP
 if (!defined('LIB_DATABASE')) { require_once('lib/database.php'); }
 if (!defined('LIB_COMMON')) { require_once('lib/common.php'); } 
 if (!defined('ADMIN') || !ADMIN) { die('Admins only'); }
?>
<div class="block" id="sites">
 <h2>ADMIN: All Sites</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>Name</th>
   <th>User</th>
   <th>Settings</th>
   <th>Stats</th>
   <th>Bandwidth</th>
   <th>Status</th>
  </tr>
<?PHP

 $i = 0;
 
 /*
  /usr/local/apache/htdocs/bandquota - Bandwidth overing
  /usr/local/apache/htdocs/bill      - Unpaid bill
 */
 
 $sql = 'SELECT site_id, site_name, site_bandin, site_bandout, site_docroot, site_curdocroot, user_name, sites.user_id FROM sites NATURAL JOIN users';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 
 while ($row = mysql_fetch_array($res)) {
?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $row['site_id']; ?>.</td>
   <td><?PHP echo $row['site_name']; ?></td>
   <td><a href="<?PHP echo CP_PATH; ?>checkuser/<?PHP echo $row['user_id']; ?>"><?PHP echo $row['user_name']; ?></a></td>
   <td><a href="<?PHP echo CP_PATH; ?>editsite/<?PHP echo $row['site_id']; ?>">Settings</a></td>
   <td><a href="<?PHP echo CP_PATH; ?>sitestats/<?PHP echo $row['site_id']; ?>">Stats</a></td>
   <td><?PHP echo NiceSize($row['site_bandin'] + $row['site_bandout']); ?></td>
<?PHP

 if (!is_dir($row['site_docroot'])) {
   echo '<td class="err">Invalid docroot</td>';
 } elseif ($row['site_docroot'] == '/usr/local/apache/htdocs/bandquota') {
   echo '<td class="err">Disabled - bandwidth exceeded</td>';
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
