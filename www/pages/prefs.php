<div class="block">
 <h2>User preferences</h2>
<?PHP

 $sql = 'SELECT user_email, user_admin, mail_announce, mail_tickets, mail_warning, mail_over, ud_name, ud_address, ud_telephone FROM users NATURAL JOIN userdetails WHERE users.user_id = '.UID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql); 
 $row = mysql_fetch_array($res);

?>
 <table class="innerblock righthead">
  <tr>
   <th>User name</th>
   <td><?PHP echo USER; ?></td>
  </tr>
  <tr>
   <th>Type</th>
   <td><?PHP echo ($row['user_admin'] == 1 ? 'Admin' : 'User'); ?></td>
  </tr>
  <tr>
   <th>E-Mail</th>
   <td><?PHP echo h($row['user_email']); ?></td>
   <td><a href="<?PHP echo CP_PATH; ?>editpref/1">Edit</a></td>
  </tr>
  <tr>
   <th>Mail preferences</th>
   <td><?PHP
    $first = true;
    // announce, tickets, warning, over
    if ($row['mail_announce'] == '1') { 
     $first = false; echo 'Announcements';
    }
    if ($row['mail_tickets'] == '1') {
     if (!$first) { echo ', '; }; $first = false;
     echo 'Tickets';
    }
    if ($row['mail_warning'] == '1') {
     if (!$first) { echo ', '; }; $first = false;
     echo 'Warnings';
    }
    if ($row['mail_over'] == '1') {
     if (!$first) { echo ', '; }; $first = false;
     echo 'Overings';
    }
    if ($first) { echo '(No mail)'; }
    ?></td>
   <td><a href="<?PHP echo CP_PATH; ?>editpref/2">Edit</a></td>
  </tr>
 </table>
</div>

<div class="block">
 <h2>Contact details</h2>
 <table class="innerblock righthead">
  <tr> 
   <th>Full name</th>
   <td><?PHP echo h($row['ud_name']); ?></td>
   <td><a href="<?PHP echo CP_PATH; ?>editpref/3">Edit</a></td>
  </tr>
  <tr>
   <th>Address</th>
   <td><?PHP echo h($row['ud_address']); ?></td>
   <td><a href="<?PHP echo CP_PATH; ?>editpref/4">Edit</a></td>
  </tr>
  <tr>
   <th>Telephone</th>
   <td><?PHP echo h($row['ud_telephone']); ?></td>
   <td><a href="<?PHP echo CP_PATH; ?>editpref/5">Edit</a></td>
  </tr>
 </table>
</div>
