<?php
$title = "Kelola Artikel";
$kelas ='artikel';
$kelas2 = 'kategoriartikel';
$imagepath = 'images_artikel/';
?>

@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop

@section('content')
<!-- header -->

<section class="content-header">
    <h1>
        <i class="fa fa-book"></i> {{ $title }}
        <small>Mengelola Data Artikel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-book"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    @permission('view.'.$kelas.'_view')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            @permission('view.'.$kelas.'_view')
                <li class="active"><a href="#tab_artikel" data-toggle="tab">Artikel</a></li>
            @endpermission
            @permission('view.'.$kelas2.'_view')    
                <li ><a href="#tab_kategoriartikel" data-toggle="tab">Kategori Artikel</a></li>
            @endpermission    
        </ul>
        <div class="tab-content"> 
            @permission('view.'.$kelas.'_view')
            <div class="tab-pane active" id="tab_artikel">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                </div>

                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    <tr>
                        <th data-sortable="false">#</th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th data-sortable="false">Foto</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Tanggal Tulis</th>
                        <th>Tanggal Ubah</th>
                        <th>Terbit</th>
                        <th>Pilihan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td class="bg-aqua disabled color-palette"></td>
                            <td hidden>{{ $data->id }}</td>
                            <td hidden>{{ $data->status }}</td>
                            <td hidden>{{ $data->pilih }}</td>
                            @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                                <td style="white-space: nowrap"><div class="modalphotos" >
                                        {{ Html::image(($imagepath.$data->gambar).'n.jpg',asset(($imagepath.$data->gambar)."jpg"),
                                            array('class' => 'img-responsive ',
                                            'id' => 'tampilgambar', 'width' => '50')) }}
                                    </div></td>
                            @elseif(!empty($data->gambar) && is_file($imagepath.$data->gambar)))
                                <td style="white-space: nowrap"><div class="modalphotos" >
                                        {{ Html::image(($imagepath.$data->gambar),asset($imagepath.$data),
                                            array('class' => 'img-responsive ',
                                            'id' => 'tampilgambar', 'width' => '50')) }}
                                    </div></td>
                            @else
                                <td>{{ Html::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive',
                                                'id' => 'tampilgambar', 'width' => '50')) }}</td>
                            @endif
                            <td class="warptext">{{ $data->judul }}</td>    
                            <td>{{ $data->kategoriartikel->name }}</td>
                            <td>{{ $data->penulis }}</td>
                            <td>{{ $data->created_at->format('d/n/Y') }}</td>
                            <td>{{ $data->updated_at->format('d/n/Y')  }}</td>
                            <td>
                                @if($data->status == "1")
                                    <a href="#" class="btn btn-warning" disabled><i class="fa fa-check"></i></a>
                                @else
                                    <a href="#" class="btn btn-default" disabled><i class="fa fa-ban"></i></a>
                                @endif
                            </td>    
                            <td>
                                @if($data->pilihan == "1")
                                    <a href="#" class="btn btn-warning" disabled><i class="fa fa-check"></i></a>
                                @else
                                    <a href="#" class="btn btn-default" disabled><i class="fa fa-ban"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endpermission
            @permission('view.'.$kelas2.'_view')
            <div class="tab-pane" id="tab_kategoriartikel">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext2" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                </div>

                <table class="table table-hover" id="dataTables-example2" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    <tr>
                        <th data-sortable="false">#</th>
                        <th hidden></th>
                        <th>Nama Kategori </th>
                        <th>Jumlah Artikel</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas2 as $data)
                        <tr>
                            <td class="bg-aqua disabled color-palette"></td>
                            <td hidden>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            @if($data->hasartikel->count() > 0)
                                <td><a class="btn btn-default" disabled>{{ $data->jumlah }}</a></td>
                            @else
                                <td><a href="#" class="btn btn-default" disabled>{{ $data->hasartikel->count() }}</a> </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endpermission
        </div>
    </div>
    @endpermission
    <!--content-->

</section>

{{-- modal --}}
@permission('view.'.$kelas.'_view')
<div class="modal fade" id="modalstatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.update_status'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-check-square"></i> Terbit Artikel</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id" value="" id="modalstatus_id" hidden>
                <h4 id="judulterbit"></h4>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Ya</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<div class="modal fade" id="modalpilihan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.update_pilihan'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-check-square"></i> Artikel Pilihan</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id" value="" id="modalpilihan_id" hidden>
                <h4 id="judulpilihan"></h4>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Ya</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
@endpermission
@permission('view.'.$kelas2.'_view')
<!-- tambah -->
<div class="modal fade" id="modaltambahkategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('route' => array('admins.'.$kelas2.'.store_kategori'),'data-toggle' => 'validator','role' => 'form')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-active color-palette">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title "><i class="fa fa-plus"></i> Tambah Kategori Artikel</h4>
        </div>
        <div class="modal-body">
          <h4>Menambah Kategori Artikel</h4>
          <input type="text" name="id" value="" id="modaltambahkategori_id" hidden>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('name',null,array('class' => 'form-control',
                  'placeholder' => 'Silahkan masukkan nama kategori artikel','autocomplete'=>'off','required'))}}
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
<div class="modal fade" id="modalubahkategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open(array('route' => array('admins.'.$kelas2.'.update_kategori',$kelas2), 'method' => 'put','data-toggle' => 'validator','role' => 'form')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-active color-palette">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title "><i class="fa fa-pencil-square-o"></i> Ubah Kategori Artikel</h4>
        </div>
        <div class="modal-body">
          <h4>Mengubah kategori artikel</h4>
          <input type="text" name="id" value="" id="modalubahkategori_id" hidden>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('name',null,array('class' => 'form-control','id'=>'modalubahkategori_text',
                'placeholder' => 'Silahkan masukkan nama kategori artikel baru','autocomplete'=>'off','required'))}}
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
    {{ Form::model($datas2,array('route' => array('admins.'.$kelas2.'.destroy_kategori',$kelas2), 'method' => 'delete')) }}
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
                        var judul = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[2];
                        });
                        if(id != ""){
                            $('#modalhapus').modal({show:true});
                                $('#modalhapus_id').attr('value',id);
                                $('#modalhapus_judul').text('Hapus Artikel');
                                $('#modalhapus_detail').text('Yakin menghapus artikel "' + judul + '" ?');
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                @permission('update_status.'.$kelas.'_update_status')
                {
                    text: '<i class="fa fa-check-square"></i> Penerbitan Artikel',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[1];
                        });
                        var judul = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[5];
                        });
                        var status = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[2];
                        });
                        if(id != ""){
                            $('#modalstatus').modal({show:true});
                            if(status != "1"){
                                $('#judulterbit').text('Terbitkan artikel "' + judul + '" ini?');
                            }else{
                                $('#judulterbit').text('Tidak menerbitkan artikel "' + judul + '"" ini?');
                            }
                            $('#modalstatus_id').attr('value',id);
                        }else{
                            $('#modalwarning').modal({show:true});
                        }
                    }
                },
                @endpermission
                @permission('update_pilihan.'.$kelas.'_update_pilihan')
                {
                    text: '<i class="fa fa-dot-circle-o"></i> Artikel Pilihan',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[1];
                        });
                        var judul = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[5];
                        });
                        var status = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[3];
                        });
                        if(id != ""){
                            $('#modalpilihan').modal({show:true});
                            if(status !="1"){
                                $('#judulpilihan').text('Jadikan artikel "' + judul + '"" sebagai artikel pilihan?');
                            }else{
                                $('#judulpilihan').text('Tidak Jadikan artikel "' + judul + '"" sebagai artikel pilihan?');
                            }
                            $('#modalpilihan_id').attr('value',id);
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
                        $('#modaltambahkategori').modal({show:true});
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
                            $('#modalubahkategori').modal({show:true});
                            $('#modalubahkategori_id').attr('value',id);
                            $('#modalubahkategori_text').attr('value',id2);
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
                                $('#modalhapus_judul2').text('Hapus Kategori Artikel');
                                $('#modalhapus_detail2').text('Yakin menghapus kategori artikel ini ?');
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