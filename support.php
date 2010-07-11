<?PHP

 require_once('lib/dashboard.php');
 
 if (!isset($_GET['n']) || !preg_match('/^[0-9]{3}$/',$_GET['n']) || !file_exists('sup/'.$_GET['n'].'.php')) {
   $support = '000';
 } else {
   $support = $_GET['n'];
 }

 if (isset($_GET['n']) && ctype_digit($_GET['n']) && strlen($_GET['n']) == 3) {
  if ($_GET['n'] != $support) {
   define('MESSAGE', 'Support article not found.');
  }
 }
 
 define('NOLOGINREF', true); // Everyone can access support!
 define('NOTACREF', true);

 require_once('lib/common.php');

 if (file_exists('../support.dat')) {
  $stats = unserialize(file_get_contents('../support.dat'));
 } else {
  $stats = array();
 }
 if ($support != '000' && $support != '999') {
  $stats[$support]++;
  file_put_contents('../support.dat', serialize($stats));
 }
 
 require_once('sup/'.$support.'.php');
 
 define('TITLE', 'Support :: '.SUPPORT_TITLE);
 
 addDashboardItem('Useful links', 'Raise a ticket', 'tickets');
 addDashboardItem('Useful links', 'Support home', 'support/000');
 addDashboardItem('Useful links', 'Search support', 'support/999');

 require_once('lib/header.php');
 
 require_once('pages/support.php');
 
 require_once('lib/footer.php');


?>
