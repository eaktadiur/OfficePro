<?php
include_once '../../DBManager/AppConfig.php';
include_once '../../DBManager/paths.php';
include_once '../../DBManager/Session.php';
Session::init();


if ($_POST) {
    include '../../MyProject_DAL/Login_DAL.php';
    $login = new Login_DAL();
    $login->run($_POST['login'], $_POST['password'], $_POST['company']);
}
?>
