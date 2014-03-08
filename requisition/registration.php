<?php
/*
  UserCake Version: 2.0.2
  http://usercake.com
 */

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])) {
    die();
}

//Forms posted
if (!empty($_POST)) {
    $deletions = $_POST['delete'];
    if ($deletion_count = deleteLeads($deletions)) {
        $successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
    } else {
        $errors[] = lang("SQL_ERROR");
    }
}


require_once("header.php");


$searchId = $_REQUEST["searchId"];
$mode = $_REQUEST['mode'];

if ($mode == 'delete') {
    $dal->delete($searchId);
}

$objWordList = getList();
?>


<div id="dialog-form" title="Add/Edit Registration"></div>

<a href="registration_add.php?mode=new" class="btn btn-link">Registration</a>



<div>
    <ul class="breadcrumb">
        <li>
            <a href="account.php">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="leads.php">Registration</a>
        </li>
    </ul>
</div>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i>Register User List</h2>

        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th field="1">S/N</th>
                        <th field="2">Title</th>
                        <th field="3">Name</th>
                        <th field="4">Date Of Birth</th>
                        <th field="5">Contact No</th>
                        <th field="6">City</th>
                        <th field="7">State</th>
                        <th field="8">Country</th>
                        <th field="9">Zip</th>
                        <th field="10">Status</th>
                        <th field="11">Course Objective</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $objWordList->fetch_object()) { ?>
                        <tr>
                            <td><?php echo ++$sl; ?></td>
                            <td><?php echo stripcslashes($row->Title); ?></td>
                            <td><?php echo stripcslashes($row->Name); ?></td>
                            <td><?php echo stripcslashes($row->DateOfBirth); ?></td>
                            <td><?php echo stripcslashes($row->ContactNo); ?></td>
                            <td><?php echo stripcslashes($row->City); ?></td>
                            <td><?php echo stripcslashes($row->State); ?></td>
                            <td><?php echo stripcslashes($row->Country); ?></td>
                            <td><?php echo stripcslashes($row->Zip); ?></td>
                            <td><?php echo stripcslashes($row->Status); ?></td>
                            <td><?php echo stripcslashes($row->CourseObjective); ?></td>
                            <td class='center'>
                                <a href='lead_details.php?id=" . $v1['id'] . "'>View</a>
                                <a href='lead_edit.php?id=" . $v1['id'] . "'>Edit</a>
                            </td>
                            <!--
                            <td>
                                <button class="view" searchId="<?php echo $row->ComprehensionId ?>" mode="view" href="#">view</button> | 
                                <button class="edit" searchId="<?php echo $row->ComprehensionId ?>" mode="edit" href="#">Edit</button> | 
                            <?php deleteIcon("?mode=delete&searchId=$row->ComprehensionId"); ?>
                            </td>
                            -->
                        </tr>

                        <?php
                    }
                    $objWordList->close();
                    ?>

                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div>	

<?php include '../body/footer.php'; ?>









