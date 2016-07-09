<?php
$title="Ubah Info";
$imagepath ='images_cu/';
$file_max = ini_get('upload_max_filesize');
$file_max_str_leng = strlen($file_max);
$file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
$file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
$file_max = substr($file_max,0,$file_max_str_leng - 1);
$file_max = intval($file_max);
?>
@extends('_layouts.layout')

@section('content')
        <!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            @include('cu.header')
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>CU</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('cu.alert')
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="classic-title"><span>Ubah Informasi Dasar</span></h3>
                    </div>
                    {{ Form::model($data,array('route' => array('cu.update_info'),'files' => true,
                   'data-toggle' => 'validator','role' => 'form')) }}
                    <div class="col-md-6">
                        <h5>Logo</h5>
                        <div class="thumbnail" >
                            @if(!empty($data->logo))
                                {{ HTML::image($imagepath.$data->logo, 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '100')) }}
                            @else
                                {{ HTML::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar2', 'width' => '100')) }}
                            @endif
                            <div class="caption">
                                {{ Form::file('logo', array('onChange' => 'readURL2(this)')) }}
                            </div>
                        </div>
                        <br/>
                        <h5>Nama</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama cu',
                                'required','min-length' => '5','data-error' => 'Nama wajib diisi dan minimal 5 karakter','autocomplete'=>'off'))}}
                            <div class="help-block with-errors"></div>
                            {{ $errors->first('name', '<p class="text-warning">:message</p>') }}
                        </div>
                        <br/>
                        <h5>No. BA</h5>
                        <div class="input-group">
                            <span class="input-group-addon">0-9</span>
                            {{ Form::text('no_ba',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor anggota',
                                'onKeyPress' => 'return isNumberKey(event)','data-error' => 'No. Anggota wajib diisi',
                                'autocomplete'=>'off'))}}
                            <div class="help-block with-errors"></div>
                            {{ $errors->first('no_ba', '<p class="text-warning">:message</p>') }}
                        </div>
                        <br/>
                        <h5>No. Badan Hukum</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            {{ Form::text('badan_hukum',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor badan hukum',
                                'autocomplete'=>'off'))}}
                        </div>
                        <br/>
                        <h5>No. Telepon</h5>
                        <div class="input-group">
                            <span class="input-group-addon">0-9</span>
                            {{ Form::text('telp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor telepon',
                                    'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                        </div>
                        <br/>
                        <h5>No. Handphone</h5>
                        <div class="input-group">
                            <span class="input-group-addon">0-9</span>
                            {{ Form::text('hp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor handphone',
                                    'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                        </div>
                        <br/>
                        <h5>Kode Pos</h5>
                        <div class="input-group">
                            <span class="input-group-addon">0-9</span>
                            {{ Form::text('pos',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan kode pos',
                                    'onKeyPress' => 'return isNumberKey(event)'))}}
                        </div>
                        <br/>
                        <h5>Jumlah Tempat Pelayanan</h5>
                        <div class="input-group">
                            <span class="input-group-addon">0-9</span>
                            {{ Form::text('tp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah tempat pelayanan',
                                    'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                        </div>
                        <br/>
                        <h5>Alamat</h5>
                        <div class="input-group">
                            {{ Form::textarea('alamat',null,array('class' => 'form-control','rows' => '5', 'placeholder' => 'Silahkan masukkan alamat'))}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Foto CU</h5>
                        <div class="thumbnail" >
                            @if(!empty($data->gambar))
                                {{ HTML::image($imagepath.$data->gambar.'n.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                            @else
                                {{ HTML::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                            @endif
                            <div class="caption">
                                {{ Form::file('gambar', array('onChange' => 'readURL(this)')) }}
                            </div>
                        </div>
                        <br/>
                        <!--Tanggal berdiri-->
                        <h5>Tanggal Berdiri</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <?php
                            if(!empty($data->ultah)){
                                $timestamp = strtotime($data->ultah);
                                $tanggal = date('d/m/Y',$timestamp);
                            }
                            ?>
                            <input type="text" name="ultah" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                                   data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                        </div>
                        <br/>
                        <!--/tanggal berdiri-->
                        <!--Tanggal bergabung-->
                        <h5>Tanggal Bergabung</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <?php
                            if(!empty($data->bergabung)){
                                $timestamp = strtotime($data->bergabung);
                                $tanggal = date('d/m/Y',$timestamp);
                            }
                            ?>
                            <input type="text" name="bergabung" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                                   data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                        </div>
                        <br/>
                        <!--/tanggal bergabung-->
                        <h5>Website</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            {{ Form::text('website',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan alamat website',
                                'autocomplete'=>'off'))}}
                        </div>
                        <br/>
                        <h5>E-mail</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            {{ Form::email('email',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan alamat email',
                                'data-error' => 'Alamat email anda salah','autocomplete'=>'off'))}}
                            <div class="help-block with-errors"></div>
                        </div>
                        <br/>
                        <h5>Aplikasi Komputerisasi</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            {{ Form::text('app',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama aplikasi komputerisasi',
                                'autocomplete'=>'off'))}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                        <div class="well well-sm">
                            Ukuran maksimum file gambar adalah {{ $file_max. ' ' .$file_max_meassure_unit }}
                        </div>
                        <hr/>
                        <button type="submit" name="simpan" accesskey="s" class="btn btn-primary" value="simpan">
                            <i class="fa fa-save"></i> <u>S</u>impan</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
</div>
@stop