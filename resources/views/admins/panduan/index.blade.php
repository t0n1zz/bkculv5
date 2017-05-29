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
        Selamat datang di panduan pengoperasian aplikasi berbasis website <b>{{ $appname }}</b>. Panduan ini dibuat untuk memberikan pemahaman kepada anda, cara pengoperasian aplikasi <b>{{ $appname }}</b>. Serta memberikan pemahaman mengenai fungsi dan tujuan di ciptakannya aplikasi <b>{{ $appname }}</b>.
        <br/><br/>
        Panduan ini dibuat dengan beberapa fitur yang akan memudahkan anda dalam mengakses informasi, pada bagian sebelah kiri dari web anda akan melihat kolom hitam yang merupakan daftar isi interaktif, dengan menekan judul dari masing-masing bagian anda dapat langsung dibawa ke bagian yang ditekan.
        <br/><br/>
        Apabila anda ingin menyimpan panduan ini dalam versi offline atau mencetaknya anda dapat menekan tombol <code><i class="fa fa-print"></i> Print/Cetak</code> yang terletak di pojok kanan atas pada halaman ini.
    </p>
    <h3>Perkenalan</h3>
    <p class="lead">
        <b>{{ $appname }}</b> merupakan aplikasi berbasis web yang berfungsi untuk mengolah data dari organisasi. Nama <b>{{ $appname }}</b> sendiri diambil dari singkatan Sistem Informasi Manajemen Organisasi yang menjelaskan bahwa aplikasi ini adalah sebuah sistem informasi yang berfungsi untuk mengatur(manajemen) data dari organisasi (gerakan Puskopdit BKCU Kalimantan).
        <br/><br/>
        Aplikasi ini menyediakan fitur-fitur yaitu:
        <ol>
            <li><b>Pusat kontrol website Puskopdit BKCU Kalimantan</b>: yang mencakup kontrol artikel yang ada di website, pengumuman, saran serta komponen dalam website Puskopdit BKCU Kalimantan.</li>
            <li><b>Pusat data CU</b>: merupakan pusat data hal-hal yang berkaitan dengan CU seperti data staf CU yang terhubung dengan riwayat mengikuti pelatihan/diklat, profil CU, data TP/KP/Cabang, dan data-data lainnya yang digunakan untuk membuat sebuah portal CU di website Puskopdit BKCU Kalimantan. Portal CU ini sendiri adalah sebuah pusat informasi yang lengkap mengenai CU anggota Puskopdit BKCU Kalimantan di website. Dengan adanya portal CU ini memudahkan masyarakat dan anggota untuk mendapatkan informasi yang lengkap mengenai CU anggota Puskopdit BKCU Kalimantan.</li>
            <li><b>Pusat data laporan keuangan CU</b>: yang memberikan kemudahan dan kebebasan kepada CU untuk mengisikan laporan keuangan per periode dan akan diolah menjadi kumpulan laporan keuangan lengkap dengan grafik serta perhitungan laporan P.E.A.R.L.S.</li>
            <li><b>Pusat data Diklat</b>: yang merupakan pusat pengolahan seluruh data diklat dan merupakan tempat dilakukannya pendaftaran peserta diklat secara online/langsung melalui aplikasi. </li>
        </ol>
        Dari fitur-fitur diatas maka dapat dilihat bahwa tujuan dari <b>{{ $appname }}</b> adalah untuk menyatukan semua data dalam organisasi kedalam satu tempat yang mudah diakses dan mudah untuk diperbaharui langsung.
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
        Aplikasi <b>{{ $appname }}</b> merupakan aplikasi berbasis website, maka untuk mengaksesnya adalah melalui <b>browser</b> pada komputer/gadget anda. Kemudian di <b>address bar</b> ketikkan <code><a href="http://puskopditbkcukalimantan.org/admins" target="_blank">www.puskopditbkcukalimantan.org/admins</a></code> kemudian anda akan sampai ke halaman login. 
    </p>
    {{ Html::image($imagepath.'login.png','Login', array('class' => 'img-responsive ','style'=>'margin-bottom:10px;')) }}
    <p class="lead">
        Pada halaman <b>login</b> anda mesti mengisi <b>username</b> dan <b>password</b> sesuai dengan yang telah diberikan dari <b>Puskopdit BKCU Kalimantan</b> kemudian menekan tombol <button class="btn btn-primary btn-float disabled"><i class="fa fa-sign-in"></i> Login</button> untuk masuk kedalam aplikasi {{ $appname }}.
    </p>
</section>
<section id="dashboard">
    @include('admins.panduan.dashboard')
</section>
<section id="cu">
    @include('admins.panduan.cu')
</section>
<section id="tpcu">
    @include('admins.panduan.tpcu')
</section>
<section id="laporancu">
    @include('admins.panduan.laporancu')
</section>
<section id="staf">
    @include('admins.panduan.staf')
</section>
<section id="diklat">
    @include('admins.panduan.diklat')
</section>
@stop
@section('js')
    <script type="text/javascript">
    </script>
@stop