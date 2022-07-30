<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ asset('admin/DataTables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/sweetalert.css') }}">
  <link rel="stylesheet" href="{{ asset('css/picktim.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css')}}">
  <link rel="stylesheet" href="{{ asset('css/jquery.ptTimeSelect.css')}}">
  {{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
  {{-- <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet"> --}}
  
  @yield('css_files')
  <style>
    * {font-family: 'Cairo';font-size: 17px};
    .ui-widget-content,.ui-widget{top: 265px !important};
    #ptTimeSelectCntr{top:  265px !important};
  </style>
  <title>Dental Clinic</title>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->

<div class="wrapper">
  @yield('modals')

    {{-- Navbar --}}
      
    {{-- !!!! --}}

    <!-- Main Sidebar Container -->
    {{-- if(auth()->user()->is_admin == 1){
            return $next($request);
        } --}}

    {{-- @if (isset(Auth::user()->name))
      @if (Auth::user()->is_admin == 1)
        @include('inc.aside')
      @endif
    @endif --}}
    
    <!-- /.sidebar -->


        {{-- @include('inc.messages') --}}
        <section class="content p-0">

          @if (isset(Auth::user()->name))
            @if (Auth()->user()->is_admin)
              <div class="row justify-content-right p-2 text-center mb-3"style="background-color: #000000a6;border-radius-top:2px">
                {{-- <a id="settings" href="#">
                  <i class="fa fa-cog" style=" max-width:100px;font-size:40px" alt=""></i>
                  <h2><i class="fa fa-angle-right" style=" max-width:20px;font-size:20px" alt=""></i> {{__('Settings')}}</h2>
                </a> --}}
                
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
                    <li class="nav-item has-treeview ml-4 pt-2" >
                      <a href="" class="nav-link text-center" style="color:white;">
                        <i class="nav-icon fa fa-cog ml-4" style="font-size:40px"></i>
                        <h2><i class="fa fa-angle-left right" style="max-width:30px;font-size:20px"></i> {{__('Settings')}}</h2>
                          
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{route('users')}}" class="nav-link" style="color:white;">
                            <i class="fa fa-user nav-icon"></i>
                            <p>{{__('المستخدمين')}}</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{route('backup')}}" class="nav-link" style="color:white;">
                            <i class="fa fa-circle nav-icon"></i>
                            <p>{{__('باك اب الداتا')}}</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{route('logout')}}" class="nav-link" style="color:white;">
                            <i class="fa fa-square nav-icon"></i>
                            <p>{{__('تسيجل الخروج')}}</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                <a href="{{route('appointments.index')}}" class="ml-5 pt-3" style="color:white;">
                  <i class="fa fa-calendar-alt" style="font-size:40px" alt=""></i>
                  <h2>جميع الحجوزات</h2>
                </a>
                <a href="{{route('admin.index')}}" class="ml-5 pt-3" style="color:white;">
                  <i class="fa fa-home" style="font-size:40px" alt=""></i>
                  <h2>اللوحة الرئيسية</h2>
                </a>
                <a href="{{route('patients.index')}}" class="ml-5 pt-3" style="color:white;">
                  <i class="fa fa-users" style="font-size:40px" alt=""></i>
                  <h2>المرضي</h2>
                </a>
                
                
              </div>
              {{-- <div class="row bg-info mb-3" style="margin-right:2%;margin-left:2%;border-radius-top:2px">
                <ul>
                  <li>Create Backup File</li>
                  <li>Log Out</li>
                </ul>
              </div> --}}
            @endif
          @endif


          <div class="page-content">
            @include('inc.messages')
          </div>
          
          @yield('content')
        </section>
</div>

<!-- ./wrapper -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}


{{-- js filles --}}

<script type="text/javascript" src="{{ asset('admin/js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('js/bootstrap-timepicker.js') }}"></script> --}}
<script src="{{ asset('js/picktim.js')}}"></script>
<script src="{{ asset('js/jquery.ptTimeSelect.js')}}"></script>
<script src="{{ asset('/js/popup-image.js')}}"></script>
<script src="{{ asset('js/custom.js')}}"></script>

<script>
  $(window).on('load',function() {
    $('#loading').remove();
  });
</script>
@yield('js_files')
</body>
</html>
