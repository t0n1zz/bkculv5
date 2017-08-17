@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Pelayanan Puskopdit BKCU Kalimantan</h2>
                <p>Pelayanan yang ditawarkan meliputi Bidang Keuangan, Bidang JALINAN dan Non Keuangan</p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Pelayanan Puskopdit BCKU Kalimantan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<div id="content">
    <div class="container">
        <?php $i=1;$pos=""; ?>
        @foreach($pelayanans as $pelayanan)
            @if($i % 2 == 0)
                <?php $pos =2; ?>
            @elseif($i % 3 == 0)
                <?php $pos =1; ?>
            @elseif($i % 2 == 1)
                <?php $pos =1; ?>
            @endif

            @if($pos == 1)
                <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
                    <h1>{{ $pelayanan->name }}</h1>
                    <hr/>
                </div>
                <div class="row" id="{{ $pelayanan->id }}" data-animation="fadeInDown" data-animation-delay="01">
                    <div class="col-sm-6">
                        {!! $pelayanan->content !!}
                    </div>
                    <div class="col-sm-6">
                        @if(!empty($pelayanan->gambar) && is_file("images_artikel/{$pelayanan->gambar}"))
                            {{ Html::image('images_artikel/'.$pelayanan->gambar, $pelayanan->judul, array(
                                'class' => 'img-responsive img-thumbnail shadow','width' => '700px')) }}
                        @endif
                    </div>
                </div>
                    <div class="hr1" style="margin-bottom:40px;"></div>
            @elseif($pos ==2)
                <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
                    <h1>{{ $pelayanan->name }}</h1>
                    <hr/>
                </div>
                <div class="row" id="{{$pelayanan->id}}" data-animation="fadeInDown" data-animation-delay="01">
                    <div class="col-sm-6">
                        @if(!empty($pelayanan->gambar) && is_file("images_artikel/{$pelayanan->gambar}"))
                            {{ Html::image('images_artikel/'.$pelayanan->gambar, $pelayanan->judul, array(
                                'class' => 'img-responsive img-thumbnail shadow','width' => '700px')) }}
                        @endif
                    </div>
                    <div class="col-sm-6">
                        {!! $pelayanan->content !!}
                    </div>
                </div>
                    <div class="hr1" style="margin-bottom:40px;"></div>
            @endif

            <?php  $i++; ?>
        @endforeach
    </div>
</div>
@stop