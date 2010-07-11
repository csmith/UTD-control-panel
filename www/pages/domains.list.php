<div class="block">
<h2>Domains</h2>
<div class="innerblock">
  <p class="blurb">
   A domain may not be deleted while it is associated with a site.
  </p>
  <table class="form">
<?PHP

 $sql = 'SELECT domain_id, domain_name, domain_parent FROM domains WHERE domain_enabled = 1 AND user_id = '.UID.' ORDER BY domain_name';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

 if (mysql_num_rows($res) == 0) {
  echo '<p>You do not have any domains associated with your account.</p>';
 }

 $doms = array();
 
 while ($row = mysql_fetch_array($res)) {
  if (!isset($doms[$row['domain_parent']])) {
   $doms[$row['domain_parent']] = array();
  }
  $doms[$row['domain_parent']][] = $row;
 }

 foreach ($doms[0] as $row) {
  doDomain($row);
 }

 function doDomain($row, $indent = 0) {
  global $doms;

  $sql2 = 'SELECT r.record_value, s.site_name, s.site_id FROM records AS r, sites AS s WHERE r.domain_id = '.$row['domain_id'].' AND r.record_type = \'UTD\' AND s.site_id = r.record_value';
  $res2 = mysql_query($sql2) or mf(__FILE__, __LINE__, $sql2);
  if (mysql_num_rows($res2) > 0) {
   $row2 = mysql_fetch_array($res2);
   $asite = $row2['site_name'];
   $asiteid = $row2['site_id'];
  } else {
   $asite = '';
  }

  $name = h($row['domain_name']);
?>
   <tr>
    <td<?PHP echo $indent == 0 ? ' style="font-weight: bold;"' : ''; ?>>
     <?PHP echo str_repeat('&gt; ', $indent).$name; ?>
    </td>
    <td><?PHP if ($asite != '') { ?>
     Associated with <a href="<?PHP echo CP_PATH; ?>editsite/<?PHP echo $asiteid; ?>"><?PHP echo h($asite); ?></a>.
     </td><td>
<?PHP if (gethostbyname($row['domain_name']) != '63.246.141.80') { ?>
      <a href="<?PHP echo CP_PATH; ?>support/017" style="color: red;">DNS Error</a>
<?PHP } ?>
     <?PHP } else { ?>Not associated with any site.</td><td>
<?PHP if (gethostbyname($row['domain_name']) != '63.246.141.80') { ?>
      <a href="<?PHP echo CP_PATH; ?>support/017" style="color: red;">DNS Error</a>
<?PHP } ?>
     </td><td>
     <form action="<?PHP echo CP_PATH; ?>domains" method="post"><input type="hidden" name="action" value="deldom"><input type="hidden" name="domain" value="<?PHP echo $row['domain_id']; ?>"><input type="submit" value="Delete"></form><?PHP } ?>
    </td>
   </tr>
<?PHP
  if (isset($doms[$row['domain_id']])) {
   foreach ($doms[$row['domain_id']] as $nrow) {
    doDomain($nrow, $indent + 1);
   }
  }
 }

?>
  </table>
</div>
</div>
