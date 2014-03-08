<?php
require_once '../lib/db-settings.php';



$searchId = getParam('searchId');


if (isSave()) {
    $checkedProduct = getParam('chk');
    $PricedProduct = getParam('price');
    foreach ($checkedProduct AS $keys => $ProductID) {
        foreach ($PricedProduct AS $key => $priceValue) {
            if ($keys == $key) {
                $SQLInsert = "INSERT INTO company_product (CompanyId, ProductId, Price, CreatedBy, CreatedDate) "
                        . "VALUES('$searchId', '$keys', '$priceValue', '$UserName', '$CreatedDate')";
                query($SQLInsert);
            }
        }
    }
    echo "<script>location.replace('product_company_view.php?searchId=" . encodeSearchId($searchId) . "');</script>";
}

$product = getCompanyProduct($searchId);
//$product = getCompanyProductList($companyId);
while ($row = $product->fetch_object()) {
    $productList .= $row->ProductId . ',';
}
$product->close();
$productList = substr($productList, 0, -1);

$productResult = getAllProducts($productList);
//$productResult = getProductByCompanyId($companyId, $productList);

include '../body/header.php';
?>
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Product List</a>
            </h3>
        </div>
        <div class="box-content">
            <form name="shopcart" method="post">
                <!--<input type="hidden" name="searchId" value="<?php echo $searchId; ?>"/>-->

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th width="30">S/N</th>
                                <th width="120">Item Code</th>
                                <th>Item Name</th>
                                <th  width="30">Price</th>
                                <th  width="30">Chk</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $productResult->fetch_object()) {
                                ?>
                                <tr>
                                    <td valign="top"><?php echo ++$sl; ?>.</td>
                                    <td valign="top"><?php echo $row->Code; ?><input name="item_code[<?php echo $row->ProductId; ?>]" type="hidden" id="item_code" value="<?php echo $row->Code; ?>"></td>
                                    <td valign="top"><?php echo $row->Name; ?><input name="description[<?php echo $row->ProductId; ?>]" type="hidden" id="description" value="<?php echo $row->Name; ?>"></td>
                                    <td valign="top"><input name="price[<?php echo $row->ProductId; ?>]" type="text" class="input" id="quantity" value="0" size="5"></td>
                                    <td valign="top" align="center"><input type="checkbox" name="chk[<?php echo $row->ProductId; ?>]" value="<?php echo $row->ProductId; ?>"/></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <button type="submit" name="save" class="btn btn-primary">
                        <i class="icon-check icon-white"></i> Assign product
                    </button>
                    <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon-white icon-arrow-left"></i>  
                        Go Back
                    </button>
                    <a class="btn btn-primary" href="product_company_view.php?searchId=<?php echo $searchId; ?>">Company List</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include '../body/footer.php'; ?>