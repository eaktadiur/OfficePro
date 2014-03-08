<?php
include_once '../lib/db-settings.php';



$challanList = getChallanList(); //Fetch information for all leads

require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Challan & Bill List</a>
            </h3>
        </div>
        <div class="box-content">
            <ul class="nav nav-tabs" id="myTab">
                <li class='active'><a href="#challan">Challan list</a></li>
                <li><a href="#bill">Bill List</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="challan">

                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                            <tr>
                                <th width="30">S/N</th>
                                <th>Ref No</th>
                                <th>Challan No <i class="icon-filter"></i></th>
                                <th>Challan Date <i class="icon-filter"></i></th>
                                <th>Requisition From <i class="icon-filter"></i></th>
                                <th width="90">Actions</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <?php while ($row = $challanList->fetch_object()) { ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $row->RefNo; ?></td>
                                    <td><?php echo $row->ChallanNo; ?></td>
                                    <td><?php echo $row->ChallanDate; ?></td>
                                    <td><?php echo $row->RequisitionFrom . ' (' . $row->CName . ')'; ?></td>
                                    <td class='center'>
                                        <?php
                                        viewIcon("challan_paper.php?searchId=".encodeSearchId($row->ChallanId));
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
                        <a class="btn btn-primary" href="bill_paper.php">Bill Prepare</a>
                    </div> 
                </div>

                <div class="tab-pane" id="bill">

                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                            <tr>
                                <th width="30">S/N</th>
                                <th>Ref No</th>
                                <th>Bill No <i class="icon-filter"></i></th>
                                <th>Bill Date <i class="icon-filter"></i></th>
                                <th>Bill For <i class="icon-filter"></i></th>
                                <th width="90">Actions</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <?php
                            $billList = getBillList();
                            while ($row = $billList->fetch_object()) {
                                ?>
                                <tr>
                                    <td><?php echo ++$j; ?></td>
                                    <td><?php echo $row->RefNo; ?></td>
                                    <td><?php echo $row->BillNo; ?></td>
                                    <td><?php echo $row->BillDate; ?></td>
                                    <td><?php echo $row->CName . ' (' . $row->Code . ')'; ?></td>
                                    <td class='center'>
                                        <?php
                                        viewIcon("bill_view.php?searchId=$row->BillId");
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
                        <a class="btn btn-primary" href="bill_paper.php">Bill Prepare</a>
                        <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon icon-white icon-arrow-down"></i> 
                        Go Back
                    </button>
                    </div> 
                </div>
            </div>
        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>