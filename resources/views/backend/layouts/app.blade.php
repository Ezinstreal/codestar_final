
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> @yield('title') </title>

  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  @yield('css')
</head>

@include('backend.layouts.header')

@yield('main')

@include('backend.layouts.footer')

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable( {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.22/i18n/Vietnamese.json',
        }
    } );
} );

</script>
@yield('js')
</body>
</html>
