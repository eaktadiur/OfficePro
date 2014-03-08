<?php
include '../lib/db-settings.php';
include '../body/header.php';
?>

<script type="text/javascript">
    $(document).ready(function() {
$('#Search').filterable();

        $('#SearchResults').dataTable({
            "bJQueryUI": true,
            //"bProcessing": true,
            "sDom": 'T<"clear">lfrtip',
            "bServerSide": true,
            "sAjaxSource": "datable_server_1.json",
            "sServerMethod": "POST",
            "sPaginationType": "bootstrap",
            "bStateSave": true

        });
        
        

        $('#Search').dataTable({
            "bJQueryUI": true,
            "bProcessing": true,
            "bServerSide": true,
            "bRetrieve": true,
            "iDisplayLength": 10,
            //"sScrollX": "100%",
            "sAjaxSource": "datable_server.json",
            "sServerMethod": "POST",
            "aoColumns": [
                {"mData": "engine"},
                {"mData": "browser"},
                {"mData": "platform"},
                {"mData": "version"},
                {"mData": "grade"}
            ],
            "aoColumnDefs": [{
                    "aTargets": [0],
                    "mData": "engine",
                    "mRender": function(data, type, full) {
                        return '<a href="?' + data + '">Download</a>';
                    }
                }]

        });
    });
</script>


<table id='SearchResults' class="display tables">
    <thead>
    <th>Rendering engine</th>
    <th>Browser <i class="icon-filter"></i></th>
    <th>Platform(s)</th>
    <th>Engine version</th>
    <th>CSS grade</th>
</thead>
<tbody>
    <tr>
      <td colspan="5" class="dataTables_empty">Loading data from server</td>
    </tr>
</tbody>
</table>
<br><br><br>
<hr>
<table id='Search' class="display">
    <thead>
    <th>Rendering engine</th>
    <th>Browser</th>
    <th>Platform(s)</th>
    <th>Engine version</th>
    <th>CSS grade</th>
</thead>
<tbody>

</tbody>
</table>

<?php include '../body/footer.php'; ?>