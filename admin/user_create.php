<?php
include_once '../lib/db-settings.php';


$mode = getParam('mode');
$searchId = getParam('searchId');
$name = getParam('UserName');

if (isSave()) {




    $Password = getParam('Password');
    $RePassword = getParam('Re-Password');
    $comaony = getParam('comaony');
    $encPass = md5($Password);




    if ($mode == 'new') {


        $sql = "INSERT INTO user_table(CompanyId, UserName, DisplayName, `Password`, IsActive, CreatedBy, CreatedDate) "
                . "VALUES('$comaony', 'admin', 'Admin', '$encPass', '1', '$employeeId', NOW())";
        query($sql);
    } else {
        $sql = "UPDATE user_table SET "
                . "Password='$encPass' "
                . "WHERE UserTableId='$searchId'";
        query($sql);
    }


    echo "<script>location.replace('index.php')</script>";
    exit();
}

$companyList = getCompanyComb();
include '../body/header.php';
?>
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="index.php">User List</a>
            </h3>
        </div>
        <form name="create_company" Action='<?php //echo $_SERVER['PHP_SELF']            ?>' method = 'POST' class="">
            <div class="span4">

                <label for="comaony">Company: </label>
                <div class="controls">
                    <?php comboBox('comaony', $companyList, '', TRUE); ?>
                </div>

                <label for="UserName">User Name: </label>
                <div class="controls">
                    <input type="text" id="UserName" name="UserName" value="<?php echo $name; ?>" readonly placeholder="UserName">
                </div>

                <label for="Password">Password: </label>
                <div class="controls">
                    <input type="Password" id="Password" name="Password" required placeholder="Password">
                </div>

                <label for="Re-Password">Re-Password</label>
                <div class="controls">
                    <input type="Password" id="Re-Password" data-validation-match-match="Password"  name="Re-Password" placeholder="Re-Password">
                </div>
                <button type="submit" class="btn btn-primary" name="save" value="save">
                    <i class="icon icon-white icon-save"></i> Submit</button>
            </div>

            <div class="span4">

                <label for="comaony">Company: </label>
                <div class="controls">
                    <?php comboBox('comaony', $companyList, '', TRUE); ?>
                </div>

                <label for="UserName">User Name: </label>
                <div class="controls">
                    <input type="text" id="UserName" name="UserName" value="<?php echo $name; ?>" readonly placeholder="UserName">
                </div>

                <label for="Password">Password: </label>
                <div class="controls">
                    <input type="Password" id="Password" name="Password" required placeholder="Password">
                </div>

                <label for="Re-Password">Re-Password</label>
                <div class="controls">
                    <input type="Password" id="Re-Password" data-validation-match-match="Password"  name="Re-Password" placeholder="Re-Password">
                </div>
                <button type="submit" class="btn btn-primary" name="save" value="save">
                    <i class="icon icon-white icon-save"></i> Submit</button>
            </div>

            <div class="span4">

                <label for="comaony">Company: </label>
                <div class="controls">
                    <?php comboBox('comaony', $companyList, '', TRUE); ?>
                </div>

                <label for="UserName">User Name: </label>
                <div class="controls">
                    <input type="text" id="UserName" name="UserName" value="<?php echo $name; ?>" readonly placeholder="UserName">
                </div>

                <label for="Password">Password: </label>
                <div class="controls">
                    <input type="Password" id="Password" name="Password" required placeholder="Password">
                </div>

                <label for="Re-Password">Re-Password</label>
                <div class="controls">
                    <input type="Password" id="Re-Password" data-validation-match-match="Password"  name="Re-Password" placeholder="Re-Password">
                </div>
                <button type="submit" class="btn btn-primary" name="save" value="save">
                    <i class="icon icon-white icon-save"></i> Submit</button>
            </div>

        </form>
    </div>
</div>
<?php include '../body/footer.php'; ?>