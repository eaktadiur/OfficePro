<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <title>Office Pro</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
        <meta name="author" content="Schoolify">
        <link rel='shortcut icon' type='image/x-icon' href='../public/images/favicon.ico'/>

        <!-- The styles -->
        <link id="bs-css" href="../public/css/bootstrap-redy.css" rel="stylesheet"/>
        <link id="bs-css" href="../public/css/site.css" rel="stylesheet"/>
        <link href="../public/css/bootstrap-responsive.css" rel="stylesheet"/>
        <link href="../public/css/charisma-app.css" rel="stylesheet"/>
        <link href="../public/css/jquery-ui-1.8.21.custom.css" rel="stylesheet"/>
        <link href='../public/css/fullcalendar.css' rel='stylesheet'/>
        <link href='../public/css/fullcalendar.print.css' rel='stylesheet'  media='print'/>
        <link href='../public/css/chosen.css' rel='stylesheet'/>
        <link href='../public/css/uniform.default.css' rel='stylesheet'/>
        <link href='../public/css/colorbox.css' rel='stylesheet'/>
        <link href='../public/css/jquery.cleditor.css' rel='stylesheet'/>
        <link href='../public/css/jquery.noty.css' rel='stylesheet'/>
        <link href='../public/css/noty_theme_default.css' rel='stylesheet'/>
        <link href='../public/css/elfinder.min.css' rel='stylesheet'/>
        <link href='../public/css/elfinder.theme.css' rel='stylesheet'/>
        <link href='../public/css/jquery.iphone.toggle.css' rel='stylesheet'/>
        <link href='../public/css/opa-icons.css' rel='stylesheet'/>
        <link href='../public/css/uploadify.css' rel='stylesheet'/>

        <link href='../public/DataTables-1.9.4/media/css/jquery.dataTables.css' rel="stylesheet" type="text/css" />
        <!--<link href='../public/DataTables-1.9.4/extras/TableTools/media/css/TableTools.css' rel='stylesheet'/>-->
        <link href='../public/DataTables-1.9.4/media/css/jquery.dataTables_themeroller.css' rel="stylesheet" type="text/css" />

        <link href="../public/css/default.css" rel="stylesheet" type="text/css" />
        <link href="../public/css/component.css" rel="stylesheet" type="text/css" />
        <link href="../public/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
        <link href="../public/css/bootstrap-editable.css" rel="stylesheet">
        <link href="../public/css/bootstrap-filterable.css" rel="stylesheet" type="text/css" />
        <link href="../public/css/DT_bootstrap.css" rel="stylesheet" type="text/css" />


        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- The fav icon -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <script src="../public/js/jquery.js"></script>
    </head>

    <body>
        <?php if ($userName) { ?>
            <!-- topbar starts -->
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a class="brand" href="../index.php"> <img alt="Colbert/Ball Tax Services" src="../public/images/logo.png" /></a>


                        <!-- user dropdown starts -->
                        <div class="btn-group pull-right" >
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-user"></i><span class="hidden-phone"><?php echo $userName . ' ' . $companyCode; ?></span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="../common/user_settings.php">Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="../common/logout.php?logout=true">Logout</a></li>
                            </ul>
                        </div>
                        <!-- user dropdown ends -->


                    </div>
                </div>
            </div>
            <!-- topbar ends -->
        <?php } ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php if ($userName) { ?>
                    <!-- left menu starts -->
                    <div class="span2 main-menu-span">
                        <div class="well nav-collapse sidebar-nav">
                            <ul class="nav nav-tabs nav-stacked main-menu">
                                <li class="nav-header hidden-tablet">Main</li>
                                <?php getMenu($userName); ?>
                            </ul>
                        </div><!--/.well -->
                    </div><!--/span-->
                    <!-- left menu ends -->
                <?php } ?>
                <div id="content" class="span10">
                    <!-- content starts -->
                    <?php //} ?>
