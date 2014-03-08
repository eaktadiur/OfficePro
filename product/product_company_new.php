<?php
// open session
require_once '../lib/db-settings.php';
include '../body/header.php';



// open shopcart library
require("../ShopCart/shopcart.php");
$shopcart = get_shopcart();
$listSQL= "SELECT CompanyId, Name FROM company ORDER BY Name";
$companyList = rs2array($listSQL);
$UserName = 1;
$CreatedDate = date('Y-m-d');
$company=getParam('company');


//echo $productList;
if($_POST){
//    echo "<pre>";
//    print_r($_POST); 
    
    $checkedProduct = getParam('chk');
    $PricedProduct = getParam('price');
   foreach($checkedProduct AS $keys =>$ProductID){
        foreach ($PricedProduct AS $key =>$priceValue){
            if($keys==$key){
            $SQLInsert="INSERT INTO company_product (CompanyId, ProductId, Price, CreatedBy, CreatedDate) "
                    . "VALUES('$company', '$keys', '$priceValue', '$UserName', '$CreatedDate')";
            query($SQLInsert);
            }
        }
  }
    
   //die(); 
    
}




$productList = getAllProducts();
?>

<style type="text/css">
    .input {
        width: 80px;
    }
</style>
<!--action="../ShopCart/addtocart.php"--> 
<!--<a href="requisition_new.php" class="button">Show Shop Cart Details</a>-->
<form name="shopcart" method="post">
    <table class="productGrid">
        <thead>
            <tr>
                <th>SL</th>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $sl = 0;
            while ($row = $productList->fetch_object()) {
                ?>
                <tr>
                    <td valign="top" width="25"><?php echo ++$sl; ?>.</td>
                    <td valign="top" width="200"><?php echo $row->Code; ?>
                        <input name="item_code[<?php echo $row->ProductId; ?>]" type="hidden" id="item_code" value="<?php echo $row->Code; ?>">
                    </td>
                    <td valign="top"><?php echo $row->Name; ?>
                        <input name="description[<?php echo $row->ProductId; ?>]" type="hidden" id="description" value="<?php echo $row->Name; ?>">
                    </td>
                    <td valign="top"><input name="price[<?php echo $row->ProductId; ?>]" type="text" class="input" id="quantity" value="1" size="5"></td>
                    <td valign="top" width="30"><input type="checkbox" name="chk[<?php echo $row->ProductId; ?>]" value="<?php echo $row->ProductId; ?>"/></td>
                </tr>

                <?php
            }
            ?>
                
        </tbody>
    </table>
    <br />
    <table>
        <tr><th width="300">Assign to: </th><td><?php comboBox('company',$companyList,$company,TRUE);?></td></tr>
    </table>
    <input type="submit" name="Submit" value="Assign product to company">

</form>
<?php include '../body/footer.php'; ?>