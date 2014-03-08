<?php
include_once '../lib/db-settings.php';


$searchId = getParam('searchId');


$var = find("SELECT DATE_FORMAT(c.ChallanDate,'%d %b %Y') AS ChallanDate, c.ChallanNo, c.RefNo, c.Remark,
co.`Name`, co.Address1
FROM challan c 
LEFT JOIN company co ON co.CompanyId=c.CompanyId
where c.ChallanId='$searchId'");

$challanDetail = query("SELECT cd.Qty, cd.UnitPrice, cd.Total, p.`Name`, 
u.`Name` AS UName, p.`Code`, cd.Remark, rd.Qty AS RQty
FROM challan_details cd
INNER JOIN challan c ON c.ChallanId=cd.ChallanId
LEFT JOIN requisition_details rd ON rd.RequisitionDetailsId=cd.RequisitionDetailsId
LEFT JOIN company_product cp ON cp.ProductId=rd.ProductId AND cp.CompanyId=c.CompanyId
LEFT JOIN product p ON p.ProductId=cp.ProductId
LEFT JOIN unit u ON u.UnitId=cp.UnitId
WHERE cd.ChallanId='$searchId'");

include '../body/header.php';
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Challan Details</a>
            </h3>
        </div>
        <div class="box-content">

            <table id="ac-challan-table" width="100%">
                <tr>
                    <td>
                        Challan No: <?php echo $var->ChallanNo; ?><br />
                        Ref No.: <?php echo $var->RefNo; ?>
                    </td>
                    <td align="right">Date: <?php echo $var->ChallanDate; ?></td>
                </tr>
                <tr>
                    <td align="center" colspan="2">
                        <h2>Challan Paper</h2>
                    </td>            
                </tr>
                <tr>
                    <td colspan="2">
                        <div>
                            To, <br />
                            <?php
                            echo $var->Name . '<br>' .
                            $var->Address1;
                            ?>
                        </div>
                    </td>
                </tr>
            </table>
            <br /><br />
            <table class="productGrid">
                <thead>
                    <th>S/N</td>
                    <th>Product ID</th>
                    <th>Product/Service Description</th>
                    <th>Requisition Quantity</th>
                    <th>Supply Quantity</th>
                </thead>
                <?php
                $itemCount = 0;
                while ($row = $challanDetail->fetch_object()) {
                    $itemCount++;
                    echo "<tr>";
                    echo "<td align='center'>" . ++$i . "</td>";
                    echo "<td align='center'>" . $row->Code . '->' . $row->Name . "</td>";
                    echo "<td>" . $row->Remark . "</td>";
                    echo "<td align='center'>" . $row->Qty . "</td>";
                    echo "<td align='center'>" . $row->RQty . "</td>";
                    echo "<tr>";
                }
                ?>
            </table>
            <br>
            <p>We've received the above Products/Services</p>

            <table style="width: 100%;">
                <tr>
                    <td>__________<br>Delivered By</td>
                    <td align="right">__________<br>Received By</td>
                </tr>
            </table>
            <br><br>
            <button type="button" class="btn btn-primary" onclick="goBack();">
                <i class="icon icon-white icon-arrow-down"></i> 
                Go Back
            </button>
        </div>
    </div><!--/span-->

</div>
<?php include '../body/footer.php'; ?>