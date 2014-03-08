<?php
include '../lib/db-settings.php';

$searchId = getParam('searchId');


$user_level_sql = "SELECT ul.UserLevelId, MainId, SubId, ul.`Name` 
FROM user_level AS ul 
LEFT JOIN user_table AS u ON u.UserLevelId=ul.UserLevelId 
WHERE ul.UserLevelId='$searchId' #AND ul.CompanyId='$companyId'";

$user_level_sub_id = find($user_level_sql);



$user_level_sub_id_list = ($user_level_sub_id->SubId != '' ? $user_level_sub_id->SubId : '0');

$user_level_main_id_list = ($user_level_sub_id->MainId != '' ? $user_level_sub_id->MainId : '0');


$sysmenu = query("select  MenuId,`Name` FROM sys_menu Where `Group` = 'main' AND `Show` = '1'");

if (isSave()) {


    $main_menu = getParam('main_menu');
    $main_menu_id = implode(',', $main_menu);

    $sub_menu = getParam('sub_menu');

    $sub_menu_id = $sub_menu != '' ? implode(', ', $sub_menu) : 0;




    $sql_update = "UPDATE user_level set 
        MainId = '$main_menu_id',
        SubId = '$sub_menu_id' 
        Where UserLevelId = '$searchId'";


    query($sql_update);



    echo " <script>location.replace('sysmenu_edit.php?mode=search&searchId=" . encodeSearchId($searchId) . "');</script>";
}

include '../body/header.php';
?>

<style type="text/css">
    .edit-div{margin-top: 50px;}
    ul.sysmenu_edit input { border: 1px solid #8A8575; min-height: 0px; }
    ul.sysmenu_edit{margin-bottom: 10px; list-style: none;}
    ul.sysmenu_edit li{margin-left: 20px; list-style: none; font-weight: bold; font-size: 12pt;}
    ul.sysmenu_edit li ul {margin-left: 20px; list-style: none;}
    ul.sysmenu_edit li ul li{margin-left: 20px; list-style: none; font-weight: normal; font-size: 10pt;}
</style>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Edit User Level</a>
            </h3>
        </div>
        <div class="box-content">
            <h1> User Level Edit For - <span style="color:#086606;"><?php echo $user_level_sub_id->USER_LEVEL_NAME ?> </span></h1>
            <form name='requisition' action="" method='post' id="requisition">
                <ul class="sysmenu_edit">

                    <?php
                    if (mysqli_num_rows($sysmenu) > 0) {
                        while ($sys = $sysmenu->fetch_object()) {
                            $sqlChk = "SELECT MainId FROM user_level WHERE UserLevelId = '$searchId' AND '$sys->MenuId' in($user_level_main_id_list)";

                            $user_level = findValue($sqlChk);

                            if ($user_level != '') {
                                $checked = 'checked = "checked"';
                            } else {
                                $checked = '';
                            }
                            ?> 
                            <li><input type="checkbox" name="main_menu[]"  value="<?php echo $sys->MenuId; ?>" <?php echo $checked; ?> />
                                <?php echo $sys->Name; ?> 


                                <ul>
                                    <?php
                                    $submenu = query("SELECT MenuId, `Name` FROM sys_menu WHERE `Show` = '1' AND SubId ='$sys->MenuId'");

                                    while ($sys_sub = $submenu->fetch_object()) {
                                        $sqlChk = "SELECT SubId FROM user_level WHERE UserLevelId = '$searchId' AND '$sys_sub->MenuId' IN($user_level_sub_id_list)";

                                        $user_level = findValue($sqlChk);

                                        if ($user_level != '') {
                                            $checked = 'checked = "checked"';
                                        } else {
                                            $checked = '';
                                        }
                                        ?>
                                        <li> 
                                            <input type="checkbox" name="sub_menu[]"  value="<?php echo $sys_sub->MenuId; ?>" <?php echo $checked; ?> />
                                            <?php echo $sys_sub->Name; ?> 

                                            <ul>
                                                <?php
                                                $submenu_sub = query("SELECT MenuId, `Name` FROM sys_menu WHERE `Show` = '1' AND SubId ='$sys_sub->MenuId'");
                                                if (mysqli_num_rows($submenu_sub) > 0) {
                                                    while ($sys_sub_sub = $submenu_sub->fetch_object()) {
                                                        $sqlChk = "SELECT SubId FROM user_level WHERE UserLevelId = '$search_id' AND '$sys_sub_sub->MenuId' IN($user_level_sub_id_list)";

                                                        $user_level = findValue($sqlChk);

                                                        if ($user_level != '') {
                                                            $checked = 'checked = "checked"';
                                                        } else {
                                                            $checked = '';
                                                        }
                                                        ?>
                                                        <li> <input type="checkbox" name="sub_menu[]"  value="<?php echo $sys_sub_sub->MenuId; ?>" <?php echo $checked; ?> >
                                                            <?php
                                                            echo $sys_sub_sub->Name;
                                                        }
                                                        ?>


                                                </ul>

                                                <?php
                                            }
                                        }
                                        ?> 

                                    </li>
                                </ul>

                            <li>

                                <?php
                            }
                        }
                        ?>
                </ul>

                <div class="form-actions">
                    <button type="submit" name="save" value="SaveSysMenu" class="btn btn-primary">Save</button>
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



