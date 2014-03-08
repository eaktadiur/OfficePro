<?php
require_once '../lib/db-settings.php';


$listSQL = "SELECT CompanyId, Name FROM company ORDER BY Name";
$companyList = rs2array($listSQL);

$CreatedDate = date('Y-m-d');
$company = getParam('company');

$searchId = getParam('searchId');
$date = getParam('date');

$productList = getCompanyProduct($searchId);
$companyName = findValue("SELECT Name FROM company WHERE CompanyId='$searchId'");



include '../body/header.php';
?>

<br/>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Product List</a>
            </h3>
        </div>
        <div class="box-content">
            <h3>Company: <?php echo $companyName; ?></h3>
            <form name="shopcart" method="post">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th width="30">S/N</th>
                                <th width="120">Item Code</th>
                                <th>Item Name</th>
                                <th width="100">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sl = 0;
                            while ($row = $productList->fetch_object()) {
                                ?>
                                <tr>
                                    <td><?php echo ++$sl; ?>.</td>
                                    <td><?php echo $row->Code; ?><input name="item_code[<?php echo $row->ProductId; ?>]" type="hidden" id="item_code" value="<?php echo $row->Code; ?>"></td>
                                    <td><?php echo $row->Name; ?><input name="description[<?php echo $row->ProductId; ?>]" type="hidden" id="description" value="<?php echo $row->Name; ?>"></td>
                                    <td><?php echo $row->Price; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <a class="btn btn-primary" href="product_company_new.php?searchId=<?php echo encodeSearchId($searchId); ?>">
                        <i class="icon icon-white icon-xls"></i> 
                        Add New Product
                    </a>
                    <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon-white icon-arrow-left"></i>  
                        Go Back
                    </button>
                    <a class="btn btn-primary" href="../company/index.php">Company List</a>
                </div>  
        </div>
    </div>
</div>

</form>
<?php include '../body/footer.php'; ?>