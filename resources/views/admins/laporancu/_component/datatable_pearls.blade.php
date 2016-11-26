<script>
    var table4 = $('#dataTables-pearls').DataTable({
        dom: 'Bti',
        select: true,
        scrollY : '80vh',
        scrollX: true,
        autoWidth: true,
        scrollCollapse : true,
        paging : false,
        stateSave : false,
        order : [],
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
        },
        fnInitComplete:function(){
            $('.dataTables_scrollBody').perfectScrollbar();
        },
        fnDrawCallback: function( oSettings ) {
            $('.dataTables_scrollBody').perfectScrollbar('destroy').perfectScrollbar();
        }
    });
    $('#searchtextpearls').keyup(function(){
        table4.search($(this).val()).draw() ;
    });

    table4.on( 'order.dt search.dt', function () {
        table4.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    new $.fn.dataTable.Buttons(table4,{
        buttons: [
            {
                extend:'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend:'print',
                text: '<i class="fa fa-print"></i> Print',
                exportOptions: {
                    stripHtml: false,
                    columns: ':visible'
                }
            }
        ]
    });
    table4.buttons( 0, null ).container().prependTo(
            table4.table().container()
    );
</script>