<?php
// open session
require("session.php");

if (isset($_GET["error_id"]))
	$error_id = $_GET["error_id"];
else
	$error_id = 0;

switch($error_id)
	{
	case 1:
		$error_msg = "No Data (please submit from form)";
		break;
	case 2:
		$error_msg = "Invalid Quantity (must be numeric)";
		break;
	case 3:
		$error_msg = "Invalid Index (item doesnt exist)";
		break;
	case 4:
		$error_msg = "ShopCart is empty";
		break;
	default:
		$error_msg = "Unspecified error";
	}

?>
<html>
<body>
<p><a href="index.php">Back to Main</a> </p>
<p>Error: <?php echo $error_msg ?></p>
</body>
</html>