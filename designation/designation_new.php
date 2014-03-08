<?php
include_once '../lib/db-settings.php';

$id = getParam('id');

$arrayDesignation = array(
    'designation' => "DesignationId", //table name
    "$id" => "$employeeId",
    'Name' => "designation",
    'CompanyId'=>"comanyId"
    );



if (!empty($_POST)) {

    saveTable($arrayDesignation);
    echo "<script>location.replace('designation_new.php');</script>";

}

require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="index.php">Home</a> <span class="divider">/</span>
                <a href="designation_new.php">Add New</a>
            </h3>
        </div>
        <div class="box-content">
            <form method='POST'>
                <input type="hidden" name="comanyId" value="<?php echo $companyId; ?>"/>
                
                <table class="table table-striped table-bordered">
                        <tr>
                            <td width="150">Designation</td>
                            <td><input type="text" name="designation" required value="<?php echo $designation; ?>"></td>
                        </tr>
                </table>
                <div class="form-actions">
                    <button type="submit" name="save" class="btn btn-primary">
                      <i class="icon-pencil icon-white"></i> Save Designation
                    </button>
                    <a href="../employee/employee_new.php" class="btn btn-primary">Employee New</a>
                </div> 
            </form>    
        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>