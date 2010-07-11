<?PHP

 $sql = 'SELECT band_total, band_used, hdd_total, hdd_used FROM users WHERE user_id = '.UID;
 $ress = mysql_query($sql);
 $row = mysql_fetch_array($ress);

 $used = round($row[1] * (150/($row[0])),0);
 $free = 150 - $used;

 $hused = round($row[3] * (150/($row[2])),0);
 $hfree = 150 - $hused;

 $sql  = 'SELECT bill_due FROM billing WHERE';
 $sql .= ' user_id = '.UID.' AND bill_paid <> 2';
 $ress = mysql_query($sql);
 $pay = mysql_fetch_array($ress);
 $next = $pay[0];
?>
<table id="bandwidth" class="righthead">
 <tr>
  <th>Bandwidth</th>
  <td>
   <img src="<?PHP echo CP_PATH; ?>res/bandout.png" alt="[Red]" title="Bandwidth used" width="<?PHP echo $used; ?>" height="10"><img src="<?PHP echo CP_PATH; ?>res/bandfree.png" alt="[Green]" title="Free bandwidth" width="<?PHP echo $free; ?>" height="10">
  </td>
  <td><?PHP echo niceSize($row[1]).' / '.niceSize($row[0]); ?></td>
 </tr>
 <tr>
  <th>Hard drive</th>
  <td>
   <img src="<?PHP echo CP_PATH; ?>res/bandout.png" alt="[Red]" title="Hard drive space used" width="<?PHP echo $hused; ?>" height="10"><img src="<?PHP echo CP_PATH; ?>res/bandfree.png" alt="[Green]" title="Free space" width="<?PHP echo $hfree; ?>" height="10">
  </td>
  <td><?PHP echo niceSize($row[3]).' / '.niceSize($row[2]); ?></td>
 </tr>
 <tr>
  <th>Next payment</th>
  <td colspan="2" style="text-align: center"><?PHP echo date('l, jS F, Y', $next); ?></td>
 </tr>
</table>
