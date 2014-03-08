<?php
include_once '../lib/db-settings.php';


$employeeList = getEmployeeByCompanyId($companyId); //Fetch information for all employee's

require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Employee List</a>
            </h3>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th width="30">S/N</th>
                        <th>Employee Name</th>
                        <th>Designation</th>
                        <th>Next Approval Person</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th width="90">Actions</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    while ($row = $employeeList->fetch_object()) {
                        ?>
                        <tr> 
                            <td><?php echo ++$sl; ?></td>
                            <td><?php echo stripcslashes($row->CardNo . '->' . $row->FirstName . ' ' . $row->LastName); ?></td>
                            <td><?php echo stripcslashes($row->DName); ?></td>
                            <td><?php echo stripcslashes($row->nextPers); ?></td>
                            <td><?php echo stripcslashes($row->RName); ?></td>
                            <td><?php echo stripcslashes($row->email); ?></td>
                            <td class='center'>
                                <?php
                                viewIcon("employee_details.php?searchId=" . encodeSearchId($row->employeeId));
                                editIcon("employee_edit.php?searchId=" . encodeSearchId($row->employeeId));
                                deleteIcon("#");
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>  
            <div class="form-actions">
                <a href="employee_new.php" class="btn btn-primary">
                    <i class="icon-white icon-plus-sign"></i> Add Employee
                </a>
                <button type="button" class="btn btn-primary" onclick="goBack();">
                    <i class="icon-white icon-arrow-left"></i> 
                    Go Back
                </button>
            </div> 


        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>