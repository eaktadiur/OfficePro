<table  class="table table-striped table-bordered bootstrap-datatable">
    <tr>
        <td width="120">PR No :  </td>
        <td><?php echo OrderNo(1); ?></td >
        <td width="120">Staff Member :</td>
        <td><?php echo $var->FirstName . ' ' . $var->LastName . ' (' . $userName . ')'; ?></td>
    </tr>
    <tr>
        <td>Requisition Date :</td>
        <td><?php echo bddate(date('Y-d-m')); ?></td>
        <td>Location :</td>
        <td><?php // echo user_location(1); ?></td>
    </tr>
    <tr>
        <td>Created by :</td>
        <td><?php echo $userName; ?></td>
        <td>Process Dept : </td>
        <td><?php // echo $RquisitionType; ?></td>
    </tr>                    
</table>
<hr>
