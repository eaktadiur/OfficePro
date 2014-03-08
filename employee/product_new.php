<?php
// open session
include_once '../lib/db-settings.php';
include '../body/header.php';
// open shopcart library
require("../ShopCart/shopcart.php");

// read shopcart
$shopcart = get_shopcart();
// show only if shopcart is not empty
if (count($shopcart) > 0) {
    ?>
    <p>
        <a href="../ShopCart/clearshopcart.php" class="btn">Clear Product List</a>
        <a href="../ShopCart/checkout.php" class="btn">Check Out</a>
    </p>
    <?php
}
$var = getEmployeeById(1);
?>





<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="index.php">Requisition List</a>
            </h3>
        </div>
        <div class="box-content">
            <?php include './requisition_header.php'; ?>
            <a href="product_search.php" class="btn btn-danger">Add Product</a>
            <table class="productGrid">
                <thead>
                    <tr>
                        <th width="30">S/N</th>
                        <th>Item Code </th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Remark</th>
                        <!--<th>Total</th>-->
                        <th width="100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($shopcart) > 0) {
                        $index = 0;
                        foreach ($shopcart as $item) {
                            ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $item[1]; ?></td>
                                <td><?php echo $item[2]; ?></td>
                                <td><?php echo $item[3]; ?></td>
                                <td><?php echo $item[4]; ?></td>
                                <!--<td><?php echo $item[5]; ?></td>-->
                                <td><a href="../ShopCart/updatecart.php?index=<?php echo $index; ?>">Edit</a> | <a href="../ShopCart/deletefromcart.php?index=<?php echo $index; ?>">Delete</a></td>
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
                    <tr>
                        <td valign="top">Remark:</td>
                        <td colspan="5"><textarea name="remark" style="width: 100%;" class=""></textarea></td>
                    </tr>  
                </tbody>
            </table>

            <?php file_upload_html(TRUE); ?>

            <br/>
            <button type="submit" class="btn btn-danger">Submit</button>
        </div>
    </div><!--/span-->

</div>	












<?php include '../body/footer.php'; ?>