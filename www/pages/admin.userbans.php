<?PHP
 require_once('lib/database.php');
 require_once('lib/common.php'); 
?>
<div class="block" id="users">
 <h2>ADMIN: Username blocks</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>Username</th>
  </tr>
<?PHP

 $i = 0;
 $n = 0; 
 $sql = 'SELECT bu_id, bu_name FROM banneduser';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

 if (mysql_num_rows($res) == 0) {
  echo '<tr><td colspan="2" style="text-align: center; font-style: italic;">';
  echo 'No username blocks</td></tr>';
 }
 
 while ($row = mysql_fetch_array($res)) {
  $n++;
?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $n; ?>.</td>
   <td><?PHP echo h($row['bu_name']); ?></td>
  </tr>
<?PHP
   $i = 1 - $i;
 }

?>    
 </table>
</div>
