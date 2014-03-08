<?php
include_once '../lib/db-settings.php';
include '../body/header.php';


$searchId = getParam('searchId');


if (isSave()) {

    $arrayUnit = array(
        'unit' => "UnitId", //table name
        "$searchId" => "$employeeId",
        'Name' => "unit"
    );

    updateTable($arrayUnit);
    echo "<script>location.replace('index.php')</script>";
    exit();
}


$unit = getAUnit($searchId);

require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="unit_new.php">Add New</a>
            </h3>
        </div>
        <div class="box-content">
            <?php echo resultBlock($errors, $successes); ?>
            <form method='post'>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr><td width="200">Unit</td><td><input type="text" name="unit" value="<?php echo $unit; ?>"></td></tr>
                    </thead>   
                </table> 
                <div class="form-actions">
                    <button type="submit" name="save" class="btn btn-primary">
                        <i class="icon-pencil icon-white"></i> Update Unit
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

<?php include('../body/footer.php'); ?>