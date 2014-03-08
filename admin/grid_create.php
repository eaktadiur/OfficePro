<?php
include_once '../lib/db-settings.php';
include_once '../body/header.php';



if (isSave()) {

    $formName = getParam('formName');


    $string.="<?php 
include_once '../lib/db-settings.php';
include_once '../body/header.php';
\$Result=query('SELECT EmployeeId, FirstName, LastName FROM employee');

?>

<div class='row-fluid sortable'>		
    <div class='box span12'>
        <div class='box-header well' data-original-title>
            <h3>
                <a href=\"#\">Home</a> <span class='divider'>/</span>
                <a href=\"#\">Auto List</a>
            </h3>
        </div>
        <div class='box-content'>
            <table class='table table-striped table-bordered bootstrap-datatable datatable'>
                <thead>
                <tr>
                    <th width='30'>S/N</th>
                    <th>Name <i class='icon-filter'></i></th>
                    <th width='90'>Action</th>
                 </tr>
                </thead>
                <tbody>
                    <?php 
                    while (\$row = \$Result->fetch_object()) { ?>
                    <tr>
                        <td><?php echo ++\$i; ?></td>
                        <td><?php echo \$row->FirstName; ?></td>
                        <td class='center'>
                        <?php
                        viewIcon(\"requisition_view.php?searchId=\" . encodeSearchId(\$row->EmployeeId));
                        editIcon(\"#\");
                        deleteIcon(\"#\");
                        ?>
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div><!--/span-->
</div>

<?php
include_once '../body/footer.php';
?>
";


    $fp = fopen("$formName.php", "w");
    fwrite($fp, $string);
    fclose($fp);
}
?>


<div class="row-fluid sortable">		
    <div class="box span12 hidden-print">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Form Generate</a>
            </h3>
        </div>
        <div class="box-content hidden-print">
            <form class="form-horizontal" method='POST'>
                <div class="form-group">
                    <label for="companyID" class="col-sm-2 control-label">Form Name </label>
                    <div class="col-sm-10">
                        <input type="text" id="companyID" name="formName" value="<?php echo $formName; ?>" required/>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon icon-white icon-arrow-down"></i> 
                        Go Back
                    </button>
                </div>
            </form>
        </div>
    </div><!--/span-->       
</div>
<?php
include_once '../body/footer.php';
?>