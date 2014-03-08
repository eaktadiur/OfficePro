<?php
include_once '../lib/db-settings.php';
include '../body/header.php';

$searchId = getParam('searchId');
$Code = getParam('Code');
$Name = getParam('Name');

if (!empty($_POST)) {
    updateProduct($searchId, $Code, $Name);
    echo "<script>location.replace('index.php');</script>";
}

$gridDataObj = getProductDetails($searchId); //Fetch information for all employee's

/* functions are temporarywritten here...
 */

function getProductDetails($prID) {
    $sqlEmployeeDetails = "SELECT ProductId, Code, Name FROM product WHERE ProductId='$prID'";
    $stmtEmp = find($sqlEmployeeDetails);

    return $stmtEmp;
}

function updateProduct($searchId, $Code, $Name) {
    $updateSQL = "Update product SET Code='$Code' , Name='$Name' WHERE ProductId='$searchId'";
    query($updateSQL);
}

require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Product Edit</a>
            </h3>
        </div>

        <div class="box-content">
            <form method='post'>
                <table class="table table-striped table-bordered">
                    <tr>
                        <td width="200">Item Code</td>
                        <td><input type="text" name="Code" value="<?php echo stripcslashes($gridDataObj->Code); ?>"></td>
                    </tr>
                    <tr>
                        <td>Item Name</td>
                        <td><input type="text" name="Name" value="<?php echo stripcslashes($gridDataObj->Name); ?>"></td>
                    </tr>
                </table> 
                <div class="form-actions">
                    <button type="submit" name="update" class="btn btn-primary">
                        <i class="icon-pencil icon-white"></i> Update Product
                    </button>
                    <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon-white icon-arrow-left"></i>  
                        Go Back
                    </button>
                </div>  
            </form>    
        </div>

    </div>

</div>	

<?php include('../body/footer.php'); ?>