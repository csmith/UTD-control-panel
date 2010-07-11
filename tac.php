<?PHP

 define('NOTACREF', True);

 require_once('lib/account.php');
 require_once('lib/common.php');

 if (isset($_POST['version']) && isset($_POST['agree'])) {
  if ($_POST['agree'] == 'I AGREE') {
   $fh = fopen('/home/admin/common/tac.txt','r');
   $version = trim(fgets($fh));
   fclose($fh);
   if ((int)$_POST['version'] != (int)$version) {
    define('MESSAGE', 'Oops. The T&amp;C appears to have been updated again!');
   } else {
    $sql = 'UPDATE users SET user_tac = '.$version.' WHERE user_id = '.UID;
    mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
    l('Accepted Terms and Conditions version '.str_pad($version,4,'0',STR_PAD_LEFT));
    header('Location: '.CP_PATH);
   }
  } else {
   define('MESSAGE', 'You must type \'I AGREE\' if you accept the T&amp;C.');
  }
 }

 require_once('lib/dashboard.php');
 
 define('TITLE', 'Terms and Conditions');
 
 require_once('lib/header.php');
 
 require_once('pages/tac.php');
 
 require_once('lib/footer.php');


?>
