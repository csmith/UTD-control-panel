<p>
<?PHP if ($_SESSION['action'] == 'deferred' && $_SESSION['type'] == 'newuser') { ?>
 Thank you. Your application has been deferred to our admin team, and your account will be set up shortly. You should receive an e-mail within 24 hours containing details on how to access the control panel and how to pay your first bill. If you have any questions before you get a control panel login, please mail <a href="mailto:support@utd-hosting.com">support@utd-hosting.com</a>.
<?PHP } elseif ($_SESSION['action'] == 'deferred') { ?>
Thank you. Your request has been deferred to our admin team, who will contact you shortly about new billing arrangements and your new account limits. 
<?PHP } else { ?>
Thank you. Your application has been processed and you may now log into our <a href="/control">control panel</a> and pay for your account. If you require any assistance, please mail <a href="mailto:support@utd-hosting.com">support@utd-hosting.com</a>.
</p>
<p>
<form action="/control" method="post">
 <input type="submit" value="Continue">
</form>
<?PHP } ?>
</p>
<!-- Google Code for SIGNUP Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1065381349;
var google_conversion_language = "en_GB";
var google_conversion_format = "1";
var google_conversion_color = "666666";
if (35.0) {
  var google_conversion_value = 35.0;
}
var google_conversion_label = "SIGNUP";
//-->
</script>
<script language="JavaScript" src="https://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="https://www.googleadservices.com/pagead/conversion/1065381349/?value=35.0&label=SIGNUP&script=0">
</noscript>

                                    
