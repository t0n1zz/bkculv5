@extends('_layouts.layout')

@section('content')
<div class="page-banner" style="padding:40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Manajemen Puskopdit BKCU Kalimantan</h2>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Manajemen Puskopdit BCKU Kalimantan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<div id="content">
    <div class="container">
        <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
            <h1>Manajemen <strong>Puskopdit BKCU Kalimantan</strong></h1>
        </div>
        <div class="row" data-animation="fadeInDown" data-animation-delay="01">
            <?php $imagepath = 'images_staf/';?>
            @foreach($manajemens as $manajemen)
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="team-member">
                    <div class="member-photo">
                        @if(!empty($manajemen->gambar) && is_file($imagepath.$manajemen->gambar.".jpg"))
                            {{ Html::image($imagepath.$manajemen->gambar.'.jpg',$manajemen->name) }}
                        @else
                            {{ Html::image('images/no_image_man.jpg', $manajemen->name) }}
                        @endif
                    </div>
                    <div class="member-info">
                        <strong>{{ $manajemen->name }}</strong>
                        <br/>
                        {{ $manajemen->jabatan }}
                        <hr/>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop