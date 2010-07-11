<?PHP

 $sql = 'SELECT domain_id, domain_name FROM domains WHERE domain_enabled = 1 AND user_id = '.UID;
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);

 if (mysql_num_rows($res) > 0) {
?>
<form name="submd" action="<?PHP echo CP_PATH; ?>domains" method="post" onSubmit="return validateSubdomainForm();">
<input type="hidden" name="action" value="addsub">
<div class="block">
 <h2>Add a new subdomain</h2>
 <div class="innerblock">
  <p class="blurb">
   You can add a new subdomain to any of your existing domains. Subdomains
   are added instantly, and you can use them right away. You will need to
   make sure that the subdomain resolves to the correct IP address.
  </p>
  <table class="form leftpad">
   <tr>
    <td><input type="text" name="subdomain" id="subdomain" class="inflat" style="width: 120px;"></td>
    <td style="width: 10px;">.</td>
    <td>
     <select name="subdomaind" id="subdomaind" style="inflat">
<?PHP

 while ($row = mysql_fetch_array($res)) { 
  if (strpos($row['domain_name'],'*')) { continue; }
  echo '<option value="'.$row['domain_id'].'">'.$row['domain_name'].'</option>';
 }

?>
     </select>
    </td>
    <td style="width:100%;"><span id="subdomainerr" class="validation"></span></td>
   </tr>
   <tr><td colspan="3" style="text-align: right;">
    <input type="submit" value="Add">
   </td></tr>
  </table>
 </div>
</div>
</form>
<?PHP } ?>
<form name="md" action="<?PHP echo CP_PATH; ?>domains" method="post" onSubmit="return validateDomainForm();">
<input type="hidden" name="action" value="add">
<div class="block">
 <h2>Add a new domain</h2>
 <div class="innerblock">
  <p class="blurb">
   Before you can use a new domain, a UTD-Hosting staff member will have to confirm that the
   domain belongs to you. This is to ensure that other customers do not "steal" your domains,
   and vice-versa.
  </p>
  <table class="form leftpad">
   <tr>
    <td><input type="text" name="domain" id="domain" class="inflat" style="width: 120px;"></td>
    <td style="width:100%;"><span id="domainerr" class="validation"></span></td>
   </tr>
   <tr><td style="text-align: right;">
    <input type="submit" value="Add">
   </td></tr>
  </table>
 </div>
</div>
</form>

