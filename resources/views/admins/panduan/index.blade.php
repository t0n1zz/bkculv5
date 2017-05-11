<?php 
$appname = "SIMO";
$versi = "2.1.3";
$imagepath = "images_panduan/";
?>
@extends('admins.panduan.layout')

@section('css')
@stop

@section('content')
<section id="pendahuluan">
    <h2 class="page-header"><a href="#pendahuluan">Pendahuluan</a></h2>
    <p class="lead">
        Selamat datang di panduan pengoperasian aplikasi berbasis website <b>{{ $appname }}</b>. Panduan ini dibuat untuk memberikan pemahaman kepada pengguna, cara pengoperasian aplikasi <b>{{ $appname }}</b>.
    </p>
    <div class="callout callout-warning lead">
        <h4>Perhatian!</h4>
        <p>
            Panduan ini untuk aplikasi website <b>{{ $appname }}</b> versi {{ $versi }}, jadi mungkin akan terdapat perbedaan dalam penjelasan apabila versi panduan ini dan versi aplikasi <b>{{ $appname }}</b> berbeda. Untuk mengetahui versi aplikasi {{ $appname }}, bisa lihat penjelasannya di bagian <a href="#dashboard-footer"><b>footer</b></a>. <br/>
        </p>
    </div>
    <div class="callout callout-danger lead">
        <h4>Penting!</h4>
        <p>
            Aplikasi ini memerlukan <b>koneksi internet</b> dan browser yang digunakan mesti sudah mendukung <b>HTML5</b> dan <b>Javascript</b>. Hubungi bagian IT apabila terjadi masalah dalam mengakses aplikasi.
        </p>
    </div>
</section>
<section id="login">
    <h2 class="page-header"><a href="#login">Login</a></h2>
    <p class="lead">
        Aplikasi <b>{{ $appname }}</b> merupakan aplikasi berbasis website, maka untuk mengaksesnya adalah melalui <b>browser</b> pada komputer/gadget pengguna. Kemudian di <b>address bar</b> ketikkan <code><a href="http://puskopditbkcukalimantan.org/admins" target="_blank">www.puskopditbkcukalimantan.org/admins</a></code> kemudian pengguna akan sampai ke halaman login. 
    </p>
    {{ Html::image($imagepath.'login.png','Login', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Pada halaman <b>login</b> pengguna mesti mengisi <b>username</b> dan <b>password</b> sesuai dengan yang telah diberikan dari <b>Puskopdit BKCU Kalimantan</b> kemudian menekan tombol <button class="btn btn-primary btn-float disabled"><i class="fa fa-sign-in"></i> Login</button> untuk masuk kedalam aplikasi {{ $appname }}.
    </p>
</section>
<section id="dashboard">
    @include('admins.panduan.dashboard')
</section>
<section id="cu">
    @include('admins.panduan.cu')
</section>
<section id="laporancu">
    @include('admins.panduan.laporancu')
</section>
<section id="diklat">
    @include('admins.panduan.diklat')
</section>
@stop
@section('js')
    <script type="text/javascript">
    </script>
@stop