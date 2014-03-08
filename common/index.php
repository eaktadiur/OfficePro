<?php
require_once("../lib/db-settings.php");



//Forms posted
if (!empty($_POST)) {
    login();
}
$no_visible_elements = true;
include('../body/header.php');

?>

<div class="row-fluid">
    <div class="span12 center login-header">
        <h2>Welcome to Office Pro</h2>
    </div><!--/span-->
</div><!--/row-->

<div class="row-fluid">
    <div class="well span5 center login-box">
        <div class="alert alert-info">
            login with your Company Code, User Name and Password.
        </div>
        <?php //echo resultBlock($errors, $successes);  ?>
        <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <fieldset>
                <div class="input-prepend" title="Company Code"  data-rel="tooltip">
                    <span class="add-on"><i class="icon-user"></i></span>
                    <input autofocus class="input-large span10" name="company" id="company" type="text" placeholder="Company Code"/>
                </div>
                <div class="clearfix"></div>
                <div class="input-prepend" title="User Name" data-rel="tooltip">
                    <span class="add-on"><i class="icon-user"></i></span>
                    <input class="input-large span10" name="username" id="username" type="text" placeholder="User Name"/>
                </div>
                <div class="clearfix"></div>

                <div class="input-prepend" title="Password" data-rel="tooltip">
                    <span class="add-on"><i class="icon-lock"></i></span>
                    <input class="input-large span10" name="password" id="password" type="password" placeholder="Password"/>
                </div>
                <div class="clearfix"></div>

                <div class="clearfix"></div>
                <p class="center span5">
                    <button type="submit" class="btn btn-primary">Login</button>
                </p>
                <p><a href="../common/forgot-password.php">Forgot Password</a></p>
            </fieldset>
        </form>
    </div><!--/span-->
</div><!--/row-->
