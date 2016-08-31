var table = $('#dataTables-example').DataTable({
    dom: 'Bti',
    select: true,
    scrollY: '80vh',
    scrollX: true,
    autoWidth: false,
    scrollCollapse : true,
    paging : false,
    stateSave : false,
    columnDefs: [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
    } ],
    order : [[ 0, "asc" ]],
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

$('#searchtext').keyup(function(){
    table.search($(this).val()).draw() ;
});
