$(document).ready(function() {
    $('.datatables').dataTable({
        "bJQueryUI": true,
        "sDom": 'T<"clear"><"H"lfr>t<"F"ip>',
        "bPaginate": true,
        "iDisplayLength": 20,
        "sPaginationType": "full_numbers"
        


    });
});

