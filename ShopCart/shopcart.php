<?php

// read/create shopcart (from session)
function get_shopcart() {
    // create shopcart if it doesnt exist
    if (!isset($_SESSION["shopcart"]))
    // empty shopcart
        $_SESSION["shopcart"] = array();

    return $_SESSION["shopcart"];
}

// save shopcart (to session)
function save_shopcart($shopcart) {
    $_SESSION["shopcart"] = $shopcart;
}

// clear shopcart items
function clear_shopcart() {
    // replace with empty array
    $_SESSION["shopcart"] = array();
}

// create item array
function create_item($item_code, $description, $quantity, $amount, $total) {
    $item = array($item_code, $description, $quantity, $amount, $total);
    return $item;
}

function find_item($shopcart, $index) {
    // check if item exists
    if (isset($shopcart[$index]))
        return true;

    return false;
}

// add item array to stack
function add_item($shopcart, $item) {
    array_push($shopcart, $item);
    return $shopcart;
}

// remove item from stack (by reference)
function delete_item(&$shopcart, $index) {
    // check if item exists
    if (find_item($shopcart, $index)) {
        // remove
        unset($shopcart[$index]);

        // recount index
        if (count($shopcart) > 0)
            array_unshift($shopcart, array_shift($shopcart));

        return true;
    }

    return false;
}

// update item in stack (by reference)
function update_item(&$shopcart, $index, $item_code, $description, $quantity, $remark) {
    // check if it exists
    if (find_item($shopcart, $index)) {
        // update values
        $shopcart[$index][1] = $item_code;
        $shopcart[$index][2] = $description;
        $shopcart[$index][3] = $quantity;
        $shopcart[$index][4] = $remark;
        return true;
    }

    return false;
}

?>