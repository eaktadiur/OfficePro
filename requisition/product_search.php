<?php
require_once '../lib/db-settings.php';
include '../body/header.php';



// open shopcart library
require("../ShopCart/shopcart.php");
$shopcart = get_shopcart();

$productList = '';
foreach ($shopcart as $value) {
    $productList .= $value[0] . ',';
}
$productList = substr($productList, 0, -1);

$productList = getProductByCompanyId($companyId, $productList);
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Requisition Product Search</a>
            </h3>
        </div>
        <div class="box-content">
            <form name="shopcart" action="../ShopCart/addtocart.php" method="post">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed">
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
                                        <input name="item_code[<?php echo $row->ProductId; ?>]" type="hidden" id="item_code" value="<?php echo $row->Code; ?>">
                                    </td>
                                    <td valign="top"><?php echo $row->Name; ?>
                                        <input name="description[<?php echo $row->ProductId; ?>]" type="hidden" id="description" value="<?php echo $row->Name; ?>">
                                    </td>
                                    <td valign="top"><input name="quantity[<?php echo $row->ProductId; ?>]" type="text" class="input" id="quantity" value="1" size="5"><?php echo $row->UnitName; ?></td>
                                    <td width="300" valign="top"><textarea name="remark[<?php echo $row->ProductId; ?>]"></textarea></td>
                                    <td valign="top"><input type="checkbox" name="chk[<?php echo $row->ProductId; ?>]" value="<?php echo $row->ProductId; ?>"/></td>
                                </tr>

                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <input type="submit" class="btn btn-primary" name="Submit" value="Add to Requisition"/>
                <a href="requisition_new.php" class="btn btn-primary"><i class="icon-white icon-arrow-left"></i> 
                        Go Back</a>

            </form>
        </div>
    </div><!--/span-->

</div>	
<?php include '../body/footer.php'; ?>