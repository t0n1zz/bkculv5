<!DOCTYPE Html>
<Html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Puskopdit BKCU Kalimantan Admin Site </title>
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" >

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/AdminLTE.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('admin/skin-blue.min.css')}}" >

    <!-- Custom Fonts -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" >

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/dataTables.bootstrap.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/KeyTable/css/keyTable.bootstrap.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/Select/css/select.dataTables.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/Select/css/select.bootstrap.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/Buttons/css/buttons.dataTables.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dataTables/extension/Buttons/css/buttons.bootstrap.min.css')}}" >
 

    <!-- Bootstrap extended form CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('plugins/BootstrapFormHelper/css/bootstrap-formhelpers.min.css')}}" > -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/summernote/summernote.css')}}" >

    <style>
        td { white-space: nowrap; }
        div.DTTT { margin-bottom: 0.5em; float: right; }
        div.dataTables_wrapper { clear: both; }
    </style>

    @yield('css')

    <link rel="stylesheet" type="text/css" href="{{asset('admin/mystyle.css')}}" >
    <!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/Html5shiv/3.7.0/Html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
<div class="wrapper">
    <!-- Header -->
    @include('admins._layouts.header')
            <!-- /Header -->

    <!-- sidebar -->
    @include('admins._layouts.sidebar')
            <!-- /sidebar -->

    <!-- content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /content -->

    <!-- footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.0.1
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <?php echo date("Y") ?> <a href="#">Puskopdit BKCU Kalimantan</a>.</strong> All rights reserved.
    </footer>
    <!-- /footer -->
</div>

<!--modal photos-->
<div class="modal fade" id="modalphotoshow">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img class="pointer img-responsive img-rounded center-block" src="" id="modalimage"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"
                        >Kembali <i class="fa fa-fw fa-chevron-right"></i> </button>
            </div>
        </div>
    </div>
</div>
<!--/modal photos-->
<script type="text/javascript" src="{{ URL::asset('admin/jQuery/jQuery-2.1.3.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script type="text/javascript" src="{{ URL::asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script>
    var AdminLTEOptions = {
        sidebarExpandOnHover : true,
        sidebarSlimScroll: true
    };
</script>
<script type="text/javascript" src="{{ URL::asset('admin/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/app.min.js') }}"></script>

<!-- fastclick for touch browser -->
<script type="text/javascript" src="{{ URL::asset('plugins/fastclick/fastclick.min.js') }}"></script>

<!-- InputMask JavaScript -->
<script type="text/javascript" src="{{ URL::asset('plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/BootstrapFormHelper/js/bootstrap-formhelpers.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/validator.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/summernote.js') }}"></script>

<!-- datatables -->
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/KeyTable/js/dataTables.keyTable.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Select/js/dataTables.select.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Buttons/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Buttons/js/buttons.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/dataTables/extension/Buttons/js/buttons.colVis.min.js') }}"></script>

<!-- form helper -->
<script type="text/javascript" src="{{ URL::asset('plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/validator.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/summernote.js') }}"></script>

@yield('scripts')

<script>
$(document).ready(function() {
    var table = $('#dataTables-example').DataTable({
        dom: 'Bftip',
        select: true,
        scrollY: '80vh',
        scrollX: true,
        "autoWidth": false,
        scrollCollapse : true,
        paging : false,
        stateSave : true,
        order : [[ 0, "asc" ]],
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
                        window.location.href =  kelas + "/" + id + "/edit";
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
            },
            {
                extend: 'colvis'
            }
        ],
        language: {
            buttons : {
                colvis: "<i class='fa fa-columns'></i> Kolom",
                pageLength: "<i class='fa fa-bars'></i> Baris"
            },
            select:{
              rows:{
                  _: "",
                  0: "",
                  1: ""
              }
            },
            "emptyTable": "Tidak terdapat data di tabel",
            "info": "",
            "infoEmpty": "",
            "infoFiltered":   "",
            "search": "<i class='fa fa-search'></i> Cari:",
            "paginate": {
                "next":       ">",
                "previous":   "<"
            },
            "zeroRecords": "Tidak ditemukan data yang sesuai",
        }
    });

    $(":input").inputmask();

    $('#editor').summernote({
        minHeight: 300,
        maximumImageFileSize: 1242880,
        placeholder: 'Silahkan isi disini...',
        toolbar: [
            ['para',['style']],
            ['style', ['bold', 'italic', 'underline', 'hr']],
            ['font', ['strikethrough', 'superscript', 'subscript','clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol']],
            ['paragraph',['paragraph']],
            ['table',['table']],
            ['height', ['height']],
            ['insert',['link','picture','video']] ,
            ['misc',['fullscreen','codeview']],
            ['misc2',['undo','redo']]
        ]
    });
});
</script>

<script type="text/javascript" src="{{ URL::asset('admin/myscript.js') }}"></script>
</body>
</Html>

