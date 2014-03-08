<?php

//Database Information
$db_host = "localhost"; //Host address (most likely localhost)
$db_name = "enroute"; //Name of Database
$db_user = "root"; //Name of database user
$db_pass = ""; //Password for database user

GLOBAL $errors;
GLOBAL $successes;

$errors = array();
$successes = array();

/* Create a new mysqli object with database connection parameters */
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
GLOBAL $mysqli;

if (mysqli_connect_errno()) {
    echo "Connection Failed: " . mysqli_connect_errno();
    exit();
}

//error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$encrypKey = "schoolify"; // change this

require_once("funcs.php");
include_once 'standard_include.php';
include 'functionList.php';

authenticate($userName);
?>