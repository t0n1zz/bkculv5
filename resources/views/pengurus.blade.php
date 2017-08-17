@extends('_layouts.layout')

@section('content')
<?php $imagepath = 'images_staf/';?>
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Pengurus Puskopdit BKCU Kalimantan</h2>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Pengurus Puskopdit BCKU Kalimantan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<div id="content">
    <div class="container">
        <div class="row" data-animation="fadeInDown" data-animation-delay="01">
            @foreach($penguruses2 as $pengurus)
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="team-member">
                        <div class="member-photo">
                            @if(!empty($pengurus->gambar) && is_file($imagepath.$pengurus->gambar.".jpg"))
                                {{ Html::image($imagepath.$pengurus->gambar.'.jpg',$pengurus->name) }}
                            @else
                                {{ Html::image('images/no_image_man.jpg', $pengurus->name) }}
                            @endif
                        </div>
                        <div class="member-info">
                            <strong>{{ $pengurus->name }}</strong>
                            <br/>
                            {{ $pengurus->jabatan }}
                            <hr/>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="hr1" style="margin-bottom:50px;"></div>
        <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
            <h1>Pengurus <strong>Puskopdit BKCU Kalimantan</strong></h1>
            <p>Periode 2012 - 2014</p>
        </div>
        <div class="row" data-animation="fadeInDown" data-animation-delay="01">
            @foreach($penguruses1 as $pengurus)
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="team-member">
                        <div class="member-photo">
                            @if(!empty($pengurus->gambar) && is_file($imagepath.$pengurus->gambar.".jpg"))
                                {{ Html::image($imagepath.$pengurus->gambar.'.jpg',$pengurus->name) }}
                            @else
                                {{ Html::image('images/no_image_man.jpg', $pengurus->name) }}
                            @endif
                        </div>
                        <div class="member-info">
                            <strong>{{ $pengurus->name }}</strong>
                            <br/>
                            {{ $pengurus->jabatan }}
                            <hr/>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop