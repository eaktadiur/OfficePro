<?php
include_once '../lib/db-settings.php';

if (!empty($_POST)) {
    $array = array(
        'product' => "ProductId", //table name
        "$id" => "$userId",
        'Code' => "Code",
        'Name' => "Name");
    saveTable($array);
    echo "<script>location.replace('index.php')</script>";
}

require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="index.php">Home</a> <span class="divider">/</span>
                <a href="#">New Product</a>
            </h3>
        </div>

        <div class="box-content">
            <?php echo resultBlock($errors, $successes); ?>
            <form method='post'>
                <table class="table table-striped table-bordered">
                    <tr>
                        <td width="100">Product Code</td>
                        <td><input type="text" name="Code"></td>
                    </tr>
                    <tr>
                        <td>Product Name</td>
                        <td><input type="text" name="Name"></td>
                    </tr>
                </table>   
                <div class="form-actions">
                    <button type="submit" name="save" class="btn btn-primary">
                        <i class="icon-ok icon-white"></i> Save Product
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