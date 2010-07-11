<?PHP if (!defined('ADMIN') || !ADMIN) { die('Admins only'); } ?>
<form action="<?PHP echo CP_PATH; ?>bans" method="post">
<div class="block">
 <h2>Add IP ban</h2>
 <div class="innerblock">
  <p class="blurb">
   IP Addresses are strictly matched (i.e., no ranges are allowed).
   The reason specified is exposed to the banned user, so keep it civil.
   Expirary time should be formatted as specified <a href="http://www.gnu.org/software/tar/manual/html_node/tar_109.html">here</a>. Most commonly you'll just
   want '+1 day' or so.
  </p>
  <table class="form leftpad">
   <tr>
    <th><label for="ip">IP Address</label></th>
    <td><input type="text" name="ip" class="inflat"></td>
   </tr>
   <tr>
    <th><label for="reason">Reason</label></th>
    <td><input type="text" name="reason" class="inflat"></td>
   </tr>
   <tr>
    <th><label for="expirary">Expirary</label></th>
    <td><input type="text" name="expirary" class="inflat"></td>
   </tr>
   <tr><td colspan="2" style="text-align: right;">
    <input type="submit" value="Add">
   </td></tr>
  </table>
 </div>
</div>
</form>
