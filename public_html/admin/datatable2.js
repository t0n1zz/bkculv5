var table2 = $('#dataTables-example2').DataTable({
    dom: 'Bti',
    select: true,
    scrollY: '70vh',
    scrollX: true,
    autoWidth: true,
    scrollCollapse : true,
    paging : false,
    stateSave : false,
    order : [],
    buttons: [],
    language: {
        buttons : {},
        select:{
            rows:{
                _: "",
                0: "",
                1: ""
            }
        },
        "sProcessing":   "Sedang proses...",
        "sLengthMenu":   "Tampilan _MENU_ entri",
        "sZeroRecords":  "Tidak ditemukan data yang sesuai",
        "sInfo":         "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
        "sInfoEmpty":    "Tampilan 0 hingga 0 dari 0 entri",
        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
        "sInfoPostFix":  "",
    }
});

table2.on( 'order.dt search.dt', function () {
    table2.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();

$('#searchtext2').keyup(function(){
    table2.search($(this).val()).draw() ;
});

