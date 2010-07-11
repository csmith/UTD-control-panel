<div class="block">
 <h2>Edit preference</h2>
<?PHP
 if ($_GET['n'] != 2) {
 $sql  = 'SELECT '.$fields[($_GET['n'])].' FROM users NATURAL JOIN userdetails';
 $sql .= ' WHERE user_id = '.UID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 $row = mysql_fetch_array($res);

?>
 <div class="innerblock">
  <p>
   Please enter your <?PHP echo $prefs[($_GET['n'])]; ?>.
  </p>
  <form action="<?PHP echo CP_PATH; ?>editpref/<?PHP echo $_GET['n']; ?>" method="post">
   <input type="text" name="value" value="<?PHP echo htmlentities($row[0]); ?>">
   <input type="submit" value="Submit">
 </form>
  <p>Please be aware that providing false information may lead to termination
   of your UTD-Hosting account.</p>
 </div>
<?PHP } else { 
 $sql  = 'SELECT mail_announce, mail_tickets, mail_warning, mail_over FROM ';
 $sql .= 'users WHERE user_id = '.UID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 $row = mysql_fetch_array($res);
?>
 <div class="innerblock">
  <p>Please select your mailing preferences</p>
  <form action="<?PHP echo CP_PATH; ?>editpref/2" method="post">
  <input type="hidden" name="mail" value="tr00">
  <table class="form">
   <tr>
    <td><input type="checkbox" name="mail_announce"<?PHP if ($row['mail_announce']) { echo ' checked="checked"'; } ?>></td>
    <td>Announcements</td>
    <td>Low volume announcements about UTD-Hosting</td>
   </tr>
   <tr>
    <td><input type="checkbox" name="mail_tickets"<?PHP if ($row['mail_tickets']) { echo ' checked="checked"'; } ?>></td>
    <td>Tickets</td>
    <td>Notification of replies to your tickets</td>
   </tr>
   <tr>
    <td><input type="checkbox" name="mail_warning"<?PHP if ($row['mail_warning']) { echo ' checked="checked"'; } ?>></td>
    <td>Warnings</td>
    <td>Automatic warning when you near your HDD or BW limit</td>
   </tr>
   <tr>
    <td><input type="checkbox" name="mail_over"<?PHP if ($row['mail_over']) { echo ' checked="checked"'; } ?></td>
    <td>Overrings</td>
    <td>Automatic message when you exceed your HDD or BW limit</td>
   </tr>
   <tr>
    <td></td>
    <td>
     <input type="submit" value="Update">
    </td>
   </tr>
  </table>
  <p>Note that Warnings and Overrings are currently not implemented. This
  functionality will be added at a future time.</p>
 </div>
<?PHP } ?>
</div>
