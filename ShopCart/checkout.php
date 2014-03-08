<?php
require_once '../lib/db-settings.php';
include '../body/header.php';

// open shopcart library
require("shopcart.php");

// read shopcart
$shopcart = get_shopcart();

// check if empty
if (count($shopcart) <= 0)
// force redirect (cant use "header" since we already have session header)
    die("<script>location.href='error.php?error_id=4'</script>");

// build details (can be sent to mail)
$info = "[ShopCart Details]\n";
$info .= "Date/Time: " . date("F j, Y, g:i a") . "\n";
$info .= "Total item(s): " . count($shopcart) . "\n\n";

$numbering = 1;
$sum = 0.0;
foreach ($shopcart as $item) {
    $info .= "Item No.: " . $numbering . "\n";
    $info .= "Item Code: " . $item[0] . "\n";
    $info .= "Description: " . $item[1] . "\n";
    $info .= "Quantity: " . $item[2] . "\n";
    $info .= "Amount: " . number_format($item[3], 2) . "\n";
    $info .= "Total: " . number_format($item[4], 2) . "\n\n";
    $sum += $item[4];
    $numbering++;
}
$info .= "Sum Total: " . number_format($sum, 2);

// clear shopcart
//clear_shopcart();
?>
<html>
    <body>
        <p><a href="index.php">Back to Main</a> </p>
        <p>ShopCart Checked Out!</p>
        <p><?php echo str_replace("\n", "<br/>", $info); ?></p>
    </body>
</html>