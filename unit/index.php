<?php
include_once '../lib/db-settings.php';
include '../body/header.php';


$gridData = getUnits(); //Fetch information for all employee's

require_once("../body/header.php");
?>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Add New</a>
            </h3>
        </div>
        <div class="box-content">
            <?php echo resultBlock($errors, $successes); ?>
            <form method='POST'>
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th width="30">S/N</th>
                            <th>Unit Name</th>
                            <th width="90">Action</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        while ($row = $gridData->fetch_object()) {
                            ?>
                            <tr> 
                                <td><?php echo ++$sl; ?></td>
                                <td><?php echo stripcslashes($row->Name); ?></td>
                                <td align="center">
                                    <?php
                                    editIcon("unit_edit.php?searchId=" . encodeSearchId($row->UnitId));
                                    deleteIcon(encodeSearchId($row->UnitId));
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>   
            </form>  
            <div class="form-actions">
                <a class="btn btn-primary" href="unit_new.php">
                    <i class="icon icon-white icon-xls"></i> 
                    Add Unit
                </a>
                <button type="button" class="btn btn-primary" onclick="goBack();">
                    <i class="icon icon-white icon-arrow-down"></i> 
                    Go Back
                </button>
            </div>  
        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>