<?php
include_once '../lib/db-settings.php';
 $searchId = getParam('searchId');


if (isSave()) {

    $sqlUpdate = "UPDATE requisition SET StatusId=2 WHERE RequisitionId='$searchId';";
    query($sqlUpdate);
    echo "<script>location.replace('index.php');</script>";
}
$approvalHistory = getApprovalHistoryById('requisition', $searchId);

include '../body/header.php';

$var = getRequisitionById("$searchId");
$requisitionDetailsList = getRequisitionDetailsById("$searchId");
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
                    <td width="120">Requisition No :  </td>
                    <td><?php echo $var->RequisitionNo; ?></td >
                    <td width="120">Requisition Date :</td>
                    <td><?php echo bddate($var->RequisitionDate); ?></td>
                </tr>
                <tr>
                    <td>Requisition From :</td>
                    <td><?php echo $var->RequisitionFrom; ?></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <!--<a href="product_search.php" class="btn btn-danger">Add Product</a>-->
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
                <button type="submit" name="save" value="confirm" class="btn btn-primary">Confirm</button> |
                <a href="#" name="save" class="btn btn-primary">Edit</a> |
                <a href="#" name="save" class="btn btn-primary">Draft</a>
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