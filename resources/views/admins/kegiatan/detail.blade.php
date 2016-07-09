<?php
$title = "Detail Kegiatan";
$kelas = "kegiatan";
?>
@extends('admins._layouts.layout')

@section('content')

<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-database"></i> {{ $title }}
        <small>Informasi Detail Kegiatan </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><i class="fa fa-calendar"></i> Kegiatan</li>
        <li class="active"><i class="fa fa-database"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4>Diklat Pimpinan Manajemen Tingkat Pertama</h4>
        <i class="fa fa-circle-o"></i> Tahun Buku 2014
    </div>
    <br/>
    <a href="#" class="btn btn-primary btn-sm" ><i class="fa fa-print"></i> Print</a>
    <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-list-alt"></i> One Page</a>
    <br/><br/>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#info_1" data-toggle="tab"><b>Info</b></a></li>
            <li><a href="#info_2" data-toggle="tab"><b>Biaya</b></a></li>
            <li><a href="#info_3" data-toggle="tab"><b>Evaluasi</b></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="info_1">
                <div class="row">
                    <div class="col-sm-3 ">
                        <b>District Office</b>: Barat
                        <br/><br/>
                        <b>Lama Kegiatan</b>: 33 Hari
                        <br/>
                        <b>Tanggal Mulai</b>: 24 Mei 2015
                        <br/>
                        <b>Tanggal Selesai</b>: 27 Juni 2015
                        <br/><br/>
                        <b>Sasaran Peserta</b><br/>
                        <p>Manajemen Baru / Staf Baru bukan staf magang</p>
                        <b>Tempat</b><br/>
                        <p>Sarikan dan RRC Pontianak</p>
                    </div>
                    <div class="col-sm-4 ">
                        <p class="lead">Deskripsi Kegiatan</p>
                        <p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architect</p>
                    </div>
                    <div class="col-sm-5">
                        <p class="lead">Status</p>
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa fa-check"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Kegiatan</span>
                                <span class="info-box-number">100%</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                          <span class="progress-description">
                            Sudah selesai dilaksanakan
                          </span>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon"><i class="fa fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Peserta</span>
                                <span class="info-box-number">30 orang</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 80%"></div>
                                </div>
                          <span class="progress-description">
                            Max : 50 | Min : 20
                          </span>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div>
                </div>
            </div><!-- /.tab-pane -->
            <div class="tab-pane fade" id="info_2">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Penerimaan Kas</a>
                            <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Tambah Pengeluaran Kas</a>
                            <br/><br/>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Uraian</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Satuan</th>
                                    <th>Nominal</th>
                                    <th>Total</th>
                                    <th>Hapus</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="8"><b>Penerimaan Kas<b/></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Kas Awal</td>
                                    <td>22-5-2015</td>
                                    <td>El snort testosterone trophy </td>
                                    <td></td>
                                    <td>4.000.000,-</td>
                                    <td>4.000.000,-</td>
                                    <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Kas Tambahan</td>
                                    <td>22-5-2015</td>
                                    <td>El snort testosterone trophy </td>
                                    <td></td>
                                    <td>2.000.000,-</td>
                                    <td>2.000.000,-</td>
                                    <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td colspan="6"><b>Total Penerimaan Kas</b></td>
                                    <td><b>6.000.000,-</b></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="8"><b>Pengeluaran Kas</b></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Call of Duty</td>
                                    <td>22-5-2015</td>
                                    <td>El snort testosterone trophy </td>
                                    <td>2</td>
                                    <td>1.000.000,-</td>
                                    <td>2.000.000,-</td>
                                    <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Need for Speed IV</td>
                                    <td>28-5-2015</td>
                                    <td>Wes Anderson umami biodiesel</td>
                                    <td>1</td>
                                    <td>800.000,-</td>
                                    <td>800.000,-</td>
                                    <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Monsters DVD</td>
                                    <td>24-5-2015</td>
                                    <td>Terry Richardson helvetica</td>
                                    <td>1</td>
                                    <td>1.500.000,-</td>
                                    <td>1.500.000,-</td>
                                    <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Grown Ups Blue Ray</td>
                                    <td>30-5-2015</td>
                                    <td>Tousled lomo letterpress</td>
                                    <td>2</td>
                                    <td>500.000,-</td>
                                    <td>1.000.000,-</td>
                                    <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td colspan="6"><b>Total Pengeluaran Kas</b></td>
                                    <td><b>5.300.000,-</b></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width:50%">Total Penerimaan Kas</th>
                                    <td>Rp. 6.000.000</td>
                                </tr>
                                <tr>
                                    <th>Total Pengeluaran Kas</th>
                                    <td>Rp. 5.300.000,-</td>
                                </tr>
                                <tr>
                                    <th>Saldo Akhir Kas</th>
                                    <td>Rp. 700.000,-</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.tab-pane -->
            <div class="tab-pane fade" id="info_3">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="lead" style="text-align: center">Penyelenggara</p>
                    </div>
                    <div class="col-sm-3">
                        <p class="text-left">
                            <strong><i class="fa fa-clock-o"></i> Waktu</strong>
                        </p>
                        <div class="progress-group">
                            <span class="progress-text"><b>A</b> | Sangat Memuaskan</span>
                            <span class="progress-number"><b>15</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-blue" style="width: 50%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">B | Memuaskan</span>
                            <span class="progress-number"><b>9</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 30%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">C | Cukup Memuaskan</span>
                            <span class="progress-number"><b>3</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width:10%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">D | Kurang Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-yellow" style="width: 5%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">E | Tidak Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-red" style="width: 5%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                    </div>
                    <div class="col-sm-3">
                        <p class="text-left">
                            <strong><i class="fa fa-home"></i> Tempat</strong>
                        </p>
                        <div class="progress-group">
                            <span class="progress-text">A | Sangat Memuaskan</span>
                            <span class="progress-number"><b>15</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-blue" style="width: 50%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">B | Memuaskan</span>
                            <span class="progress-number"><b>9</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 30%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">C | Cukup Memuaskan</span>
                            <span class="progress-number"><b>3</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width:10%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">D | Kurang Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-yellow" style="width: 5%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">E | Tidak Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-red" style="width: 5%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                    </div>
                    <div class="col-sm-3">
                        <p class="text-left">
                            <strong><i class="fa fa-cutlery"></i> Konsumsi</strong>
                        </p>
                        <div class="progress-group">
                            <span class="progress-text">A | Sangat Memuaskan</span>
                            <span class="progress-number"><b>15</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-blue" style="width: 50%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">B | Memuaskan</span>
                            <span class="progress-number"><b>9</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 30%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">C | Cukup Memuaskan</span>
                            <span class="progress-number"><b>3</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width:10%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">D | Kurang Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-yellow" style="width: 5%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">E | Tidak Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-red" style="width: 5%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                    </div>
                    <div class="col-sm-3">
                        <p class="text-left">
                            <strong><i class="fa fa-user"></i> Panitia</strong>
                        </p>
                        <div class="progress-group">
                            <span class="progress-text">A | Sangat Memuaskan</span>
                            <span class="progress-number"><b>15</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-blue" style="width: 50%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">B | Memuaskan</span>
                            <span class="progress-number"><b>9</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 30%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">C | Cukup Memuaskan</span>
                            <span class="progress-number"><b>3</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width:10%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">D | Kurang Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-yellow" style="width: 5%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">E | Tidak Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-red" style="width: 5%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                    </div>
                    <div class="col-sm-12">
                        <hr/>
                        <p class="lead" style="text-align: center">Fasilitator</p>
                    </div>
                    <div class="col-sm-4">
                        <p class="text-left">
                            <strong><i class="fa fa-crosshairs"></i> Penyampaian</strong>
                        </p>
                        <div class="progress-group">
                            <span class="progress-text"><b>A</b> | Sangat Memuaskan</span>
                            <span class="progress-number"><b>15</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-blue" style="width: 50%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">B | Memuaskan</span>
                            <span class="progress-number"><b>9</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 30%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">C | Cukup Memuaskan</span>
                            <span class="progress-number"><b>3</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width:10%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">D | Kurang Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-yellow" style="width: 5%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">E | Tidak Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-red" style="width: 5%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                    </div>
                    <div class="col-sm-4">
                        <p class="text-left">
                            <strong><i class="fa fa-book"></i> Penyajian</strong>
                        </p>
                        <div class="progress-group">
                            <span class="progress-text">A | Sangat Memuaskan</span>
                            <span class="progress-number"><b>15</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-blue" style="width: 50%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">B | Memuaskan</span>
                            <span class="progress-number"><b>9</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 30%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">C | Cukup Memuaskan</span>
                            <span class="progress-number"><b>3</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width:10%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">D | Kurang Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-yellow" style="width: 5%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">E | Tidak Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-red" style="width: 5%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                    </div>
                    <div class="col-sm-4">
                        <p class="text-left">
                            <strong><i class="fa fa-gears"></i> Alat</strong>
                        </p>
                        <div class="progress-group">
                            <span class="progress-text">A | Sangat Memuaskan</span>
                            <span class="progress-number"><b>15</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-blue" style="width: 50%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">B | Memuaskan</span>
                            <span class="progress-number"><b>9</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 30%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">C | Cukup Memuaskan</span>
                            <span class="progress-number"><b>3</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width:10%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">D | Kurang Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-yellow" style="width: 5%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">E | Tidak Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-red" style="width: 5%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                    </div>
                    <div class="col-sm-12">
                        <hr/>
                        <p class="lead" style="text-align: center">Peserta</p>
                    </div>
                    <div class="col-sm-4">
                        <p class="text-left">
                            <strong><i class="fa fa-comments-o"></i> Keaktifan</strong>
                        </p>
                        <div class="progress-group">
                            <span class="progress-text"><b>A</b> | Sangat Memuaskan</span>
                            <span class="progress-number"><b>15</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-blue" style="width: 50%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">B | Memuaskan</span>
                            <span class="progress-number"><b>9</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 30%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">C | Cukup Memuaskan</span>
                            <span class="progress-number"><b>3</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width:10%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">D | Kurang Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-yellow" style="width: 5%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">E | Tidak Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-red" style="width: 5%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                    </div>
                    <div class="col-sm-4">
                        <p class="text-left">
                            <strong><i class="fa fa-child"></i> Daya Serap</strong>
                        </p>
                        <div class="progress-group">
                            <span class="progress-text">A | Sangat Memuaskan</span>
                            <span class="progress-number"><b>15</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-blue" style="width: 50%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">B | Memuaskan</span>
                            <span class="progress-number"><b>9</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 30%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">C | Cukup Memuaskan</span>
                            <span class="progress-number"><b>3</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width:10%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">D | Kurang Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-yellow" style="width: 5%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">E | Tidak Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-red" style="width: 5%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                    </div>
                    <div class="col-sm-4">
                        <p class="text-left">
                            <strong><i class="fa fa-thumbs-up"></i> Memenuhi Harapan?</strong>
                        </p>
                        <div class="progress-group">
                            <span class="progress-text">A | Sangat Memuaskan</span>
                            <span class="progress-number"><b>15</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-blue" style="width: 50%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">B | Memuaskan</span>
                            <span class="progress-number"><b>9</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: 30%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">C | Cukup Memuaskan</span>
                            <span class="progress-number"><b>3</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width:10%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">D | Kurang Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-yellow" style="width: 5%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">E | Tidak Memuaskan</span>
                            <span class="progress-number"><b>2</b>/30</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-red" style="width: 5%"></div>
                            </div>
                        </div><!-- /.progress-group -->
                    </div>
                </div>
            </div>
        </div><!-- /.tab-content -->
    </div>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab"><b>Fasilitator / Panitia</b></a></li>
            <li><a href="#tab_2" data-toggle="tab"><b>Peserta</b></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab_1">
                <div class="table-responsive">
                    <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Fasilitator / Panitia</a>
                    <br/><br/>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Asal</th>
                            <th>Materi</th>
                            <th>Status</th>
                            <th>Insentif</th>
                            <th>Foto</th>
                            <th>Detail</th>
                            <th>Hapus</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Call of Duty</td>
                            <td>testosterone </td>
                            <td>El snort testosterone trophy driving gloves handsome</td>
                            <td>Fasilitator</td>
                            <td>2.000.000,-</td>
                            <td>{{ HTML::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                            'id' => 'tampilgambar', 'width' => '50')) }}</td>
                            <td><a href="#" class="btn btn-info"><i class="fa fa-database"></i></a></td>
                            <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td>Need for Speed IV</td>
                            <td>Anderson</td>
                            <td>Wes Anderson umami biodiesel</td>
                            <td>Panitia</td>
                            <td>800.000,-</td>
                            <td>{{ HTML::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                            'id' => 'tampilgambar', 'width' => '50')) }}</td>
                            <td><a href="#" class="btn btn-info"><i class="fa fa-database"></i></a></td>
                            <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td>Monsters DVD</td>
                            <td>helvetica</td>
                            <td>Terry Richardson helvetica tousled street art master</td>
                            <td>Co-Fasilitator</td>
                            <td>1.500.000,-</td>
                            <td>{{ HTML::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                            'id' => 'tampilgambar', 'width' => '50')) }}</td>
                            <td><a href="#" class="btn btn-info"><i class="fa fa-database"></i></a></td>
                            <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td>Grown Ups Blue Ray</td>
                            <td>letterpress</td>
                            <td>Tousled lomo letterpress</td>
                            <td>Trainee</td>
                            <td>1.000.000,-</td>
                            <td>{{ HTML::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                            'id' => 'tampilgambar', 'width' => '50')) }}</td>
                            <td><a href="#" class="btn btn-info"><i class="fa fa-database"></i></a></td>
                            <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.tab-pane -->
            <div class="tab-pane fade" id="tab_2">
                <div class="table-responsive">
                    <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Peserta</a>
                    <br/><br/>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Asal</th>
                            <th>Jabatan</th>
                            <th>Jenis Kelamin</th>
                            <th>Foto</th>
                            <th>Detail</th>
                            <th>Hapus</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Call of Duty</td>
                            <td>testosterone </td>
                            <td>El snort testosterone trophy driving gloves handsome</td>
                            <td>Laki-laki</td>
                            <td>{{ HTML::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                            'id' => 'tampilgambar', 'width' => '50')) }}</td>
                            <td><a href="#" class="btn btn-info"><i class="fa fa-database"></i></a></td>
                            <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td>Need for Speed IV</td>
                            <td>Anderson</td>
                            <td>Wes Anderson umami biodiesel</td>
                            <td>Laki-laki</td>
                            <td>{{ HTML::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                            'id' => 'tampilgambar', 'width' => '50')) }}</td>
                            <td><a href="#" class="btn btn-info"><i class="fa fa-database"></i></a></td>
                            <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td>Monsters DVD</td>
                            <td>helvetica</td>
                            <td>Terry Richardson helvetica tousled street art master</td>
                            <td>Laki-laki</td>
                            <td>{{ HTML::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                            'id' => 'tampilgambar', 'width' => '50')) }}</td>
                            <td><a href="#" class="btn btn-info"><i class="fa fa-database"></i></a></td>
                            <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td>Grown Ups Blue Ray</td>
                            <td>letterpress</td>
                            <td>Tousled lomo letterpress</td>
                            <td>Laki-laki</td>
                            <td>{{ HTML::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                            'id' => 'tampilgambar', 'width' => '50')) }}</td>
                            <td><a href="#" class="btn btn-info"><i class="fa fa-database"></i></a></td>
                            <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
    </div>
</section>
<div class="clearfix"></div>
@stop