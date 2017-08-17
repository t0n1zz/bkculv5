@extends('_layouts.layout')

@section('content')
<?php $imagepath = 'images_artikel/';?>
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>{{ $title }}</h2>
                <p>Menampilkan Artikel <strong>{{ $title }}</strong></p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>{{ $title }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<!-- artikel list -->
<div id="content">
    <div class="container">
        <div class="page-content">
            <div class="row latest-posts-classic">
                <div class="col-md-12">
                    <!-- Call Action Button -->
                    {{ Form::open(array('route' => array('cari'),'method' => 'get')) }}
                    <!-- Call Action Text -->
                    <div class="input-group">
                        {{ Form::text('q',null,array('class' => 'form-control', 'placeholder' => 'Masukkan kata kunci'))}}
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                    </div>
                    {{ Form::close() }}
                </div>
                <div class="hr1 margin-top"></div>
                <div class="hr1 margin-top"></div>
                @if($artikels->isEmpty())
                    <div class="col-md-12 ">
                        <div class="call-action call-action-boxed call-action-style1 clearfix">
                            <!-- Call Action Button -->
                            <!-- Call Action Text -->
                            <h2 class="primary">Maaf <strong>Artikel tidak ditemukan</strong></h2>
                            <p>Silahkan kunjungi kembali lain waktu...</p>
                        </div>
                    </div>
                    <div class="hr1 margin-top"></div>
                @else
                @foreach($artikels as $artikel)
                        <div class="col-md-4 col-sm-6 post-row portfolio-item">
                            <div class="portfolio-thumb" style="padding-bottom: 1em">
                                @if(!empty($artikel->gambar) && is_file($imagepath.$artikel->gambar."n.jpg"))
                                    <a class="lightbox" title="{{ $artikel->judul }}" href="{{ asset($imagepath.$artikel->gambar.".jpg") }}">
                                        <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                        {{ Html::image($imagepath.$artikel->gambar.'n.jpg',$artikel->judul,
                                            array('class' => 'img-responsive ')) }}
                                    </a>
                                @else
                                    <a class="lightbox" title="{{ $artikel->judul }}" href="{{ asset('images/image-article.jpg') }}">
                                        <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                        {{ Html::image('images/image-articlen.jpg', $artikel->judul, array(
                                            'class' => 'img-responsive')) }}
                                    </a>
                                @endif
                            </div>
                            <h4 style="border-bottom: thin solid #00afd1 ;padding-bottom:1em;">
                                <a href="{{ route('artikel_detail',array($artikel->id)) }}">{{ $artikel->judul}}</a>
                                <?php $date = new Date($artikel->created_at); ?>
                                <br/><small>
                                    <i class="fa fa-fw fa-calendar"></i> {{ $date->format('l, j F Y, H:i') }}
                                    &nbsp&nbsp&nbsp
                                    <i class="fa fa-fw fa-user"></i> {{ $artikel->penulis }}
                                </small>
                            </h4>
                            <p>
                                <a href="{{ route('artikel_detail',array($artikel->id)) }}" style="color:#666;">
                                    {{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $artikel->content),200) }}
                                </a>
                            </p>
                        </div>
                @endforeach
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 pagination-wrapper">
                    @if(!empty($key))
                        {{ $artikels->appends(array('q' => $key))->links() }}
                    @else
                        {{ $artikels->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /artikel list -->
@stop