<script>
    var table3 = $('#dataTables-provinsi').DataTable({
        dom: 'Bti',
        select: true,
        scrollY : '80vh',
        scrollX: true,
        autoWidth: true,
        scrollCollapse : true,
        paging : false,
        stateSave : false,
        order : [[ 1, 'asc']],
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
                show: [ 0,1,2,3,4,5,6,7 ],
                hide: [ 8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24 ]
            },
            {
                extend: 'colvisGroup',
                text: 'SHU',
                show: [ 0,1,2,8,22,23,24 ],
                hide: [ 3,4,5,7,6,9,10,11,12,13,14,15,16,17,18,19,20,21 ]
            },
            {
                extend: 'colvisGroup',
                text: 'Piutang',
                show: [ 0,1,2,14,15,16,17,18,19 ],
                hide: [ 3,4,5,6,7,8,9,10,11,12,13,20,21,22,23,24 ]
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
    $('#searchtextprov').keyup(function(){
        table3.search($(this).val()).draw() ;
    });

    table3.on( 'order.dt search.dt', function () {
        table3.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    new $.fn.dataTable.Buttons(table3,{
        buttons: [
            {
                extend:'excelHtml5',
                text: '<i class="fa fa-download fa-fw"></i> Download Excel',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ]
    });
    table3.buttons( 0, null ).container().prependTo(
            table3.table().container()
    );
</script>