@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Tim Puskopdit BKCU Kalimantan</h2>
                <p>Pengurus, Pengawas dan Manajemen Puskopdit BKCU Kalimantan</p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Tim Puskopdit BCKU Kalimantan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<div id="content">
    <div class="container">
        <div class="page-content">
            <h4 class="classic-title"><span>Pengurus</span></h4>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="team-member">
                        <div class="member-photo">
                            <div class="member-name">John Doe <span>Developer</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--pengurus-->
<div class="section">
    <div class="container">
        <h2>Pengurus</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="tabbable">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs product-details-nav">
                        <li class="active"><a href="#tab1" data-toggle="tab">Periode 2015 - 2017</a></li>
                        <li><a href="#tab2" data-toggle="tab">Periode 2012 - 2014</a></li>
                    </ul>
                </div>
                <div class="tab-content product-detail-info">
                    <div class="tab-pane active" id="tab1">
                        <?php $i=0; ?>
                        @foreach($penguruses2 as $pengurus)
                            @if($i % 4 == 0 || $i == 0)
                                <div class="row">
                                    @endif

                                    <div class="col-md-3 col-sm-6">
                                        <div class="team-member shadow">
                                            <div class="team-member-image">
                                                @if(!empty($pengurus->gambar) && is_file("images_staff/{$pengurus->gambar}"))
                                                    {{ HTML::image('images_staff/'.$pengurus->gambar, $pengurus->name, array(
                                                        'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                @else
                                                    @if($pengurus->kelamin == "Wanita")
                                                        {{ HTML::image('images/no_image_woman.jpg', $pengurus->name, array(
                                                           'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                    @else
                                                        {{ HTML::image('images/no_image_man.jpg', $pengurus->name, array(
                                                           'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="team-member-info">
                                                <ul>
                                                    <li class="team-member-name">{{ $pengurus->name }}</li>
                                                    <li>{{ $pengurus->jabatan }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $i++; ?>
                                    @if($i % 4 == 0 || $i == $penguruses2->count())
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="tab-pane" id="tab2">
                        <?php $i1=0; ?>
                        @foreach($penguruses1 as $pengurus)
                            @if($i % 4 == 0 || $i == 0)
                                <div class="row">
                                    @endif

                                    <div class="col-md-3 col-sm-6">
                                        <div class="team-member shadow">
                                            <div class="team-member-image">
                                                @if(!empty($pengurus->gambar) && is_file("images_staff/{$pengurus->gambar}"))
                                                    {{ HTML::image('images_staff/'.$pengurus->gambar, $pengurus->name, array(
                                                        'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                @else
                                                    @if($pengurus->kelamin == "Wanita")
                                                        {{ HTML::image('images/no_image_woman.jpg', $pengurus->name, array(
                                                           'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                    @else
                                                        {{ HTML::image('images/no_image_man.jpg', $pengurus->name, array(
                                                           'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="team-member-info">
                                                <ul>
                                                    <li class="team-member-name">{{ $pengurus->name }}</li>
                                                    <li>{{ $pengurus->jabatan }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $i1++; ?>
                                    @if($i % 4 == 0 || $i == $penguruses1->count())
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/pengurus-->
<!--pengawas-->
<div class="section">
    <div class="container">
        <h2>Pengawas</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="tabbable">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs product-details-nav">
                        <li class="active"><a href="#tab3" data-toggle="tab">Periode 2015 - 2017</a></li>
                        <li><a href="#tab4" data-toggle="tab">Periode 2012 - 2014</a></li>
                    </ul>
                </div>
                <div class="tab-content product-detail-info">
                    <div class="tab-pane active" id="tab3">
                        <?php $i=0; ?>
                        @foreach($pengawases2 as $pengawas)
                            @if($i % 4 == 0 || $i == 0)
                                <div class="row">
                                    @endif

                                    <div class="col-md-3 col-sm-6">
                                        <div class="team-member shadow">
                                            <div class="team-member-image">
                                                @if(!empty($pengawas->gambar) && is_file("images_staff/{$pengawas->gambar}"))
                                                    {{ HTML::image('images_staff/'.$pengawas->gambar, $pengawas->name, array(
                                                        'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                @else
                                                    {{ HTML::image('images/no_image.jpg', $pengawas->name, array(
                                                       'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                @endif
                                            </div>
                                            <div class="team-member-info">
                                                <ul>
                                                    <li class="team-member-name">{{ $pengawas->name }}</li>
                                                    <li>{{ $pengawas->jabatan }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $i++; ?>
                                    @if($i % 4 == 0 || $i == $pengawases2->count())
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="tab-pane active" id="tab4">
                        <?php $i=0; ?>
                        @foreach($pengawases1 as $pengawas)
                            @if($i % 4 == 0 || $i == 0)
                                <div class="row">
                                    @endif

                                    <div class="col-md-3 col-sm-6">
                                        <div class="team-member shadow">
                                            <div class="team-member-image">
                                                @if(!empty($pengawas->gambar) && is_file("images_staff/{$pengawas->gambar}"))
                                                    {{ HTML::image('images_staff/'.$pengawas->gambar, $pengawas->name, array(
                                                        'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                @else
                                                    {{ HTML::image('images/no_image.jpg', $pengawas->name, array(
                                                       'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                @endif
                                            </div>
                                            <div class="team-member-info">
                                                <ul>
                                                    <li class="team-member-name">{{ $pengawas->name }}</li>
                                                    <li>{{ $pengawas->jabatan }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $i++; ?>
                                    @if($i % 4 == 0 || $i == $pengawases1->count())
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/pengawas-->
<!--manajemen-->
<div class="section">
    <div class="container">
        <h2>Manajemen</h2>
        <div class="row">
            <div class="col-lg-12">
                <?php $i=0; ?>
                @foreach($manajemens as $manajemen)
                    @if($i % 4 == 0 || $i == 0)
                        <div class="row">
                    @endif

                    <div class="col-md-3 col-sm-6">
                        <div class="team-member shadow">
                            <div class="team-member-image">
                                @if(!empty($manajemen->gambar) && is_file("images_staff/{$manajemen->gambar}"))
                                    {{ HTML::image('images_staff/'.$manajemen->gambar, $manajemen->name, array(
                                        'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                @else
                                    {{ HTML::image('images/no_image.jpg', $manajemen->name, array(
                                       'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                @endif
                            </div>
                            <div class="team-member-info">
                                <ul>
                                    <li class="team-member-name">{{ $manajemen->name }}</li>
                                    <li>{{ $manajemen->jabatan }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <?php $i++; ?>
                    @if($i % 4 == 0 || $i == $manajemens->count())
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<!--/manajemn-->
@stop