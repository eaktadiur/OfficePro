<?php
include_once '../../DBManager/Session.php';
Session::init();

if ($_GET) {
    $log = $_GET['id'];
    if ($log == 1) {
        Session::destroy();
        echo "<script> window.location='index.php'</script>";
    }
}
?>

