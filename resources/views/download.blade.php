@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Download</h2>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Download</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page Title -->
<div id="content">
    <div class="container">
        <div class="row">
        @if($downloads->isEmpty())
            <div class="col-md-12 ">
                <div class="call-action call-action-boxed call-action-style1 clearfix">
                    <!-- Call Action Button -->
                    <!-- Call Action Text -->
                    <h2 class="primary">Maaf <strong>Belum terdapat file apapun</strong></h2>
                    <p>Silahkan kunjungi kembali lain waktu...</p>
                </div>
            </div>
        @else
            @foreach($downloads as $download)
                <div class="col-md-4 col-sm-6 service-box service-center">
                    <a href="{{ route('file',array($download->filename))}}">
                        <div class="service-boxed">
                            <div class="service-icon" style="margin-top:-25px;">
                                @if($download->ekstensi == "doc" || $download->ekstensi == "docx" ||
                                    $download->ekstensi == "docm" || $download->ekstensi == "dotx" ||
                                    $download->ekstensi == "dotm" || $download->ekstensi == "dot")
                                    <i class="fa  fa-file-word-o icon-medium-effect icon-effect-1"></i>
                                @elseif($download->ekstensi == "xls" || $download->ekstensi == "xlsx" ||
                                    $download->ekstensi == "xlsm" || $download->ekstensi == "xlsb" ||
                                    $download->ekstensi == "xltx" || $download->ekstensi == "xltm"||
                                    $download->ekstensi == "xlt" )
                                    <i class="fa  fa-file-excel-o icon-medium-effect icon-effect-1"></i>
                                @elseif($download->ekstensi == "pptx" || $download->ekstensi == "ppt" ||
                                    $download->ekstensi == "pptm" || $download->ekstensi == "potx" ||
                                    $download->ekstensi == "pot" || $download->ekstensi == "potm" ||
                                    $download->ekstensi == "ppsx" || $download->ekstensi == "ppsm" ||
                                    $download->ekstensi == "pps")
                                    <i class="fa  fa-file-powerpoint-o icon-medium-effect icon-effect-1"></i>
                                @elseif($download->ekstensi == "pdf")
                                    <i class="fa  fa-file-pdf-o icon-medium-effect icon-effect-1"></i>
                                @elseif($download->ekstensi == "jpg" || $download->ekstensi == "png" ||
                                   $download->ekstensi == "jpeg" || $download->ekstensi == "gif" ||
                                   $download->ekstensi == "bmp" || $download->ekstensi == "tif")
                                    <i class="fa  fa-file-picture-o icon-medium-effect icon-effect-1"></i>
                                @else
                                    <i class="fa  fa-file-file-o icon-medium-effect icon-effect-1"></i>
                                @endif
                            </div>
                            <div class="service-content">
                                <h4>{{$download->name}}</h4>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @endif
        </div>
    </div>
</div>
@stop