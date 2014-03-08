<?php
include_once '../../DBManager/AppConfig.php';
include_once '../../DBManager/paths.php';
include_once '../../DBManager/Session.php';
include_once '../../DBManager/standard_function.php';



Session::init();
$companyid = Session::get('company');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

        <style type="text/css" title="currentStyle" media="screen">
            @import "../../Public/Site.css";
            @import "../../Public/TableTools-2.0.2/media/css/TableTools.css";
            @import "../../Public/DataTables/media/css/demo_table_jui.css";
            @import "../../Public/DataTables/media/css/demo_page.css";
            @import "../../Public/DataTables/media/css/demo_table.css";
            @import "../jquery-ui-1.10.3/css/smoothness/jquery-ui-1.10.3.custom.min.css";
            @import "../../Public/ColVis/media/css/ColVisAlt.css";
            @import "../../Public/jqueryslidemenu.css";
        </style>

        <style type="text/css" title="currentStyle" media="print">
            @import "../../Public/Print.css";
            @import "../../Public/Site.css";
            @import "../../Public/TableTools-2.0.2/media/css/TableTools.css";
            @import "../../Public/DataTables/media/css/demo_table_jui.css";
            @import "../../Public/DataTables/media/css/demo_page.css";
            @import "../../Public/DataTables/media/css/demo_table.css";
            @import "../jquery-ui-1.10.3/css/smoothness/jquery-ui-1.10.3.custom.min.css";
            @import "../../Public/ColVis/media/css/ColVisAlt.css";
            @import "../../Public/jqueryslidemenu.css";
        </style>

        <script type="text/javascript" charset="utf-8" src="../../Public/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/JQuery-DataTables-Editable-1.3/media/js/jquery.dataTables.editable.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/JQuery-DataTables-Editable-1.3/media/js/jquery.jeditable.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/DataTables/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/TableTools-2.0.2/media/js/ZeroClipboard.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/TableTools-2.0.2/media/js/TableTools.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/jquery-ui/js/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/jquery.dataTables.columnFilter.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/ColVis/media/js/ColVis.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/jquery.ui.combobox.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/jqueryslidemenu.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/Header_Jquery.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/jquery.fancybox-1.2.1.pack.js"></script>
        <script type="text/javascript" charset="utf-8" src="../../Public/js/jquery.validate.min.js"></script>

        <title>My ERP Project</title>

    </head>


    <body> 

        <div class="HeaderSection">
            <?php if (Session::get('loggedIn') == FALSE) { ?>
                <!-- Login Starts Here -->
                <div id="loginContainer">
                    <a href="#" id="loginButton"><span>Login</span><em></em></a>
                    <div style="clear:both"></div>
                    <div id="loginBox">                
                        <form id="loginForm" action="login.php" method="post" class="form">
                            <fieldset id="body">

                                <fieldset>
                                    <label for="companyId">LogIn Name</label>
                                    <?php
                                    include '../../MyProject_DAL/Company_DAL.php';
                                    $company = new Company_DAL();
                                    $CompanyList = $company->CompanyList();
                                    ?>

                                    <select name="company" id="companyId"> 
                                        <option></option>
                                        <?php
                                        foreach ($CompanyList as $key => $value) {
                                            echo "<option value='$value[GroupID]'>$value[Name]</option>";
                                        }
                                        ?>
                                    </select>
                                </fieldset>
                                <fieldset>
                                    <label for="email">LogIn Name</label>
                                    <input type="text" name="login" id="email" />
                                </fieldset>
                                <fieldset>
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" />
                                </fieldset>
                                <input type="submit" id="login" value="Sign in" />
                                <label for="checkbox"><input type="checkbox" id="checkbox" />Remember me</label>
                            </fieldset>
                            <span><a href="#">Forgot your password?</a></span>
                        </form>
                    </div>
                </div>
                <!-- Login Ends Here -->
            <?php } ?>

            <div id="Logo"><a href='<?php echo URL; ?>'><h1>Eaktadiur's Lab</h1></a></div>

            <div id="login">
                <?php if (Session::get('loggedIn') == TRUE) { ?>
                    Welcome: <?php
                    if (Session::get('user')) {
                        echo Session::get('user');
                    } else {
                        echo 'Guest';
                    }
                    ?><br/>
                    <?php
                }
                if (Session::get('loggedIn') == TRUE) {
                    ?>
                    <a href='<?php echo URL; ?>Myproject_UI/Index/login_out.php?id=1'>Logout</a>
                <?php } ?>
            </div>

            <?php if (Session::get('loggedIn') == TRUE): ?>

                <div id="myslidemenu" class="jqueryslidemenu">
                    <?php Session::getMenu(Session::get('user')) ?>
                </div>
            <?php endif; ?>

            <div id="menu_space"></div>
        </div>
        <div id="body">


