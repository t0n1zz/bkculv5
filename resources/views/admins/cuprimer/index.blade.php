<?php
$title = "Kelola CU";
$kelas = 'cuprimer';
$kelas2 = 'wilayahcuprimer';
$imagepath = "images_cu/";
?>

@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-building"></i> {{ $title }}
        <small>Mengelola Data CU Primer</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-building"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<!-- Main content -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!-- content -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            @permission('view.'.$kelas.'_view')
                <li class="active"><a href="#tab_cuprimer" data-toggle="tab">CU</a></li>
            @endpermission
            @permission('view.'.$kelas2.'_view')
                <li><a href="#tab_wilayahcuprimer" data-toggle="tab">Wilayah CU</a></li>
            @endpermission
        </ul>
        <div class="tab-content">
            @permission('view.'.$kelas.'_view') 
                <div class="tab-pane active" id="tab_cuprimer">
                    <div class="input-group tabletools">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                    </div>
                    <table class="table table-hover order-column" id="dataTables-example" width="100%">
                        <thead class="bg-light-blue-active color-palette">
                        <tr>
                            <th data-sortable="false">#</th>
                            <th hidden></th>
                            <th hidden></th>
                            <th data-sortable="false">Foto</th>
                            <th>Nama </th>
                            <th>No. BA</th>
                            <th>Wilayah</th>
                            <th>District Office</th>
                            <th>Tanggal Berdiri</th>
                            <th>Tanggal Bergtabung</th>
                            <th>TP</th>
                            <th>Staf</th>
                            <th>Aplikasi</th>
                            <th>Badan Hukum</th>
                            <th>Telepon</th>
                            <th>Handphone</th>
                            <th>Kode Pos</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Website</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <?php 
                                $date = new Date($data->ultah); 
                                $date2 = new Date($data->bergabung);
                                if($data->do == "1"){
                                    $do ="Barat";
                                }else if($data->do == "2"){
                                    $do ="Tengah";
                                }else if($data->do == "3"){
                                    $do ="Timur";
                                }else{
                                    $do ='-';
                                }
                            ?>
                            <tr>
                                <td class="bg-aqua disabled color-palette"></td>
                                <td hidden>{{ $data->id }}</td>
                                <td hidden>{{ $data->no_ba }}</td>
                                @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                                    <th><img class="img-responsive"  width="50px" src="{{ asset($imagepath.$data->gambar.'n.jpg') }}"
                                             id="tampilgambar" alt="{{ asset($imagepath.$data->gambar."jpg") }}"></th>
                                @elseif(!empty($data->gambar) && is_file($imagepath.$data->gambar))
                                    <th><img class="img-responsive" width="50px" src="{{ asset($imagepath.$data->gambar) }}"
                                             id="tampilgambar" alt="{{ asset($imagepath.$data->gambar) }}"></th>
                                @else
                                    <th><img class="img-responsive" width="50px" src="{{ asset('images/image-cu.jpg') }}"
                                         id="tampilgambar" alt="cu profile"></th>
                                @endif  
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->no_ba }}</td>
                                <td>{{ $data->wilayahcuprimer->name }}</td>
                                <td>{{ $do }}</td>
                                <td data-order="{{ $data->ultah }}">{{ $date->format('d/m/Y') }}</td>
                                <td data-order="{{ $data->bergabung }}">{{ $date2->format('d/m/Y') }}</td>
                                <td>{{ $data->tp }}</td>
                                <td>{{ $data->staf }}</td>
                                <td>{{ $data->app }}</td>
                                <td>{{ $data->badan_hukum }}</td>
                                <td>{{ $data->telp }}</td>
                                <td>{{ $data->hp }}</td>
                                <td>{{ $data->pos }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td><a href="http://{{$data->website}}" class="facebook" target="_blank"> {{ $data->website }} </a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            @endpermission
            @permission('view.'.$kelas2.'_view')
            <div class="tab-pane" id="tab_wilayahcuprimer">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext2" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                </div>

                <table class="table table-hover" id="dataTables-example2" style="width:100%;">
                    <thead class="bg-light-blue-active color-palette">
                    <tr>
                        <th>#</th>
                        <th hidden></th>
                        <th>Nama Wilayah </th>
                        <th>Jumlah CU</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas2 as $data)
                        <tr>
                            <td class="bg-aqua disabled color-palette"></td>
                            <td hidden>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            @if($data && count($data->hascuprimer) > 0)
                                <td><a class="btn btn-default" href="#" disabled="">{{ $data->jumlah }}</a></td>
                            @else
                                <td><a class="btn btn-default" href="#" disabled="">{{ $data->jumlah }}</a></td>
                            @endif
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            @endpermission
        </div>
    </div>
    <!-- content -->
{{-- modal --}}
@permission('view.'.$kelas2.'_view')
<!-- tambah -->
<div class="modal fade" id="modaltambahwilayah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('route' => array('admins.'.$kelas2.'.store_wilayah'),'data-toggle' => 'validator','role' => 'form')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-active color-palette">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title "><i class="fa fa-plus"></i> Tambah Wilayah CU</h4>
        </div>
        <div class="modal-body">
          <h4>Menambah wilayah CU</h4>
          <input type="text" name="id" value="" id="modaltambahwilayah" hidden>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('name',null,array('class' => 'form-control',
                  'placeholder' => 'Silahkan masukkan nama wilayah CU','autocomplete'=>'off','required'))}}
            </div>
        </div>
        <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   {{ Form::close() }}
</div>
<!-- /tambah -->
<!-- ubah -->
<div class="modal fade" id="modalubahwilayah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open(array('route' => array('admins.'.$kelas2.'.update_wilayah',$kelas2), 'method' => 'put','data-toggle' => 'validator','role' => 'form')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-active color-palette">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title "><i class="fa fa-pencil-square-o"></i> Ubah Wilayah CU</h4>
        </div>
        <div class="modal-body">
          <h4>Mengubah wilayah CU</h4>
          <input type="text" name="id" value="" id="modalubahwilayah_id" hidden>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('name',null,array('class' => 'form-control','id'=>'modalubahwilayah_text',
                'placeholder' => 'Silahkan masukkan nama wilayah CU baru','autocomplete'=>'off','required'))}}
           </div>
        </div>
        <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-save"></i> Simpan</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   {{ Form::close() }}
</div>
<!-- /ubah -->
{{-- hapus --}}
<div class="modal fade" id="modalhapus2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas2,array('route' => array('admins.'.$kelas2.'.destroy_wilayah',$kelas2), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash fa-fw"></i> <span id="modalhapus_judul2"></span></h4>
            </div>
            <div class="modal-body">
                <h4 style="font-size: 16px" id="modalhapus_detail2"></h4>
                <input type="text" name="id" value="" id="modalhapus_id2" hidden>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="modalbutton"><i class="fa fa-trash fa-fw"></i> Hapus</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
@endpermission
{{-- /modal --}}
</section>
@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script>
        $(document).ready(function(){
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );
        });
    </script>
    @permission('view.'.$kelas.'_view')
    <script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
    <script>
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                {
                    extend:'colvis',
                    text: '<i class="fa fa-table"></i>'
                },
                {
                    extend:'colvisRestore',
                    text: 'Semua'
                }
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                @permission('create.'.$kelas.'_create')
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
                @permission('update.'.$kelas.'_update')
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
                            window.location.href =  kelas + "/" + id + "/edit";
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                @permission('destroy.'.$kelas.'_destroy')
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
                            $('#modalhapus_judul').text('Hapus Data CU');
                            $('#modalhapus_detail').text('Hapus Data CU');
                            $('#hapus-id').attr('value',id);
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
                    text: '<i class="fa fa-building"></i> Profil',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[2];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href =  kelas + "/detail/" + id;
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                {
                    text: '<i class="fa fa-home"></i> TP',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[2];
                        });
                        if(id != ""){
                            window.location.href =  "/admins/tpcu/index_cu/" + id;
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @permission('view.laporancu_view')
                {
                    text: '<i class="fa fa-line-chart"></i> Laporan',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[2];
                        });
                        if(id != ""){
                            window.location.href =  "/admins/laporancu/index_cu/" + id;
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                @permission('view.staf_view')
                {
                    text: '<i class="fa fa-sitemap"></i> Staf',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[2];
                        });
                        if(id != ""){
                            window.location.href =  "/admins/staf/index_cu/" + id;
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                }
                @endpermission
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
    @endpermission
    @permission('view.'.$kelas2.'_view')
    <script type="text/javascript" src="{{ URL::asset('admin/datatable2.js') }}"></script>
        <script>
        new $.fn.dataTable.Buttons(table2,{
            buttons: [
                @permission('create.'.$kelas2.'_create')
                {
                    text: '<i class="fa fa-plus"></i> <u>T</u>ambah',
                    key: {
                        altKey: true,
                        key: 't'
                    },
                    action: function(){
                        $('#modaltambahwilayah').modal({show:true});
                    }
                },
                @endpermission
                @permission('update.'.$kelas2.'_update')
                {
                    text: '<i class="fa fa-pencil"></i> <u>U</u>bah',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        var id = $.map(table2.rows({ selected: true }).data(),function(item){
                            return item[1];
                        });
                        var id2 = $.map(table2.rows({ selected: true }).data(),function(item){
                            return item[2];
                        });
                        if(id != ""){
                            $('#modalubahwilayah').modal({show:true});
                            $('#modalubahwilayah_id').attr('value',id);
                            $('#modalubahwilayah_text').attr('value',id2);
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                @permission('destroy.'.$kelas2.'_destroy')
                {
                    text: '<i class="fa fa-trash"></i> <u>H</u>apus',
                    key: {
                        altKey: true,
                        key: 'h'
                    },
                    action: function(){
                        var id = $.map(table2.rows({ selected:true }).data(),function(item){
                            return item[1];
                        });
                        if(id != ""){
                            $('#modalhapus2').modal({show:true});
                                $('#modalhapus_id2').attr('value',id);
                                $('#modalhapus_judul2').text('Hapus Wilayah CU');
                                $('#modalhapus_detail2').text('Yakin menghapus wilayah CU ini ?');
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                }
                @endpermission
            ]
        });
        table2.buttons( 0, null ).container().prependTo(
                table2.table().container()
        );
    </script>
    @endpermission

@stop