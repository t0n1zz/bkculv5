var table = $('#dataTables-example').DataTable({
    dom: 'Bti',
    scrollY: '70vh',
    autoWidth: true,
    scrollCollapse : true,
    paging : false,
    stateSave : false ,
    select: {
        style:    'os',
        selector: 'td:not(:last-child)'
    },
    responsive:{
        details:{
            type: 'column',
            target: -1
        }
    },
    columnDefs: [ {
        className: 'control',
        orderable: false,
        targets:   -1
    }],
    buttons: [
        {
            extend:'colvis',
            text: '<i class="fa fa-table"></i>'
        },
        {
            extend:'colvisGroup',
            text: 'Semua',
            show: ':hidden'
        }
    ],
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

table.columns('.sort').order('asc').draw();

$('#searchtext').keyup(function(){
    table.search($(this).val()).draw() ;
});