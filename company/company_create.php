<?php
include_once '../lib/db-settings.php';

$searchId = getParam('searchId');

if (isSave()) {
    
    $Code = getParam('Code');
    $encPass = md5($Code);

    $array = array(
        'company' => "CompanyId", // Table & Primary Key
        "$searchId" => "$employeeId", // Table & Primary Key
        'Name' => "Name",
        'Code' => "Code",
        'Address1' => "Address1",
        'Address2' => "Address2",
        'ZipCode' => "ZipCode",
        'Phone' => "Phone",
        'Fax' => "Fax",
        'Email' => "Email",
        'IsActive' => "IsActive",
        'AgreementId'=>'agreement',
        'TotalBudget'=>'TotalBudget'
    );

    saveTable($array);
    $compId = insertLastId();

    file_upload_save('../documents/company/', "$compId", 'company');

    $emp = "INSERT INTO employee (CardNo, FirstName, LastName, MiddleName, SurName, DesignationId, PresentAddress, CompanyId, RoleID, Cell, Email, NextApprovalId, CreatedBy, CreatedDate) "
            . "VALUES('admin', 'admin', 'admin', '', '', '1', '', '$compId', '1', '', '', '', '3', NOW())";

    query($emp);

    $empId = insertLastId();
    $sql = "INSERT INTO user_table(UserName, DisplayName, `Password`, EmployeeId, IsActive, CreatedBy, CreatedDate) "
            . "VALUES('admin', 'Admin', '$encPass', '$empId', '1', '$employeeId', NOW())";
    query($sql);

    echo "<script>location.replace('index.php')</script>";
    exit();
}

$agreeMentList = agreeMentList();
include '../body/header.php';
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.bootstrap-multiple').multiselect();
    });
</script>
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="index.php">New Company</a>
            </h3>
        </div>
        <div class="box-content">
            <form name="create_company" Action = '' method = 'POST' class="form" enctype="multipart/form-data">
                <table class="table table-striped table-bordered bootstrap-datatable">
                    <tr>
                        <td width="120">Company Name: </td>
                        <td><input type = 'text' name = 'Name' required size = '40' maxlength = '40'/></td>
                    </tr>
                    <tr>
                        <td width="120">Company Code: </td>
                        <td><input type = 'text' name = 'Code' required size = '40' maxlength = '40'/></td>
                    </tr>
                    <tr>
                        <td>Address Line 1:</td>
                        <td><textarea name = 'Address1' rows="3" cols="50"></textarea></td>
                    </tr>

                    <tr>
                        <td>Address Line 2:</td>
                        <td><textarea name="Address2" rows="3" cols="50"></textarea></td>
                    </tr>
                    <tr>
                        <td>Zip Code:</td>
                        <td><input type='text' name = 'ZipCode' size = '10' maxlength = '10'/></td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td><input type='text' name = 'Phone' size = '50' maxlength = '50'/></td>
                    </tr>
                    <tr>
                        <td>Fax:</td>
                        <td><input type='text' name = 'Fax' size = '37' maxlength = 40'/></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type='email' name = 'Email' required/></td>
                    </tr>
                    <tr>
                        <td>Total Budget :</td>
                        <td><input type='text' name='TotalBudget' class="number" value =""/></td>
                    </tr>
                    <tr>
                        <td>Type:</td>
                        <td><?php comboBox('agreement', $agreeMentList, $var->AgreementId, TRUE); ?></td>
                    </tr>

                    <tr>
                        <td>Is Active:</td>
                        <td><input type='checkbox' name = 'IsActive' value ="1"/></td>
                    </tr>
                </table>
                <?php file_upload_edit($searchId, 'company', TRUE); ?>
                <button type="submit" class="btn btn-primary" name="save" value="save">
                    <i class="icon icon-white icon-save"></i> Save
                </button>
                <button type="button" class="btn btn-primary" onclick="goBack();">
                    <i class="icon-white icon-arrow-left"></i>  
                    Go Back
                </button>
            </form>
        </div><!--/span-->

    </div>
</div>

<br/> <br/>
<?php include '../body/footer.php'; ?>