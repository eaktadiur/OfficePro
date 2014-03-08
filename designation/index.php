<?php
include_once '../lib/db-settings.php';
include '../body/header.php';
include 'lib_designation.php';

//function deleteDesignation($id){
//    image("delete.png");
//    query("DELETE FROM designation WHERE DesignationId='$id'");
//}


if (!empty($_POST)) {
    $deletions = $_POST['delete'];
    if ($deletion_count = deleteLeads($deletions)) {
        $successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
    } else {
        $errors[] = lang("SQL_ERROR");
    }
}

$gridData = getDesignations(); //Fetch information for all employee's

require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="designation_new.php">Add New</a>
            </h3>
        </div>
        <div class="box-content">
            <?php echo resultBlock($errors, $successes); ?>
            <form name='leads' action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post' id="leads">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th width="20">SL</th>
                            <th>Designation</th>
                            <th width="80">Action</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        $sl = 0;
                        while ($row = $gridData->fetch_object()) {
                            ?>
                            <tr> 
                                <td><?php echo ++$sl; ?></td>
                                <td><?php echo stripcslashes($row->Name); ?></td>
                                <td align="center">
                                    <?php
                                    editIcon("designation_edit.php?id=$row->DesignationId");
                                    deleteIcon($row->DesignationId);
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>   
            </form>    
        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>