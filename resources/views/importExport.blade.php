<html lang="en">
<head>
	<title>Import - Export Laravel 5</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Import - Export in Excel and CSV Laravel 5</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
		<a href="{{ URL::to('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
		<a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>
		<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<input type="file" name="import_file" />
			<button class="btn btn-primary">Import File</button>
		</form>
		<button type="button" class="btn btn-primary" id="getreq">get request</button>
        <form id="register" action="#">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" id="firstname" class="form-control">
            <input type="text" id="lastname" class="form-control">
            <input type="submit" value="register" class="btn btn-primary">
        </form>

        <div id="getreqdata"></div>
        <div id="postreqdata"></div>
	</div>
	<script type="text/javascript" src="{{ URL::asset('admin/jQuery/jQuery-2.1.3.min.js') }}"></script>
	<script type="text/javascript">
        $.ajaxSetup({
           headers:{
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });

		$(document).ready(function () {
			$('#getreq').click(function () {
//				$.get('getreq',function (data) {
//					console.log(data);
//				})

                $.ajax({
                    type: "GET",
                    url: "getreq",
                    success: function (data) {
                        console.log(data);
                        $('#getreqdata').append(data);
                    }
                })
			});

            $('#register').submit(function () {
                var fname = $('#firstname').val();
                var lname = $('#lastname').val();

//                $.post('register',{ firstname:fname, lastname:lname},function (data) {
//                    console.log(data);
//                    $('#postreqdata').html(data);
//                });

                var datastring = "firstname="+fname+"&lastname="+lname;
                $.ajax({
                    type: "POST",
                    url: "register",
                    data: datastring,
                    success: function (data) {
                        console.log(data);
                        $('#postreqdata').html(data);
                    }
                });
            });
		});
	</script>
</body>
</html>