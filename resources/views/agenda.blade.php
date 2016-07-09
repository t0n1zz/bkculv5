@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Kegiatan</h2>
                <p>Kegiatan yang diselenggarakan bidang <strong>DIKLAT</strong></p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Kegiatan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<div id="content">
<div class="container">
    <div class="page-content">
        {{--kegiatan--}}
        <div class="row">
            <div class="col-md-12">
                <h4 class="classic-title"><span>Jadwal Diklat 2016</span></h4>
                <br/>
                <div class="table-responsive">
                    <table class="table table-stripped table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis Diklat</th>
                            <th>Wilayah</th>
                            <th>Tempat</th>
                            <th>Waktu</th>
                            <th>Sasaran Peserta</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($kegiatans->isEmpty())
                            <tr>
                                <td colspan="6">Belum terdapat kegiatan</td>
                            </tr>
                        @else
                        @foreach($kegiatans as $kegiatan)
                            <tr>
                                @if(!empty($kegiatan->tanggal))
                                    <?php $date = new Date($kegiatan->tanggal); ?>
                                    <td><i hidden="true">{{  $kegiatan->tanggal }}</i> {{ $date->format('l, j F Y') }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($kegiatan->name))
                                    <td>{{ $kegiatan->name }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($kegiatan->wilayah))
                                    <td>{{ $kegiatan->wilayah }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if(!empty($kegiatan->tempat))
                                    <td>{{ $kegiatan->tempat }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                <?php
                                $startTimeStamp = strtotime($kegiatan->tanggal);
                                $endTimeStamp = strtotime($kegiatan->tanggal2);
                                $timeDiff = abs($endTimeStamp - $startTimeStamp);
                                $numberDays = $timeDiff/86400;
                                $numberDays = intval($numberDays) + 1;
                                $realnumber = sprintf("%02s", $numberDays);
                                ?>
                                <td class="event-venue"><i hidden="true">{{ $realnumber }}</i> {{ $numberDays  }} Hari</td>

                                @if(!empty($kegiatan->sasaran))
                                    <td>{{ $kegiatan->sasaran }}</td>
                                @else
                                    <td>-</td>
                                @endif
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <br/>
                <div class="call-action call-action-boxed call-action-style3 clearfix">
                    <!-- Call Action Button -->
                    <div class="button-side" style="margin-top:4px;">
                        <a href="https://drive.google.com/file/d/0B5-CAlY_YuBDaEcxMDM2blNYeGM/view?usp=sharing"
                           target="_blank" class="btn-system border-btn btn-medium">Dapatkan Katalog Diklat 2015</a>
                        <br/><br/>
                        <a href="https://drive.google.com/file/d/0B5-CAlY_YuBDY2Nuc1BxT1VxVU0/view?usp=sharing"
                           target="_blank" class="btn-system border-btn btn-medium">Dapatkan Katalog Diklat 2016</a>
                    </div>
                    <!-- Call Action Text -->
                    <h2 class="primary">Kami juga menyediakan <strong>Katalog Diklat</strong></h2>
                    <p>Katalog Diklat di buat untuk memberikan informasi dan pemahaman lebih mengenai Diklat yang diselenggarakan.</p>
                </div>
                <div class="hr1 margin-top"></div>
            </div>
        </div>
        {{--kegiatan--}}
        <div class="hr1 margin-top"></div>
        {{--foto kegiatan--}}
        <div class="row">
            <div class="col-md-12">
                <h4 class="classic-title"><span>Foto Kegiatan</span></h4>
                <div class="recent-projects">
                    <div class="projects-carousel touch-carousel navigation-3">
                        @foreach($gambars as $gambar)
                            <div class="portfolio-item item ">
                                <div class="portfolio-border">
                                    <div class="portfolio-thumb">
                                        <?php
                                        $img_url = "http://farm{$gambar['farm']}.staticflickr.com/{$gambar['server']}/{$gambar['id']}_{$gambar['secret']}.jpg";
                                        $img_url_big = "http://farm{$gambar['farm']}.staticflickr.com/{$gambar['server']}/{$gambar['id']}_{$gambar['secret']}_b.jpg";
                                        ?>
                                        <a class="lightbox" data-lightbox-type="ajax" title="" href="{{ $img_url_big }}">
                                            <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                            <div style="width: 265px;height: 176px;overflow: hidden">
                                                <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                                     data-src="{{$img_url}}" alt="flickr bkcu image" />
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-12" data-animation="fadeInDown" data-animation-delay="01">
                <div class="hr1 margin-top"></div>
                <div class="call-action call-action-boxed call-action-style2 clearfix">
                    <div class="button-side" style="margin-top:4px;">
                        <a href="https://www.flickr.com/photos/127271987@N07/"
                           target="_blank" class="btn-system border-btn btn-medium">Lihat Semua Foto</a></div>
                    <h2 class="primary">Ingin melihat semua <strong>Foto Kegiatan?</strong></h2>
                    <p>Semua foto kegiatan kami simpan di <strong>flickr</strong> </p>
                </div>
            </div>
        </div>
        {{--foto kegiatan--}}
    </div>
</div>
</div>

@stop