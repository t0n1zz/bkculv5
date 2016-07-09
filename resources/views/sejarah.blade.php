@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Sejarah</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
@include('_layouts.event')
<div class="section">
    <div class="container">
        <div class="row">
            @foreach($sejarahs as $sejarah)
                <div class="col-sm-12">
                    <h2>{{$sejarah->judul}}</h2>
                    <div class="row">
                        <div class="col-sm-12" style="padding-left: 4%;padding-right: 4%">
                            {{ $sejarah->content }}
                        </div>
                    </div>
                    <br /><br />
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop