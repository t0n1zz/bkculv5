<?php
$title="Ubah Deskripsi";
?>
@extends('_layouts.layout')

@section('css')
{{ HTML::style('plugins/summernote/summernote.css') }}
@stop

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
                        <h3 class="classic-title">
                            <span>
                                Ubah Profil
                                <small>mengenai CU, sejarah & latar belakang, produk & pelayanan, visi/misi</small>
                            </span>
                        </h3>
                    </div>
                    {{ Form::model($data,array('route' => array('cu.update_deskripsi'),'files' => true,
                   'data-toggle' => 'validator','role' => 'form')) }}
                    <div class="col-md-12">
                        <textarea id="editor" name="deskripsi"
                                >@if(!empty($data->deskripsi)){{ $data->deskripsi }}@endif</textarea>
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

@section('javascript')
{{ HTML::script('plugins/summernote/summernote.js') }}
<script>
    $(document).ready(function() {
        $('#editor').summernote({
            minHeight: 300,
            placeholder: 'Silahkan isi disini...',
            toolbar: [
                ['para',['style']],
                ['style', ['bold', 'italic', 'underline', 'hr']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol']],
                ['paragraph',['paragraph']],
                ['table',['table']],
                ['height', ['height']],
                ['insert',['link','picture','video']] ,
                ['misc',['fullscreen','codeview']],
                ['misc2',['undo','redo']]
            ]
        });
    });
</script>
@stop