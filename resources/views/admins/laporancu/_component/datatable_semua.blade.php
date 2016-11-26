<script>
//    new $.fn.dataTable.FixedColumns( table, {
//        leftColumns : 1
//    } );
    var table = $('#dataTables-all').DataTable({
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
        },
        fnInitComplete:function(){
            $('.dataTables_scrollBody').perfectScrollbar();
        },
        fnDrawCallback: function( oSettings ) {
            $('.dataTables_scrollBody').perfectScrollbar('destroy').perfectScrollbar();
        }
    });

    $('#searchtext').keyup(function(){
        table.search($(this).val()).draw() ;
    });

    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    new $.fn.dataTable.Buttons(table,{
        buttons: [
            {
                extend:'colvis',
                columns: ':not(:contains(#))',
                text: '<i class="fa fa-table"></i>'
            },
            {
                extend:'colvisGroup',
                text: 'Semua',
                show: ':hidden'
            },
            @if(!Request::is('admins/laporancu/index_cu/*'))
                {
                    extend: 'colvisGroup',
                    text: ' Anggota',
                    show: [ 0,1,2,6,7,8,9,10,11 ],
                    hide: [ 3,4,5,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'SHU',
                    show: [ 0,1,2,6,12,26,27,28 ],
                    hide: [ 3,4,5,7,8,9,10,11,13,14,15,16,17,18,19,20,21,22,23,24,25,29,30 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'Piutang',
                    show: [ 0,1,2,6,18,19,20,21,22,23 ],
                    hide: [ 3,4,5,7,8,9,10,11,12,13,14,15,16,17,24,25,26,27,28,29,30 ]
                },
            @else
                {
                    extend: 'colvisGroup',
                    text: 'Anggota',
                    show: [ 0,1,2,3,4,5,6,7 ],
                    hide: [ 8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26]
                },
                {
                    extend: 'colvisGroup',
                    text: 'SHU',
                    show: [ 0,1,2,8,22,23,24 ],
                    hide: [ 3,4,5,6,7,9,10,11,12,13,14,15,16,17,18,19,21,25,26 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'Piutang',
                    show: [ 0,1,2,14,15,16,17,18,19 ],
                    hide: [ 3,4,5,6,7,8,9,10,11,12,13,20,21,22,23,24,25,26 ]
                },
            @endif
        ]
    });
    table.buttons( 0, null ).container().prependTo(
            table.table().container()
    );

    new $.fn.dataTable.Buttons(table,{
        buttons: [
            {
                text: '<i class="fa fa-plus"></i> <u>T</u>ambah',
                key: {
                    altKey: true,
                    key: 't'
                },
                action: function(){
                    window.location.href = "{{URL::to('admins/'.$kelas.'/create')}}";
                }
            },
            {
                text: '<i class="fa fa-pencil"></i> <u>U</u>bah',
                key: {
                    altKey: true,
                    key: 'u'
                },
                action: function(){
                    var id = $.map(table.rows({ selected: true }).data(),function(item){
                        return item[1];
                    });
                    var kelas = "{{ $kelas }}";
                    if(id != ""){
                        window.location.href =  "/admins/" + kelas + "/" + id + "/edit";
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            },
            {
                text: '<i class="fa fa-trash"></i> <u>H</u>apus',
                key: {
                    altKey: true,
                    key: 'h'
                },
                action: function(){
                    var id = $.map(table.rows({ selected:true }).data(),function(item){
                        return item[1];
                    });
                    if(id != ""){
                        $('#modalhapus').modal({show:true});
                        $('#modalhapus_judul').text('Hapus Data Perkembangan CU');
                        $('#modalhapus_detail').text('Hapus Data Perkembangan CU');
                        $('#modalhapus_id').attr('value',id);
                    }else{
                        $('#modalwarning').modal({show:true});
                    }
                }
            }
        ]
    });
    table.buttons( 0, null ).container().prependTo(
            table.table().container()
    );

    new $.fn.dataTable.Buttons(table,{
        buttons: [
            @if(!Request::is('admins/perkembangancu/index_cu/*'))
            {
                text: '<i class="fa fa-database"></i> Detail',
                action: function(){
                    var id = $.map(table.rows({ selected: true }).data(),function(item){
                        return item[3];
                    });
                    var kelas = "{{ $kelas }}";
                    if(id != ""){
                        window.location.href = "/admins/" + kelas + "/index_cu/" + id ;
                    }
                }
            }
            @endif
        ]
    });
    table.buttons( 0, null ).container().prependTo(
            table.table().container()
    );

    new $.fn.dataTable.Buttons(table,{
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
    table.buttons( 0, null ).container().prependTo(
            table.table().container()
    );
</script>