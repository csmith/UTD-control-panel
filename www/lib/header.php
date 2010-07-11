<?PHP

 require_once('lib/common.php'); 
 require_once('lib/profiler.php');
 require_once('lib/account.php'); 
 require_once('lib/dashboard.php'); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <title>UTD-Hosting :: <?PHP echo TITLE; ?></title>
  <link rel="stylesheet" type="text/css" href="<?PHP echo CP_PATH; ?>res/style-002.css">
  <script src="<?PHP echo CP_PATH; ?>res/script-001.js" type="text/javascript"></script>
 </head>
 <body>
  <div id="header">
   <h1><img src="<?PHP echo CP_PATH; ?>res/logo-001.png" alt="UTD-Hosting" title="UTD-Hosting"></h1>
  </div>
<?PHP

 if (DEVELOPMENT) { echo '<div id="dev">Development version</div>'; }

 if (defined('USER')) { require_once('lib/bandwidth.php'); }

?>  
  <div id="menu">
   <div id="menuleft">
    <?PHP if (defined('USER') && !defined('NOBILLREF')) { ?>
    <a href="<?PHP echo CP_PATH; ?>">Account overview</a> |
    <?PHP if (HAS_DNS || HAS_HOSTING) { ?>
     <a href="<?PHP echo CP_PATH; ?>domains">Domains</a> |
    <?PHP } ?>
    <?PHP if (HAS_DNS) { ?>
     <a href="<?PHP echo CP_PATH; ?>dns">DNS</a> |
    <?PHP } ?>
    <?PHP if (HAS_HOSTING) { ?>
     <a href="<?PHP echo CP_PATH; ?>email">E-mail</a> |
     <a href="<?PHP echo CP_PATH; ?>database">Databases</a> |
     <a href="<?PHP echo CP_PATH; ?>sites">Sites</a> |
    <?PHP } ?>
    <?PHP if (HAS_SSH) { ?>
     <a href="<?PHP echo CP_PATH; ?>ssh">SSH</a> |
    <?PHP } ?>
    <a href="<?PHP echo CP_PATH; ?>tickets">Tickets</a>
    <?PHP } else { ?>
    UTD-Hosting control panel
    <?PHP } ?>
   </div>
   <div id="menuright">
    <?PHP if (defined('USER') && !defined('NOBILLREF')) { ?>
    <a href="<?PHP echo CP_PATH; ?>account">My Account</a> |
    <a href="<?PHP echo CP_PATH; ?>invoices">My Invoices</a> |
    <a href="<?PHP echo CP_PATH; ?>support">Support</a> |
    <?PHP if (defined('ADMIN') && ADMIN) { ?>
    <a href="<?PHP echo CP_PATH; ?>admin" style="font-weight: bold;">Admin</a> |
    <?PHP } ?>
    <a href="<?PHP echo CP_PATH; ?>logout">Log out</a>
    <?PHP } else { ?>
    <a href="<?PHP echo CP_PATH; ?>support">Support</a> 
    <?PHP if (!defined('USER')) { ?>
     | <a href="<?PHP echo CP_PATH; ?>login">Log in</a>
    <?PHP } else { ?>
     | <a href="<?PHP echo CP_PATH; ?>billing" style="font-weight: bold;">Billing</a>
    <?PHP } } ?>
   </div>
  </div>
  <?PHP generateDashboard(); ?>
  <?PHP if (defined('MESSAGE')) { ?>
  <div id="message">
   <div>
    <?PHP echo MESSAGE; ?>
   </div>
  </div>
  <?PHP } ?>
