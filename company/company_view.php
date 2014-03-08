<?php
include_once '../lib/db-settings.php';

$searchId = getParam('searchId');

$var = getCompanyInfoById($searchId);

include '../body/header.php';
?>
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="index.php">Company Details</a>
            </h3>
        </div>
        <div class="box-content">
            <form name="create_company" Action = '' method = 'POST' class="form">
                <table class="table table-striped table-bordered bootstrap-datatable">
                    <tr>
                        <td width="120">Name: </td>
                        <td><?php echo $var->Name ?></td>
                    </tr>
                    <tr>
                        <td width="120">Code: </td>
                        <td><?php echo $var->Code ?></td>
                    </tr>
                    <tr>
                        <td>Address 1:</td>
                        <td><?php echo $var->Address1 ?></td>
                    </tr>

                    <tr>
                        <td>Address 2:</td>
                        <td><?php echo $var->Address2 ?></td>
                    </tr>
                    <tr>
                        <td>Zip Code:</td>
                        <td><?php echo $var->ZipCode ?></td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td><?php echo $var->Phone ?></td>
                    </tr>
                    <tr>
                        <td>Fax:</td>
                        <td><?php echo $var->Fax ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo $var->Email ?></td>
                    </tr>
                    <tr>
                        <td>Total Budget:</td>
                        <td><?php echo $var->TotalBudget ?></td>
                    </tr>

                    <tr>
                        <td>Is Active:</td>
                        <td><?php echo $var->Active ?></td>
                    </tr>
                </table>
                <?php file_upload_edit($searchId, 'company', TRUE); ?>
                <div class="form-actions">
                    <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon-white icon-arrow-left"></i>  
                        Go Back
                    </button>
                </div>    
            </form>
        </div><!--/span-->

    </div>
</div>

<br/> <br/>
<?php include '../body/footer.php'; ?>