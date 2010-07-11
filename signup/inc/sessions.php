<?PHP

session_name('UTDsignup');
session_start();

if (!isset($_SESSION['stage'])) {
 $_SESSION['stage'] = 1;
}

if (isset($_GET['ref'])) {
 $_SESSION['ref'] = $_GET['ref'];
}

?>
