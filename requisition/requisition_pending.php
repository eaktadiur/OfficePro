<?php
include_once '../lib/db-settings.php';
$searchId = getParam('searchId');

$var = getRequisitionById("$searchId");

if (isSave()) {
    $Nextemployee = getParam('Nextemployee');

    $array = array(
        'approval_history' => "ModuleId", // Table & Primary Key
        "$searchId" => "$employeeId", // Table & Primary Key
        "ModuleId" => "searchId",
        'Module' => "Module",
        'DesignationId' => "DesignationId",
        'EmployeeId' => "EmployeeId",
        'Comment' => "approval_comment"
    );

    saveTable($array);
    if ($companyId == 1) {
        if ($var->StatusId == '7') {// customer veried
            //die('7');
            adminApproval($searchId);
        } elseif ($designationId == '18') {//Operation
            sendToCustomerVarification($searchId, '6');
        } else {
            //die('customer');
            //Send to Next combo selected employee
            nextApproval("$Nextemployee", "$searchId", "5");
        }
    } else {
        if ($roleId == 1) {
            //send to the enroute service officer
            branchAdminReview('1', $searchId, '4');
        } elseif ($var->CreatedBy == $var->PresentLocationId) { //present loacation and creator same
            branchAdminReview('1', $searchId, '7');
        } else {
            //Send to Next Line Manager
            nextApproval("$nextApprovalId", "$searchId", "3");
        }
    }
    echo "<script>location.replace('index.php')</script>";
    exit();
}


$requisitionDetailsList = getRequisitionDetailsById("$searchId");
$operationTeamList = getEmployeeByDesignation($companyId, '18');
$approvalHistory = getApprovalHistoryById('requisition', $searchId);

include '../body/header.php';
?>


<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="index.php">Requisition List</a>
            </h3>
        </div>
        <div class="box-content">
            <table  class="table table-striped table-bordered bootstrap-datatable">
                <tr>
                    <td width="130">Requisition No :  </td>
                    <td><?php echo $var->RequisitionNo; ?></td >
                    <td width="130">Requisition Date :</td>
                    <td><?php echo bddate($var->RequisitionDate); ?></td>
                </tr>
                <tr>
                    <td>Requisition From :</td>
                    <td><?php echo $var->RequisitionFrom; ?></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <h3>Product List</h3>
            <table class="productGrid">
                <thead>
                    <tr>
                        <th width="30">S/N</th>
                        <th>Item Code </th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $requisitionDetailsList->fetch_object()) { ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $row->Code; ?></td>
                            <td><?php echo $row->Name; ?></td>
                            <td><?php echo $row->Qty; ?></td>
                            <td><?php echo $row->Remark; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td valign="top">Remark:</td>
                        <td colspan="5"><?php echo $var->Remark; ?></td>
                    </tr>  
                </tbody>
            </table>

            <?php file_upload_view($searchId, 'requisition', TRUE); ?>

            <br/>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="Module" value="requisition"/>
                <input type="hidden" name="DesignationId" value="<?php echo $designationId; ?>"/>
                <input type="hidden" name="EmployeeId" value="<?php echo $employeeId; ?>"/>
                <?php if ($var->StatusId == 4) { ?>
                    <div class="form-group">
                        <label for="Nextemployee" class="control-label">Transfer To :</label>
                        <div class="col-sm-10"> <?php comboBox('Nextemployee', $operationTeamList, '', TRUE, '', 'required'); ?></div>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">
                    <label for="Comments" class="control-label">Comments: </label>
                    <div class="col-sm-10"> <textarea name="approval_comment" class="form-input" placeholder="Write your approval comment.."></textarea></div>
                </div>
                <div class="form-actions">
                    <button type="submit" name="save" value="confirm" class="btn btn-primary">Approve</button> |
                    <a href="#" name="save" class="btn btn-primary">Reject</a> |
                    <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon icon-white icon-arrow-down"></i> 
                        Go Back
                    </button>
                </div>    

            </form>

            <h3>Requisition Approval History</h3>
            <table class="productGrid">
                <thead>
                <th width="20">SL</th>
                <th width="300">Name</th>
                <th width="100">Date</th>
                <th>Approval Comment</th>
                </thead>
                <tbody>
                    <?php
                    while ($row = $approvalHistory->fetch_object()) {
                        ?>
                        <tr>
                            <td><?php echo ++$no; ?>.</td>
                            <td><?php echo $row->app_person; ?></td>
                            <td><?php echo bddate($row->CreatedDate); ?></td>
                            <td><?php echo $row->Comment; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div>	












<?php include '../body/footer.php'; ?>