<?php
include_once '../lib/db-settings.php';
include '../body/header.php';
include 'lib.php';


$searchId = getParam('searchId');


$gridDataObj = getEmployeeDetails($searchId); //Fetch information for all employee's

require_once("../body/header.php");
?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="index.php">Home</a> <span class="divider">/</span>
                <a href="#">Employee Details</a>
            </h3>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr><td width="200">Card No</td><td><?php echo stripcslashes($gridDataObj->CardNo); ?></td></tr>
                    <tr><td>First Name</td><td><?php echo stripcslashes($gridDataObj->FirstName); ?></td></tr>
                    <tr><td>Middle Name</td><td><?php echo stripcslashes($gridDataObj->MiddleName); ?></td></tr>
                    <tr><td>Last Name</td><td><?php echo stripcslashes($gridDataObj->LastName); ?></td></tr>
                    <tr><td>Sur Name</td><td><?php echo stripcslashes($gridDataObj->SurName); ?></td></tr>
                    <tr><td>Present Address</td><td><?php echo stripcslashes($gridDataObj->PresentAddress); ?></td></tr>
                    <tr><td>Company Name</td><td><?php echo stripcslashes($gridDataObj->Name); ?></td></tr>
                    <tr><td>Designation</td><td><?php echo stripcslashes($gridDataObj->DName); ?></td></tr>
                    <tr><td>Next Approval Person</td><td><?php echo stripcslashes($gridDataObj->nextPers); ?></td></tr>
                    <tr><td>Email</td><td><?php echo stripcslashes($gridDataObj->email); ?></td></tr>
                    <tr><td>Cell</td><td><?php echo stripcslashes($gridDataObj->Cell); ?></td></tr>
                </thead>   
            </table>  
            <div class="form-actions">
                <button type="button" class="btn btn-primary" onclick="goBack();">
                    <i class="icon-white icon-arrow-left"></i> 
                    Go Back
                </button>
                <a href="index.php" class="btn btn-primary">Employee List</a>
            </div> 
        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>