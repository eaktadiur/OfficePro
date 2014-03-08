<?php
include_once '../lib/db-settings.php';

$searchId = getParam('searchId');

$gridDataObj = getProductDetails($searchId); //Fetch information for all employee's

/* functions are temporarywritten here...
 */

function getProductDetails($searchId) {
    //$res = $productList == '' ? '' : " AND cp.ProductId NOT IN ($productList)";
    $sqlEmployeeDetails = "SELECT ProductId, Code, Name FROM product WHERE ProductId='$searchId'";
    $stmtEmp = find($sqlEmployeeDetails);

    return $stmtEmp;
}

require_once("../body/header.php");
?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="index.php">Home</a> <span class="divider">/</span>
                <a href="#">Product Details</a>
            </h3>
        </div>
        <div class="box-content">
            <?php //echo resultBlock($errors, $successes);  ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post'>
                <table class="table table-striped table-bordered">
                    <tr>
                        <td width="100">Item Code</td>
                        <td><?php echo stripcslashes($gridDataObj->Code); ?></td>
                    </tr>
                    <tr>
                        <td>Item Name</td>
                        <td><?php echo stripcslashes($gridDataObj->Name); ?></td>
                    </tr>
                </table>    
                <div class="form-actions">
                    <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon-white icon-arrow-left"></i> 
                        Go Back
                    </button>
                </div>    
            </form>    
        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>