<?php
$kelas ='kegiatan';
?>

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/summernote/summernote.css')}}" >
<link rel="stylesheet" type="text/css" href="{{asset('plugins/select/dist/css/select2.min.css')}}" >
<link rel="stylesheet" type="text/css" href="{{asset('plugins/select/dist/css/select2-bootstrap.min.css')}}" >
@stop

<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Kode</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('kode',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan kode kegiatan'))}}
                    </div>
                    <div class="help-block">Nama kegiatan harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>Nama</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama kegiatan'))}}
                    </div>
                    <div class="help-block">Nama kegiatan harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>Tipe Kegiatan</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        <select class="form-control" name="tipe">
                            <option hidden>Pilih tempat kegiatan</option>
                            <option value="1" 
                                @if(!empty($data))
                                    @if($data->tipe == "1")
                                        {{ "selected" }}
                                    @endif
                                @endif
                            >Diklat Puskopdit BKCU Kalimantan</option>
                            <option value="2" 
                                @if(!empty($data))
                                    @if($data->tipe == "2")
                                        {{ "selected" }}
                                    @endif
                                @endif
                            >Diklat Lembaga lain</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>Kota</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('kota',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama kota pelaksanaan kegiatan','onChange'=>'func_ubahkota(value)','id'=>'kota'))}}
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>Tempat</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        <select class="form-control" onChange="func_selecttempat(value);" name="selecttempat" id="selecttempat">
                            <option value="batal">Pilih tempat kegiatan</option>
                            @foreach($tempats as $tempat)
                                <option value="{{ $tempat->id }}"
                                @if(!empty($data->tempat) && $tempat->id == $data->tempat->id)
                                    selected
                                @endif
                                >{{ $tempat->name . ', ' . $tempat->kota }}</option>
                            @endforeach    
                            <option disabled>--------------</option> 
                            <option value="tambah" >Tambah Tempat Kegiatan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="tempatbaru" style="display: none;">
                <div class="col-sm-12"><hr/></div>
                <div class="col-sm-6">
                    <h4>Foto</h4>
                    <div class="thumbnail">
                        @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                            {{ Html::image($imagepath.$data->gambar.'n.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                        @else
                            {{ Html::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                        @endif
                        <div class="caption">
                            {{ Form::file('gambar', array('onChange' => 'readURL(this)','id'=>'gambartempat')) }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <h4>Nama Tempat</h4>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            {{ Form::text('nametempat',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama tempat','autocomplete'=>'off','id'=>'nametempat'))}}
                        </div>
                        <div class="help-block">Nama tempat harus diisi.</div>
                        {!! $errors->first('nametempat', '<p class="text-warning">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        <h4>Nama Kota</h4>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            {{ Form::text('kota',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama kota','autocomplete'=>'off','onChange'=>'func_ubahkotatempat(value)','id'=>'kotatempat'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        <h4>Keterangan</h4>
                        {{ Form::textarea('keterangantempat',null,array('class' => 'form-control','rows' => '3','placeholder' => 'Silahkan masukkan keterangan berupa penjelasan tempat','id'=>'keterangantempat')) }}
                    </div>
                </div>
                <div class="col-sm-12"><hr/></div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>Periode Kegiatan</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="periode" value="@if(!empty($data->periode)){{$data->periode}}@endif" class="form-control"
                               data-inputmask="'mask': '9999'" placeholder="yyyy" />
                    </div>
                    <div class="help-block">Periode kegiatan selesai harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-4">
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
                    <div class="help-block">Tanggal kegiatan dimulai harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-4">
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
                    <div class="help-block">Tanggal kegiatan selesai harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>Peserta Minimal</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::number('min',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah minimal peserta','autocomplete'=>'off'))}}
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <h4>Peserta Maksimal</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::number('max',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah maksimal peserta','autocomplete'=>'off'))}}
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group has-feedback">
                    <h4>Sasaran</h4>
                    <div class="table-responsive">
                        <table class="table table-condensed" style="margin-bottom: 0px;">
                            <tr>
                                @foreach($sasarans as $sasaran)
                                <td style="border-bottom: 1px solid #f4f4f4">
                                    <div class="checkbox">
                                        <label>
                                        <input name="sasaran[]" type="checkbox" value="{{$sasaran->id}}"
                                            @if(!empty($data))
                                                @foreach($data->sasaranhub as $sasaranhub)
                                                    @if($sasaran->id == $sasaranhub->id_sasaran)
                                                        checked
                                                    @endif
                                                @endforeach
                                            @endif 
                                        />
                                        {{$sasaran->name}}</label>
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                        </table>
                    </div>
                    <div class="help-block">Sasaran kegiatan harus dipilih.</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Prasyarat</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        <select class="form-control select2" name="prasyarat[]" id="prasyarat" multiple>
                        @foreach($prasyarats as $prasyarat)
                            <option value="{{ $prasyarat->id }}" >{{ $prasyarat->kode . ' - ' . $prasyarat->name}}</option>
                        @endforeach    
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <h4>Peserta</h4>
                <textarea id="peserta" name="peserta"
                    >@if(!empty($data->peserta)){{ $data->peserta }}@endif</textarea>
            </div>
            <div class="col-sm-12">
                <h4>Deskripsi</h4>
                <textarea id="deskripsi" name="deskripsi"
                    >@if(!empty($data->deskripsi)){{ $data->deskripsi }}@endif</textarea>
            </div>
            <div class="col-sm-12">
                <h4>Tujuan</h4>
                <textarea id="tujuan" name="tujuan"
                    >@if(!empty($data->tujuan)){{ $data->tujuan }}@endif</textarea>
            </div>
            <div class="col-sm-12">
                <h4>Ruang Lingkup</h4>
                <textarea id="ruang" name="ruang"
                    >@if(!empty($data->ruang)){{ $data->ruang }}@endif</textarea>  
            </div>
            <div class="col-sm-12">
                <h4>Informasi Tambahan</h4>
                <textarea id="informasi" name="informasi"
                    >@if(!empty($data->keterangan)){{ $data->keterangan }}@endif</textarea>  
            </div>
        </div>
    </div>
    <div class="box-footer with-border">
        <button type="submit" name="simpan" accesskey="s" class="btn btn-primary">
                <i class="fa fa-save"></i> <u>S</u>impan</button>
        <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary">
            <i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
        <a href="{{ route('admins.'.$kelas.'.index') }}" name="batal" accesskey="b" class="btn btn-danger">
            <i class="fa fa-times"></i> <u>B</u>atal</a>
    </div>
</div>

@section('js')
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/summernote.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/plugins/summernote-cleaner.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/select/dist/js/select2.full.min.js') }}"></script>
<script>
    var tempat = false;
    function func_ubahkota(value){
        if(!tempat){
            $('#kotatempat').val(value);
            $('#kotatempat').trigger('change');
        }
    }

    function func_ubahkotatempat(value){
        if(tempat){
            $('#kota').val(value);
            $('#kota').trigger('change');
        }
    }

    $("#prasyarat").select2({
        placeholder: "pilih prasyarat kegiatan",
        theme: "bootstrap"
    });

    function func_selecttempat($i){
        if($i == "tambah"){
            $('#tempatbaru').show();
            tempat = true;
            $('#kota').prop('readonly',true);
        }else if($i == "batal"){
            $('#tempatbaru').hide();
            $('#kota').prop('readonly',false);
        }else{
            $('#tempatbaru').hide();
            $('#kota').prop('readonly',true);
        }
    }

    $('#peserta').summernote({
        placeholder:'Silahkan paparkan deskripsi peserta',
        minHeight: 150,
        cleaner:{
            notTime:2400, // Time to display Notifications.
            action:'button', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
            newline:'<br>', // Summernote's default is to use '<p><br></p>'
            notStyle:'position:absolute;bottom:0;left:2px', // Position of Notification
            icon:'<i class="note-icon">Hapus Format Word</i>'
        },
        toolbar: [
            ['cleaner',['cleaner']],
            ['para',['style']],
            ['style', ['addclass','bold', 'italic', 'underline', 'hr']],
            ['font', ['strikethrough', 'superscript', 'subscript','clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol']],
            ['paragraph',['paragraph']],
            ['table',['table']],
            ['height', ['height']],
            ['insert',['link']] ,
            ['misc',['fullscreen']],
            ['misc2',['undo','redo']]
        ]
    });
    $('#deskripsi').summernote({
        placeholder:'Silahkan paparkan deskripsi pelatihan ini',
        minHeight: 150,
        cleaner:{
            notTime:2400, // Time to display Notifications.
            action:'button', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
            newline:'<br>', // Summernote's default is to use '<p><br></p>'
            notStyle:'position:absolute;bottom:0;left:2px', // Position of Notification
            icon:'<i class="note-icon">Hapus Format Word</i>'
        },
        toolbar: [
            ['cleaner',['cleaner']],
            ['para',['style']],
            ['style', ['addclass','bold', 'italic', 'underline', 'hr']],
            ['font', ['strikethrough', 'superscript', 'subscript','clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol']],
            ['paragraph',['paragraph']],
            ['table',['table']],
            ['height', ['height']],
            ['insert',['link']] ,
            ['misc',['fullscreen']],
            ['misc2',['undo','redo']]
        ]
    });
    $('#tujuan').summernote({
        placeholder:'Silahkan paparkan tujuan dilaksanakannya kegiatan ini',
        minHeight: 150,
        cleaner:{
            notTime:2400, // Time to display Notifications.
            action:'button', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
            newline:'<br>', // Summernote's default is to use '<p><br></p>'
            notStyle:'position:absolute;bottom:0;left:2px', // Position of Notification
            icon:'<i class="note-icon">Hapus Format Word</i>'
        },
        toolbar: [
            ['cleaner',['cleaner']],
            ['para',['style']],
            ['style', ['addclass','bold', 'italic', 'underline', 'hr']],
            ['font', ['strikethrough', 'superscript', 'subscript','clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol']],
            ['paragraph',['paragraph']],
            ['table',['table']],
            ['height', ['height']],
            ['insert',['link']] ,
            ['misc',['fullscreen']],
            ['misc2',['undo','redo']]
        ]
    });
    $('#ruang').summernote({
        placeholder:'Silahkan paparkan ruang lingkup pembahasan kegiatan ini',
        minHeight: 150,
        cleaner:{
            notTime:2400, // Time to display Notifications.
            action:'button', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
            newline:'<br>', // Summernote's default is to use '<p><br></p>'
            notStyle:'position:absolute;bottom:0;left:2px', // Position of Notification
            icon:'<i class="note-icon">Hapus Format Word</i>'
        },
        toolbar: [
            ['cleaner',['cleaner']],
            ['para',['style']],
            ['style', ['addclass','bold', 'italic', 'underline', 'hr']],
            ['font', ['strikethrough', 'superscript', 'subscript','clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol']],
            ['paragraph',['paragraph']],
            ['table',['table']],
            ['height', ['height']],
            ['insert',['link']] ,
            ['misc',['fullscreen']],
            ['misc2',['undo','redo']]
        ]
    });
    $('#informasi').summernote({
        placeholder:'Silahkan isi apabila ada informasi tambahan',
        minHeight: 150,
        cleaner:{
            notTime:2400, // Time to display Notifications.
            action:'button', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
            newline:'<br>', // Summernote's default is to use '<p><br></p>'
            notStyle:'position:absolute;bottom:0;left:2px', // Position of Notification
            icon:'<i class="note-icon">Hapus Format Word</i>'
        },
        toolbar: [
            ['cleaner',['cleaner']],
            ['para',['style']],
            ['style', ['addclass','bold', 'italic', 'underline', 'hr']],
            ['font', ['strikethrough', 'superscript', 'subscript','clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol']],
            ['paragraph',['paragraph']],
            ['table',['table']],
            ['height', ['height']],
            ['insert',['link']] ,
            ['misc',['fullscreen']],
            ['misc2',['undo','redo']]
        ]
    });
</script>
@stop