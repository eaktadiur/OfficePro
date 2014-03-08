<?php
include '../lib/db-settings.php';
include '../body/header.php';


$list = getEmployeeByCompanyId($companyId);

while ($row = $list->fetch_assoc()) {
    $a[$row['employeeId']] = $row['FirstName'];
}
$selectedValues = array(1, 3, 5);

$searchId = 50;
$userId = 'hasan';

$array = array(
    'company' => "CompanyId", // Table & Primary Key
    "$searchId" => "$userId", // Table & Primary Key
    'Name' => "Name",
    'Address1' => "Address1",
    'Address2' => "Address2",
    'ZipCode' => "ZipCode",
    'Phone' => "Phone",
    'Fax' => "Fax",
    'Email' => "Email",
    'IsActive' => "IsActive"
);



if ($_POST) {
    saveTable($array);
    echo "<br>";
    updateTable($array);
    echo "<br>";
    deleteTable($array);
}
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.bootstrap-multiple').multiselect();
    });
</script>
<table>
    <tr>
        <td>
            <select class="bootstrap-multiple" multiple="multiple">
                <option value="cheese" selected>Cheese</option>
                <option value="tomatoes" selected>Tomatoes</option>
                <option value="mozarella" selected>Mozzarella</option>
                <option value="mushrooms">Mushrooms</option>
                <option value="pepperoni">Pepperoni</option>
                <option value="onions">Onions</option>
            </select>
        </td>
        <td>
            <select class="bootstrap-multiple" multiple="multiple">
                <?php
                foreach ($a as $key => $value) {
                    $selected = in_array($key, $selectedValues) ? 'selected ' : '';
                    echo '<option ' . $selected . 'value="' . $key . '">' . $value . '</option>';
                }
                ?>
            </select>

        </td>
    </tr>
</table> 

<!--    <form action="" method="POST">
        <input type="text" name="Name"/>
        <input type="text" name="Address1"/>
        <input type="text" name="Address2"/>
        <input type="text" name="ZipCode"/>
        <input type="text" name="Phone"/>
        <input type="text" name="Fax"/>
        <input type="text" name="Email"/>
        <input type="text" name="IsActive"/>
        <button type="submit" name="s">Submit</button>
    </form>-->
<?php include '../body/footer.php'; ?>
