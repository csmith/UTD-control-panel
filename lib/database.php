<?PHP

 if (defined('LIB_DB') && !isset($_redodb)) { return; }

 require_once('lib/profiler.php');
 require_once('lib/log.php');

 mysql_connect('localhost', '', '');
 mysql_select_db('');

 if (!function_exists('mf')) {
  function mf ($file, $line, $sql) {
   logger::log($file.'<'.$line.'>: MySQL query failed: '.mysql_error().' [SQL: '.$sql.']', logger::important);
  }
 }

 define('LIB_DB', true);

?>
