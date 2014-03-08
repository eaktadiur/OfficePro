<?php
include_once '../lib/db-settings.php';




$company_list = getUserList(); //Fetch information for all leads

require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">User List</a>
            </h3>
        </div>
        <div class="box-content">
            <?php //echo resultBlock($errors, $successes); ?>
            <form name='leads' action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post' id="leads">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                    </thead>

                    <tbody>
                        <?php
                        while ($row = $company_list->fetch_object()) {
                            echo "<tr>";
                            echo "<td>" . $row->Name . "</td>";
                            echo "<td>" . $row->Email . "</td>";
                            echo "<td>" . $row->Phone . "</td>";
                            echo "<td>" . $row->IsActive . "</td>";
                            echo "<td class='center'>";
                            echo "<a href='#'>View</a> | ";
                            echo "<a href='user_create.php?mode=edit&searchId=" . encodeSearchId($row->UserTableId) . "&UserName=$row->UserName'>Edit</a> | ";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <div class="form-actions">
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



