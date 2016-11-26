<?php
$kelas ='kegiatan';
?>

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/summernote/summernote.css')}}" >
@stop

<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group has-feedback">
                    <h4>Nama</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama kegiatan',
                          'required','min-length' => '5'))}}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="help-block">Nama kegiatan harus diisi dan minimal 5 karakter.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Wilayah / District Office</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <select class="form-control" name="wilayah" required>
                            <option value="" selected disabled>Silahkan pilih wilayah pelatihan</option>
                            <option value="Barat"
                            @if(!empty($data))
                                @if($data->wilayah == "Barat")
                                    {!! "selected" !!}
                                        @endif
                                    @endif
                            >Barat</option>
                            <option value="Tengah"
                            @if(!empty($data))
                                @if($data->wilayah == "Tengah")
                                    {!! "selected" !!}
                                        @endif
                                    @endif
                            >Tengah</option>
                            <option value="Timur"
                            @if(!empty($data))
                                @if($data->wilayah == "Timur")
                                    {!! "selected" !!}
                                        @endif
                                    @endif
                            >Timur</option>
                            <option value="Bersama"
                            @if(!empty($data))
                                @if($data->wilayah == "Bersama")
                                    {!! "selected" !!}
                                        @endif
                                    @endif
                            >Bersama</option>
                        </select>
                    </div>
                    <div class="help-block">Wilayah / Disrtict Office kegiatan harus dipilih.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Tanggal Kegiatan Dimulai</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php
                        if(!empty($data->tanggal)){
                            $timestamp = strtotime($data->tanggal);
                            $tanggal = date('d/m/Y',$timestamp);
                        }
                        ?>
                        <input type="text" name="tanggal" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" required />
                    </div>
                    <div class="help-block">Tanggal kegiatan dimulai harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Tanggal Kegiatan Selesai</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php
                        if(!empty($data->tanggal2)){
                            $timestamp = strtotime($data->tanggal2);
                            $tanggal = date('d/m/Y',$timestamp);
                        }
                        ?>
                        <input type="text" name="tanggal2" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" required />
                    </div>
                    <div class="help-block">Tanggal kegiatan selesai harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-feedback">
                    <h4>Tempat</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('tempat',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan tempat kegiatan',
                          'required','autocomplete'=>'off'))}}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="help-block">Tempat kegiatan harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group has-feedback">
                    <h4>Sasaran</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('sasaran',null,array('class' => 'form-control','placeholder' => 'Silahkan masukkan sasaran kegiatan',
                          'required','autocomplete'=>'off'))}}
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>  
                    </div>
                    <div class="help-block">Sasaran kegiatan harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <h4>Tujuan</h4>
                <textarea id="texttujuan" name="tujuan" 
                    >@if(!empty($data->tujuan)){{ $data->tujuan }}@endif</textarea>
            </div>
            <div class="col-sm-6">
                <h4>Pokok Bahasan</h4>
                <textarea id="textpokok" name="pokok"
                    >@if(!empty($data->pokok)){{ $data->pokok }}@endif</textarea>  
            </div>
        </div>
    </div>
    <div class="box-footer with-border">
        <button type="submit" name="simpan" accesskey="s" class="btn btn-primary" value="simpan"><i
                    class="fa fa-save"></i> <u>S</u>impan</button>
        <a href="{{ route('admins.'.$kelas.'.index') }}" name="batal" accesskey="b" class="btn btn-danger"
           value="batal"><i class="fa fa-times"></i> <u>B</u>atal</a>
    </div>
</div>

@section('js')
    <script type="text/javascript" src="{{ URL::asset('plugins/summernote/summernote.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('plugins/summernote/plugins/summernote-cleaner.js') }}"></script>
    <script>
        $('#texttujuan').summernote({
            placeholder:'Silahkan paparkan tujuan dilaksanakannya kegiatan ini...',
            minHeight: 100,
            toolbar:[
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol']]
            ],
            cleaner:{
                notTime:2400, // Time to display Notifications.
                action:'paste', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
                newline:'<br>', // Summernote's default is to use '<p><br></p>'
                notStyle:'position:absolute;bottom:0;left:2px', // Position of Notification
                icon:'<i class="note-icon">Clean Word Format</i>'
            }
        });
        $('#textpokok').summernote({
            placeholder:'Silahkan paparkan pokok pembahasan kegiatan ini...',
            minHeight: 100,
            toolbar:[
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol']]
            ],
            cleaner:{
                notTime:2400, // Time to display Notifications.
                action:'paste', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
                newline:'<br>', // Summernote's default is to use '<p><br></p>'
                notStyle:'position:absolute;bottom:0;left:2px', // Position of Notification
                icon:'<i class="note-icon">Clean Word Format</i>'
            }
        });
    </script>
@stop