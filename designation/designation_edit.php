<?php
include_once '../lib/db-settings.php';
include '../body/header.php';
include 'lib_designation.php';
$id= getParam('id');

$CreatedBy = 1;
$userId=$CreatedBy;



$arrayDesignation = array(
        'designation' => "DesignationId", //table name
        "$id" => "$userId",
        'Name' => "designation");

if (!empty($_POST)) {
    updateTable($arrayDesignation);
}

//$gridDataObj = getDesignations(); 

$designation= getADesignation($id);

require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="requisition_new.php">Add New</a>
            </h3>
        </div>
        <div class="box-content">
            <?php echo resultBlock($errors, $successes); ?>
            <form method='post'>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr><td width="200">Designation</td><td><input type="text" name="designation" value="<?php echo $designation; ?>"></td></tr>
                    </thead>   
                </table> 
                 <div class="form-actions">
                    <button type="submit" name="update" class="btn btn-primary">
                      <i class="icon-pencil icon-white"></i> Update Designation
                    </button>
                </div>  
            </form>  
        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>