<?php

if (count($_POST) > 0) {
    $index = $_POST["index"];
    $item_code = $_POST["item_code"];
    $description = $_POST["description"];
    $quantity = $_POST["quantity"];
    $remark = $_POST["remark"];

 
} else {
    header("Location: error.php?error_id=1");
    exit();
}

// open session
require("session.php");

// open shopcart library
require("shopcart.php");

// read shopcart
$shopcart = get_shopcart();


// update item
$result = update_item($shopcart, $index, $item_code, $description, $quantity, $remark);

// update error - returned false
if (!$result)
// force redirect (cant use "header" since we already have session header)
    die("<script>location.href='error.php?error_id=3'</script>");
else
// save shopcart
    save_shopcart($shopcart);
echo "<script>location.href='../requisition/requisition_new.php'</script>";
?>
