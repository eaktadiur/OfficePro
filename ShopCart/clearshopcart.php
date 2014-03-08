<?php
// open session
require("session.php");

// open shopcart library
require("shopcart.php");

// clear
clear_shopcart();
header("Location: ../requisition/requisition_new.php");
exit();
?>
