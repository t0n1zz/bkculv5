@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Login</h2>
                <p>Login untuk Credit Union dalam jaringan Puskopdit BKCU Kalimantan</p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Login</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('cu.alert')
                <h4 class="classic-title"><span>Login</span></h4>
                {{ Form::open(array('route' => array('cu.login.post'), 'files' => true)) }}
                    <input type="text" class="form-control"  placeholder="Username" name="username">
                    <br/>
                    <input type="password" class="form-control"  placeholder="Password" name="password">
                    <br/>
                    <button type="submit" id="submit" class="btn-system btn-large">Login</button>
                    <div id="success" style="color:#34495e;"></div>
                {{ Form::close() }}
            </div>

            <div class="col-md-4">
                <h4 class="classic-title"><span>Informasi</span></h4>
                <p>Silahkan login untuk melakukan mengelola data Credit Union anda, <b>username</b> dan <b>password</b>
                   akan kami informasikan segera.</p>
                <div class="hr1" style="margin-bottom:15px;"></div>
                <h4 class="classic-title"><span>Apa yang bisa saya lakukan setelah login?</span></h4>
                <ul class="list-unstyled">
                    <li><strong>Mengubah dan menambah</strong><br/> informasi umum Credit Union anda.</li>
                    <li><strong>Mengubah, menambah dan mengelola</strong><br/> informasi staf Credt Union.</li>
                    <li><strong>Daftar</strong><br/> Diklat yang diselenggarakan oleh Puskopdit BKCU Kalimantan.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop