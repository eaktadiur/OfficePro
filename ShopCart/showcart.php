<?php
// open session
include_once '../lib/db-settings.php';
include '../body/header.php';
// open shopcart library
require("shopcart.php");

// read shopcart
$shopcart = get_shopcart();
// show only if shopcart is not empty
if (count($shopcart) > 0) {
    ?>
    <p>
        <a href="clearshopcart.php" class="button">Clear Product List</a>
        <a href="checkout.php" class="button">Check Out</a>
    </p>
    <?php
}
?>
<script type="text/javascript" src="../public/jquery-ui-1.10.3/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="../public/DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="../public/jquery-ui-1.10.3/css/smoothness/jquery-ui-1.10.3.custom.min.css"/>
<link rel="stylesheet" type="text/css" href="../public/DataTables-1.9.4/media/css/jquery.dataTables.css"/>
<link rel="stylesheet" type="text/css" href="../public/DataTables-1.9.4/media/css/demo_page.css"/>
<link rel="stylesheet" type="text/css" href="../public/DataTables-1.9.4/media/css/demo_table_jui.css"/>

<script type="text/javascript" src="header.js"></script>

<a href="index.php" class="btn">Product List</a>
<table id="productGrid">
    <thead>
        <tr>
            <th>Item Code </th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($shopcart) > 0) {
            $index = 0;
            foreach ($shopcart as $item) {
                ?>
                <tr>
                    <td><?php echo $item[0]; ?></td>
                    <td><?php echo $item[1]; ?></td>
                    <td><?php echo $item[2]; ?></td>
                    <td><?php echo $item[3]; ?></td>
                    <td><?php echo $item[4]; ?></td>
                    <td><a href="updatecart.php?index=<?php echo $index; ?>">Edit</a> | <a href="deletefromcart.php?index=<?php echo $index; ?>">Delete</a></td>
                </tr>
                <?php
                $index++;
            } // foreach($shopcart as $item)
        } // if (count($shopcart) > 0)
        else {
            ?>
            <tr>
                <td colspan="6">Shop Cart is Empty</td>
            </tr>
            <?php
        } // // if (count($shopcart) > 0) ... else
        ?>
    </tbody>
</table>
<?php include '../body/footer.php'; ?>