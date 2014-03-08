<?php
include_once '../lib/db-settings.php';
$searchId = getParam('searchId');
$billCompanyId = getParam('company');

if (isSave()) {

    $remarks = getParam('remarks');
    $refNo = getParam('refNo');
    $billDate = getParam('Billdate');
    $ProductId = getParam('ProductId');
    $chk = getParam('chk');
    $processQuantity = getParam('processQuantity');
    $unitPrice = getParam('unitPrice');

    $billNo = OrderNo(maxBillId());

    $insertQuery = "INSERT INTO bill(RefNo, BillNo, BillDate, Remark, StatusId, IsActive, CompanyId, CreatedBy, CreatedDate) 
                    VALUES ('$refNo','$billNo','$billDate','$remarks', 1, 1,'$billCompanyId','$employeeId',NOW())";
    query($insertQuery);
    $billID = insertLastId();


    foreach ($chk as $key => $value) {
        query("INSERT INTO bill_details(BillId, ChallanDetailsId, Qty,UnitPrice, Total) 
            VALUES ('$billID','$key', '$processQuantity[$key]','$unitPrice[$key]', '$processQuantity[$key]*$unitPrice[$key]')");
    }
    echo "<script>location.replace('index.php')</script>";
    exit();
}


$companyList = getCompanyComb();
require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12 hidden-print">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Bill Process</a>
            </h3>
        </div>
        <div class="box-content hidden-print">
            <div class="span12">

                <form class="form-horizontal" method='GET'>
                    <div class="form-group">
                        <label for="companyID" class="control-label">Company :</label>
                        <div class="col-sm-10">
                            <?php comboBox('company', $companyList, "$billCompanyId", TRUE, 'form-control chosen-select'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>

                <form action="" method='POST' enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="company" value="<?php echo $billCompanyId; ?>"/>
                    <div class="span6">
                        <div class="form-group">
                            <label for="refNo" class="control-label">Ref : </label>
                            <div class="col-sm-10"><input type="text" name="refNo" id="refNo" required></div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="form-group">
                            <label for="Billdate" class="control-label">Bill Date : </label>
                            <div class="col-sm-10"><input type="text" name="Billdate" id="Billdate" class="datepicker" data-date-format="yyyy-mm-dd" required></div>
                        </div>
                    </div>
                    <br />
                    <table class="table table-striped table-bordered bootstrap-datatable">
                        <thead>
                        <th width="30">S/N</th>
                        <th>Product Description</th>
                        <th width="30">Qty</th>
                        <th width="50">Unit</th>
                        <th width="100">Total</th>
                        <th width="30">Chk</th>
                        </thead>
                        <tbody>
                            <?php
                            $requisitionRow = getChallanForPrepareBill($billCompanyId);
                            while ($row = $requisitionRow->fetch_object()) {
                                ?>
                                <tr>
                                    <td><?php echo ++$sl; ?></td>
                                    <td><?php echo $row->Code . '->' . $row->Name; ?></td>
                                    <td class="center"><?php echo $row->Qty; ?></td>
                                    <td class="right"><?php echo $row->UnitPrice; ?></td>
                                    <td class="right"><?php echo $row->Total; ?></td>
                                    <td><input type="checkbox" name="chk[<?php echo $row->ChallanDetailsId; ?>]"/></td>
                                </tr>
                            <?php }
                            ?> 
                        </tbody>
                    </table> 
                    <div class="form-group">
                        <label for="Remarks" class="control-label">Remarks : </label>
                        <div class="col-sm-10"><textarea type="text" class="form-input" name="remarks" id="remarks"></textarea></div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="save" class="btn btn-primary" value="save">
                            <i class="icon icon-white icon-save"></i> 
                            Create Bill</button>
                        <button type="button" class="btn btn-primary" onclick="goBack();">
                            <i class="icon icon-white icon-arrow-down"></i> 
                            Go Back
                        </button>
                    </div>    
                </form> 
            </div>
        </div>
    </div><!--/span-->       
</div>
<?php include '../body/footer.php'; ?>