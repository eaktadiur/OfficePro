<?php
include_once '../lib/db-settings.php';
$searchId = getParam('searchId');

$var = getBillInfoId($searchId);
require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12 hidden-print">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Bill View</a>
            </h3>
        </div>
        <div class="box-content hidden-print">
            <table class="table">
                <tr>
                    <td width='10'>Ref: </td>
                    <td><?php echo $var->RefNo; ?></td>
                    <td width='80'>Company: </td>
                    <td><?php echo $var->Name; ?></td>
                    <td width='80'>Bill Date: </td>
                    <td><?php echo $var->BillDate; ?></td>
                </tr>
            </table>

            <br />
            <table class="table table-striped table-bordered bootstrap-datatable">
                <thead>
                <th width="30">S/N</th>
                <th>Product Description</th>
                <th width="30">Qty</th>
                <th width="50">Unit</th>
                <th width="100">Total</th>
                </thead>
                <tbody>
                    <?php
                    $requisitionRow = getBillByBillId($searchId);
                    while ($row = $requisitionRow->fetch_object()) {
                        ?>
                        <tr>
                            <td><?php echo ++$sl; ?></td>
                            <td><?php echo $row->Code . '->' . $row->Name; ?></td>
                            <td class="center"><?php echo $row->Qty; ?></td>
                            <td class="right"><?php echo $row->UnitPrice; ?></td>
                            <td class="right"><?php echo $row->Total; ?></td>
                        </tr>
                    <?php }
                    ?> 
                    <tr>
                        <td>Remarks</td>
                        <td colspan="4"><?php echo $var->Remark; ?></td>
                    </tr>
                </tbody>


            </table>

            <div class="form-actions">
                <button type="button" class="btn btn-primary" onclick="goBack();">
                    <i class="icon icon-white icon-arrow-down"></i> 
                    Go Back
                </button>
            </div>    
            </form> 
        </div>
    </div><!--/span-->       
</div>
<?php include '../body/footer.php'; ?>