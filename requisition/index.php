<?php
include_once '../lib/db-settings.php';



$myRequisitionList = getRequisitionList($employeeId, $companyId);


require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Requisition List</a>
            </h3>
        </div>
        <div class="box-content">
            <ul class="nav nav-tabs" id="myTab">
                <li class='active'><a href="#active">My Requisition</a></li>
                <?php if ($roleId == 5 || $roleId == 1) { ?>
                    <li><a href="#inActive">Waiting for Review</a></li>
                    <?php
                }
                if ($companyId == 1) {
                    ?>
                    <li><a href="#enroute">Waiting for Process</a></li>
                    <?php
                }
                if ($companyId == 1 && $roleId = 4) {
                    echo "<li><a href='#enrouteAccount'>Approved Requisition List</a></li>";
                }
                ?>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="active">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                            <tr>
                                <th width="30">S/N</th>
                                <th>Requisition No <i class="icon-filter"></i></th>
                                <th>Date<i class="icon-filter"></i></th>
                                <th>Requisition From</th>
                                <th>Present Location</th>
                                <th>Present Status</th>
                                <th width="90">Actions</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <?php while ($row = $myRequisitionList->fetch_object()) { ?>
                                <tr>
                                    <td><?php echo ++$j; ?></td>
                                    <td><?php echo $row->RequisitionNo; ?></td>
                                    <td><?php echo bddate($row->RequisitionDate); ?></td>
                                    <td><?php echo $row->RequisitionFrom; ?></td>
                                    <td><?php echo $row->PresentLocation; ?></td>
                                    <td><?php echo $row->SName; ?></td>
                                    <td class='center'>
                                        <?php
                                        viewIcon("requisition_view.php?searchId=" . encodeSearchId($row->RequisitionId));
                                        editIcon("#");
                                        deleteIcon("#");
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>   
                    <div class="form-actions">
                        <a href="requisition_new.php" class="btn btn-primary">
                            <i class="icon-white icon-plus-sign"></i> 
                            Create New Requisition</a>
                    </div>  
                </div>
                <?php if ($roleId == 5 || $roleId == 1) { ?>
                    <div class="tab-pane" id="inActive">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                    <th width="30">S/N</th>
                                    <th>Requisition No <i class="icon-filter"></i></th>
                                    <th>Date <i class="icon-filter"></i></th>
                                    <th>Requisition From</th>
                                    <th>Present Location</th>
                                    <th>Present Status</th>
                                    <th width="80">Actions</th>
                                </tr>
                            </thead>   
                            <tbody>
                                <?php
                                $pendingRequisitionList = getPendingRequisitionList($employeeId, $companyId);
                                while ($row = $pendingRequisitionList->fetch_object()) {
                                    ?>
                                    <tr>
                                        <td><?php echo ++$i; ?></td>
                                        <td><?php echo $row->RequisitionNo; ?></td>
                                        <td><?php echo bddate($row->RequisitionDate); ?></td>
                                        <td><?php echo $row->RequisitionFrom; ?></td>
                                        <td><?php echo $row->PresentLocation; ?></td>
                                        <td><?php echo $row->SName; ?></td>
                                        <td class='center'>
                                            <?php viewIcon("requisition_view.php?searchId=" . encodeSearchId($row->RequisitionId)); ?>
                                            <a href="requisition_pending.php?searchId=<?php echo encodeSearchId($row->RequisitionId); ?>">Review</a>

                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>   
                    </div>
                    <?php
                }
                if ($companyId == 1) {
                    ?>
                    <div class="tab-pane" id="enroute">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                    <th width="30">S/N</th>
                                    <th>Requisition No <i class="icon-filter"></i></th>
                                    <th>Date <i class="icon-filter"></i></th>
                                    <th>Requisition From <i class="icon-filter"></i></th>
                                    <th>Location</th>
                                    <th>Status <i class="icon-filter"></i></th>
                                    <th width="80">Actions</th>
                                </tr>
                            </thead>   
                            <tbody>
                                <?php
                                $approvedRequisitionList = getApprovedRequisitionList($employeeId);
                                while ($row = $approvedRequisitionList->fetch_object()) {
                                    ?>
                                    <tr>
                                        <td><?php echo ++$k; ?></td>
                                        <td><?php echo $row->RequisitionNo; ?></td>
                                        <td><?php echo bddate($row->RequisitionDate); ?></td>
                                        <td><?php echo $row->RequisitionFrom; ?></td>
                                        <td><?php echo $row->PresentLocation; ?></td>
                                        <td><?php echo $row->SName; ?></td>
                                        <td class='center'>
                                            <?php viewIcon("requisition_view.php?searchId=" . encodeSearchId($row->RequisitionId)); ?>
                                            <a href="requisition_pending.php?searchId=<?php echo encodeSearchId($row->RequisitionId); ?>">Review</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>   
                       
                    </div>
                    <?php
                }
                if ($companyId == 1 && $roleId = 4) {
                    ?>
                    <div class="tab-pane" id="enrouteAccount">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                    <th width="30">S/N</th>
                                    <th>Requisition No <i class="icon-filter"></i></th>
                                    <th>Date <i class="icon-filter"></i></th>
                                    <th>Requisition From <i class="icon-filter"></i></th>
                                    <th>Location</th>
                                    <th>Status <i class="icon-filter"></i></th>
                                    <th width="80">Actions</th>
                                </tr>
                            </thead>   
                            <tbody>
                                <?php
                                $approvedRequisitionList = getApprovedRequisitionForChallanList($employeeId);
                                while ($row = $approvedRequisitionList->fetch_object()) {
                                    ?>
                                    <tr>
                                        <td><?php echo ++$j; ?></td>
                                        <td><?php echo $row->RequisitionNo; ?></td>
                                        <td><?php echo bddate($row->RequisitionDate); ?></td>
                                        <td><?php echo $row->RequisitionFrom; ?></td>
                                        <td><?php echo $row->PresentLocation; ?></td>
                                        <td><?php echo $row->SName; ?></td>
                                        <td class='center'>
                                            <?php viewIcon("requisition_view.php?searchId=" . encodeSearchId($row->RequisitionId)); ?>
                                            <a href="../challan/process_requisition.php?searchId=<?php echo encodeSearchId($row->RequisitionId); ?>">Challan Create</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>   
                         
                    </div>
                <?php }
                ?>
            </div>
        </div><!--/span-->

    </div>	

    <?php include('../body/footer.php'); ?>