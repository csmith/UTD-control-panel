<?PHP
 require_once('lib/database.php');
 require_once('lib/common.php'); 
?>
<div class="block" id="users">
 <h2>ADMIN: Users</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>Name</th>
   <th>E-Mail</th>
   <th>Bandwidth</th>
   <th>HDD</th>
   <th>Actions</th>
  </tr>
<?PHP

 $i = 0;
 $n = 0;
 
 $sql = 'SELECT user_id, user_name, user_email, band_used, band_total, hdd_used, hdd_total FROM users ORDER BY user_name';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 
 while ($row = mysql_fetch_array($res)) {
  $n++;
?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $n; ?>.</td>
   <td><?PHP echo h($row['user_name']); ?></td>
   <td><?PHP echo h($row['user_email']); ?></td>
   <td><?PHP
 $p = round(100 * $row['band_used'] / $row['band_total'],0);
 echo '<img src="'.CP_PATH.'res/bandout.png" style="width: '.$p.'px; height: 10px;" alt="Used" title="'.$p.'% used">';
 echo '<img src="'.CP_PATH.'res/bandfree.png" style="width: '.(100-$p).'px; height: 10px;" alt="Free" title="'.(100-$p).'% free">';
?></td>
   <td><?PHP
 $p = round(100 * $row['hdd_used'] / $row['hdd_total'],0);
 echo '<img src="'.CP_PATH.'res/bandout.png" style="width: '.$p.'px; height: 10px;" alt="Used" title="'.$p.'% used">';
 echo '<img src="'.CP_PATH.'res/bandfree.png" style="width: '.(100-$p).'px; height: 10px;" alt="Free" title="'.(100-$p).'% free">';
?></td>
  <td>
   <a href="<?PHP echo CP_PATH.'checkuser/'.$row['user_id']; ?>">Check</a>
   |
   <a href="<?PHP echo CP_PATH.'spoofuser/'.$row['user_id']; ?>">Spoof</a>
  </td>
  </tr>
<?PHP
   $i = 1 - $i;
 }

?>    
 </table>
</div>
