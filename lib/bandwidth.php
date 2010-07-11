<?PHP

 if (defined('NOBILLREF')) { return; }

 require_once('lib/profiler.php');

 $sql = 'SELECT band_total, band_used, hdd_total, hdd_used FROM users WHERE user_id = '.UID;
 $ress = mq($sql, __FILE__, __LINE__);
 $row = mysql_fetch_array($ress);

 $used = round($row[1] * (150/($row[0])),0);
 $free = 150 - $used;

 $hused = round($row[3] * (150/($row[2])),0);
 $hfree = 150 - $hused;

 $sql  = 'SELECT MIN(up_expires) FROM userpackages WHERE';
 $sql .= ' user_id = '.UID.' AND up_invoice = 1 AND up_active = 1';
 $ress = mq($sql, __FILE__, __LINE__);
 $pay = mysql_fetch_array($ress);
 $next = $pay[0];
?>
<table id="bandwidth" class="righthead">
 <tr>
  <th>Bandwidth</th>
  <td>
   <img src="<?PHP echo CP_PATH; ?>res/bandout-001.png" alt="[Red]" title="Bandwidth used" width="<?PHP echo $used; ?>" height="10"><img src="<?PHP echo CP_PATH; ?>res/bandfree-001.png" alt="[Green]" title="Free bandwidth" width="<?PHP echo $free; ?>" height="10">
  </td>
  <td><?PHP echo niceSize($row[1]).' / '.niceSize($row[0]); ?></td>
 </tr>
 <tr>
  <th>Hard drive</th>
  <td>
   <img src="<?PHP echo CP_PATH; ?>res/bandout-001.png" alt="[Red]" title="Hard drive space used" width="<?PHP echo $hused; ?>" height="10"><img src="<?PHP echo CP_PATH; ?>res/bandfree-001.png" alt="[Green]" title="Free space" width="<?PHP echo $hfree; ?>" height="10">
  </td>
  <td><?PHP echo niceSize($row[3]).' / '.niceSize($row[2]); ?></td>
 </tr>
 <tr>
  <th>Next payment</th>
  <td colspan="2" style="text-align: center"><?PHP echo date('l, jS F, Y', $next); ?></td>
 </tr>
</table>
