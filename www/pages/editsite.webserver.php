<form action="<?PHP echo CP_PATH; ?>editsite/<?PHP echo $_GET['n']; ?>" method="post">
<?PHP

 $sql  = 'SELECT site_php, site_htaccess, site_index FROM sites WHERE ';
 $sql .= 'site_id = ' . $_GET['n'];
 $res  = mysql_query($sql);
 $row  = mysql_fetch_assoc($res);

 $htaccess = ((int) $row['site_htaccess'] == 1) ? ' checked="checked" ' : '';
 $index = ((int) $row['site_index'] == 1) ? ' checked="checked" ' : '';

?>
<input type="hidden" name="task" value="webserver">
<input type="hidden" name="site" value="<?PHP echo $_GET['n']; ?>">
<div class="block">
 <h2>Webserver settings</h2>
 <div class="innerblock">
  <p class="blurb">
   It may take a few minutes for changes to these settings to take effect.
  </p>
  <table class="form leftpad">
   <tr>
    <th>Enable .htaccess files</th>
    <td><input type="checkbox" name="htaccess"<?PHP echo $htaccess; ?>></td>
   </tr>
   <tr>
    <th>Allow directory indexing</th>
    <td><input type="checkbox" name="index"<?PHP echo $index; ?>></td>
   </tr>
   <tr>
    <th>PHP Version</th>
    <td>
     <select name="phpversion" class="inflat">
<?PHP

 $targets = array('stable', 'dev', 'legacy');

 foreach ($targets as $php) {
  $binary = '/opt/php/'.$php;
  if (!file_exists($binary)) { continue; }
  echo '<option value="'.$php.'"';
  if ($row['site_php'] == $php) { echo ' selected="selected"'; }
  echo '>'.ucfirst($php) . ' - ';
  echo substr(readlink($binary), strlen('/opt/php/'), -1);
  echo '</option>';
 }

?>
     </select>
    </td>
   </tr>
   <tr>
    <th>Actions</th>
    <td><input type="submit" value="Update">
     <input type="reset" value="Reset"></td>
   </tr>
  </table>
 </div>
</div>
</form>
