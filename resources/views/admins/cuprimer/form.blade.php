<?php
$imagepath ='images_cu/';
$kelas ='cuprimer';
$file_max = ini_get('upload_max_filesize');
$file_max_str_leng = strlen($file_max);
$file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
$file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
$file_max = substr($file_max,0,$file_max_str_leng - 1);
$file_max = intval($file_max);
$cu = Auth::user()->getCU();
?>
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/summernote/summernote.css')}}" >
@stop

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <h4>Foto CU</h4>
            <div class="thumbnail" >
                @if(!empty($data->gambar))
                    {{ Html::image($imagepath.$data->gambar.'n.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                @else
                    {{ Html::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar', 'width' => '200')) }}
                @endif
                <div class="caption">
                    {{ Form::file('gambar', array('onChange' => 'readURL(this)')) }}
                </div>
            </div>
            <div class="help-block">Ukuran maksimum file gambar adalah {!! $file_max. ' ' .$file_max_meassure_unit !!}.</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group has-feedback">
            <h4>Nama</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama cu',
                    'required','min-length' => '5','autocomplete'=>'off'))}}
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="help-block">Nama CU harus diisi dan minimal 5 karakter.</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group has-feedback">
            <h4>No. BA</h4>
            <div class="input-group">
                <span class="input-group-addon">0-9</span>
                @if($cu == 0)
                    {{ Form::number('no_ba',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor anggota',
                        'onKeyPress' => 'return isNumberKey(event)','autocomplete'=>'off'))}}
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                @else
                    {{ Form::number('no_ba',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor anggota','readonly'))}}
                @endif    
                
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Wilayah</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                <select class="form-control" onChange="changeFunc(value);" name="wilayah" required>
                    <option hidden>Silahkan pilih Wilayah</option>
                    @foreach($datas2 as $data2)
                        <option value="{{ $data2->id }}"
                        @if(!empty($data->wilayah))
                            @if($data->wilayah == $data2->id)
                                {!! "selected" !!}
                                    @endif
                                @endif
                        >{{ $data2->name }}</option>
                    @endforeach
                    
                    @permission('create.wilayahcuprimer_create')
                        <option disabled>--------------</option> 
                        <option value="tambah">Tambah Wilayah Baru</option>
                    @endpermission 
                </select>
            </div>
            <div class="help-block">Wilayah harus dipilih.</div>
        </div>
    </div>
    @permission('create.wilayahcuprimer_create')
    <div class="row" id="pilihan" style="display:none;">
        <div class="col-sm-12" >
            <div class="form-group">
                <h4>Wilayah Baru</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('wilayah_baru',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan wilayah baru',
                        'autocomplete'=>'off'))}}
                </div>
            </div>
        </div>
    </div>
    @endpermission 
    <div class="col-sm-6">
        <div class="form-group">
            <h4>No. Badan Hukum</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('badan_hukum',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor badan hukum',
                    'autocomplete'=>'off'))}}
            </div>
            <div class="help-block">Silahkan masukkan nomor badan hukum.</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>No. Telepon</h4>
            <div class="input-group">
                <span class="input-group-addon">0-9</span>
                {{ Form::number('telp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor telepon','autocomplete'=>'off'))}}
            </div>
            <div class="help-block">Silahkan masukkan nomor telepon.</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>No. Handphone</h4>
            <div class="input-group">
                <span class="input-group-addon">0-9</span>
                {{ Form::number('hp',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nomor handphone','autocomplete'=>'off'))}}
            </div>
            <div class="help-block">Silahkan masukkan nomor handphone.</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Kode Pos</h4>
            <div class="input-group">
                <span class="input-group-addon">0-9</span>
                {{ Form::number('pos',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan kode pos'))}}
            </div>
            <div class="help-block">Silahkan masukkan kode pos.</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Tanggal Berdiri</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php
                if(!empty($data->ultah)){
                    $timestamp = strtotime($data->ultah);
                    $tanggal = date('d/m/Y',$timestamp);
                }
                ?>
                <input type="text" name="ultah" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                       data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
            </div>
            <div class="help-block">Tanggal berdiri CU harud diisi.</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Tanggal Bergabung</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php
                if(!empty($data->bergabung)){
                    $timestamp = strtotime($data->bergabung);
                    $tanggal = date('d/m/Y',$timestamp);
                }
                ?>
                <input type="text" name="bergabung" value="@if(!empty($tanggal)){{$tanggal}}@endif" class="form-control"
                       data-inputmask="'alias': 'date'" placeholder="dd/mm/yyyy" />
            </div>
            <div class="help-block">Tanggal bergabung CU harud diisi.</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Website</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('website',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan alamat website'))}}
            </div>
            <div class="help-block">Silahkan masukkan alamat website.</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group has-feedback">
            <h4>E-mail</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::email('email',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan alamat email','autocomplete'=>'off'))}}
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="help-block">Silahkan masukkan alamat email.</div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <h4>Aplikasi Komputerisasi</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                {{ Form::text('app',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama aplikasi komputerisasi keuangan',
                    'autocomplete'=>'off'))}}
            </div>
            <div class="help-block">Silahkan masukkan nama aplikasi komputerisasi keuangan.</div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <h4>Alamat Kantor Pusat</h4>
            {{ Form::textarea('alamat',null,array('class' => 'form-control','rows' => '3','placeholder'=>'Silahkan masukkan alamat')) }}
            <div class="help-block">Silahkan masukkan alamat.</div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <h4>Deskripsi <small>Silahkan tambahkan misi, visi, nilai-nilai inti dan slogan serta profil singkat CU.</small></h4>
            {{ Form::textarea('deskripsi',null,array('class' => 'form-control','rows' => '3','placeholder'=>'Silahkan masukkan alamat','id'=>'summernote')) }}
            <div class="help-block">Silahkan masukkan alamat.</div>
        </div>
    </div>
</div>


@section('js')
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/summernote.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/plugins/summernote-ext-addclass.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/plugins/summernote-cleaner.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#summernote').summernote({
            minHeight: 300,
            dialogsFade: true,
            placeholder: 'Silahkan isi disini...',
            addclass: {
                debug: false,
                classTags: [{title:"Button",value:"btn btn-success"},"jumbotron", "lead","img-rounded","img-circle", "img-responsive","btn", "btn btn-success","btn btn-danger","text-muted", "text-primary", "text-warning", "text-danger", "text-success", "table-bordered", "table-responsive", "alert", "alert alert-success", "alert alert-info", "alert alert-warning", "alert alert-danger", "visible-sm", "hidden-xs", "hidden-md", "hidden-lg", "hidden-print"]
            },
            cleaner:{
                notTime:2400, // Time to display Notifications.
                action:'paste', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
                newline:'<br>', // Summernote's default is to use '<p><br></p>'
                notStyle:'position:absolute;bottom:0;left:2px', // Position of Notification
                icon:'<i class="note-icon">Clean Word Format</i>'
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
                ['misc',['fullscreen','codeview']],
                ['misc2',['undo','redo']]
            ]
        });
    });    
</script>
@stop