<?php

require_once '../lib/db-settings.php';
// check post data first
if (count($_POST) > 0) {
    $item_code = $_POST["item_code"];
    $description = $_POST["description"];
    $quantity = $_POST["quantity"];
    $remark = $_POST["remark"];
    $chk = $_POST['chk'];
} else {
    header("Location: error.php?error_id=1");
    exit();
}



// open shopcart library
require("shopcart.php");
$shopcart = get_shopcart();

$sl = 0;
foreach ($chk as $key => $value) {
    if ($shopcart[$sl][0] != $key) {

        // check quantity
        if (is_numeric($quantity[$key])) {
            // compute sub-total
            $total = $quantity[$key] * $amount[$key];
        } else {
            //header("Location: error.php?error_id=2");
            exit();
        }

        // create item
        $item = create_item($key,$item_code[$key], $description[$key], $quantity[$key], $remark[$key], $total);

// read shopcart
        $shopcart = get_shopcart();

// add to shopcart
        $shopcart = add_item($shopcart, $item);

// save shopcart
        save_shopcart($shopcart);
        $sl++;
    }
}

header("Location: ../requisition/requisition_new.php");
?>
