#!/usr/bin/php -q
<?PHP

 chdir('/home/utd/control/sup');
 $files = glob('*.php');
 chdir('/home/utd/scripts');
 foreach ($files as $file) {
  if ((int)$file != 0 || (int)$file > 900) {
   system('./get-support-article.php '.substr($file,0,3));
  }
 }
?>
