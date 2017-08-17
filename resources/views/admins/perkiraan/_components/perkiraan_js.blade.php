<script type="text/javascript">
var tableloaded = false;

function load_tp()
{
    var selectcu = $('#selectcu').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        data: {idcu:selectcu},
        url: '/admins/perkiraan/load_tp',
        success: function(data){
            $('#selecttp').attr('disabled',false);
            $('#selecttp').empty().append('<option hidden>Silahkan pilih TP</option>');
            $.each(data,function(index,value){
               $('#selecttp').append('<option value="'+value.tp+'">'+value.tp+'</option>');
            });
        },
        error: function(xhr, textstatus,errorThrown){
        }
    });
}

function load_periode()
{
    var selectcu = $('#selectcu').val();
    var selecttp = $('#selecttp').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        data: {idcu:selectcu,idtp:selecttp},
        url: '/admins/perkiraan/load_periode',
        success: function(data){
            $('#selectperiode').attr('disabled',false);
            $('#selectperiode').empty().append('<option hidden>Silahkan pilih Periode</option>');
            $.each(data,function(index,value){
               $('#selectperiode').append('<option value="'+value.periode+'">'+value.periode+'</option>');
            });
        },
        error: function(xhr, textstatus,errorThrown){
        }
    });
}

function load_perkiraan()
{
    var selectcu = $('#selectcu').val();
    var selecttp = $('#selecttp').val();
    var selectperiode = $('#selectperiode').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        data: {
            idcu:selectcu,
            idtp:selecttp,
            periode:selectperiode
           },
        url: '/admins/perkiraan/load_perkiraan',
        success: function(data){
            if(!tableloaded){
                $('#div_table').show();
                tableloaded = true;
                var table = $('#dataTables-example').DataTable({
                    dom: 'Bti',
                    data: data,
                    scrollY: '80vh',
                    scrollX: true,
                    scrollCollapse : true,
                    paging : false,
                    stateSave : false,
                    select: {
                        style:    'os'
                    },
                    columns: [
                        { data: "id", searchable:false, orderable:false, visible:false },
                        { data: "kode_induk", searchable:false, orderable:false, visible:false },
                        { data: "awal", searchable:false, orderable:false, visible:false },
                        { data: "akhir", searchable:false, orderable:false, visible:false},
                        { data: "total", searchable:false, orderable:false, visible:false},
                        { data: "kode", title:"No. Perkiraan"},
                        { data: "name" , title:"Nama Perkiraan"},
                        { data: "induk", title:"induk" , visible:false},
                        { data: "kelompok" , title:"Kelompok"},
                        { data: "awal" , title:"Saldo Awal", className:"text-right", render:function(data){
                            if(data < 0){
                                return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-danger">K</b>';
                            }else{
                                return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-info">D</b>';
                            }
                        }},
                        { data: "akhir" , title:"Saldo Akhir", className:"text-right", render:function(data){
                            if(data < 0){
                                return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-danger">K</b>';
                            }else{
                                return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-info">D</b>';
                            }
                        }},
                        { data: "total", title:"Total Saldo", className:"text-right", render:function(data){
                            if(data < 0){
                                return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-danger">K</b>';
                            }else{
                                return $.fn.dataTable.render.number('.', ',', 0,).display(Math.abs(data))  + ' <b class="label label-info">D</b>';
                            }
                        }}
                    ],
                    orderFixed: [7, 'asc'],
                    order: [5,'asc'],
                    rowGroup:{
                        endRender: function(rows,group){
                            var sldawl_tipe ="";
                            var sldakr_tipe ="";
                            var ttl_tipe ="";
                            var sldawl=rows
                                    .data()
                                    .pluck('awal')
                                    .reduce(function(a,b){
                                        return a + b*1;
                                    },0);
                            var sldakr=rows
                                    .data()
                                    .pluck('akhir')
                                    .reduce(function(a,b){
                                        return a + b*1;
                                    },0);
                            var ttl=rows
                                    .data()
                                    .pluck('total')
                                    .reduce(function(a,b){
                                        return a + b*1;
                                    },0);        
                            if(sldawl >= 0){
                                sldawl_tipe = "[D]";
                                sldawal_class = "bg-aqua";
                            }else{
                                sldawl_tipe = "[K]";
                                sldawal_class = "bg-red";
                            }
                            if(sldakr >= 0){
                                sldakr_tipe = "[D]";
                                sldakr_class = "bg-aqua";
                            }else{
                                sldakr_tipe = "[K]";
                                sldakr_class = "bg-red";
                            }
                            if(ttl >= 0){
                                ttl_tipe = "[D]";
                                ttl_class = "bg-aqua";
                            }else{
                                ttl_tipe = "[K]";
                                ttl_class = "bg-red";
                            }     
                            return $('<tr/>')
                            .append( '<td></td>' )
                            .append( '<td colspan="2" class="text-right">TOTAL '+group+'</td>' )
                            .append( '<td class="'+sldawal_class+' disabled color-palette text-right " >'+$.fn.dataTable.render.number('.', ',', 0,).display( Math.abs(sldawl) )+' '+sldawl_tipe+'</td>' )
                            .append( '<td class="'+sldakr_class+' disabled color-palette text-right ">'+$.fn.dataTable.render.number('.', ',', 0,).display( Math.abs(sldakr) )+' '+sldakr_tipe+'</td>' )
                            .append( '<td class="'+ttl_class+' disabled color-palette text-right ">'+$.fn.dataTable.render.number('.', ',', 0,).display( Math.abs(ttl) )+' '+ttl_tipe+'</td>' )
                        },
                        dataSrc: 'induk'
                    },
                    buttons: [
                        {
                            text: '<i class="fa fa-object-group"></i>',
                            className: 'nokelompok',
                            titleAttr: 'Tidak dikelompokkan',
                            action: function(){
                                table.rowGroup().disable().draw();
                                table.order.fixed({pre: [[5,'asc']]}).draw();
                                table.column(5).order('asc').draw();
                                table.column(7).visible(true);
                                table.column(8).visible(true);
                                $('.nokelompok').addClass('disabled');
                                $('.induk').removeClass('disabled'); 
                                $('.kelompok').removeClass('disabled');  
                            }
                        },
                        {
                            text: 'Induk',
                            className: 'induk disabled',
                            titleAttr: 'Dikelompokkan berdasarkan induk perkiraan',
                            action: function(){
                                table.rowGroup().enable().draw();
                                table.rowGroup().dataSrc('induk');
                                table.order.fixed({pre: [[7,'asc']]}).draw();
                                table.column(5).order('asc').draw();
                                table.column(7).visible(false);
                                table.column(8).visible(true);
                                $('.nokelompok').removeClass('disabled');
                                $('.induk').addClass('disabled'); 
                                $('.kelompok').removeClass('disabled'); 
                            }
                        },
                        {
                            text: 'Kelompok',
                            className: 'kelompok',
                            titleAttr: 'Dikelompokkan berdasarkan Kelompok perkiraan',
                            action: function(){
                                table.rowGroup().enable().draw();
                                table.rowGroup().dataSrc('kelompok');
                                table.order.fixed({pre: [[8,'asc']]}).draw();
                                table.column(5).order('asc').draw();
                                table.column(8).visible(false);
                                table.column(7).visible(true);
                                $('.nokelompok').removeClass('disabled');
                                $('.induk').removeClass('disabled'); 
                                $('.kelompok').addClass('disabled'); 
                            }
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

                new $.fn.dataTable.Buttons(table,{
                    buttons: [
                        {
                            text: '<i class="fa fa-plus"></i> Tambah',
                            titleAttr: 'Tambah perkiraan',
                            action: function(){
                                $('#modalperkiraan').modal({show:true});
                                $('#modalperkiraan_judul').html('<i class="fa fa-plus"></i> Tambah Perkiraan')
                                $('#id_perkiraan').val('');
                                $('#nmprk').val('');
                                $('#noprk').val('');
                                $('#induk').val($('#induk option:first').val());
                                $('#kelompok').val($('#kelompok option:first').val());
                                $('#sldawal').val('');
                                $('#sldakhir').val('');
                            }
                        },
                        {
                            text: '<i class="fa fa-pencil"></i> Ubah',
                            action: function(){
                                var id = $.map(table.rows({ selected: true }).data(),function(item){
                                    return item[0];
                                });
                                var induk = $.map(table.rows({ selected: true }).data(),function(item){
                                    return item[1];
                                });
                                var sldawal = $.map(table.rows({ selected: true }).data(),function(item){
                                    return item[2];
                                });
                                var sldakhir = $.map(table.rows({ selected: true }).data(),function(item){
                                    return item[3];
                                });
                                var noprk = $.map(table.rows({ selected: true }).data(),function(item){
                                    return item[5];
                                });
                                var nmprk = $.map(table.rows({ selected: true }).data(),function(item){
                                    return item[6];
                                });
                                var kelompok = $.map(table.rows({ selected: true }).data(),function(item){
                                    return item[8];
                                });

                                $('#modalperkiraan').modal({show:true});
                                $('#modalperkiraan_judul').html('<i class="fa fa-pencil"></i> Ubah Perkiraan')
                                $('#id_perkiraan').val(id);
                                $('#nmprk').val(nmprk);
                                $('#noprk').val(noprk);
                                $('#induk').val(induk);
                                $('#kelompok').val(kelompok);
                                $('#sldawal').val(sldawal);
                                $('#sldakhir').val(sldakhir);
                            },
                            init: function ( dt, node, config ) {
                                var that = this;
                                dt.on( 'select.dt.DT deselect.dt.DT', function () {
                                    that.enable( dt.rows( { selected: true } ).any() );
                                } );
                                this.disable();
                            }
                        },
                        {
                            text: '<i class="fa fa-trash"></i> Hapus',
                            titleAttr: 'Hapus perkiraan',
                            action: function(){
                                $('#modaltambahperkiraan').modal({show:true});
                            },
                            init: function ( dt, node, config ) {
                                var that = this;
                                dt.on( 'select.dt.DT deselect.dt.DT', function () {
                                    that.enable( dt.rows( { selected: true } ).any() );
                                } );
                                this.disable();
                            }
                        }
                    ]
                });
                table.buttons( 0, null ).container().prependTo(
                        table.table().container()
                ); 
            }else{
                var table = $('#dataTables-example').DataTable();
                table.clear().rows.add(data).draw();
            } 
        },
        error: function(xhr, textstatus,errorThrown){
        }
    });
}
</script>