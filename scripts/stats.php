#!/usr/local/php-stable/bin/php -q
<?PHP

 mysql_connect('', '', '');
 mysql_select_db('');

 $sql = 'SELECT site_id, site_name FROM sites';
 $res = mysql_query($sql);
 while ($row = mysql_fetch_array($res)) {
  $id = str_pad($row[0],3,'0',STR_PAD_LEFT);
  if (!is_dir('/home/utd/stats/'.$id)) {
   mkdir('/home/utd/stats/'.$id);
  }
  if (!file_exists('/usr/local/apache/logs/'.$id.'-access_log')) {
   continue;
  }
  $row[1] = addslashes($row[1]);
  system('/usr/local/bin/webalizer -o /home/utd/stats/'.$id.'/ -n \''.$row[1].'\' -t \''.$row[1].'\' -N 5 -D /home/utd/dnscache /usr/local/apache/logs/'.$id.'-access_log');
 }


?>
