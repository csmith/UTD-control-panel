#!/usr/bin/php -q
<?PHP

 chdir('/home/utd/public_html/mon');

 set_time_limit(0);

 require_once('lib/database.php');
 require_once('lib/common.php');

 mysql_query('UPDATE results SET result_last = 0');

 $sql = 'SELECT ss_silenced, servers.server_id, server_host, service_name, server_name, services.service_id, service_port FROM servserv NATURAL JOIN servers, services WHERE services.service_id = servserv.service_id';
 $res = mysql_query($sql) or print(mysql_error());
 while ($row = mysql_fetch_assoc($res)) {
  if (@fsockopen($row['server_host'], $row['service_port'], $a, $b, 10)) {
   $result = 'up';
   if ($row['ss_silenced'] == '1') {
    mysql_query('UPDATE servserv SET ss_silenced = 0 WHERE server_id = '.$row['server_id'].' AND service_id = '.$row['service_id']);
    botlog($row['service_name'].' [port '.$row['service_port'].'] is now accessible on '.$row['server_name'].'. The service has been unsilenced.'); 
   }
  } else {
   $result = 'down';
   if ($row['ss_silenced'] == '0') {
    botlog(chr(2).'WARNING'.chr(2).': '.$row['service_name'].' [port '.$row['service_port'].'] is not accessible on '.$row['server_name'].' ['.$row['server_host'].']. Silence: http://admin.utd-hosting.com/mon/?silence&serv='.$row['server_id'].'&svc='.$row['service_id']);
   }
  }
  mysql_query('INSERT INTO results (service_id, server_id, result_result, result_time) VALUES ('.$row['service_id'].', '.$row['server_id'].', \''.$result.'\', '.time().')'); 
 }

?>
