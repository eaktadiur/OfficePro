<?php
include_once '../lib/db-settings.php';

$searchId = getParam('searchId');

if (isSave()) {
    $array = array(
        'employee' => 'EmployeeId',
        "$searchId" => "$employeeId",
        'FirstName' => 'firstName',
        'LastName' => 'LastName',
        'MiddleName' => 'MiddleName',
        'SurName' => 'SurName',
        'DesignationId' => 'designationID',
        'PresentAddress' => 'PresentAddress',
        'RoleID' => 'Role',
        'Cell' => 'cell',
        'Email' => 'email',
        'NextApprovalId' => 'approvePersID');

    updateTable($array);
    echo "<script>location.replace('index.php')</script>";
    exit();
}

$gridDataObj = getEmployeeDetails($searchId); //Fetch information for all employee's
$empList = getEmployeeByCompanyIdComb($companyId);
$designationList = getDesignationByCompanyIdComb($companyId);
$roleList = getRoleCompanyIdComb();


require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="index.php"><i class="icon-home"></i>Home</a> 
                <span class="divider">/</span>
                <a href="#">Employee Add</a>
            </h3>
        </div>
        <div class="box-content">
            <form name='leads' action="" method='post'>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td width="200">Card No</td>
                            <td><?php echo stripcslashes($gridDataObj->CardNo); ?></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><input type="text" name="firstName" required value="<?php echo stripcslashes($gridDataObj->FirstName); ?>"></td>
                        </tr>
                        <tr>
                            <td>Middle Name</td>
                            <td><input type="text" name="MiddleName" value="<?php echo stripcslashes($gridDataObj->MiddleName); ?>"></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><input type="text" name="LastName" required value="<?php echo stripcslashes($gridDataObj->LastName); ?>"></td>
                        </tr>
                        <tr>
                            <td>Sur Name</td>
                            <td><input type="text" name="SurName" value="<?php echo stripcslashes($gridDataObj->SurName); ?>"></td>
                        </tr>
                        <tr>
                            <td>Present Address</td>
                            <td><textarea name="PresentAddress"><?php echo stripcslashes($gridDataObj->PresentAddress); ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td><?php comboBox('designationID', $designationList, $gridDataObj->DesignationId, TRUE, '', 'required'); ?></td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td><?php comboBox('Role', $roleList, $gridDataObj->RoleId, TRUE, '', 'required'); ?></td>
                        </tr>
                        <tr>
                            <td>Next Approval Person</td>
                            <td><?php comboBox('approvePersID', $empList, $gridDataObj->NextApprovalId, TRUE); ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="email" required value="<?php echo ($gridDataObj->email); ?>"></td>
                        </tr>
                        <tr>
                            <td>Cell</td>
                            <td><input type="text" name="cell" value="<?php echo ($gridDataObj->Cell); ?>"></td>
                        </tr>
                    </thead>   
                </table>
                <div class="form-actions">
                    <button type="submit" name="save" class="btn btn-primary">
                        <i class="icon-pencil icon-white"></i>  Update Employee
                    </button>
                    <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon-white icon-arrow-left"></i></i> 
                        Go Back
                    </button>
                    <a href="index.php" class="btn btn-primary">
                        <i class="icon-user icon-white"></i> Employee List
                    </a>
                </div>  
            </form>    
        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>