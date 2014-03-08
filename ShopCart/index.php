<?php
// open session
require_once '../lib/db-settings.php';
include '../body/header.php';



// open shopcart library
require("shopcart.php");
$shopcart = get_shopcart();

foreach ($shopcart as $value) {
    $productList .= $value[0] . ',';
}
$productList = substr($productList, 0, -1);
//echo "<pre>";
//print_r($shopcart);

$productList = getProductByCompanyId($productList);
?>

<style type="text/css">
    .input {
        width: 80px;
    }
</style>
<a href="../requisition/requisition_new.php" class="button">Show Shop Cart Details</a>
<form name="shopcart" action="addtocart.php" method="post">
    <table id="productGrid">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Item Code</th>
                <th>Item Description</th>
                <th>Quantity</th>
                <th>Remark</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $sl = 0;
            while ($row = $productList->fetch_object()) {
                ?>
                <tr>
                    <td valign="top"><?php echo ++$sl; ?>.</td>
                    <td valign="top"><?php echo $row->Code; ?>
                        <input name="item_code[<?php echo $row->ProductId; ?>]" type="hidden" id="item_code" value="<?php echo $row->ProductId; ?>">
                    </td>
                    <td valign="top"><?php echo $row->Name; ?>
                        <input name="description[<?php echo $row->ProductId; ?>]" type="hidden" id="description" value="<?php echo $row->Name; ?>">
                    </td>
                    <td valign="top"><input name="quantity[<?php echo $row->ProductId; ?>]" type="text" class="input" id="quantity" value="1" size="5"></td>
                    <td width="300" valign="top"><textarea name="remark[<?php echo $row->ProductId; ?>]"></textarea></td>
                    <td valign="top"><input type="checkbox" name="chk[<?php echo $row->ProductId; ?>]" value="<?php echo $row->ProductId; ?>"/></td>
                </tr>

                <?php
            }
            ?>

        </tbody>
    </table>
    <input type="submit" name="Submit" value="Add to Cart">

</form>
<?php include '../body/footer.php'; ?>