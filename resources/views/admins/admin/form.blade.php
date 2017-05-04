<?php
$kelas ='admin';
?>
<input type="text" value="0" name="style" hidden />
<div class="row">
    <!--username-->
    <div class="col-sm-6">
        <div class="form-group has-feedback">
            <h4>Username</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                @if(!empty($data))
                    {{ Form::text('username',null,array('class'=>'form-control','id'=>'username',
                    'placeholder'=>'Silahkan masukkan username', 'autocomplete'=>'off','readonly'))}}
                @else
                    {{ Form::text('username',null,array('class'=>'form-control','id'=>'username',
                    'placeholder'=>'Silahkan masukkan username','autocomplete'=>'off','required','data-minlength'=>'5'))}}
                @endif
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="help-block">Username harus diisi dan minimal 5 karakter.</div>
        </div>  
    </div>
    <!--/username-->
    <!--name-->
    <div class="col-sm-6">
        <div class="form-group has-feedback">
            <h4>Nama</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                @if(!empty($data))
                    {{ Form::text('name',null,array('class'=>'form-control','id'=>'name',
                    'placeholder'=>'Silahkan masukkan nama', 'autocomplete'=>'off','readonly'))}}
                @else
                    {{ Form::text('name',null,array('class'=>'form-control','id'=>'name',
                    'placeholder'=>'Silahkan masukkan nama','autocomplete'=>'off','required'))}}
                @endif
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="help-block">Nama harus diisi.</div>
        </div>  
    </div>
    <!--/name-->

    @if(empty($data))
        <!--password 1-->
        <div class="col-sm-6">
            <div class="form-group has-feedback">
                <h4>Password</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::password('password',array('class' => 'form-control','id'=>'password',
                    'placeholder' => 'Silahkan masukkan password admin','required','data-minlength'=>'5'))}}
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="help-block">Password harus diisi dan minimal 5 karakter.</div>
            </div>
        </div>
        <br/>
        <!--/password 1-->
        <!--password 2-->
        <div class="col-sm-6">
            <div class="form-group has-feedback">
                <h4>Ualngi Password</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::password('password2',array('class' => 'form-control','id'=>'konfirmpassword',
                    'placeholder' => 'Silahkan masukkan password admin sekali lagi','required',
                    'data-match'=>'#password','data-match-error'=>'Maaf, password tidak sesuai.'))}}
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="help-block">Silahkan tulis ulang password anda.</div>
            </div>
        </div>
        <!--/password 2-->
    @endif
    <div class="col-sm-12">
        <div class="form-group">
            <h4>Tipe</h4>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-list"></i></div>
                <select class="form-control" id="tipe" onChange="changeFuncUser(value);" name="tipe" required>
                    <option value="" selected disabled>Silahkan pilih tipe user</option>
                    <option value="bkcu"
                        @if(!empty($data))
                            @if($data->cu == 0)
                                {{ "selected" }}
                            @endif
                        @endif
                            >BKCU</option>
                    <option value="cu"
                        @if(!empty($data))
                            @if($data->cu > 0)
                                {{ "selected" }}
                            @endif
                        @endif
                            >CU Primer</option>
                </select>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="help-block">Silahkan pilih tipe admin.</div>
        </div>
    </div>
    @if(!empty($data))
        @if($data->cu > 0)
            <div id="tipe_cu">
        @else
            <div id="tipe_cu" hidden>
        @endif
    @else
        <div id="tipe_cu" hidden>
    @endif
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>CU</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" name="cu" id="pilih_cu">
                            <option value="" selected disabled>Silahkan pilih CU</option>
                            @foreach($datas2 as $data2)
                                <option value="{{ $data2->no_ba }}"
                                    @if(!empty($data))
                                        @if($data->cu == $data2->no_ba)
                                            {{ "selected" }}
                                        @endif
                                    @endif
                                >{{ $data2->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="help-block">Silahkan CU admin.</div>
                </div>
            </div>    
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Hak Akses</h4>
                    <hr style="margin-bottom: 0px;margin-top: 0px;"/>
                    <div class="help-block">Silahkan pilih hak akses admin CU.</div>
                    @include('admins.'.$kelas.'.hak_akses')
                </div>
            </div>       
        </div>
    @if(!empty($data))
        @if($data->cu == 0)
            <div class="col-lg-12" id="tipe_bkcu">
        @else
            <div class="col-lg-12" id="tipe_bkcu" hidden>
        @endif
    @else
        <div class="col-lg-12" id="tipe_bkcu" hidden>
    @endif
        <div class="form-group">
            <h4>Hak Akses</h4>
            <hr style="margin-bottom: 0px;margin-top: 0px;"/>
            <div class="help-block">Silahkan pilih hak akses admin BKCU.</div>
            @include('admins.'.$kelas.'.hak_akses')
        </div>
    </div>
</div>
@section('js')
<script>
    function changeFuncUser($i) {
        if($i == "cu"){
            $('#tipe_cu').show();
            $('.bkcu').hide();
            $('#tipe_bkcu').hide();
        }else{
            $('#tipe_cu').hide();
            $('.bkcu').show();
            $('#tipe_bkcu').show();
        }
    }
</script>
@stop