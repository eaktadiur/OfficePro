<?php
include_once '../lib/db-settings.php';


$company_list = getCompanyList(); //Fetch information for all leads

require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Company List</a>
            </h3>
        </div>
        <div class="box-content">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post'>
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <th width="30">S/N</th>
                    <th>Company Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Active</th>
                    <th width="120">Action</th>
                    </thead>

                    <tbody>
                        <?php
                        while ($row = $company_list->fetch_object()) {
                            echo "<tr>";
                            echo "<td>" . ++$sl . "</td>";
                            echo "<td>" . $row->Name . ' ' . $row->Code . "</td>";
                            echo "<td>" . $row->Address1 . "</td>";
                            echo "<td>" . $row->Email . "</td>";
                            echo "<td>" . $row->Phone . "</td>";
                            echo "<td>" . $row->Active . "</td>";
                            echo "<td class='center'>";
                            viewIcon("company_view.php?searchId=" . encodeSearchId($row->CompanyID));
                            editIcon('#');
                            echo "<a href='../product_company/product_company_view.php?searchId=" . encodeSearchId($row->CompanyID) . "'>Product</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <div class="form-actions">
                    <a class="btn btn-primary" href="company_create.php?mode=new">
                        <i class="icon icon-white icon-xls"></i> 
                        Add Company
                    </a>
                    <a class="btn btn-primary" href="#">
                        <i class="icon icon-white icon-xls"></i> 
                        Export to Excel
                    </a>
                    <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon icon-white icon-arrow-down"></i> 
                        Go Back
                    </button>
                </div>  
            </form>    
        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>



