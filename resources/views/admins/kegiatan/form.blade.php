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
                <div class="form-group">
                    <h4>Nama Kegiatan</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama kegiatan',
                          'required','min-length' => '5','data-error' => 'Nama kegiatan wajib diisi dan minimal 5 karakter'))}}
                    </div>
                    <div class="help-block with-errors"></div>
                    {!! $errors->first('name', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Wilayah / District Office</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <select class="form-control" name="wilayah" required data-error="Wilayah wajib dipilih">
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
                    <div class="help-block with-errors"></div>
                    {!! $errors->first('wilayah', '<p class="text-warning">:message</p>') !!}
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
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                    </div>
                    {!! $errors->first('tanggal', '<p class="text-warning">:message</p>') !!}
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
                               data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
                    </div>
                    {!! $errors->first('tanggal2', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Tempat</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('tempat',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan tempat kegiatan',
                          'required','data-error' => 'Tempat wajib diisi','autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block with-errors"></div>
                    {!! $errors->first('tempat', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Sasaran</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('sasaran',null,array('class' => 'form-control','placeholder' => 'Silahkan masukkan sasaran kegiatan',
                          'required','data-error' => 'Sasaran wajib diisi','autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block with-errors"></div>
                    {!! $errors->first('sasaran', '<p class="text-warning">:message</p>') !!}
                </div>
            </div>
            <div class="col-sm-6">
                <h4>Tujuan</h4>
                <div class="texttujuan">
                    @if(!empty($data->tujuan)){!! $data->tujuan !!}@endif
                </div>
            </div>
            <div class="col-sm-6">
                <h4>Pokok Bahasan</h4>
                <div class="textpokok">
                    @if(!empty($data->pokok)){!! $data->pokok !!}@endif
                </div>
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
    <script>
        $('.texttujuan').summernote({
            placeholder:'Silahkan paparkan tujuan dilaksanakannya kegiatan ini...',
            minHeight: 100,
            toolbar:[
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol']]
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
        $('.textpokok').summernote({
            placeholder:'Silahkan paparkan pokok pembahasan kegiatan ini...',
            minHeight: 100,
            toolbar:[
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol']]
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
    </script>
@stop