<?php
// open session
include_once '../lib/db-settings.php';



$empList = getEmployeeByCompanyIdComb($companyId);
$designationList = rs2array("SELECT DesignationId, Name FROM designation WHERE CompanyId='$companyId'");
$roleList = rs2array("SELECT RoleId, Name FROM Role");

if ($_POST) {

    $array = array(
        'employee' => 'EmployeeId',
        "$searchId" => "$employeeId",
        'CardNo' => "CardNo",
        'FirstName' => 'FirstName',
        'LastName' => 'LastName',
        'MiddleName' => 'MiddleName',
        'SurName' => 'SurName',
        'DesignationId' => 'DesignationId',
        'PresentAddress' => 'PresentAddress',
        'CompanyId' => 'comanyId',
        'RoleID' => 'Role',
        'Cell' => 'Cell',
        'Email' => 'Email',
        'NextApprovalId' => 'NextApprovalId');

    saveTable($array);

    $CardNo = getParam('CardNo');

    $empId = insertLastId();
    $encPass = md5($CardNo);
    $sql = "INSERT INTO user_table(UserName, DisplayName, `Password`, EmployeeId, UserLevelId, IsActive, CreatedBy, CreatedDate) "
            . "VALUES('$CardNo', '$CardNo', '$encPass', '$empId', '2', '1', '$employeeId', NOW())";
    query($sql);
    echo "<script>location.replace('index.php')</script>";
    exit();
}
include '../body/header.php';
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">New Employee</a>
            </h3>
        </div>
        <div class="box-content">
            <form method='POST' autocomplete="off">
                <input type="hidden" name="comanyId" value="<?php echo $companyId; ?>"/>

                <table class="table table-striped table-bordered">
                    <tr>
                        <td width="150">Card No</td>
                        <td><input type="text" name="CardNo" required></td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><input type="text" name="FirstName" required></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="LastName" required></td>
                    </tr>
                    <tr>
                        <td>Middle Name</td>
                        <td><input type="text" name="MiddleName"></td>
                    </tr>
                    <tr>
                        <td>Surname</td>
                        <td><input type="text" name="SurName"></td>
                    </tr>
                    <tr>
                        <td>Present Address</td>
                        <td><textarea name="PresentAddress"></textarea></td>
                    </tr>
                    <tr>
                        <td>Permanent Address</td>
                        <td><textarea name="PermanentAddress"></textarea></td>
                    </tr>         
                    <tr>
                        <td>Designation</td>
                        <td><?php comboBox('DesignationId', $designationList, $DesignationId, TRUE, '', 'required'); ?> <a href="../designation/designation_new.php">Add Designation</a></td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td><?php comboBox('Role', $roleList, $Role, TRUE, '', 'required'); ?></td>
                    </tr>
                    <tr>
                        <td>Next Approval Person</td>
                        <td><?php comboBox('NextApprovalId', $empList, $NextApprovalId, TRUE); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="Email"></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td><input type="text" name="Cell"></td>
                    </tr>
                </table>
                <div class="form-actions">
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="icon icon-white icon-save"></i> Save 
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

<?php include '../body/footer.php'; ?>