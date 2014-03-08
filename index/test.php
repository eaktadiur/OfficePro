<style type="text/css" title="currentStyle" media="print">
    @import "../../Public/jqueryslidemenu.css";
</style>
<script type="text/javascript" charset="utf-8" src="../../Public/jqueryslidemenu.js"></script>

<?php
include_once '../../DBManager/AppConfig.php';
include_once '../../DBManager/paths.php';
include_once '../../DBManager/Session.php';

Session::init();

Session::getMenu(Session::get('user'))
?>

