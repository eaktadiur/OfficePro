<?php

require_once("./db-settings.php");
//if (!securePage($_SERVER['PHP_SELF'])){die();}
require 'php-excel.class.php';


/* * ************
  This PHP script Extracts MySQL table and downloads into an Excel Spreadsheet.
  Script by Jeff Johns, for a full explanation and tutorial on this, see: http://www.phpfreaks.com/tutorials/114/0.php
 * *************
  CONFIGURATION:

  YOUR DATABASE HOST = (ex. localhost)
  USERNAME = username used to connect to host
  PASSWORD = password used to connect to host
  DB_NAME = your database name
  TABLE_NAME = table in the database used for extraction
 * *************
  To extract specific fields and not the whole table, simply replace
  the * in the $select variable with the fields you want
 * ************ */
/* define(db_host, "YOUR DATABASE HOST");
  define(db_user, "USERNAME");
  define(db_pass, "PASSWORD");
  define(db_link, mysql_connect(db_host,db_user,db_pass));
  define(db_name, "DB_NAME");
  mysql_select_db(db_name);
  /*************
  Build query, call it, and find the number of fields
  /************ */

if ($_REQUEST['ex'] == 'leads') {
    $doc = exportCompany($companyId);
    //echo "<pre>";
    //print_r($doc);
    //die();
} else if ($_REQUEST['ex'] == 'franchisee')
    $doc = exportFranchisee();
$today = date("d-m-Y");

// generate excel file
$xls = new Excel_XML('UTF-8', false, 'My Test Sheet');
$xls->addArray($doc);
$xls->generateXML("event_training_" . $today);
?>


