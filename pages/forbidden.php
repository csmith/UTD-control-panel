<div class="block">
 <h2>Error</h2>
 <div class="innerblock">
<?PHP
 if (defined('EXPIRES')) {
?>
  <p>
   Your IP address has been temporarily banned from using this control panel. 
  </p>
  <p>
   The reason specified was: <em><?PHP echo h(REASON); ?></em>
  </p>
  <p>
   The ban will automatically expire in approximately <em><?PHP echo duration(EXPIRES-time()); ?></em>
  </p>
  <p>
   If you feel that this ban was placed in error, do not understand the ban
   reason, or are using a shared IP address that has been banned because of
   another user, please e-mail support@utd-hosting.com, mentioning your IP
   address: <em><?PHP echo $_SERVER['REMOTE_ADDR']; ?></em>. 
  </p>
<?PHP
 } else {
?>
  <p>
   Sorry, you do not have access to the page that you requested.
  </p>
  <p>
   This could be because you have not purchased the relevant package, or your
   account has insufficient privileges.
  </p>
  <p>
   If you feel that you are receiving this message in error, please
   <a href="<?PHP echo CP_PATH; ?>tickets">raise a ticket</a> or contact
   support@utd-hosting.com.
  </p>
<?PHP
 }
?>
 </div>
</div>
