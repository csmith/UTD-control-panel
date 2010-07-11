<?PHP
 require_once('lib/database.php');
 require_once('lib/common.php');
?>
<div class="block" id="tickets">
 <h2>ADMIN: Admin menu</h2>
 <div class="innerblock doublelist">
  <div style="float: left; width: 50%; padding: 0px;">
   <ul>
    <li><a href="<?PHP echo CP_PATH; ?>admintickets">Ticket management</a></li>
    <li><a href="<?PHP echo CP_PATH; ?>admininvoices">Invoice management</a></li>
    <li><a href="<?PHP echo CP_PATH; ?>adminbans">Ban management</a></li>
    <li><a href="<?PHP echo CP_PATH; ?>admindiscounts">Discount management</a></li>
    <li><a href="<?PHP echo CP_PATH; ?>adminfinances">Finances</a></li>
    <li><a href="<?PHP echo CP_PATH; ?>adminlogs">Logs</a></li>
   </ul>
  </div>
  <div style="margin-left: 50%;">
   <ul>
    <li><a href="<?PHP echo CP_PATH; ?>adminusers">User management</a></li>
    <li><a href="<?PHP echo CP_PATH; ?>admindomains">Domain management</a></li>
    <li><a href="<?PHP echo CP_PATH; ?>adminsites">Site management</a></li>
    <li><a href="<?PHP echo CP_PATH; ?>adminannouncements">Announcements</a></li>
    <li><a href="<?PHP echo CP_PATH; ?>adminreports">Reports</a></li>
    <li><a href="<?PHP echo CP_PATH; ?>adminwiki">Wiki</a></li>
   </ul>
  </div>
 </div>
</div>
