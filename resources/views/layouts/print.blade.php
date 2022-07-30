<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="/css/app.css">
  
  @yield('css_files')

  <title>Dental Clinic</title>
</head>
<body class="hold-transition sidebar-mini" style="background:unset;overflow:hidden">
<!-- Site wrapper -->

<div class="container-fluid text-center" style="direction:rtl">
  {{-- style="direction:rtl;background-image:url('/img/logo.png');background-size:center" --}}
  @yield('content')
</div>


<!-- ./wrapper -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}


{{-- js filles --}}

<script type="text/javascript" src="{{ asset('admin/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="/js/app.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script src="/js/custom.js"></script>
@yield('js_files')
</body>
</html>
