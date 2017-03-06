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
        order : [[ 8, 'desc']],
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
            @if(Request::is('admins/laporancu/index_hapus') || Request::is('admins/laporancu/index_cu*'))

            @else
                {
                    extend: 'colvisGroup',
                    text: ' Anggota',
                    show: [ 0,1,2,3,4,8,9,10,11,12,13 ],
                    hide: [ 5,6,7,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'SHU',
                    show: [ 0,1,2,3,4,8,14,28,29,30 ],
                    hide: [ 5,6,7,9,10,11,12,13,15,16,17,18,19,20,21,22,23,24,25,26,27,31,32 ]
                },
                {
                    extend: 'colvisGroup',
                    text: 'Piutang',
                    show: [ 0,1,2,3,4,8,20,21,22,23,24,25 ],
                    hide: [ 5,6,7,9,10,11,12,13,14,15,16,17,18,19,26,27,28,29,30,31,32 ]
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

    $('#searchtext').keyup(function(){
        table.search($(this).val()).draw() ;
    });

    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();


    @if(Request::is('admins/laporancu/index_hapus') || Request::is('admins/laporancu/index_cu*'))
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                @permission('update.laporancu_update')
                {
                    text: '<i class="fa fa-check"></i> Pulihkan',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[1];
                        });
                        if(id != ""){
                            $('#modalpulih').modal({show:true});
                            $('#modalpulih_id').attr('value',id);
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                {
                    text: '<i class="fa fa-database"></i> Detail',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[1];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href = "/admins/" + kelas + "/detail/" + id ;
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
    @else
        new $.fn.dataTable.Buttons(table,{
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
                @endpermission
                @permission('destroy.laporancu_destroy')
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
                            $('#modalhapus_judul').text('Hapus Laporan CU');
                            $('#modalhapus_detail').text('Hapus Laporan CU');
                            $('#modalhapus_id').attr('value',id);
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                {
                    text: '<i class="fa fa-database"></i> Detail',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[1];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href = "/admins/" + kelas + "/detail/" + id ;
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
                @permission('upload.laporancu_upload')
                {
                    text: '<i class="fa fa-upload fa-fw"></i> Upload Excel',
                    action: function(){
                        $('#modalexcel').modal({show:true});
                    }
                },
                @endpermission
                {
                    extend:'excelHtml5',
                    text: '<i class="fa fa-download fa-fw"></i> Download Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );    
    @endif    
</script>