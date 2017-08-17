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
        rowGroup:{
            endRender:function(rows,group){
                var nomor = [];
                for (i = 9; i < 31; i++){
                    nomor.push(i);
                }

                return $('<tr/>')
                    .append( '<td></td>' )
                    .append( '<td colspan="5" class="bg-aqua tdtotal text-right">TOTAL '+group+'</td>' )
                    .append( $.map(nomor, function(value,key){
                        var ttl=rows
                            .data()
                            .pluck(value)
                            .reduce(function(a,b){ 
                                const str = b.split(' ')[0];

                                return a + str.replace(/[^\d]/g,'') *1;
                            },0);   
                        return $( '<td class="bg-aqua disabled color-palette text-right" >'+$.fn.dataTable.render.number('.', ',', 0,).display( Math.abs(ttl) )+'</td>');
                    }))
                    .append( '<td colspan="2" class="bg-aqua disabled color-palette ">&nbsp;</td>' );
            },
            dataSrc: '0'
        },
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
                    hide: [ 5,6,7,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32 ],
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

    new $.fn.dataTable.Buttons(table,{
        buttons: [
            {
                text: '<i class="fa fa-object-group"></i>',
                className: 'nokelompok disabled',
                titleAttr: 'Tidak dikelompokkan',
                action: function(){
                    table.rowGroup().enable().draw();
                    table.rowGroup().dataSrc(0);
                    table.order.fixed({pre: [[0,'asc']]}).draw(false);
                    table.column(3).order('asc').draw();
                    table.column(7).visible(true);
                    table.column(6).visible(true);
                    $('.nokelompok').addClass('disabled');
                    $('.provinsi').removeClass('disabled');
                    $('.do').removeClass('disabled'); 
                    $('.tdtotal').attr('colspan',5);
                }
            },
            {
                text: 'Provinsi',
                className: 'provinsi',
                titleAttr: 'Dikelompokkan berdasarkan wilayah CU',
                action: function(){
                    table.rowGroup().enable().draw();
                    table.rowGroup().dataSrc(7);
                    table.order.fixed({pre: [[7,'asc']]}).draw();
                    table.column(4).order('asc').draw();
                    table.column(7).visible(false);
                    table.column(6).visible(true);
                    $('.provinsi').addClass('disabled');
                    $('.nokelompok').removeClass('disabled');
                    $('.do').removeClass('disabled');
                    $('.tdtotal').attr('colspan',4); 
                }
            },
            {
                text: 'District Office',
                className: 'do',
                titleAttr: 'Dikelompokkan berdasarkan District Office CU',
                action: function(){
                    table.rowGroup().enable().draw();
                    table.rowGroup().dataSrc(6);
                    table.order.fixed({pre: [[6,'asc']]}).draw();
                    table.column(4).order('asc').draw();
                    table.column(6).visible(false);
                    table.column(7).visible(true);
                    $('.do').addClass('disabled');
                    $('.nokelompok').removeClass('disabled');
                    $('.provinsi').removeClass('disabled');
                    $('.tdtotal').attr('colspan',4);
                }
            }
        ]
    });
    table.buttons( 0, null ).container().prependTo(
            table.table().container()
    );

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