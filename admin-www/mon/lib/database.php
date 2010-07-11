<?PHP

 if (defined('LIB_DB') && !isset($_redodb)) { return; }

 mysql_connect('', '', '');
 mysql_select_db('');

 define('LIB_DB', true);

?>
