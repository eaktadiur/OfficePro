<table  class="table table-striped table-bordered bootstrap-datatable">
    <tr>
        <td width="120">PR No :  </td>
        <td><?php echo OrderNo(1); ?></td >
        <td width="120">Requisition From :</td>
        <td><?php echo $var->FirstName . ' ' . $var->LastName . ' (' . $userName . ')'; ?></td>
    </tr>
    <tr>
        <td>Requisition Date :</td>
        <td><?php echo bddate(date('Y-d-m')); ?></td>
        <td></td>
        <td><?php // echo user_location(1); ?></td>
    </tr>
</table>
<hr>
