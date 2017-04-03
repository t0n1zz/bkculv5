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
        @if(!Request::is('admins/laporancu/index_cu/*'))
            order : [[ 3, 'desc']],
        @else
            order : [[ 2, 'desc']],
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

    table4.$("a[rel=popover]").popover().click(function(e) {e.preventDefault();});

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
                    var id = $.map(table4.rows({ selected: true }).data(),function(item){
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
                    var id = $.map(table4.rows({ selected:true }).data(),function(item){
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
                    var id = $.map(table4.rows({ selected: true }).data(),function(item){
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
    table4.buttons( 0, null ).container().prependTo(
            table4.table().container()
    );

    new $.fn.dataTable.Buttons(table4,{
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
    table4.buttons( 0, null ).container().prependTo(
            table4.table().container()
    );
</script>