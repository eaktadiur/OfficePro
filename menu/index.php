<?php
include '../lib/db-settings.php';


$user_level_list = getDataUserLevel($userName);

include '../body/header.php';
?>
<br/>


<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Add New</a>
            </h3>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead >
                <th Width="20">SL</th>
                <th>User Type</th>
                <th width="80">Action</th>
                </thead>
                <tbody>
                    <?php while ($row = $user_level_list->fetch_object()) {
                        ?>
                        <tr>
                            <td><?php echo ++$SL; ?>.</td>
                            <td><?php echo $row->Name; ?></td>
                            <td><a  href="sysmenu_edit.php?searchId=<?php echo encodeSearchId($row->UserLevelId); ?>"> Edit </a></td>
                        </tr>
                    <?php }
                    ?>

                </tbody>
            </table>
            <div class="form-actions">
                <button type="button" class="btn btn-primary" onclick="goBack();">
                    <i class="icon icon-white icon-arrow-down"></i> 
                    Go Back
                </button>
            </div>
        </div>
    </div><!--/span-->

</div>	

<?php include('../body/footer.php'); ?>