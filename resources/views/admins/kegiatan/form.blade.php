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
                    <h4>Nama</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama kegiatan','required'))}}
                    </div>
                    <div class="help-block">Nama kegiatan harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h4>Peserta Minimal</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('min',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah minimal peserta','required','autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block">Jumlah peserta minimal harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h4>Peserta Maksimal</h4>
                    <div class="input-group">
                        <span class="input-group-addon">0-9</span>
                        {{ Form::text('max',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan jumlah maksimal peserta','required','autocomplete'=>'off'))}}
                    </div>
                    <div class="help-block">Jumlah peserta maksimal harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h4>Tipe Kegiatan</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        <select class="form-control" name="tipe" required>
                            <option hidden>Pilih tempat kegiatan</option>
                            <option value="1" >Diklat Puskopdit BKCU Kalimantan</option>
                            <option value="2" >Diklat Lembaga lain</option>
                            <option value="3" >Rapat</option>
                        </select>
                    </div>
                    <div class="help-block">Tipe kegiatan harus dipilih.</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h4>Periode Kegiatan</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="periode" value="@if(!empty($data->periode)){{$data->periode}}@endif" class="form-control"
                               data-inputmask="'mask': '9999'" placeholder="yyyy" required />
                    </div>
                    <div class="help-block">Periode kegiatan selesai harus diisi.</div>
                </div>
            </div>
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Tempat</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        <select class="form-control" onChange="func_selecttempat(value);" name="selecttempat" id="selecttempat">
                            <option hidden>Pilih tempat kegiatan</option>
                            @foreach($tempats as $tempat)
                                <option value="{{ $tempat->id }}"
                                @if(!empty($data->tempat) && $tempat->id == $data->tempat->id)
                                    selected
                                @endif
                                >{{ $tempat->name }}</option>
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
                            {{ Form::file('gambar', array('onChange' => 'readURL(this)')) }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <h4>Nama Tempat</h4>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            {{ Form::text('nametempat',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama tempat','autocomplete'=>'off'))}}
                        </div>
                        <div class="help-block">Nama tempat harus diisi.</div>
                        {!! $errors->first('nametempat', '<p class="text-warning">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        <h4>Nama Kota</h4>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            {{ Form::text('kota',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama kota','autocomplete'=>'off'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        <h4>Keterangan</h4>
                        {{ Form::textarea('keterangantempat',null,array('class' => 'form-control','rows' => '3','placeholder' => 'Silahkan masukkan keterangan berupa penjelasan tempat')) }}
                    </div>
                </div>
                <div class="col-sm-12"><hr/></div>
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
                <h4>Tujuan</h4>
                <textarea id="texttujuan" name="tujuan"
                    >@if(!empty($data->tujuan)){{ $data->tujuan }}@endif</textarea>
            </div>
            <div class="col-sm-12">
                <h4>Pokok Bahasan</h4>
                <textarea id="textpokok" name="pokok"
                    >@if(!empty($data->pokok)){{ $data->pokok }}@endif</textarea>  
            </div>
            <div class="col-sm-12">
                <h4>Informasi Tambahan</h4>
                <textarea id="texttambahan" name="informasi"
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
<script>
    function func_selecttempat($i){
        if($i == "tambah"){
             $('#tempatbaru').show();
        }else{
             $('#tempatbaru').hide();
        }
    }


    $('#texttujuan').summernote({
        placeholder:'Silahkan paparkan tujuan dilaksanakannya kegiatan ini...',
        minHeight: 150,
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
        minHeight: 150,
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
    $('#texttambahan').summernote({
        placeholder:'Silahkan isi apabila ada informasi tambahan',
        minHeight: 150,
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