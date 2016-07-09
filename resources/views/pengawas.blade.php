@extends('_layouts.layout')

@section('content')
        <!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Pengawas Puskopdit BKCU Kalimantan</h2>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Pengawas Puskopdit BCKU Kalimantan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<?php $imagepath = 'images_staf/';?>
<div id="content">
    <div class="container">
        <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
            <h1>Pengawas <strong>Puskopdit BKCU Kalimantan</strong></h1>
            <p>Periode 2015 - 2017</p>
        </div>
        <div class="row" data-animation="fadeInDown" data-animation-delay="01">
            @foreach($pengawases2 as $pengawas)
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="team-member">
                        <div class="member-photo">
                            @if(!empty($pengawas->gambar) && is_file($imagepath.$pengawas->gambar.".jpg"))
                                {{ Html::image($imagepath.$pengawas->gambar.'.jpg',$pengawas->name) }}
                            @else
                                {{ Html::image('images/no_image_man.jpg', $pengawas->name) }}
                            @endif
                        </div>
                        <div class="member-info">
                            <strong>{{ $pengawas->name }}</strong>
                            <br/>
                            {{ $pengawas->jabatan }}
                            <hr/>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="hr1" style="margin-bottom:50px;"></div>
        <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
            <h1>Pengawas <strong>Puskopdit BKCU Kalimantan</strong></h1>
            <p>Periode 2012 - 2014</p>
        </div>
        <div class="row" data-animation="fadeInDown" data-animation-delay="01">
            @foreach($pengawases1 as $pengawas)
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="team-member">
                        <div class="member-photo">
                            @if(!empty($pengawas->gambar) && is_file($imagepath.$pengawas->gambar.".jpg"))
                                {{ Html::image($imagepath.$pengawas->gambar.'.jpg',$pengawas->name) }}
                            @else
                                {{ Html::image('images/no_image_man.jpg', $pengawas->name) }}
                            @endif
                        </div>
                        <div class="member-info">
                            <strong>{{ $pengawas->name }}</strong>
                            <br/>
                            {{ $pengawas->jabatan }}
                            <hr/>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop