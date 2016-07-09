@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Hyme Credit Union</h2>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Hymne Credit Union</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<div id="content">
<div class="container">
    <div class="row">
        <!-- Blog Post -->
        <div class="col-md-12">
            <div class="text-center">
            <audio controls autoplay>
                <source src="{{ asset('music/CU_melodi.mp3') }}" type="audio/mpeg">
                Browser anda tidak mendukung pemutar lagu.
            </audio>
            </div>
        </div>
        <div class="col-md-12">
            <div class="text-center">
                <img alt="" src="{{ asset('images/hymnecu.png') }}" />
            </div>
        </div>
    </div>
</div>
</div>
<!--modal photos-->
<div class="modal fade" id="modalphotoshow">
    <div class="modal-body">
      <img class="pointer img-responsive center-block" src="" id="modalimage"/>
    </div>
</div>
<!--/modal photos-->
@stop