@extends('_layouts.layout')

@section('content')
<?php $imagepath = 'images_artikel/';?>
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>{{ $detail_artikel->KategoriArtikel->name }}</h2>
                <p>Menampilkan Artikel <strong>{{ $detail_artikel->judul }}</strong></p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('artikel',array(0)) }}">Semua Berita</a></li>
                    <li><a href="{{ route('artikel',array($detail_artikel->kategori)) }}">{{ $detail_artikel->KategoriArtikel->name }}</a></li>
                    <li>{{ str_limit($detail_artikel->judul,30) }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page Title -->
<div id="content">
    <div class="container">
        <div class="row blog-post-page">
            <div class="col-md-12 blog-box">
                <div class="blog-post gallery-post">
                    <div class="post-head">
                        @if(!empty($detail_artikel->gambar) && is_file($imagepath.$detail_artikel->gambar.".jpg"))
                            {{ Html::image($imagepath.$detail_artikel->gambar.'.jpg',$detail_artikel->judul,
                                array('class' => 'img-responsive ')) }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9 blog-box">
                <div class="blog-post gallery-post">
                    <div class="post-content" style="padding-left: 0px">
                        <h1>{{ $detail_artikel->judul }}</h1>
                        <br/>
                        <ul class="post-meta">
                            <li><?php $date = new Date($detail_artikel->created_at); ?>
                                <i class="fa fa-fw fa-calendar"></i> <b>{{ $date->format('l, j F Y, H:i') }}</b></li>
                            @if(!empty($detail_artikel->penulis))
                            <li><i class="fa fa-fw fa-user"></i> <b>{{ $detail_artikel->penulis }}</b></li>
                            @endif
                        </ul>
                        <hr/>
                        {!! $detail_artikel->content !!}
                        <div class="post-bottom clearfix">
                            <div class="post-share">
                                <span><b>Share This Post:</b></span>
                                <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}"
                                   onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
                                    <i class="fa fa-facebook"></i></a>
                                <a class="twitter" href="https://twitter.com/share?url={{Request::url()}}&amp;text={{$detail_artikel->judul}}&amp;hashtags=BKCU"
                                   onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
                                    <i class="fa fa-twitter"></i></a>
                                <a class="gplus" href="https://plus.google.com/share?url={{Request::url()}}"
                                   onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
                                    <i class="fa fa-google-plus"></i></a>
                                <a class="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{Request::url()}}"
                                   onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
                                    <i class="fa fa-linkedin"></i></a>
                                <a class="mail" href="javascript:;" onclick="window.print()">
                                    <i class="fa fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 sidebar right-sidebar">
                <div class="widget widget-search">
                    {{ Form::open(array('route' => array('cari'),'method' => 'get')) }}
                        <input type="search" name="q" placeholder="Enter Keywords..." />
                        <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                    {{ Form::close() }}
                </div>

                <div class="widget widget-categories">
                    <h4>Kategori <span class="head-line"></span></h4>
                    <ul>
                        @foreach($kategoris as $kategori)
                        <li>
                            <a href="{{ route('artikel',array($kategori->id)) }}">{{ $kategori->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="widget widget-popular-posts">
                    <h4>Artikel Terbaru</h4>
                    <ul>
                        @foreach($artikelbarus as $artikelbaru)
                            <li>
                                <div class="widget-thumb">
                                    <a href="{{ route('artikel_detail',array($artikelbaru->id)) }}">
                                    @if(!empty($artikelbaru->gambar) && is_file($imagepath.$artikelbaru->gambar."n.jpg"))
                                        {{ Html::image($imagepath.$artikelbaru->gambar.'n.jpg',$artikelbaru->judul,
                                            array('class' => 'img-responsive ')) }}
                                    @else
                                        {{ Html::image('images/image-articlen.jpg', $artikelbaru->judul, array(
                                            'class' => 'img-responsive')) }}
                                    @endif
                                    </a>
                                </div>
                                <div class="widget-content">
                                    <h5>{{ link_to_route('artikel_detail', $artikelbaru->judul, array($artikelbaru->id)) }} </h5>
                                    <?php $date = new Date($artikelbaru->created_at); ?>
                                    <span>{{ $date->format('j F Y') }}</span>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop