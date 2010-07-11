<?PHP
 require_once('lib/database.php'); 
 require_once('lib/common.php'); 
?>
<div class="block">
 <h2>MySQL databases</h2>
<form action="<?PHP echo CP_PATH; ?>database" method="post">
 <table class="innerblock bottomdiv">
  <tr>
   <th>&nbsp;</th>
   <th>Name</th>
   <th></th>
  </tr>
<?PHP

 $i = 0;
 
 $sql = 'SELECT db_id, db_name FROM db_dbs WHERE user_id = '.UID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 
 while ($row = mysql_fetch_array($res)) {
?>
  <tr class="<?PHP echo ($i == 0) ? 'even' : 'odd'; ?>">
   <td><input type="checkbox" name="db<?PHP echo $row['db_id']; ?>" id="db<?PHP echo $row['db_id']; ?>"<?PHP if (isset($_POST['delete'])) { if(isset($_POST['db'.$row['db_id']])) { echo ' checked="checked"'; }; echo ' disabled="disabled"'; } ?>>
   <td><?PHP echo $row['db_name']; ?></td>
<?PHP if (isset($_POST['delete']) && isset($_POST['db'.$row['db_id']])) { ?>
   <input type="hidden" name="db<?PHP echo $row['db_id']; ?>" value="delete">
   <td style="color: red;">This database will be deleted</td>
<?PHP } else { ?>
    <td></td>
<?PHP } ?>
  </tr>
<?PHP
   $i = 1 - $i;
 }

?>    
 </table>
 <div class="innerblock">
  <p>With selected:</p>
  <blockquote>
<?PHP if (isset($_POST['delete']) && !isset($_POST['confirm'])) { ?>
   <input type="hidden" name="confirm" value="confirm">
   <input type="submit" name="delete" value="Confirm deletion">
   <input type="submit" name="cancel" value="Cancel">
<?PHP } else { ?>
   <input type="submit" name="delete" id="delete" value="Delete">
<?PHP } ?>
  </blockquote>
 </div>
 </form>
 <div class="innerblock" style="padding-top: 0px;">
  <p>Add new database:</p>
  <form action="<?PHP echo CP_PATH; ?>database" method="post">
   <input type="hidden" name="action" value="adddb">
   <blockquote>Name: <?PHP echo USER; ?>_<input type="text" name="newdb">
    <input type="submit" value="Add">
   </blockquote>
  </form>  
 </div>
</div>
