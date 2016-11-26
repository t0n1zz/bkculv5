<script>
    var table4 = $('#dataTables-total').DataTable({
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
            },
            {
                extend: 'colvisGroup',
                text: 'Anggota',
                show: [ 0,1,2,3,4,5 ],
                hide: [ 6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22 ]
            },
            {
                extend: 'colvisGroup',
                text: 'SHU',
                show: [ 0,20,21,22 ],
                hide: [ 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19 ]
            },
            {
                extend: 'colvisGroup',
                text: 'Piutang',
                show: [ 0,6,12,13,14,15,16,17 ],
                hide: [ 1,2,3,4,5,7,8,9,10,11,18,19,20,21,22 ]
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