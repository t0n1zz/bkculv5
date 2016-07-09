@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Credit Union</h2>
                <p>Credit Union dalam jaringan Puskopdit BKCU Kalimantan</p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Credit Union</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<div id="content">
    <div class="container">
    <?php $imagepath = 'images_cu/';?>
    @foreach($jejarings as $jejaring)
    <div class="row">
        <h4 class="classic-title"><span>{{$jejaring->name}}</span></h4>
        @foreach($jejaring->cuprimer as $cuprimer)
            <div class="col-md-3">
                <a href="{{ route('cuprimer_detail',array($cuprimer->id)) }}">
                    <div class="portfolio-item item">
                        <div class="portfolio-border">
                            <div class="portfolio-thumb ">
                                @if(!empty($cuprimer->gambar) && is_file($imagepath.$cuprimer->gambar."n.jpg"))
                                    <a class="lightbox" data-lightbox-type="ajax" title="{{ 'CU '.$cuprimer->name }}" href="{{ asset($imagepath.$cuprimer->gambar.".jpg") }}">
                                        <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                        {{ Html::image($imagepath.$cuprimer->gambar.'n.jpg', 'CU '.$cuprimer->name,
                                            array('class' => 'img-responsive ')) }}
                                    </a>
                                @else
                                    <a class="lightbox" data-lightbox-type="ajax" title="{{ 'CU '.$cuprimer->name }}" href="{{ asset('images/image-cu.jpg') }}">
                                        <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                        {{ Html::
                                        image('images/image-cu.jpg', $cuprimer->name, array(
                                            'class' => 'img-responsive')) }}
                                    </a>
                                @endif
                            </div>
                            <div class="portfolio-details">
                                <a href="{{ route('cuprimer_detail',array($cuprimer->id)) }}">
                                    @if(!empty($cuprimer->name))
                                        <h4>CU {{ $cuprimer->name }}</h4>
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div><br/>
    @endforeach
    </div>
</div>

@stop