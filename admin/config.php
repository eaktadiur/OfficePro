<?php 
include_once './db-settings.php';
include_once '../body/header.php';
$Result=query('SELECT FirstName, LastName FROM employee');

?>
<table class='table table-striped table-bordered bootstrap-datatable datatable'>
    <thead>
        <th width='30'>S/N</th>
	<th>Name <i class='icon-filter'></i></th>
        <th width='90'>Action</th>
    </thead>
    <tbody>
        <?php 
        while ($row = $Result->fetch_object()) { ?>
        <tr>
            <td><?php echo ++$i; ?></td>
            <td><?php echo $row->FirstName; ?></td>
            <td class='center'>
            <?php
            viewIcon("requisition_view.php?searchId=" . encodeSearchId($row->RequisitionId));
            editIcon("#");
            deleteIcon("#");
            ?>
        </td>
	</tr>
    <?php } ?>
    </tbody>
</table>