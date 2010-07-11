#!/usr/bin/php -q
<?PHP

$log = 3;

$log = str_pad($log, 3, '0', STR_PAD_LEFT);

$fh = fopen('/usr/local/apache/logs/'.$log.'-access_log','r');

while (!feof($fh)) {
 $line = trim(fgets($fh));
 if (preg_match('/^.*?"[A-Z]+ (.*?) [^ ]*?" .* ([0-9]+)$/',$line,$m)) {
  if ((int)$m[2] > 100000) {
   echo $m[1]."\r\n";
  }
 } 
}

fclose($fh);

?>
