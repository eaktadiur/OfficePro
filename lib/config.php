<?php
include_once '../lib/db-settings.php';
include_once '../body/header.php';
$Result = query('SELECT EmployeeId, FirstName, LastName FROM employee');
?>
<table class='table table-striped table-bordered bootstrap-datatable datatable'>
    <thead>
        <tr>
            <th width='30'>S/N</th>
            <th>Name <i class='icon-filter'></i></th>
            <th width='90'>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $Result->fetch_object()) { ?>
            <tr>
                <td><?php echo ++$i; ?></td>
                <td><?php echo $row->FirstName; ?></td>
                <td class='center'>
                    <?php
                    viewIcon("requisition_view.php?searchId=" . encodeSearchId($row->EmployeeId));
                    editIcon("#");
                    deleteIcon("#");
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>