<?php
include_once '../lib/db-settings.php';
include '../body/header.php';

if (!empty($_POST)) {
    $deletions = $_POST['delete'];
    if ($deletion_count = deleteLeads($deletions)) {
        $successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
    } else {
        $errors[] = lang("SQL_ERROR");
    }
}

$gridData = getProduct(); 

function getProduct(){   
            //$res = $productList == '' ? '' : " AND cp.ProductId NOT IN ($productList)";
            $sqlPrdct = "SELECT CompanyProductId, cmp.CompanyId, cmp.Name, SUBSTR(cp.CreatedDate,1,10) AS createdDate 
                FROM company_product cp
LEFT OUTER JOIN company cmp ON cmp.CompanyId = cp.CompanyId #GROUP BY Name, SUBSTR(cp.CreatedDate,1,10)";
            $stmtEmp = query($sqlPrdct);

            return $stmtEmp;
}

require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="product_company_new.php">Add New</a>
            </h3>
        </div>
        <div class="box-content">
            <?php echo resultBlock($errors, $successes); ?>
            <form name='leads' action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post' id="leads">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th width="30">SL</th>
                            <th>Company Name</th>
                            <th>Creation Date</th>
                            <th width="130">Actions</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php 
                        $sl=0;
                        while ($row = $gridData->fetch_object()) { ?>
                        <tr> 
                            <td><?php echo ++$sl; ?></td>
                            <td><?php echo stripcslashes($row->Name); ?></td>
                            <td><?php echo stripcslashes($row->createdDate); ?></td>
                            <td class='center'>
                                <?php
                                    viewIcon("product_company_view.php?id=$row->CompanyId&date=$row->createdDate");
                                    editIcon("employee_edit.php?id=$row->employeeId");
                                    deleteIcon("#");
                                 ?>
                            </td>
                        </tr>
                   <?php } ?>
                    </tbody>
                </table>   
                </div>  
            </form>    
        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>