<?php
include_once '../lib/db-settings.php';

$gridData = getProduct(); //Fetch information for all employee's

function getProduct() {
    //$res = $productList == '' ? '' : " AND cp.ProductId NOT IN ($productList)";
    $sqlPrdct = "SELECT ProductId, Code, Name FROM product;";
    $stmtEmp = query($sqlPrdct);

    return $stmtEmp;
}

require_once("../body/header.php");
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
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th width="30">SL</th>
                        <th>Item Code <i class="icon-filter"></i></th>
                        <th>Item Name <i class="icon-filter"></i></th>
                        <th width="90">Actions</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    while ($row = $gridData->fetch_object()) {
                        ?>
                        <tr> 
                            <td><?php echo ++$sl; ?></td>
                            <td><?php echo stripcslashes($row->Code); ?></td>
                            <td><?php echo stripcslashes($row->Name); ?></td>
                            <td class='center'>
                                <?php
                                viewIcon("product_details.php?searchId=" . encodeSearchId($row->ProductId));
                                editIcon("product_edit.php?searchId=" . encodeSearchId($row->ProductId));
                                deleteIcon("#");
                                ?>   
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="form-actions">
                <a href="product_new.php" class="btn btn-primary">
                    <i class="icon-white icon-plus-sign"></i>
                    Add Product
                </a>
            </div>  
        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>