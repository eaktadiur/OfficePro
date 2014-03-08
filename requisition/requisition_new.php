<?php
include_once '../lib/db-settings.php';
require("../ShopCart/shopcart.php");
$shopcart = get_shopcart();

if (isSave()) {
    $remark = getParam('remark');

    $requisitionId = findValue("SELECT MAX(IFNULL(RequisitionId,0)+1) FROM requisition");
    $orderNo = OrderNo($requisitionId);

    file_upload_save('../documents/requisition/', "$requisitionId", 'requisition');



    $sqlInsert = "INSERT INTO requisition(RequisitionNo, RequisitionDate, PresentLocationId, Remark, StatusId, IsActive, CompanyId, CreatedBy, CreatedDate) "
            . "VALUES('$orderNo', NOW(), '$nextApprovalId', '$remark', 1, 1, '$companyId', '$employeeId', NOW());";
    query($sqlInsert);
    $lastId = insertLastId();


    if (count($shopcart) > 0) {
        $index = 0;
        foreach ($shopcart as $item) {

            $sqlDetails = "INSERT INTO requisition_details(requisitionId, ProductId, Qty, Remark) "
                    . "VALUES('$requisitionId', '$item[0]', '$item[3]', '$item[4]');";
            query($sqlDetails);

            $index++;
        }
    }
    clear_shopcart();

    echo "<script>location.replace('requisition_confirm.php?mode=cinfirm&searchId=" . encodeSearchId($requisitionId) . "');</script>";
}


include '../body/header.php';

$var = getEmployeeById($employeeId);
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="index.php">Requisition List</a>
            </h3>
        </div>
        <div class="box-content">
            <?php include './requisition_header.php'; ?>
            <a href="product_search.php" class="btn btn-primary"> <i class="icon-white icon-plus-sign"></i> Add Product</a>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th width="30">S/N</th>
                                <th>Item Code </th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Remark</th>
                                <!--<th>Total</th>-->
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($shopcart) > 0) {
                                $index = 0;
                                foreach ($shopcart as $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo $item[1]; ?></td>
                                        <td><?php echo $item[2]; ?></td>
                                        <td><?php echo $item[3]; ?></td>
                                        <td><?php echo $item[4]; ?></td>
                                        <!--<td><?php echo $item[5]; ?></td>-->
                                        <td><a href="../ShopCart/updatecart.php?index=<?php echo $index; ?>">Edit</a> | <a href="../ShopCart/deletefromcart.php?index=<?php echo $index; ?>">Delete</a></td>
                                    </tr>
                                    <?php
                                    $index++;
                                } // foreach($shopcart as $item)
                            } // if (count($shopcart) > 0)
                            else {
                                ?>
                                <tr>
                                    <td colspan="6" align="center"><b>Product is Empty</b></td>
                                </tr>
                                <?php
                            } // // if (count($shopcart) > 0) ... else
                            ?>
                            <tr>
                                <td valign="top">Remark:</td>
                                <td colspan="5"><textarea name="remark" style="width: 97%;" required></textarea></td>
                            </tr>  
                        </tbody>
                    </table>
                    <?php file_upload_edit($searchId, 'requisition', TRUE); ?>
                </div>
                <div class="form-actions">
                    <button type="submit" name="save" class="btn btn-primary">
                        <i class="icon icon-white icon-save"></i> Submit
                    </button>
                    <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon-white icon-arrow-left"></i> 
                        Go Back
                    </button>
                </div>    

            </form>
        </div>
    </div><!--/span-->

</div>	


<?php include '../body/footer.php'; ?>