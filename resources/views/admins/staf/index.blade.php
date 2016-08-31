<?php
$title = "Kelola Staf";
if($isall){
    $title2 ="Semua CU";
}else{
    if(!empty($datas->first()->cuprimer))
        $title2 ="CU " . $datas->first()->cuprimer->name;
    else
        $title2 ="Puskopdit BKCU Kalimantan";
}

$kelas = "staf";
$imagepath = "images_staf/";
?>
@extends('admins._layouts.layout')


@section('css')
    @include('admins._components.datatable_CSS')
@stop

@section('content')
    <!-- header -->
    <section class="content-header">
        <h1>
            <i class="fa fa-archive"></i> {{ $title }}
            <small>Mengelola Data Staf {!! $title2 !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-sitemap"></i> {!! $title !!}</li>
        </ol>
    </section>
    <!-- /header -->
    <!-- /header -->
    <section class="content">
        <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
        <!--content-->
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-8 tabletools">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                            <input type="text" id="searchtext" class="form-control" placeholder="Kata kunci pencarian..." autofocus>
                        </div>
                    </div>
                    <div class="col-sm-4 tabletools" >
                        <?php $culists = App\Models\Cuprimer::orderBy('name','asc')->get(); ?>
                        <div class="input-group">
                            <div class="input-group-addon primary-color"><i class="fa fa-list"></i></div>
                            <select class="form-control"  id="dynamic_select">
                                <option {{ Request::is('admins/staf') ? 'selected' : '' }}
                                        value="/admins/staf">SEMUA STAF</option>
                                <option {{ Request::is('admins/staf/index_bkcu') ? 'selected' : '' }}
                                        value="/admins/staf/index_bkcu">BKCU</option>
                                @foreach($culists as $culist)
                                    <option {{ Request::is('admins/staf/index_cu/'.$culist->id) ? 'selected' : '' }}
                                            value="/admins/staf/index_cu/{{$culist->id}}">{{ $culist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr class="bg-light-blue-active color-palette">
                        <th hidden></th>
                        <th></th>
                        <th>Foto</th>
                        <th>Nama </th>
                        <th>Pekerjaan</th>
                        <th>Tingkat</th>
                        <th>Jenis Kelamin</th>
                        @if(Request::is('admins/staf'))<th>Credit Union</th>@endif
                        <th>Status</th>
                        <th>Agama</th>
                        <th>Pendidikan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <?php
                            $telp = '-';
                            $handphone = '-';
                            $email = '-';
                            $kota = '-';
                            $alamat = '-';
                            $pekerjaan = '-';
                            $tingkat = '-';
                            $pendidikan = '-';
                            $organisasi = '-';

                            if(!empty($data->telp)){
                                $telp = $data->telp;
                            }
                            if(!empty($data->handphone)){
                                $handphone = $data->handphone;
                            }
                            if(!empty($data->email)){
                                $email = $data->email;
                            }
                            if(!empty($data->kota)){
                                $kota = $data->kota;
                            }
                            if(!empty($data->alamat)){
                                $newarr = explode("\n",$data->alamat);
                                foreach($newarr as $str){
                                    $status = $str;
                                }
                            }

                            $jabatans = \App\Models\StafRiwayat::where('id_staf','=',$data->id)
                                            ->where('tipe','=',3)->get();
                            $i = 0;
                            foreach ($jabatans as $j){
                                if($j->sekarang == "1"){
                                    $pekerjaan += $j->name;
                                    $i++;
                                }
                                if($j->keternagan2 != "Manajemen"){
                                    $dateselesai = new Date($j->selesai);
                                    $selesai = $dateselesai->format('Y');
                                    if($selesai <= date("Y")){
                                        if($i > 0){
                                            $pekerjaan += $j->name;
                                        }else{
                                            $pekerjaan += $j->name;
                                        }
                                    }
                                    $i++;
                                }
                            }
                        ?>
                        <tr data-key-telp="{{ $telp }}"
                            data-key-handphone="{{ $handphone }}"
                            data-key-email="{{ $email }}"
                            data-key-kota="{{ $kota }}"
                            data-key-alamat="{{ $alamat }}"
                        >
                            <td hidden>{{$data->id}}</td>
                            <td class="details-control" style="cursor: pointer"><i class="fa fa-bars"></i></td>
                            @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                                <td style="white-space: nowrap"><div class="modalphotos" >
                                        {{ Html::image($imagepath.$data->gambar.'n.jpg',asset($imagepath.$data->gambar."jpg"),
                                         array('class' => 'img-responsive',
                                        'id' => 'tampilgambar', 'width' => '50')) }}
                                    </div></td>
                            @elseif(!empty($data->gambar) && is_file($imagepath.$data->gambar))
                                <td style="white-space: nowrap"><div class="modalphotos" >
                                        {{ Html::image($imagepath.$data->gambar,asset($imagepath.$data->gambar),
                                            array('class' => 'img-responsive ',
                                            'id' => 'tampilgambar', 'width' => '50')) }}
                                    </div></td>
                            @else
                                @if($data->kelamin == "Wanita")
                                    <td>{{ Html::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                                                        'id' => 'tampilgambar', 'width' => '50')) }}</td>
                                @else
                                    <td>{{ Html::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                                                        'id' => 'tampilgambar', 'width' => '50')) }}</td>
                                @endif
                            @endif

                            @if(!empty($data->name))
                                <td>{!! $data->name !!}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($pekerjaan))
                                <td>{!! $pekerjaan !!}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->tingkat))
                                @if($data->tingkat == 1 )
                                    <td>Pengurus Periode {!! $data->periode1 !!} - {!! $data->periode2 !!}</td>
                                @elseif($data->tingkat == 2)
                                    <td>Pengawas Periode {!! $data->periode1 !!} - {!! $data->periode2 !!}</td>
                                @elseif($data->tingkat == 3)
                                    <td>Manajemen</td>
                                @endif
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->kelamin))
                                <td>{!! $data->kelamin !!}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(Request::is('admins/staf'))
                                @if(!empty($data->cuprimer))
                                    <td>{!! $data->cuprimer->name !!}</td>
                                @else
                                    @if($data->cu == 0)
                                        <td>Puskopdit BKCU Kalimantan</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                @endif
                            @endif

                            @if(!empty($data->status))
                                <td>{!! $data->status !!}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->agama))
                                <td>{!! $data->agama !!}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if(!empty($data->pendidikan))
                                <td>{!! $data->pendidikan !!}</td>
                            @else
                                <td>-</td>
                            @endif
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- modal -->
    <!-- Hapus -->
    <div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.destroy',$kelas), 'method' => 'delete')) }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Staf</h4>
                </div>
                <div class="modal-body">
                    <h4>Menghapus staf ini ?</h4>
                    <input type="text" name="id" value="" id="modal1id" hidden>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Iya</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        {{ Form::close() }}
    </div>
    <!-- /Hapus -->
@stop

@section('js')
    @include('admins._components.datatable_JS')
    <script type="text/javascript" src="{{ URL::asset('admin/datatable.js') }}"></script>
    <script>
        function format ( dataSource ) {
            var html = '<table class="table table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            for (var key in dataSource){
                html += '<tr>'+
                        '<td>' + key             +'</td>'+
                        '<td>' + dataSource[key] +'</td>'+
                        '</tr>';
            }
            return html += '</table>';
        }


        new $.fn.dataTable.Buttons(table,{
            buttons: [
                {
                    text: '<i class="fa fa-plus"></i> <u>T</u>ambah',
                    key: {
                        altKey: true,
                        key: 't'
                    },
                    action: function(){
                        window.location.href = "{{URL::to('admins/'.$kelas.'/create')}}";
                    }
                },
                {
                    text: '<i class="fa fa-pencil"></i> <u>U</u>bah',
                    key: {
                        altKey: true,
                        key: 'u'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href = "/admins/" + kelas + "/" + id + "/edit";
                        }
                    }
                },
                {
                    text: '<i class="fa fa-trash"></i> <u>H</u>apus',
                    key: {
                        altKey: true,
                        key: 'h'
                    },
                    action: function(){
                        var id = $.map(table.rows({ selected:true }).data(),function(item){
                            return item[0];
                        });
                        if(id != ""){
                            $('#modal1show').modal({show:true});
                            $('#modal1id').attr('value',id);
                        }
                    }
                }
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );
        new $.fn.dataTable.Buttons(table,{
            buttons: [
                {
                    text: '<i class="fa fa-database"></i> Detail',
                    action: function(){
                        var id = $.map(table.rows({ selected: true }).data(),function(item){
                            return item[0];
                        });
                        var kelas = "{{ $kelas }}";
                        if(id != ""){
                            window.location.href = "/admins/" + kelas + "/" + id + "/detail";
                        }
                    }
                }
            ]
        });
        table.buttons( 0, null ).container().prependTo(
                table.table().container()
        );

        $(function(){
            // bind change event to select
            $('#dynamic_select').on('change', function () {
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location.href = url; // redirect
                }
                return false;
            });

            $('#dataTables-example').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format({
                        'No. Telepon ' : tr.data('key-telp'),
                        'No. Handphone' :  tr.data('key-handphone'),
                        'Email' : tr.data('key-email'),
                        'Kota' : tr.data('key-kota'),
                        'Alamat' : tr.data('key-alamat')
                    })).show();
                    tr.addClass('shown');
                }
            });
        });




    </script>
@stop