#!/usr/bin/php -q
<?PHP

 if (!ctype_digit($argv[1])) { die('Usage: ./get-support-article.php <id>'); }

 chdir('/home/utd/control/');
 define('NOLOGINREF', true);
 require_once('lib/database.php');
 require_once('lib/dashboard.php');
 define('SUPPORT_INDEX', True);
 
 $file = str_pad($argv[1],3,'0',STR_PAD_LEFT);

 if (file_exists('sup/'.$file.'.php')) {
  require_once('sup/'.$file.'.php');
  file_put_contents('sup/search/'.$file.'.txt', SUPPORT_TITLE."\n\n".strip_tags(SUPPORT_BODY));
 } else {
  die('Support article not found');
 }
?>
