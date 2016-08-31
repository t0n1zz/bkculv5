<?php
$title = "Kelola Artikel";
$kelas ='artikel';
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
        <i class="fa fa-archive"></i> {{ $title }}
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
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-striped table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th hidden></th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Tanggal</th>
                    <th>Gambar</th>
                    <th>Terbit</th>
                    <th>Pilihan</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td hidden>{{ $data->id }}</td>
                        @if(!empty($data->judul))
                            <td class="warptext">{{ $data->judul }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->kategoriartikel))
                            <td>{{ $data->kategoriartikel->name }}</td>
                        @else
                            <td>Tak Terkategori</td>
                        @endif

                        @if(!empty($data->penulis))
                            <td>{{ $data->penulis }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->created_at ))
                            <?php $date = new Date($data->created_at); ?>
                            <td><i hidden="true">{{$data->created_at}}</i> {{ $date->format('d-n-Y') }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                            <td style="white-space: nowrap"><div class="modalphotos" >
                                    {{ Html::image($imagepath.$data->gambar.'n.jpg',asset($imagepath.$data->gambar."jpg"),
                                        array('class' => 'img-responsive ',
                                        'id' => 'tampilgambar', 'width' => '50')) }}
                                </div></td>
                        @elseif(!empty($data->gambar) && is_file($imagepath.$data->gambar))
                            <td style="white-space: nowrap"><div class="modalphotos" >
                                {{ Html::image($imagepath.$data->gambar,asset($imagepath.$data->gambar),
                                    array('class' => 'img-responsive ',
                                    'id' => 'tampilgambar', 'width' => '50')) }}
                            </div></td>
                        @else
                            <td>{{ Html::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive',
			        	                    'id' => 'tampilgambar', 'width' => '50')) }}</td>
                        @endif

                        @if($data->status == 0)
                            <td><a href="#" class="btn btn-default" disabled>
                                    <i hidden="true">tidak</i><i class="fa fa-ban"></i></a></td>
                        @elseif($data->status == 1)
                            <td><a href="#" class="btn btn-warning" disabled>
                                    <i hidden="true">iya</i><i class="fa fa-check"></i></a></td>
                        @else
                            <td><a href="#" class="btn btn-default" disabled>
                                    <i hidden="true">-</i><i class="fa fa-minus"></i></a></td>
                        @endif

                        @if($data->pilihan == 0)
                            <td><a href="#" class="btn btn-default" disabled>
                                    <i hidden="true">tidak</i><i class="fa fa-ban"></i></a></td>
                        @elseif($data->pilihan == 1)
                            <td><a href="#" class="btn btn-warning" disabled>
                                    <i hidden="true">iya</i><i class="fa fa-check"></i></a></td>
                        @else
                            <td><a href="#" class="btn btn-default" disabled>
                                    <i hidden="true">-</i><i class="fa fa-minus"></i></a></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- modal -->
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Artikel</h4>
        </div>
        <div class="modal-body">
          <h4>Menghapus artikel ini ?</h4>
          <input type="text" name="id" value="" id="modal1id" hidden>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Iya</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   {{ Form::close() }}
</div>
<!-- /Hapus -->
<!-- /.modal -->

@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
    <script>
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
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href =  kelas + "/" + id + "/edit";
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
                            return item[0];
                        });
                        if(id != ""){
                            $('#modal1show').modal({show:true});
                            $('#modal1id').attr('value',id);
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
                {
                    text: 'Ubah Status Publikasi',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href =  kelas + "/update_status/" + id;
                        }
                    }
                },
                {
                    text: 'Ubah Status Artikel Pilihan',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href =  kelas + "/update_pilihan/" + id;
                        }
                    }
                }
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
    </script>
@stop