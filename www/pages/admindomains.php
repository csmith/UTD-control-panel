<?PHP

 if (!defined('ADMIN') || !ADMIN) { die('Admins only'); }

?>
<div class="block" id="domains">
<h2>ADMIN: All domains</h2>
<table class="innerblock">
  <tr><th>&nbsp;</th><th>Domain</th><th>User</th><th>Site</th>
  <th>DNS</th>
  <th>Enabled?</td></tr>
<?PHP

 $sql = 'SELECT domain_id, domain_name, domain_enabled, domains.user_id, user_name FROM domains NATURAL JOIN users ORDER BY user_name, domain_name';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

 $i = 0;

 while ($row = mysql_fetch_array($res)) {
  $sql2 = 'SELECT r.record_value, s.site_name, s.site_id FROM records AS r, sites AS s WHERE r.domain_id = '.$row['domain_id'].' AND r.record_type = \'UTD\' AND s.site_id = r.record_value';
  $res2 = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  if (mysql_num_rows($res2) > 0) {
   $row2 = mysql_fetch_array($res2);
   $asite = $row2['site_name'];
   $asiteid = $row2['site_id'];
  } else {
   $asite = '';
  }

?>
   <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
    <td><?PHP echo h($row['domain_id']); ?></td>
    <td><?PHP echo h($row['domain_name']); ?></td>
    <td><a href="<?PHP echo CP_PATH.'checkuser/'.$row['user_id']; ?>"><?PHP echo h($row['user_name']); ?></a></td>
    <td><?PHP if ($asite != '') { ?>
     <a href="<?PHP echo CP_PATH; ?>editsite/<?PHP echo $asiteid; ?>"><?PHP echo h($asite); ?></a>
     </td>
     <?PHP } else { ?>None</td><?PHP } ?><td>
<?PHP if (gethostbyname($row['domain_name']) != '63.246.141.80') { ?>
      <a href="<?PHP echo CP_PATH; ?>support/017" style="color: red;">Error</a>
<?PHP } else { echo 'OK'; } ?>
     </td><td>
     <?PHP if ($row['domain_enabled'] != '1') { ?>
     <a href="<?PHP echo CP_PATH; ?>enabledomain/<?PHP echo $row['domain_id']; ?>">Enable</a>
     <?PHP } else { echo 'Enabled'; } ?>
    </td>
   </tr>
<?PHP
  $i = 1 - $i;
 }
?>
  </table>
</div>
</div>
