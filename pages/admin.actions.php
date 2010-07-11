<?PHP
 require_once('lib/database.php'); 
 require_once('lib/common.php'); 
?>
<div class="block">
<form action="<?PHP echo CP_PATH; ?>admin" method="post">
 <h2>ADMIN: Schedule actions</h2>
 <table class="innerblock">
  <tr>
   <th>Service</th>
   <th>Update config</th>
   <th>Restart</th>
  </tr>
<?PHP

 $services = array('apache', 'bind', 'postfix', 'sshkeys');

 $i = 0;

 foreach ($services as $service) {
?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><?PHP echo ucfirst($service); ?></td>
   <td><input type="submit" name="<?PHP echo $service; ?>_updateconf" value="Update config"></td>
   <td><input type="submit" name="<?PHP echo $service; ?>_restart" value="Restart" <?PHP
    if ($service == 'sshkeys') { echo ' disabled="disabled"'; }
   ?>></td>
  </tr>
<?PHP
   $i = 1 - $i;
 }

?>    
 </table>
 </form>
</div>
