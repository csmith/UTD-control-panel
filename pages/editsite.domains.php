<div class="block">
 <h2>Domain associations</h2>
 <div class="innerblock">
  <p class="blurb">
   To view this website, you must associate it with at least one domain name.
   You will then be able to view the site simply by typing the domain name
   in your browser.
  </p>
  <form action="<?PHP echo CP_PATH; ?>editsite" method="POST">
  <input type="hidden" name="task" value="domains">
  <input type="hidden" name="site" value="<?PHP echo SITE_ID; ?>">
  <table class="form">
<?PHP

 $sql = 'SELECT domain_id, domain_name, domain_parent FROM domains WHERE domain_enabled = 1 AND user_id = '.SUID.' ORDER BY domain_name';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

 $doms = array();

 while ($row = mysql_fetch_array($res)) {
  $doms[$row['domain_parent']][] = $row;
 }

 foreach ($doms[0] as $row) {
  doDomain($row);
 }

 function doDomain($row, $indent = 0) {
  $sql2 = 'SELECT r.record_value, s.site_name FROM records AS r, sites AS s WHERE r.domain_id = '.$row['domain_id'].' AND r.record_type = \'UTD\' AND s.site_id = r.record_value';
  $res2 = mysql_query($sql2) or mf(__FILE__, __LINE__, $sql2);
  if (mysql_num_rows($res2) > 0) {
   $row2 = mysql_fetch_array($res2);
   $asite = $row2['site_name'];
  } else {
   $asite = '';
  }

?>
   <tr>
    <td><input type="checkbox" id="domain<?PHP echo $row['domain_id']; ?>" name="domain<?PHP echo $row['domain_id']; ?>"<?PHP if ($asite == SITE_NAME) { echo " checked=\"checked\""; } elseif ($asite != '') { echo " disabled=\"disabled\""; } ?>></td>
    <td<?PHP echo $indent == 0 ? ' style="font-weight: bold;"' : ''; ?>>
     <?PHP echo str_repeat('&gt; ', $indent).h($row['domain_name']); ?>
    </td>
    <td><?PHP if ($asite != '' && $asite != SITE_NAME) { ?>
     Already associated with <?PHP echo h($asite); ?>.
     <?PHP } ?>
    </td>
   </tr>
<?PHP
  global $doms;
  if (isset($doms[$row['domain_id']])) {
   foreach ($doms[$row['domain_id']] as $nrow) {
    doDomain($nrow, $indent+1);
   }
  }
 }
?>
   <tr><td colspan="2" style="text-align: right"><input type="submit" value="Save"></td></tr>
  </table>
  </form>
 </div>
</div>
