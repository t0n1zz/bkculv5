<?php
$navberita = KategoriArtikel::whereNotIn('id',array(1,4,8))->get();
?>
@extends('_layouts.layout')

@section('content')
        <!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Site Map</h2>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Site Map</li>
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
            <div class="col-md-6 col-sm-6">
                <div class="list-group">
                    <a href="{{ route('home') }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Home</h4>
                        <p class="list-group-item-text">Halaman Utama Website Puskopdit BKCU Kalimantan</p>
                    </a>
                    <a href="{{ route('kegiatan') }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Kegiatan</h4>
                        <p class="list-group-item-text">Halaman Kegiatan yang diselenggarakan Puskopdit BKCU Kalimantan</p>
                    </a>
                    <a href="{{ route('artikel',array(0)) }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Semua Berita</h4>
                        <p class="list-group-item-text">Halaman semua berita di website Puskopdit BKCU Kalimantan</p>
                    </a>
                    @foreach($navberita as $berita)
                        <a href="{{ route('artikel',array($berita->id)) }}" class="list-group-item">
                            <h4 class="list-group-item-heading">{{$berita->name}}</h4>
                            <p class="list-group-item-text">Halaman {{$berita->name}} di website Puskopdit BKCU Kalimantan</p>
                        </a>
                    @endforeach
                    <a href="{{ route('profil') }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Profil</h4>
                        <p class="list-group-item-text">Halaman informasi lengkap mengenai Puskopdit BKCU Kalimantan</p>
                    </a>
                    <a href="{{ route('pelayanan') }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Pelayanan</h4>
                        <p class="list-group-item-text">Halaman informasi pelayanan yang di berikan Puskopdit BKCU Kalimantan</p>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <ul class="no-list-style">
                    <a href="{{ route('pengurus') }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Pengurus</h4>
                        <p class="list-group-item-text">Halaman informasi pengurus Puskopdit BKCU Kalimantan</p>
                    </a>
                    <a href="{{ route('pengawas') }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Pengurus</h4>
                        <p class="list-group-item-text">Halaman informasi pengawas Puskopdit BKCU Kalimantan</p>
                    </a>
                    <a href="{{ route('manajemen') }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Pengurus</h4>
                        <p class="list-group-item-text">Halaman informasi manajemen Puskopdit BKCU Kalimantan</p>
                    </a>
                    <a href="{{ route('cuprimer') }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Credit Union</h4>
                        <p class="list-group-item-text">Halaman informasi Credit Union dalam jaringan Puskopdit BKCU Kalimantan</p>
                    </a>
                    <a href="{{ route('artikel',array(4)) }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Filosofi</h4>
                        <p class="list-group-item-text">Halaman artikel mengenai filosofi Credit Union</p>
                    </a>
                    <a href="{{ route('artikel',array(8)) }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Sejarah</h4>
                        <p class="list-group-item-text">Halaman artikel mengenai sejarah Credit Union dan Puskopdit BKCU Kalimantan</p>
                    </a>
                    <a href="{{ route('download') }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Download</h4>
                        <p class="list-group-item-text">Halaman untuk mengunduh file yang berkaitan dengan Credit Union dan Puskopdit BKCU Kalimantan</p>
                    </a>
                    <a href="https://www.flickr.com/photos/127271987@N07/" target="_BLANK" class="list-group-item">
                        <h4 class="list-group-item-heading">Foto Kegiatan</h4>
                        <p class="list-group-item-text">Halaman foto kegiatan yang diselenggarakan Puskopdit BKCU Kalimantan</p>
                    </a>
                    <a href="{{ route('hymnecu') }}" class="list-group-item">
                        <h4 class="list-group-item-heading">Hymne CU</h4>
                        <p class="list-group-item-text">Halaman lagu Hymne Credit Union</p>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop