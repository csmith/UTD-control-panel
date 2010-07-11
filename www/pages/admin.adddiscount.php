<?PHP

 function randLetter($set) {
  global $codes;
  $num = rand(65,90);
  $codes[$set] += $num - 65;
  return chr($num);
 }

 do {
  $codes = array();
  for ($i = 0; $i < 4; $i++) {
   for ($j = 0; $j < 4; $j++) {
    $code .= randLetter($i);
   }
   $code .= '-';
  }

  for ($i = 0; $i < 4; $i++) {
   $code .= chr(($codes[$i] % 26) + 65);
  }

  $sql  = 'SELECT discount_code FROM discounts WHERE discount_code = ';
  $sql .= '\'' . m($code) . '\'';
  $res  = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 } while (mysql_num_rows($res) != 0);
?>
<form action="<?PHP echo CP_PATH; ?>admindiscounts" method="post">
<input type="hidden" name="code" value="<?PHP echo $code; ?>">
<div class="block">
 <h2>ADMIN: Add discount</h2>
 <div class="innerblock">
  <p class="blurb">
   The discount message may be blank. If non-blank it is displayed immediately
   after the discount applied message (so you may want to start messages with
   <code>&lt;br&gt;&lt;br&gt;</code> &mdash; HTML is allowed).
  </p>
  <table class="form leftpad" style="width: auto;"> 
   <tr>
    <th>Code</th>
    <td><input type="text" name="codeinput" class="inflat" value="<?PHP echo $code; ?>" disabled="disabled" style="width: 352px;"></td>
   </tr><tr>
    <th>Message</th>
    <td><input type="text" name="message" class="inflat" style="width: 352px;"></td>
   </tr><tr>
    <th>Valid period</th>
    <td>
     <input type="text" class="inflat" name="from" value="now">
     <input type="text" class="inflat" name="to" value="+1 month">
    </td>
   </tr><tr>
    <th>Time</th>
    <td>
     <input type="text" name="timequant" value="0" class="inflat">
     <select name="timeunit" class="inflat">
      <option value="1">Seconds</option>
      <option value="60">Minutes</option>
      <option value="3600">Hours</option>
      <option value="86400">Days</option>
      <option value="2592000">Months</option>
      <option value="31536000">Years</option>
     </select>
    </tr>
   </tr><tr>
    <th>Money (pence)</th>
    <td><input type="text" name="money" value="0" class="inflat"></td>
   </tr><tr>
    <th>Type</th>
    <td>
     <select name="type" class="inflat">
      <option value="general">General</option>
      <option value="signup">Signup</option>
     </select>
    </td>
   </tr><tr>
    <th>Package</th>
    <td>
     <select name="package" class="inflat">
<?PHP

 $sql = 'SELECT package_id, package_name FROM packages ORDER BY package_name';
 $res = mysql_query($sql);
 while ($row = mysql_fetch_assoc($res)) {
  echo '<option value="'.$row['package_id'].'">'.h($row['package_name']);
  echo '</option>';
 }
?>
     </select>
    </td>
   </tr><tr>
     <td colspan="2" style="text-align: right;">
      <input type="reset" value="Reset">
      <input type="submit" name="submit" value="Submit">
     </td>
   </tr>
  </table>
 </div>
</div>
</form>
