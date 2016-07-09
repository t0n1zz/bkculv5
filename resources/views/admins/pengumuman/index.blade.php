<?php
$title = "Kelola Pengumuman";
$kelas = "pengumuman";
?>
@extends('admins._layouts.layout')

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
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="form-group">
                <a type="button" accesskey="t" class="btn btn-primary modal2"
                   href="#"><i class="fa fa-plus"></i> <u>T</u>ambah Pengumuman</a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th></th>
                    <th>Pengumuman</th>
                    <th>Tanggal</th>
                    <th>Urutan</th>
                    <th>Ubah</th>
                    <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td></td>
                        @if(!empty($data->name))
                            <td>{{ $data->name }}</td>
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
                            <td><a href="#" class="btn btn-warning modal4" name="{{ $data->id }}"
                                        >{{ $data->urutan }}</a></td>
                        @else
                            <td><a href="#" class="btn btn-warning modal4" name="{{ $data->id }}"
                                        >-</a></td>
                        @endif

                        <td><a class="btn btn-primary modal3" href="#" name={{ $data->id }}>
                                <i class="fa fa-pencil"></i></a></td>

                        <td><button class="btn btn-danger modal1" name="{{ $data->id }}">
                                <i class="fa fa-trash"></i></button></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!--content-->
</section>

<!-- modal -->
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Kategori Artikel</h4>
            </div>
            <div class="modal-body">
                <strong>Menghapus pengumuman ini ?</strong>
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
<!-- tambah -->
<div class="modal fade" id="modal2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.store'))) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-plus"></i> Tambah Pengumuman</h4>
            </div>
            <div class="modal-body">
                <strong>Menambah pengumuman baru</strong>
                <?php
                if(Auth::check()) { $id = Auth::user()->getId();}
                $urutan = App\Models\Pengumuman::count();
                ?>
                <input type="text" name="penulis" value="{{ $id }}" hidden>
                <input type="text" name="urutan" value="{{$urutan + 1}}"  hidden>
                <input type="text" name="id" value="" id="modal2id" hidden>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('name',null,array('class' => 'form-control',
                      'placeholder' => 'Silahkan masukkan nama kategori artikel','autocomplete'=>'off'))}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Ok</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /tambah -->
<!-- ubah -->
<div class="modal fade" id="modal3show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::open(array('route' => array('admins.'.$kelas.'.update',$kelas), 'method' => 'put')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><i class="fa fa-pencil-square-o"></i> Ubah Pengumuman</h4>
            </div>
            <div class="modal-body">
                <strong>Mengubah pengumuman</strong>
                <input type="text" name="id" value="" id="modal3id" hidden>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('name',null,array('class' => 'form-control','id'=>'modal3id2',
                    'placeholder' => 'Silahkan masukkan nama kategori artikel baru','autocomplete'=>'off'))}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Ok</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /ubah -->
<!-- ubah urutan -->
<div class="modal fade" id="modal4show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open(array('route' => array('admins.'.$kelas.'.update_urutan'))) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title "><i class="fa fa-pencil-square-o"></i> Ubah Urutan Pengumuman</h4>
        </div>
        <div class="modal-body">
          <strong>Mengubah urutan pengumuman?</strong>
          <input type="text" name="id" value="" id="modal4id" hidden>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-list"></i></div>
                <select class="form-control" name="urutan">
                    <option disabled selected>Silahkan pilih Urutan </option>
                    <?php $i=0; ?>
                    @foreach($datas as $data)
                        <?php $i++; ?>
                        <option value="{{ $i}}">{{ $i }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
              <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Ok</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   {{ Form::close() }}
</div>
<!-- /ubah urutan -->
<!-- /.modal -->
@stop