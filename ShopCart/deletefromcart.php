<?php
if (isset($_GET["index"]))
    $index = $_GET["index"];
else {
    header("Location: error.php?error_id=3");
    exit();
}

// open session
require("session.php");

// open shopcart library
require("shopcart.php");

// read shopcart
$shopcart = get_shopcart();

// delete item
$result = delete_item($shopcart, $index);

// deletion error - returned false
if (!$result)
// force redirect (cant use "header" since we already have session header)
    die("<script>location.href='error.php?error_id=3'</script>");
else
// save shopcart
    save_shopcart($shopcart);
header("Location: ../requisition/requisition_new.php");
exit();
?>
