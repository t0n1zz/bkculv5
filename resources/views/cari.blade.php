@extends('_layouts.layout')

@section('content')
<?php $imagepath = 'images_artikel/';?>
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Hasil Pencarian <strong>{{ $key }}</strong></h2>
                <p>Menampilkan Artikel Dengan Kata Kunci <strong>{{ $key }}</strong></p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('artikel',array(0)) }}">Semua Berita</a></li>
                    <li>Pencarian</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
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
                        <div class="portfolio-thumb">
                            @if(!empty($artikel->gambar) && is_file($imagepath.$artikel->gambar."n.jpg"))
                                <a class="lightbox" title="{{ $artikel->judul }}" href="{{ asset($imagepath.$artikel->gambar.".jpg") }}">
                                    <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                    {{ HTML::image($imagepath.$artikel->gambar.'n.jpg',$artikel->judul,
                                        array('class' => 'img-responsive ')) }}
                                </a>
                            @else
                                <a class="lightbox" title="{{ $artikel->judul }}" href="{{ asset('images/image-article.jpg') }}">
                                    <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                    {{ HTML::image('images/image-articlen.jpg', $artikel->judul, array(
                                        'class' => 'img-responsive')) }}
                                </a>
                            @endif
                        </div>
                        <hr/>
                        <div class="left-meta-post">
                            <?php $date = new Date($artikel->created_at); ?>
                            <div class="post-date"><span class="day">{{ $date->format('j') }}</span><span class="month">{{ $date->format('M') }}</span></div>
                            <div class="post-type"><i class="fa fa-picture-o"></i></div>
                        </div>
                        <h3 class="post-title"><a href="{{ route('artikel_detail',array($artikel->id)) }}">{{ $artikel->judul}}</a></h3>
                        <div class="post-content">
                            <p>
                                <a href="{{ route('artikel_detail',array($artikel->id)) }}" style="color:#666;">
                                    {{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $artikel->content),100) }}
                                </a>
                            </p>
                        </div>
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
@stop