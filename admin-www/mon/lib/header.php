<?PHP

 if (!defined('LIB_COMMON')) { require_once('lib/common.php'); }
 if (!defined('LIB_ACCOUNT')) { require_once('lib/account.php'); }
 if (!defined('LIB_DASHBOARD')) { require_once('lib/dashboard.php'); }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <title>UTD-Hosting :: <?PHP echo TITLE; ?></title>
  <link rel="stylesheet" type="text/css" href="<?PHP echo CP_PATH; ?>res/style.css">
  </script>
  <script type="text/javascript">
   _uacct = "UA-70222-2";
   urchinTracker();
  </script>
 </head>
 <body>
  <div id="header">
   <h1><img src="<?PHP echo CP_PATH; ?>res/logo.png" alt="UTD-Hosting" title="UTD-Hosting"></h1>
  </div>
<?PHP

 if (defined('USER')) { require_once('lib/bandwidth.php'); }

?>  
  <div id="menu">
   <div id="menuleft">
    <a href="<?PHP echo CP_PATH; ?>">Monitoring</a> 
   </div>
   <div id="menuright">
    <a href="https://secure.utd-hosting.com/control">Control panel</a> |
    <a href="https://secure.utd-hosting.com/control/admin">Admin</a>
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
