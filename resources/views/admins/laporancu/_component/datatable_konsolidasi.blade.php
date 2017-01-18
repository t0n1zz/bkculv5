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
        @if(Request::is('admins/laporancu/index_cu/*'))
            order : [[ 2, 'desc']],
        @else
            order : [[ 1, 'desc']],
        @endif
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
                    show: [ 0,1,2,3,4,5,6,7 ],
                    hide: [ 8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'SHU',
                    show: [ 0,1,2,8,22,23,24,25],
                    hide: [ 3,4,5,6,7,9,10,11,12,13,14,15,16,17,18,19,20,21,25,26 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'Piutang',
                    show: [ 0,1,2,14,15,16,17,18,19],
                    hide: [ 3,4,5,6,7,8,9,10,11,12,13,20,21,22,23,24,25,26 ]
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
                    show: [ 0,1,2,3,9,23,24,25 ],
                    hide: [ 4,5,6,7,8,10,11,12,13,14,15,16,17,18,19,20,21,22 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'Piutang',
                    show: [ 0,1,2,3,15,16,17,18,19,20 ],
                    hide: [ 4,5,6,7,8,9,10,11,12,13,14,21,22,23,24,25 ]
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

    @if(Request::is('admins/laporancu/index_cu/*'))
        new $.fn.dataTable.Buttons(table_konsolidasi,{
            buttons: [
                @permission('create.laporancu_create')
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
                @endpermission
                @permission('update.laporancu_update')
                {
                    text: '<i class="fa fa-pencil"></i> <u>U</u>bah',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        var id = $.map(table_konsolidasi.rows({ selected: true }).data(),function(item){
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
                @endpermission
                @permission('destroy.laporancu_destroy')
                {
                    text: '<i class="fa fa-trash"></i> <u>H</u>apus',
                    key: {
                        altKey: true,
                        key: 'h'
                    },
                    action: function(){
                        var id = $.map(table_konsolidasi.rows({ selected:true }).data(),function(item){
                            return item[1];
                        });
                        if(id != ""){
                            $('#modalhapus').modal({show:true});
                            $('#modalhapus_judul').text('Hapus Laporan CU');
                            $('#modalhapus_detail').text('Hapus Laporan CU');
                            $('#modalhapus_id').attr('value',id);
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
            ]
        });
        table_konsolidasi.buttons( 0, null ).container().prependTo(
                table_konsolidasi.table().container()
        );

        new $.fn.dataTable.Buttons(table_konsolidasi,{
            buttons: [
                @permission('upload.laporancu_upload')
                {
                    text: '<i class="fa fa-upload fa-fw"></i> Upload Excel',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        $('#modalexcel').modal({show:true});
                    }
                },
                @endpermission
            ]
        });
        table_konsolidasi.buttons( 0, null ).container().prependTo(
                table_konsolidasi.table().container()
        );

        new $.fn.dataTable.Buttons(table_konsolidasi,{
            buttons: [
                {
                    text: '<i class="fa fa-database"></i> Detail',
                    action: function(){
                        var id = $.map(table_konsolidasi.rows({ selected: true }).data(),function(item){
                            return item[1];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href = "/admins/" + kelas + "/detail/" + id ;
                        }
                    }
                }
            ]
        });
        table_konsolidasi.buttons( 0, null ).container().prependTo(
                table_konsolidasi.table().container()
        );

        new $.fn.dataTable.Buttons(table_konsolidasi,{
            buttons: [
                @if(!Request::is('admins/laporancu/index_cu/*'))
                {
                    text: '<i class="fa fa-database"></i> Detail',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[1];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href = "/admins/" + kelas + "/detail/" + id ;
                        }
                    }
                }
                @endif
            ]
        });
        table_konsolidasi.buttons( 0, null ).container().prependTo(
                table_konsolidasi.table().container()
        );
    @endif
        
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
