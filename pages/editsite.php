<?PHP
 if (!isset($error)) {
 if (!defined('SUSER')) { define('SUSER', USER); define('SUID', UID); }
?>
<div class="block">
 <h2>General settings and tools</h2>
 <table class="innerblock righthead">
  <tr>
   <th>Site name</th>
   <td><?PHP echo h(SITE_NAME); ?></td>
  </tr>
  <tr>
   <th>Document root</th>
   <td><?PHP echo h(substr(SITE_DOCROOT,strlen('/home/'.SUSER))); ?></td>
  </tr>
 </table>
</div>

<div class="block">
 <h2>Webserver settings</h2>
 <table class="innerblock righthead">
  <tr>
   <th>Enable .htaccess files</th>
   <td><input type="checkbox" name="htaccess"></td>
  </tr>
  <tr>
   <th>Allow directory indexing</th>
   <td><input type="checkbox" name="override"></td>
  </tr>
  <tr>
   <th>PHP Version</th>
   <td>
<?PHP

 $targets = array('stable', 'dev', 'legacy');

 foreach ($targets as $php) {
  $binary = '/usr/local/php-'.$php.'/bin/php';
  if (!file_exists($binary)) { continue; }
  echo '<label><input type="radio" name="php" value="'.$php.'">'.ucfirst($php);
  echo '</label>';
 }

?>
   </td>
  </tr>
 </table>
</div>

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

 $sql = 'SELECT domain_id, domain_name FROM domains WHERE domain_enabled = 1 AND user_id = '.SUID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

 while ($row = mysql_fetch_array($res)) {
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
    <td><?PHP echo h($row['domain_name']); ?></td>
    <td><?PHP if ($asite != '' && $asite != SITE_NAME) { ?>
     Already associated with <?PHP echo h($asite); ?>.
     <?PHP } ?>
    </td>
   </tr>
<?PHP
 }
?>
   <tr><td colspan="2" style="text-align: right"><input type="submit" value="Save"></td></tr>
  </table>
  </form>
 </div>
</div>
<?PHP
 } else {
  echo '<div id="message"><div>'.$error.'</div></div>';
 }	 
?>
