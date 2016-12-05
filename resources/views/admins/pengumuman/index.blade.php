<?php
$title = "Kelola Pengumuman";
$kelas = "pengumuman";
?>
@extends('admins._layouts.layout')

@section('css')
    @include('admins._components.datatable_CSS')
@stop

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-comments"></i> {{ $title }}
        <small>Mengelola Data Pengumuman</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-comments"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_pengumuman" data-toggle="tab">Pengumuman</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_pengumuman">
                <div class="input-group tabletools">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                </div>
                <table class="table table-hover" id="dataTables-example" width="100%">
                    <thead class="bg-light-blue-active color-palette">
                    <tr>
                        <th>#</th>
                        <th hidden></th>
                        <th>Pengumuman</th>
                        <th>Tanggal</th>
                        <th>Urutan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td class="bg-aqua disabled color-palette"></td>
                            <td hidden>{{ $data->id }}</td>
                            @if(!empty($data->name))
                                <td class="warptext">{{ $data->name }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->created_at ))
                                <?php $date = new Date($data->created_at); ?>
                                <td><i hidden="true">{{$data->created_at}}</i> {{  $date->format('d-n-Y') }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->urutan))
                                <td><a href="#" class="btn btn-default" disabled>{{ $data->urutan }}</a></td>
                            @else
                                <td><a href="#" class="btn btn-default" disabled>-</a></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>  
        </div>
    </div>
    <!--content-->
</section>

<!-- modal -->
<!-- tambah -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.store'),'data-toggle' => 'validator','role' => 'form')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-plus"></i> Tambah Pengumuman</h4>
            </div>
            <div class="modal-body">
                <?php
                    if(Auth::check()) { $id = Auth::user()->getId();}
                    $urutan = App\Models\Pengumuman::count();
                ?>
                <input type="text" name="penulis" value="{{ $id }}" hidden>
                <input type="text" name="urutan" value="{{$urutan + 1}}"  hidden>
                <input type="text" name="id" value="" id="modaltambah_id" hidden>
                <div class="form-group">
                    <h4>Menambah pengumuman baru</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control','id'=>'modaltambah_name',
                        'placeholder' => 'Silahkan masukkan pengumuman','autocomplete'=>'off','required'))}}
                    </div>
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
<div class="modal fade" id="modalubah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.update',$kelas), 'method' => 'put','data-toggle' => 'validator','role' => 'form')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-blue-active color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-pencil"></i> Ubah Pengumuman</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="id" value="" id="modalubah_id" hidden>
                <div class="form-group">
                    <h4>Mengubah pengumuman</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control','id'=>'modalubah_name',
                        'placeholder' => 'Silahkan masukkan pengumuman','autocomplete'=>'off','required'))}}
                    </div>
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
<!-- ubah urutan -->
<div class="modal fade" id="modalurutan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open(array('route' => array('admins.'.$kelas.'.update_urutan','data-toggle' => 'validator','role' => 'form'))) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-light-blue-active color-palette">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title "><i class="fa fa-ellipsis-v"></i> Urutan Pengumuman</h4>
        </div>
        <div class="modal-body">
            <input type="text" name="id" value="" id="modalurutan_id" hidden>
            <div class="form-group has-feedback">
              <h4>Mengubah urutan pengumuman?</h4>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-list"></i></div>
                    <select class="form-control" name="urutan" required="">
                        <option disabled selected>Silahkan pilih Urutan </option>
                        <?php $i=0; ?>
                        @foreach($datas as $data)
                            <?php $i++; ?>
                            <option value="{{ $i}}">{{ $i }}</option>
                        @endforeach
                    </select>
                </div>
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
<!-- /ubah urutan -->
<!-- /.modal -->
@stop

@section('js')
    @include('admins._components.datatable_JS')
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
                        var id = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[1];
                        });
                        $('#modaltambah').modal({show:true});
                        $('#modaltambah_id').attr('value',id);
                        
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
                        var name = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[2];
                        });
                        if(id != ""){
                            $('#modalubah').modal({show:true});
                            $('#modalubah_id').attr('value',id);
                            $('#modalubah_name').attr('value',name);
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
                                $('#modalhapus_id').attr('value',id);
                                $('#modalhapus_judul').text('Hapus Pengumuman');
                                $('#modalhapus_detail').text('Yakin menghapus pengumuman ini ?');
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
                @permission('update_urutan.'.$kelas.'_update_urutan')
                {
                    text: '<i class="fa fa-ellipsis-v"></i> Urutan',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[1];
                        });
                        if(id != ""){
                            $('#modalurutan').modal({show:true});
                            $('#modalurutan_id').attr('value',id);
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
@stop