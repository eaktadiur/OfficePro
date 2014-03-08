<?php
// open session
require_once '../lib/db-settings.php';
include '../body/header.php';

if (isset($_GET["index"]))
    $index = $_GET["index"];
else {
    header("Location: error.php?error_id=3");
    exit();
}

// open shopcart library
require("shopcart.php");

// read shopcart
$shopcart = get_shopcart();

// find item
$result = find_item($shopcart, $index);

// not found
if (!$result)
// force redirect (cant use "header" since we already have session header)
    die("<script>location.href='error.php?error_id=3'</script>");

// transfer to variables (easier for design, but not necessary)
$item_code = $shopcart[$index][1];
$description = $shopcart[$index][2];
$quantity = $shopcart[$index][3];
$remark = $shopcart[$index][4];
// no need for total (compute it on commit)
?>
<p><a href="index.php">Back to Main</a> </p>
<form name="shopcart" action="commitupdate.php" method="post">
    <input type="hidden" name="index" value="<?php echo $index; ?>">
    <table class="productGrid">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Item Code</th>
                <th>Item Description</th>
                <th>Quantity</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td valign="top">1.</td>
                <td valign="top"><?php echo $item_code; ?>
                    <input name="item_code" type="hidden" id="item_code" value="<?php echo $item_code; ?>">
                </td>
                <td valign="top"><?php echo $description; ?>
                    <input name="description" type="hidden" id="description" value="<?php echo $description; ?>">
                </td>
                <td valign="top"><input name="quantity" type="text" class="input" id="quantity" value="<?php echo $quantity; ?>" size="5"></td>
                <td width="300" valign="top"><textarea name="remark"><?php echo $remark; ?></textarea></td>
            </tr>
        </tbody>
    </table>
    <input type="submit" class="btn btn-danger" name="Submit" value="Update">

</form>

<table class="productGrid">
    <tr>
        <td colspan="4">Update Item </td>
    </tr>
    <tr>
        <td width="94">
            <?php echo $item_code; ?>
            <input name="item_code" type="hidden" id="item_code" value="<?php echo $item_code; ?>"></td>
        <td width="138"><?php echo $description; ?>
            <input name="description" type="hidden" id="description" value="<?php echo $description; ?>"></td>
        <td width="154">Quantity
            <input name="quantity" type="text" id="quantity" value="<?php echo $quantity; ?>" size="10"></td>
        <td width="185">Amount
            <input name="amount" type="hidden" id="amount" value=""></td>
    </tr>
    <tr>
        <td colspan="4"></td>
    </tr>
</table>
<?php include '../body/footer.php'; ?>