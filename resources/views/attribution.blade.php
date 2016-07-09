@extends('_layouts.layout')

@section('content')
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Attribution</h2>
                <p>Appreciation for those who helped created this site</p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Attribution</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="classic-title"><span>Thank You To</span></h4>
                    <li><a href="http://graygrids.com" target="_blank">GrayGrids</a> - for awesome Bootstrap Template</li>
                    <li><a href="http://www.freepik.com/free-photos-vectors/birthday" target="_blank">Birthday vector designed by Freepik</a> - for images</li>
                    <li><a href="http://www.freepik.com/free-photos-vectors/christmas" target="_blank">Christmas vector designed by Freepik</a> - for images</li>
                    <li><a href="http://www.freepik.com/free-photos-vectors/new-year" target="_blank">New year vector designed by Freepik</a> - for images</i>
                    <li><a href="https://www.vectoropenstock.com/vectors/preview/72006/real-estate-selling-process-infographics" target="_blank">Real estate selling process infographics vector</a> - for images</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop