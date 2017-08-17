<?php
$kelas= "migrasi";
$title = "Migrasi Data";
?>

@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-exchange"></i> {{ $title }}
        <small>Mengelola {{ $title }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-exchange"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    <div class="box box-solid">
        <div class="box-body">
            <a href="#" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalupload" title="upload database Sikopdit CS untuk migrasi"><i class="fa fa-upload"></i> Upload Database Sikopdit CS</a>
        </div>
    </div>
    <div class="box box-solid">
        <div class="box-body">
            <h2 class="page-header"><i class="fa fa-database"></i> Info Database</h2>
        </div>
    </div>
    <div class="box box-solid">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-9">
                    <h4></h4>
                </div>
                <div class="col-sm-3">
                    <a href="" class="btn btn-default btn-block">Migrasi Data Perkiraan</a>
                </div>
                
            </div>
        </div>
    </div>
    <!--content-->
</section>
@stop

@section('js')
    <script src="{{ asset('plugins/blueimp-file-upload/js/vendor/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('plugins/blueimp-file-upload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('plugins/blueimp-file-upload/js/jquery.fileupload.js') }}"></script>
    <script>
        var $ = window.$; // use the global jQuery instance

        var $uploadList = $("#file-upload-list");

        if ($uploadList.length > 0) {
            var idSequence = 0;

            // A quick way setup
            $('#fileupload').fileupload({
                maxChunkSize: 1000000,
                method: "POST",
                sequentialUploads: true,
                formData: function (form) {
                    //laravel token for communication
                    return [{name: '_token', value: $('input[name=_token]').val()}];
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $("#"+data.theId).text('Uploading '+progress + '%');
                },
                add: function (e, data) {
                    data._progress.theId = 'id_'+idSequence;
                    idSequence++;
                    $uploadList.append($('<li id="'+data.theId+'"></li>').text('Uploading'));
                    data.submit();
                },
                done: function (e, data) {
                    console.log(data, e);
                    $uploadList.append($('<li></li>').text('Uploaded: ' + data.result.path + ' ' + data.result.name));
                }
            });
        }
    </script>
@stop