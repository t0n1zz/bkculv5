@extends('_layouts.layout')

@section('map')
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
@stop

@section('content')
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Profil Puskopdit BKCU Kalimantan</h2>
                <p>Mari mengenal lebih jauh mengenai Puskopdit BKCU Kalimantan</p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Profil Puskopdit BKCU Kalimantan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<div id="content">
    <div class="container">
        <div class="page-content">
            {{--tentang--}}
            <div class="row">
                <div class="col-md-7">
                    <h4 class="classic-title"><span>Puskopdit BKCU Kalimantan</span></h4>
                    <p>
                        Puskopdit BKCU Kalimantan (awalnya BK3D Kalbar) berdiri pada tanggal 27 November 1988 di Pontianak.<br/>
                        Sebagai credit union sekunder,Puskopdit BKCU Kalimantan aktif mempromosikan dan memfasilitasi berdirinya credit union - credit union primer.<br/>
                        <br/>
                        Jaringan Puskopdit BKCU Kalimantan tersebar hampir ke seluruh wilayah Republik Indonesia.<br/>
                        Mayoritas credit union anggota Puskopdit BKCU Kalimantan berkembang dengan baik;aset dan jumlah anggota cukup kencang peningkatannya.<br/><br/>
                        Walaupun demikian, kami tetap menyadari masih diperlukan pembenahan-pembenahan baik internal maupun eksternal pada masa yang akan datang agar credit union mampu menghadapi berbagai dinamika yang terjadi.
                    </p>
                </div>
                <div class="col-md-5">
                    <div class="touch-slider portfolio-item" data-slider-navigation="true" data-slider-pagination="true">
                        <div class="portfolio-thumb ">
                            <a class="lightbox" data-lightbox-type="ajax" title="Manajemen Puskopdit BKCU Kalimantan" href="{{ asset('images/bkcu.jpg') }}">
                                <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                <div class="item"><img src="{{ asset('images/bkcu.jpg') }}"></div>
                             </a>
                         </div>
                        <div class="portfolio-thumb ">
                            <a class="lightbox" data-lightbox-type="ajax" title="Pengurus dan Pengawas Puskopdit BKCU Kalimantan" href="{{ asset('images/bkcu2.jpg') }}">
                                <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                <div class="item"><img src="{{ asset('images/bkcu2.jpg') }}"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{--tentang--}}
            <div class="hr1" style="margin-bottom:50px;"></div>
            {{--visi misi--}}
            <div class="row">
                <div class="col-md-6">
                    <h4 class="classic-title"><span>Misi Kami</span></h4>
                    <div class="classic-testimonials">
                        <div class="testimonial-content">
                            <p>Memperkuat gerakan Credit Union melalui tata kelola yang terintegrasi untuk
                            meningkatkan kualitas anggota secara berkelanjutan</p>
                        </div>
                    </div>
                    <h4 class="classic-title"><span>Visi Kami</span></h4>
                    <div class="classic-testimonials">
                        <div class="testimonial-content">
                            <p>Menjadi gerakan Credit Union nusantara berbasis komunitas yang terintegrasi,
                                tangguh dan berkelanjutan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="classic-title"><span>Nilai-Nilai Inti</span></h4>
                    <div class="classic-testimonials">
                        <div class="testimonial-content">
                            <p><b>Setia</b> dalam <b>Kesatuan</b>, <b>Memberdayakan</b> secara <b>Unggul</b>
                            dan <b>Innovatif</b> dengan <b>Integritas</b> tinggi serta berperilaku <b>Ramah Lingkungan.</b>
                        </div>
                    </div>
                    <h4 class="classic-title"><span>Slogan</span></h4>
                    <div class="classic-testimonials">
                        <div class="testimonial-content">
                            <p><b style="font-size: medium">Solusi Cerdas Terpercaya</b></p>
                        </div>
                    </div>
                </div>
            </div>
            {{--visi misi--}}
            <div class="hr1" style="margin-bottom:50px;"></div>
            {{--lokasi--}}
            <div class="row">
                <div class="col-md-12">
                    <h4 class="classic-title"><span>Temui Kami</span></h4>
                    <div id="map" data-position-latitude="-0.03946" data-position-longitude="109.34875"></div>
                    <script>
                        (function($) {
                            $.fn.CustomMap = function(options) {

                                var posLatitude = $('#map').data('position-latitude'),
                                        posLongitude = $('#map').data('position-longitude');

                                var settings = $.extend({
                                    home: {
                                        latitude: posLatitude,
                                        longitude: posLongitude
                                    },
                                    text: '<div class="map-popup"><h4>Puskopdit BKCU Kalimantan | Kantor Pusat</h4><p>Kantor Pusat dan Kantor District Office Barat.</p></div>',
                                    icon_url: $('#map').data('marker-img'),
                                    zoom: 15
                                }, options);

                                var coords = new google.maps.LatLng(settings.home.latitude, settings.home.longitude);

                                return this.each(function() {
                                    var element = $(this);

                                    var options = {
                                        zoom: settings.zoom,
                                        center: coords,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                                        mapTypeControl: false,
                                        scaleControl: false,
                                        streetViewControl: false,
                                        panControl: true,
                                        disableDefaultUI: true,
                                        zoomControlOptions: {
                                            style: google.maps.ZoomControlStyle.DEFAULT
                                        },
                                        overviewMapControl: true,
                                    };

                                    var map = new google.maps.Map(element[0], options);

                                    var icon = {
                                        url: settings.icon_url,
                                        origin: new google.maps.Point(0, 0)
                                    };

                                    var marker = new google.maps.Marker({
                                        position: coords,
                                        map: map,
                                        icon: icon,
                                        draggable: false
                                    });

                                    var info = new google.maps.InfoWindow({
                                        content: settings.text
                                    });

                                    google.maps.event.addListener(marker, 'click', function() {
                                        info.open(map, marker);
                                    });

                                    var styles = [{
                                        "featureType": "landscape",
                                        "stylers": [{
                                            "saturation": -100
                                        }, {
                                            "lightness": 65
                                        }, {
                                            "visibility": "on"
                                        }]
                                    }, {
                                        "featureType": "poi",
                                        "stylers": [{
                                            "saturation": -100
                                        }, {
                                            "lightness": 51
                                        }, {
                                            "visibility": "simplified"
                                        }]
                                    }, {
                                        "featureType": "road.highway",
                                        "stylers": [{
                                            "saturation": -100
                                        }, {
                                            "visibility": "simplified"
                                        }]
                                    }, {
                                        "featureType": "road.arterial",
                                        "stylers": [{
                                            "saturation": -100
                                        }, {
                                            "lightness": 30
                                        }, {
                                            "visibility": "on"
                                        }]
                                    }, {
                                        "featureType": "road.local",
                                        "stylers": [{
                                            "saturation": -100
                                        }, {
                                            "lightness": 40
                                        }, {
                                            "visibility": "on"
                                        }]
                                    }, {
                                        "featureType": "transit",
                                        "stylers": [{
                                            "saturation": -100
                                        }, {
                                            "visibility": "simplified"
                                        }]
                                    }, {
                                        "featureType": "administrative.province",
                                        "stylers": [{
                                            "visibility": "on"
                                        }]
                                    }, {
                                        "featureType": "water",
                                        "elementType": "labels",
                                        "stylers": [{
                                            "visibility": "on"
                                        }, {
                                            "lightness": -25
                                        }, {
                                            "saturation": -100
                                        }]
                                    }, {
                                        "featureType": "water",
                                        "elementType": "geometry",
                                        "stylers": [{
                                            "hue": "#ffff00"
                                        }, {
                                            "lightness": -25
                                        }, {
                                            "saturation": -97
                                        }]
                                    }];

                                    map.setOptions({
                                        styles: styles
                                    });
                                });

                            };
                        }(jQuery));

                        jQuery(document).ready(function() {
                            jQuery('#map').CustomMap();
                        });
                    </script>
                </div>
            </div>
            {{--lokasi--}}
            <div class="hr1" style="margin-bottom:50px;"></div>
            {{--cu--}}
            <div class="row">
                <div class="col-md-6">
                    <h4 class="classic-title"><span>Persebaran Credit Union</span></h4>
                    <div class="skill-shortcode">
                        <div class="skill">
                            <p>District Office Barat</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" data-percentage="90">
                                    <span class="progress-bar-span">21 Credit Union</span>
                                    <span class="sr-only">21 Credit Union</span>
                                </div>
                            </div>
                        </div>
                        <div class="skill">
                            <p>District Office Tengah</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" data-percentage="40">
                                    <span class="progress-bar-span">7 Credit Union</span>
                                    <span class="sr-only">7 Credit Union<</span>
                                </div>
                            </div>
                        </div>
                        <div class="skill">
                            <p>District Office Timur</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" data-percentage="70">
                                    <span class="progress-bar-span">16 Credit Union</span>
                                    <span class="sr-only">16 Credit Union</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="classic-title"><span>Alamat District Office</span></h4>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse-1">
                                        <i class="fa fa-angle-up control-icon"></i>
                                        District Office Barat
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    Jalan Imam Bonjol Gg. H. Mursyid 1 No. 7-8<br/>
                                    Pontianak<br/>
                                    Kalimantan Barat 78123<br/>
                                    Telp : 0561-765591 • Fax : 0561-769459<br/>
                                    cucoborneo@hotmail.com
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse-2">
                                        <i class="fa fa-angle-up control-icon"></i>
                                        District Office Tengah
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Jalan Kapuas No. 23 RT.4/RW5<br/>
                                    Kelurahan Palangka, Palangka Raya<br/>
                                    Kalimantan Tengah 73112
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse-3">
                                        <i class="fa fa-angle-up control-icon"></i>
                                        District Office Timur
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Jalan Pelita Raya Blok A-24 No. 5 RT 1; RW 3<br/>
                                    Kel. Bala Parang, Kec. Rappocini<br/>
                                    Makassar 90222
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--cu--}}
            <div class="hr1" style="margin-bottom:50px;"></div>
        </div>
    </div>
    {{--info gerakan--}}
    <div id="parallax-one" class="parallax" style="background-image:url(images/parallax/bg-04.jpg);">
        <div class="parallax-text-container-1">
            <div class="parallax-text-item">
                <div class="container">
                    <div class="row">
                        <?php $infogerakan = App\InfoGerakan::find(1); ?>
                        @if(!empty($infogerakan->jumlah_cu))
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="counter-item">
                                <i class="fa fa-building"></i>
                                <div class="timer" id="item1" data-to="{{$infogerakan->jumlah_cu}}" data-speed="2500"></div>
                                <h5>CU Primer</h5>
                            </div>
                        </div>
                        @endif
                        @if(!empty($infogerakan->jumlah_staff_cu))
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="counter-item">
                                <i class="fa fa-user"></i>
                                <div class="timer" id="item2" data-to="{{$infogerakan->jumlah_staff_cu}}" data-speed="2500"></div>
                                <h5>Staf CU</h5>
                            </div>
                        </div>
                        @endif
                        @if(!empty($infogerakan->jumlah_anggota))
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="counter-item">
                                <i class="fa fa-male"></i>
                                <div class="timer" id="item3" data-to="{{ $infogerakan->jumlah_anggota}}" data-speed="2500"></div>
                                <h5>Anggota CU</h5>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--info gerakan--}}
    <div class="hr1" style="margin-bottom:50px;"></div>
    <div class="container">
        <div class="page-content">
            <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
                <h1>Ingin Mengetahui Lebih Lanjut?</h1>
                <p>Silahkan kunjungi link dibawah</p>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="01">
                    <a href="{{ route('artikel',array(8)) }}">
                        <div class="service-boxed">
                            <div class="service-icon" style="margin-top:-25px;">
                                <i class="fa fa-university icon-medium-effect icon-effect-1"></i>
                            </div>
                            <div class="service-content">
                                <h4>Sejarah</h4>
                                <p>Bidang SPD & JALINAN memberikan bantuan dan perlindungan dalam hal Keuangan.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="01">
                    <a href="{{ route('artikel',array(4)) }}">
                        <div class="service-boxed">
                            <div class="service-icon" style="margin-top:-25px;">
                                <i class="fa fa-balance-scale icon-medium-effect icon-effect-1"></i>
                            </div>
                            <div class="service-content">
                                <h4>Filosofi</h4>
                                <p>Bidang SPD & JALINAN memberikan bantuan dan perlindungan dalam hal Keuangan.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="01">
                    <a href="{{ route('cuprimer') }}">
                        <div class="service-boxed">
                            <div class="service-icon" style="margin-top:-25px;">
                                <i class="fa fa-building icon-medium-effect icon-effect-1"></i>
                            </div>
                            <div class="service-content">
                                <h4>Credit Union</h4>
                                <p>Bidang SPD & JALINAN memberikan bantuan dan perlindungan dalam hal Keuangan.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="01">
                    <a href="{{ route('pengurus') }}">
                        <div class="service-boxed">
                            <div class="service-icon" style="margin-top:-25px;">
                                <i class="fa fa-user icon-medium-effect icon-effect-1"></i>
                            </div>
                            <div class="service-content">
                                <h4>Pengurus</h4>
                                <p>Bidang SPD & JALINAN memberikan bantuan dan perlindungan dalam hal Keuangan.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="01">
                    <a href="{{ route('pengawas') }}">
                        <div class="service-boxed">
                            <div class="service-icon" style="margin-top:-25px;">
                                <i class="fa fa-user icon-medium-effect icon-effect-1"></i>
                            </div>
                            <div class="service-content">
                                <h4>Pengawas</h4>
                                <p>Bidang SPD & JALINAN memberikan bantuan dan perlindungan dalam hal Keuangan.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="01">
                    <a href="{{ route('manajemen') }}">
                        <div class="service-boxed">
                            <div class="service-icon" style="margin-top:-25px;">
                                <i class="fa fa-user icon-medium-effect icon-effect-1"></i>
                            </div>
                            <div class="service-content">
                                <h4>Manajemen</h4>
                                <p>Bidang SPD & JALINAN memberikan bantuan dan perlindungan dalam hal Keuangan.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

