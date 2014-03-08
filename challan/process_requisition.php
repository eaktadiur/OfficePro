<?php
include_once '../lib/db-settings.php';
$searchId = getParam('searchId');

if (isSave()) {
    $reqCompanyId = getParam('reqCompanyId');
    $remarks = getParam('remarks');
    $refNo = getParam('refNo');
    $challanDate = getParam('challan-date');
    $ProductId = getParam('ProductId');
    $chk = getParam('chk');
    $processQuantity = getParam('processQuantity');
    $unitPrice = getParam('unitPrice');

    $challanNo = OrderNo(maxChallanId($reqCompanyId));

    $insertQuery = "INSERT INTO `challan`(`RefNo`, `ChallanNo`, `ChallanDate`, `Remark`, `StatusId`, `IsActive`, `CompanyId`, `CreatedBy`, `CreatedDate`) 
                    VALUES ('$refNo','$challanNo','$challanDate','$remarks', 1, 1,'$reqCompanyId','$employeeId',NOW())";
    query($insertQuery);
    $challanID = insertLastId();


    foreach ($chk as $key => $value) {
        query("INSERT INTO `challan_details`(`ChallanId`,`RequisitionDetailsId`, `Qty`, `UnitPrice`, Total) 
            VALUES ('$challanID','$key', '$processQuantity[$key]','$unitPrice[$key]', '$processQuantity[$key]*$unitPrice[$key]')");
    }
    echo "<script>location.replace('index.php')</script>";
    exit();
}

function processRequisition($searchId) {

    $sqlQuery = "SELECT rd.ProductId, rd.Remark, rd.Qty, pd.`Name`, 
        rd.RequisitionDetailsId, pd.`Code`
            FROM requisition_details rd 
            LEFT JOIN product pd on rd.ProductId=pd.ProductId 
            WHERE requisitionId='$searchId'";
    return query($sqlQuery);
}

$var = getRequisitionById($searchId);
require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Process Requisition</a>
            </h3>
        </div>
        <div class="box-content">
            <form name='leads' action="" method='POST' enctype="multipart/form-data">
                <input type="hidden" name="reqCompanyId" value="<?php echo $var->CompanyId; ?>"/>

                <table class="table table-striped table-bordered bootstrap-datatable">
                    <tr>
                        <td width='130'>Reference</td>
                        <td><input type="text" name="refNo" required></td>
                    </tr>
                    <tr>
                        <td>Challan Date</td>
                        <td><input type="text" name="challan-date" class="datepicker" data-date-format="yyyy-mm-dd" required> </td>
                    </tr>
                </table>

                <br />
                <table class="table table-striped table-bordered bootstrap-datatable">
                    <thead>
                    <th>S/N</th>
                    <th>Chk</th>
                    <th>Code</th>
                    <th>Product Category</th>
                    <th>Product Description</th>
                    <th>Requisition Quantity</th>
                    <th>Requisition Remark</th>
                    <th>Process Quantity</th>
                    <th>Unit Price</th>
                    </thead>
                    <tbody>
                        <?php
                        $itemCount = 0;
                        $requisitionRow = processRequisition($searchId);
                        while ($row = $requisitionRow->fetch_object()) {
                            $itemCount++;
                            ?>
                            <tr>
                                <td><?php echo ++$sl; ?></td>
                                <td><input type="checkbox" name="chk[<?php echo $row->RequisitionDetailsId; ?>]"/></td>
                                <td><?php echo $row->Code; ?></td>
                                <td><?php //$row->Remark;         ?></td>
                                <td><?php echo $row->Name; ?></td>
                                <td><?php echo $row->Qty; ?></td>
                                <td><?php echo $row->Remark; ?></td>
                                <td align='center'><input type='text' name='processQuantity[<?php echo $row->RequisitionDetailsId; ?>]' size="5" class='input'/></td>
                                <td align='center'><input type='text' name='unitPrice[<?php echo $row->RequisitionDetailsId; ?>]' size="5" class='input'/></td>
                            </tr>
                        <?php }
                        ?> 
                    </tbody>
                </table> 
                <table class="table table-striped table-bordered bootstrap-datatable">
                    <tr>
                        <td width='100'>Remarks</td>
                        <td><textarea type="text" name="remarks" style="width:99%;"></textarea></td>
                    </tr>
                </table>

                <div class="form-actions">
                    <button type="submit" name="save" class="btn btn-primary" value="save">
                        <i class="icon icon-white icon-save"></i> 
                        Create Challan</button>
                    <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon icon-white icon-arrow-down"></i> 
                        Go Back
                    </button>
                </div>    
            </form>            
        </div>
    </div><!--/span-->       
</div>
</div>
<?php include '../body/footer.php'; ?>