<script>
    var table_konsolidasi = $('#dataTables-konsolidasi').DataTable({
        dom: 'Bti',
        select: true,
        scrollY : '80vh',
        scrollX: true,
        autoWidth: true,
        scrollCollapse : true,
        paging : false,
        stateSave : false,
        order : [[ 1, 'desc']],
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
            @if(Request::is('admins/laporancu/index_cu/*'))
                {
                    extend: 'colvisGroup',
                    text: 'Anggota',
                    show: [ 0,1,2,3,4,5,6, ],
                    hide: [ 7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'SHU',
                    show: [ 0,1,7,21,22,23],
                    hide: [ 2,3,4,5,6,8,9,10,11,12,13,14,15,16,17,18,19,20,24,25 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'Piutang',
                    show: [ 0,1,13,14,15,16,17,18],
                    hide: [ 2,3,4,5,6,7,8,9,10,11,12,19,20,21,22,23,24,25 ]
                }
            @else
                {
                    extend: 'colvisGroup',
                    text: 'Anggota',
                    show: [ 0,1,2,3,4,5,6,7,8 ],
                    hide: [ 9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'SHU',
                    show: [ 0,1,2,3,23,24,25 ],
                    hide: [ 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'Piutang',
                    show: [ 0,1,2,3,9,15,16,17,18,19,20 ],
                    hide: [ 4,5,6,7,8,10,11,12,13,14,21,22,23,24,25 ]
                }
            @endif
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
    $('#searchtextkonsolidasi').keyup(function(){
        table_konsolidasi.search($(this).val()).draw() ;
    });

    table_konsolidasi.on( 'order.dt search.dt', function () {
        table_konsolidasi.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    new $.fn.dataTable.Buttons(table_konsolidasi,{
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
    table_konsolidasi.buttons( 0, null ).container().prependTo(
            table_konsolidasi.table().container()
    );
</script>
