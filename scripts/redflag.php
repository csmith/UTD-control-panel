#!/usr/bin/php -q
<?PHP

 chdir('/home/utd/control');
 require_once('lib/common.php');
 require_once('lib/database.php');
 chdir('/home/utd/scripts');

function sendToHost($host,$method,$path,$data,$useragent=0)
{
 // Supply a default method of GET if the one passed was empty
 if (empty($method))
  $method = 'GET';
 $method = strtoupper($method);
 $fp = fsockopen($host,80);
 if ($method == 'GET')
  $path .= '?' . $data;
 fputs($fp, "$method $path HTTP/1.1\r\n");
 fputs($fp, "Host: $host\r\n");
 fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
 if ($method == 'POST')
  fputs($fp, "Content-length: " . strlen($data) . "\r\n");
 if ($useragent)
  fputs($fp, "User-Agent: MSIE\r\n");
 fputs($fp, "Connection: close\r\n\r\n");
 if ($method == 'POST')
  fputs($fp, $data);

 while (!feof($fp))
  $buf .= fgets($fp,128);
 fclose($fp);
 return $buf;
}

 $sql = 'SELECT signup_id, signup_data FROM signups WHERE signup_checked = 0';
 $res = mysql_query($sql) or print(mysql_error());
 while ($row = mysql_fetch_array($res)) {
  $data = unserialize($row['signup_data']);

  $query = 'appid=MD87scripts&query='.urlencode($data['data']['phone']);
  $query .= '&type=phrase&adult_ok=1&similar_ok=1&output=php';
  $re = sendToHost('api.search.yahoo.com', 'get', '/WebSearchService/V1/webSearch',$query); 

  if (preg_match('/"totalResultsAvailable";i:([0-9]+);/',$re, $m)) {
   if ((int)$m[1] > 0) {
    logger::log('Red flagged account '.$data['data']['user'],logger::important);
    $sql = 'SELECT user_id FROM users WHERE user_name = \'';
    $sql .= mysql_real_escape_string($data['data']['user']).'\'';
    $re = mysql_query($sql);
    $ro = mysql_fetch_array($re);
    $sql = 'INSERT INTO actions (user_id, action_type) VALUES ('.$ro[0].', \'';
    $sql .= 'lock\')';
    mysql_query($sql);
   } 
  }
  mysql_query('UPDATE signups SET signup_checked=1 WHERE signup_id = '.$row[0]);
 }

?>
