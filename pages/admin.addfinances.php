<form action="." method="post">
<div class="block" id="add">
 <h2>Add transaction</h2>
 <div class="innerblock">
  <table class="form">
   <tr>
    <th>Date</th>
    <td>
     <input type="text" name="date" value="<?PHP echo date('Y-m-d'); ?>" class="inflat">
    </td>
   </tr>
   <tr>
    <th>Description</th>
    <td>
     <input type="text" name="desc" class="inflat">
    </td>
   </tr>
   <tr>
    <th>User</th>
    <td>
     <select name="user" class="inflat">
      <option value="5">N/A</option>
<?PHP

 $sql = 'SELECT user_id, user_name FROM users WHERE user_pass != \'invalid\' ORDER BY user_name';
 $res = mysql_query($sql);
 while ($row = mysql_fetch_array($res)) {
  echo '<option value="'.$row[0].'">'.$row[1].'</option>';
 }
?>
     </select>
    </td>
   </tr>
   <tr>
    <th>Amount</th>
    <td><input type="text" name="amount" value="35" class="inflat"></td>
   </tr>
   <tr>
    <td></td><td><input type="submit" value="Add"></td>
   </tr>
  </table>
 </div>
</div>
</form>
