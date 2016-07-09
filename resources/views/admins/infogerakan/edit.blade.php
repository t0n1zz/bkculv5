<?php
$title = "Informasi Gerakan";
$kelas = "infogerakan";

if(!empty($data->tanggal)){
    $timestamp = strtotime($data->tanggal);
    $tanggal = date('m/d/Y',$timestamp);
    $date = new Date($data->tanggal);
    $tanggal2 = $date->format('l, j F Y');
}
?>
@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-archive"></i> {{ $title }}
        <small>Mengelola Informasi Gerakan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-university"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
{{ Form::model($data,array('route' => array('admins.'.$kelas.'.update',$data->id),'method' => 'put')) }}
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="form-group">
                <button type="submit" name="simpan" accesskey="s" class="btn btn-primary">
                    <i class="fa fa-save"></i> <u>S</u>impan</button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <h4>Informasi Per Tanggal</h4>
                            <div class="bfh-datepicker" data-name="tanggal"
                                 data-date={{ $tanggal }}>
                                <input id="datepickers" type="text" class="datepicker" >
                            </div>
                        {{ $errors->first('tanggal', '<p class="text-warning">:message</p>') }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <h4>Anggota</h4>
                        <div class="input-group">
                            <div class="input-group-addon">0-9</div>
                            {{ Form::text('jumlah_anggota',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah anggota',
                                          'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                            {{ $errors->first('jumlah_anggota', '<p class="text-warning">:message</p>') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <h4>CU Primer</h4>
                        <div class="input-group">
                            <div class="input-group-addon">0-9</div>
                            {{ Form::text('jumlah_cu',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah cu primer',
                                          'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                            {{ $errors->first('jumlah_cu', '<p class="text-warning">:message</p>') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <h4>Staf CU Primer</h4>
                        <div class="input-group">
                            <div class="input-group-addon">0-9</div>
                            {{ Form::text('jumlah_staff_cu',null,array('class' => 'form-control',
                                          'placeholder' => 'Silahkan masukkan jumlah staf cu primer',
                                          'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                            {{ $errors->first('jumlah_staff_cu', '<p class="text-warning">:message</p>') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <h4>Piutang Beredar</h4>
                        <div class="input-group">
                            <div class="input-group-addon">Rp.</div>
                            {{ Form::text('piutang_beredar',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah piutang beredar',
                                          'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                            {{ $errors->first('piutang_beredar', '<p class="text-warning">:message</p>') }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <h4>Piutang Lalai 1 s.d. 12 Bulan</h4>
                        <div class="input-group">
                            <div class="input-group-addon">Rp.</div>
                            {{ Form::text('piutang_lalai_1',null,array('class' => 'form-control', 'placeholder' => 'Masukkan jumlah piutang lalai 1 s.d. 12 bulan',
                                          'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                            {{ $errors->first('piutang_lalai_1', '<p class="text-warning">:message</p>') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <h4>Piutang Bersih</h4>
                        <div class="input-group">
                            <div class="input-group-addon">Rp.</div>
                            {{ Form::text('piutang_bersih',null,array('class' => 'form-control', 'placeholder' => 'Masukkan jumlah piutang bersih',
                                          'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                            {{ $errors->first('piutang_bersih', '<p class="text-warning">:message</p>') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <h4>Aset</h4>
                        <div class="input-group">
                            <div class="input-group-addon">Rp.</div>
                            {{ Form::text('asset',null,array('class' => 'form-control', 'placeholder' => 'Masukkan jumlah asset',
                                          'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                            {{ $errors->first('asset', '<p class="text-warning">:message</p>') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <h4>SHU</h4>
                        <div class="input-group">
                            <div class="input-group-addon">Rp.</div>
                            {{ Form::text('shu',null,array('class' => 'form-control', 'placeholder' => 'Masukkan SHU',
                                          'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                            {{ $errors->first('shu', '<p class="text-warning">:message</p>') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--content-->
</section>
{{ Form::close() }}
@stop