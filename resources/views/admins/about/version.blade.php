<?php
$title = "Version";
?>

@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-th-list"></i> {{ $title }}
        <small>Version admin site and public site</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-th-list"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <ul class="timeline">
                <li class="time-label">
                  <span class="bg-red">
                    9 Desember 2016
                  </span>
                </li>
                <li>
                    <i class="fa fa-gears bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 15:00</span>
                        <h3 class="timeline-header"><a href="#">Version 2.1.0</a> admin site</h3>
                        <div class="timeline-body">
                            Penambahan fitur bagian laporan cu yang berfungsi untuk menampilkan perkembangan Credit Union diserta dengan perhitungan analisis P.E.A.R.L.S serta upgrade sistem utama aplikasi dari versi 4.2 ke versi 5.2 dan peningkatan fitur-fitur pada plugin yang dipakai.
                            <br/><br/>
                            Berikut adalah rincian perubahan pada versi ini:
                            <br/><br/>
                            <ul>
                                <li>Upgrade laravel versi 4.2 ke versi 5.2 yang menawarkan:
                                    <ul>
                                        <li>Support PHP 7</li>
                                        <li>Peningkatan keamanan dengan "middleware"</li>
                                        <li>Peningkatan eksekusi kode program</li>
                                        <li>Penambahan dukungan terhadap plugin-plugin</li>
                                        <li>Proteksi semua input terhadap serangan SQL injection</li>
                                    </ul>
                                </li>     
                                <li>Penambahan bagian laporan cu yang berfungsi:
                                    <ul>
                                        <li>Menampung dan mengolah data laporan keuangan CU menjadi laporan perkembangan CU serta analisis P.E.A.R.L.S</li>
                                        <li>Menampilkan laporan CU dalam tabel interaktif serta grafik</li>
                                        <li>Input data laporan melalui upload excel <small class="label bg-yellow">beta</small></li>
                                    </ul>
                                </li>
                                <li>Penambahan bagian TP CU untuk mendata informasi TP tiap CU secara lebih mendetail</li>
                                <li>Penambahan bagian admin untuk CU yang memungkinkan staf CU untuk:
                                    <ul>
                                        <li>Mengisi / mengubah profil dari CU</li>
                                        <li>Menambah, mengubah dan menghapus data TP di CU</li>
                                        <li>Menambah, mengubah dan menghapus laporan CU</li>
                                    </ul>
                                </li>        
                                <li>Penambahan fitur dan perubahan penggunaan pada Datatable</li>
                                <li>Penambahan fitur text editor untuk bagian artikel</li>
                                <li>Penambahan fitur pada bagian admin</li>
                                <li>Pengubahan struktur navigasi sidebar</li>
                                <li>Penambahan fitur validator untuk validasi input</li>
                                <li>Penggunaan input mask untuk pengisian tanggal serta pengisian angka</li>
                                <li>Penggunaan pace untuk animasi loading resource dan request ajax</li>
                                <li>Penggantian Plugin ACL entrust dengan kodeine untuk integrasi lebih lanjut dengan laravel ACL</li>
                                <li>Menghapus plugin flickering untuk akses ke flickr</li>
                            </ul>
                            <hr/>
                        </div>
                    </div>
                </li>
                <li class="time-label">
                  <span class="bg-red">
                    2 Januari 2016
                  </span>
                </li>
                <li>
                    <i class="fa fa-gears bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 14:00</span>
                        <h3 class="timeline-header"><a href="#">Version 2.0.1</a> admin site</h3>
                        <div class="timeline-body">
                            Pengubahan penggunaan rich text editor dari CKeditor menjadi Summernote.
                            <br/><br/>
                            Berikut adalah rincian perubahan pada versi ini:
                            <br/><br/>
                            <ul>
                                <li>Penggantian CKeditor menjadi Summernote</li>
                                <li>Pengubahan cara penanganan gambar pada Summernote</li>
                                <li>Peningkatan penanganan upload gambar dengan metode baru yang diperkenalkan
                                pada versi Intervention Image v2.x</li>
                                <li>Penambahan halaman version</li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="time-label">
                  <span class="bg-red">
                    31 Desember. 2015
                  </span>
                </li>
                <li>
                    <i class="fa fa-gears bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 13:15</span>
                        <h3 class="timeline-header"><a href="#">Version 2.0.0</a> Admin Site</h3>
                        <div class="timeline-body">
                            Rombak ulang keseluruhan tampilan admin menjadi lebih mudah di operasikan, lebih responsive/mobile friendly dan
                            pengubahan code php pada controller dan model untuk peningkatan performa dan konsistensi pada tiap
                            pengoperasian.<br/><br/>
                            Berikut adalah rincian perubahan pada versi ini:
                            <br/><br/>
                            <ul>
                                <li>Pengalaman penggunaan dengan desain yang lebih modern dan responsive</li>
                                <li>Sidebar yang fleksibel dan responsive</li>
                                <li>Upgrade bootstrap v3.3.2</li>
                                <li>Upgrade font-awesome v4.5.0</li>
                                <li>Upgrade Datatables v1.10.10</li>
                                <li>Upgrade Image Intervention v2.x</li>
                                <li>Upgrade Jquery v2.1.3 </li>
                                <li>Penambahan fitur pada semua tabel di halaman kelola yaitu
                                    <ul>
                                        <li>Tabel menjadi responsive dan dapat menyesuaikan di hampir semua ukuran layar.
                                            maka apabila layar terlalu kecil untuk kolom, kolom otomatis akan disembunyikan dan
                                            akan muncul tombol untuk menampilkan kolom yang telah di sembunyikan tersebut</li>
                                        <li>Warp text pada masing-masing cell di kolom untuk pemanfaatan ruang kosong pada cell</li>
                                        <li>Colum priority pada kolom hapus,ubah dan detail membuat kolom tersebut tidak akan
                                            tersembunyi apabila ukuran layar terlalu kecil untuk semua tabel</li>
                                        <li>Pengubahan cara berinteraksi pada tiap tabel agar lebih konsisten</li>
                                    </ul>
                                </li>
                                <li>Penambahan fitur pada semua form di halaman tambah dan ubah yaitu
                                    <ul>
                                        <li>Peningkatan desain yang lebih modern dan lebih jelas fungsinya</li>
                                        <li>Penggunaan input mask pada pengisian tanggal untuk mempermudah pengisian tanggal</li>
                                        <li>Peningkatan pada CKeditor dengan menambahkan fitur responsive pada gambar</li>
                                        <li>Penggunaan laravel validation pada input text untuk menginformasikan bagian yang bermasalah</li>
                                        <li>Peningkatan visualisasi dan informasi yang disampaikan pada bagian pemberitahuan setelah melakukan penyimpanan atau pengubahan data</li>
                                    </ul>
                                </li>
                                <li>Peningkatan cara mengangani error dan penyampaian informasi error yang lebih informatif dan akurat</li>
                                <li>Peningkatan penanganan upload gambar</li>
                                <li>Penambahan halaman detail staf untuk pemberian informasi lengkap mengenai staf</li>
                                <li>Peningkatan halaman admin (kelola admin,tambah admin, ubah admin) yaitu
                                    <ul>
                                        <li>Pengubahan cara mengubah password</li>
                                        <li>Penambahan tipe admin untuk membedakan admin BKCU dan admin CU Primer</li>
                                        <li>Menyatukan tipe admin CU Primer dengan data CU Primer yang dipilih</li>

                                    </ul>
                                </li>
                                <li>Perbaikan error routing pada beberapa halaman</li>
                                <li>Perbaikan error pada controller</li>
                                <li>Perbaikan error pada model</li>
                            </ul>
                            <hr/>
                        </div>
                    </div>
                </li>
                <li>
                    <i class="fa fa-gears bg-aqua"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 13:15</span>
                        <h3 class="timeline-header"><a href="#">Version 3.0.0</a> Public Site</h3>
                        <div class="timeline-body">
                            Rombak ulang seluruh halaman pada website publik dengan tampilan yang lebih bersih, modern,
                            responsive/mobile friendly dan visualisasi yang lebih bai k. Pada update kali ini semua
                            bagian pada halaman telah di desain ulang menyesuaikan tema halaman dengan warna dasar putih
                            dan biru serta background yang dapat disesuaikan dengan keadaan/event yang sedang berlangsung.<br/>
                            Serta penambahan halaman CU untuk melakukan pengubahan dan penambahan data pada data CU Primer.
                            <br/><br/>
                            Berikut adalah rincian perubahan pada versi ini:
                            <br/><br/>
                            <ul>
                                <li>Penambahan plugin javascript yaitu:
                                    <ul>
                                        <li>jquery.fitvids</li>
                                        <li>nivo-lightbox</li>
                                        <li>jquery.isotope</li>
                                        <li>jquery.appear</li>
                                        <li>count.to</li>
                                        <li>jquery.textillate</li>
                                        <li>jquery.lettering</li>
                                        <li>jquery.easypiechart</li>
                                        <li>jquery.nicescroll</li>
                                        <li>jquery.parallax</li>
                                        <li>jquery.slicknav</li>
                                    </ul>
                                </li>
                                <li>Upgrade bootstrap v3.3.2</li>
                                <li>Upgrade font-awesome v4.5.0</li>
                                <li>Upgrade Jquery v2.1.4</li>
                                <li>Upgrade plugin google maps</li>
                                <li>Penghapusan plugin social network sharing</li>
                                <li>Pengubahan fitur sharing social network, tidak bergantung pada plugin lagi tapi
                                dibangun 1-1 sesuai guidelines dari sharing API masing-masing social network</li>
                                <li>Penambahan animasi melalui css pada beberapa komponen halaman</li>
                                <li>Peningkatan carousel pada halaman utama untuk artikel pilihan menjadi lebih elegan
                                    dan informatif</li>
                                <li>Peningkatan zoom foto/gambar di seluruh halaman dengan menggunakan lightbox</li>
                                <li>Peningkatan menu yang lebih responsive dengan tampilan yang lebih rapi dan bersih</li>
                                <li>Peningkatan pengalaman membaca artikel dengan tulisan serta layout yang lebih nyaman di mata</li>
                                <li>Peningkatan pengalaman berinteraksi dan konsistensi desain secara keseluruhan pada semua halaman.</li>
                            </ul>
                            <hr/>
                        </div>
                    </div>
                </li>
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section>
@stop