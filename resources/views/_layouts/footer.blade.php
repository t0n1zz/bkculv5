<?php
$navberita = App\KategoriArtikel::whereNotIn('id',array(1,4,8))->get();
$infogerakan = App\InfoGerakan::find(1);
?>
{{--footer--}}
<footer>
    <div class="container">
        {{--footer widgets--}}
        <div class="row footer-widgets">
            {{--infogerakan--}}
            <div class="col-md-3 col-sm-6">
                <div class="footer-widget">
                    <h4>Info Gerakan<span class="head-line"></span></h4>
                    <p>
                        @if(!empty($infogerakan->tanggal))
                            <?php $date = new Date($infogerakan->tanggal) ?>
                            <b>Per tanggal :</b> {{ $date->format('j F Y ')}}
                            <br/>
                        @endif
                        @if(!empty($infogerakan->jumlah_anggota))
                            <b>Jumlah Anggota :</b> {{ number_format($infogerakan->jumlah_anggota,0,",",".") }} orang
                            <br/>
                        @endif
                        @if(!empty($infogerakan->jumlah_cu))
                            <b>Jumlah CU Primer :</b> <a href="{{ route('cuprimer') }}" style="color: #ccc">{{ number_format($infogerakan->jumlah_cu,0,",",".")}} Credit Union</a>
                            <br/>
                        @endif
                        @if(!empty($infogerakan->jumlah_staff_cu))
                            <b>Jumlah Staff CU Primer :</b> {{ number_format($infogerakan->jumlah_staff_cu,0,",",".") }} orang
                            <br/>
                        @endif
                        @if(!empty($infogerakan->asset))
                            <b>Jumlah Asset :</b> Rp. {{ number_format($infogerakan->asset,0,",",".") }}
                            <br/>
                        @endif
                        @if(!empty($infogerakan->piutang_beredar))
                            <b>Jumlah Piutang Beredar :</b> Rp. {{ number_format($infogerakan->piutang_beredar,0,",",".") }}
                            <br/>
                        @endif
                        @if(!empty($infogerakan->piutang_lalai_1))
                            <b>Jumlah Piutang Lalai 1 s.d. 12 Bulan  :</b> Rp. {{ number_format($infogerakan->piutang_lalai_1,0,",",".") }}
                            <br/>
                        @endif
                        @if(!empty($infogerakan->piutang_lalai_2))
                            <b>Jumlah Piutang > 12 Bulan  :</b> Rp. {{ number_format($infogerakan->piutang_lalai_2,0,",",".") }}
                            <br/>
                        @endif
                        @if(!empty($infogerakan->piutang_bersih))
                            <b>Jumlah Piutang Bersih  :</b> Rp. {{ number_format($infogerakan->piutang_bersih,0,",",".") }}
                            <br/>
                        @endif
                        @if(!empty($infogerakan->shu))
                            <b>SHU  :</b> Rp. {{ number_format($infogerakan->shu,0,",",".") }}
                            <br/>
                        @endif
                    </p>
                </div>
                <div class="footer-widget">
                    <h4>Statistik Website<span class="head-line"></span></h4>
                    @include('_components.statistik')
                </div>
            </div>
            {{--infogerakan--}}
            {{--navigasi website--}}
            <div class="col-md-3 col-sm-6">
                <div class="footer-widget">
                    <h4>Navigasi Website<span class="head-line"></span></h4>
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <ul class="no-list-style navigation">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('kegiatan') }}">Kegiatan</a></li>
                                <li><a href="{{ route('artikel',array(0)) }}">Semua Berita</a></li>
                                @foreach($navberita as $berita)
                                    <li><a href="{{ route('artikel',array($berita->id)) }}">{{$berita->name}}</a></li>
                                @endforeach
                                <li><a href="{{ route('profil') }}">Profil</a></li>
                                <li><a href="{{ route('pelayanan') }}">Pelayanan</a></li>
                            </ul>
                        </div>
                        <div class="col-md-5 col-sm-5">
                            <ul class="no-list-style navigation">
{{--                                 <li><a href="{{ route('pengurus') }}">Pengurus</a></li>
                                <li><a href="{{ route('pengawas') }}">Pengawas</a></li>
                                <li><a href="{{ route('manajemen') }}">Manajemen</a></li> --}}
                                <li><a href="{{ route('cuprimer') }}">Credit Union</a></li>
                                <li><a href="{{ route('artikel',array(4)) }}">Filosofi</a></li>
                                <li><a href="{{ route('artikel',array(8)) }}">Sejarah</a></li>
                                <li><a href="{{ route('download') }}">Download</a></li>
                                <li><a href="https://www.flickr.com/photos/127271987@N07/" target="_BLANK">Foto Kegiatan</a></li>
                                <li><a href="{{ route('hymnecu') }}">Hymne CU</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-widget">
                    <h4>External Links<span class="head-line"></span></h4>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="list-inline navigation">
                                <li><a href="http://www.cucoindo.org/" target="_blank">INKOPDIT</a></li>
                                <li><a href="http://www.aaccu.coop/" target="_blank">ACCU</a></li>
                                <li><a href="http://woccu.org/" target="_blank">WOCCU</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{--navigasi website--}}
            {{--saran/kritik--}}
            <div class="col-md-3 col-sm-6">
                <div class="footer-widget mail-subscribe-widget">
                    <h4>Saran / Kritik<span class="head-line"></span></h4>
                    <?php
                    $ip      = $_SERVER['REMOTE_ADDR'];
                    $tanggal = date("Ymd");

                    $s = DB::table('saran')
                            ->where('ip', $ip)
                            ->where('tanggal', $tanggal)
                            ->count();
                    ?>
                    @if($s != 0)
                        <i class="fa fa-check-square-o fa-3x"></i>
                        <p><b>TERIMA KASIH ATAS SARAN / KRITIK ANDA</b> <br/>Saran / Kritik anda akan membantu kami menjadi lebih baik lagi.</p>
                    @else
                        <p>Punya saran ataupun kritik terhadap kami? ayo sampaikan disini</p>
                        {{ Form::open(array('route' => array('saran'))) }}
                        <input type="text" name="name" class="form-control" maxlength='100'
                               placeholder="Silahkan masukkan identitas anda">
                        <br/>
                        <textarea class="form-control" name="content" rows="3" maxlength='250'
                                  placeholder="Silahkan masukkan saran dan kritik anda"></textarea>
                        <br/>
                        <button type="submit" class="btn btn-system" ><i class="fa fa-paper-plane-o"></i> Kirim</button>
                        {{ Form::close() }}
                    @endif
                </div>
            </div>
            {{--saran/kritik--}}
            {{--statistik website--}}
            <div class="col-md-3 col-sm-6">
                <div class="footer-widget contact-widget">
                    <h4>PUSKOPDIT BKCU KALIMANTAN<span class="head-line"></span></h4>
                    <p>Jaringan Puskopdit BKCU Kalimantan tersebar hampir ke seluruh wilayah Republik Indonesia.
                        Mayoritas credit union anggota Puskopdit BKCU Kalimantan berkembang dengan baik aset dan jumlah anggota cukup kencang peningkatannya.</p>
                    <ul>
                        <li><span>Alamat:</span> <br/>Jalan Imam Bonjol Gg. H. Mursyid 1 No. 7-8, Pontianak, ID</li>
                        <li><span>Telepon:</span> 0561 765591</li>
                        <li><span>Fax:</span> 0561-769459</li>
                        <li><span>Email:</span> cucoborneo@hotmail.com</li>
                    </ul>
                </div>
            </div>
            {{--statistik website--}}
        </div>
        {{--footer widgets--}}
        {{--copyright--}}
        <div class="copyright-section">
            <div class="row">
                <div class="col-md-6">
                    All Rights Reserved <a href="http://graygrids.com">GrayGrids</a><br/>
                    &copy; <?php echo date("Y") ?> Puskopdit BKCU Kalimantan • Badan Hukum Nomor : 927/BH/M.KUKM.2/X/2010
                </div>
                <div class="col-md-6">
                    <ul class="footer-nav">
                        <li><a href="{{ route('sitemap') }}">Site Map</a></li>
                        <li><a href="{{ route('attribution') }}">Attribution</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

