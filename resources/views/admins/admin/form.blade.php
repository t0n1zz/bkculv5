<?php
$kelas ='admin';
?>
<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<!-- content -->
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <!--username-->
            <div class="col-sm-12">
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
                        <h4>Konfirmasi Password</h4>
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
                                        <option value="{{ $data2->id }}"
                                        @if(!empty($data))
                                            @if($data->cu == $data->id)
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
    </div>
    <div class="box-footer with-border">
        <div class="form-group pull-right">
            <button type="submit" name="simpan" accesskey="s" class="btn btn-primary">
                <i class="fa fa-save"></i> <u>S</u>impan</button>
            <a href="{{ route('admins.'.$kelas.'.index') }}" name="batal" accesskey="b" class="btn btn-default">
                <i class="fa fa-times"></i> <u>B</u>atal</a>
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