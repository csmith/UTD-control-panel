<?PHP
 require_once('lib/database.php'); 
 require_once('lib/common.php'); 
?>
<div class="block">
 <h2>Support</h2>
 <div class="innerblock">
  <p class="blurb">Have a question about UTD-Hosting, this control panel, or anything else
   related to our services? Enter your question below to search our support
   system.</p>
  <p>
  <form action="<?PHP echo CP_PATH; ?>support/999" method="post">
   <input type="text" name="search" class="supportsearch">
   <input type="submit" value="Go">
  </form>
  </p>
  <p>
   If you can't find the answer to your query in our support database, please
   <a href="<?PHP echo CP_PATH; ?>tickets">raise a ticket</a> or
   <a href="<?PHP echo CP_PATH; ?>support/005">e-mail us</a>.
  </p>
 </div>
</div>
