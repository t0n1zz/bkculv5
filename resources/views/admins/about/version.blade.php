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
        <li class="active"><i class="fa fa-info"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <ul class="timeline">
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
                    <i class="fa fa-gears bg-purple"></i>
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