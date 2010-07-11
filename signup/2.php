<?PHP

 if ($_SESSION['type'] == 'newuser') {
  require_once('2new.php');
 } else {
  require_once('2old.php');
 }

?>
