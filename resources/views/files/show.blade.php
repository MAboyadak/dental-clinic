@extends('layouts/master')


@section('css_files')
  <link rel="stylesheet" type="text/css" href="{{ @url('admin/css/sweetalert.css') }}">
@endsection

@section('content')

    <div class="page-content">

      <div class="card card-info">
        <div class="card-header page-title">
          <h3 class="card-title">{{$patient->name}}</h3>
        </div>
      </div>

      
      <div class="card">

        <div class="card-header">
            <h4>All Files</h4>
        </div>

        <div class="card-body">
          @if ( $patient->files()->exists() )
          <div class="container mt-2 mb-5 d-none">
            <div class="row">
              <label class="col-2">النوع</label>
              <label class="col-6" id="fileType"></label>
            </div>
            <div class="row">
                <label class="col-2">اليوم</label>
                <label class="col-6" id="fileDate"></label>
            </div>
            <div class="row">
              <label class="col-2">الساعه</label>
              <label class="col-6" id="fileHour"></label>
            </div>
            <div class="row">
              <label class="col-2">تفاصيل</label>
              <label class="col-6" id="fileDetails"></label>
            </div>
            <hr class="my-4">
          </div>
          <div class="container my-2">

            {{-- <p class="font-weight-bold">Bootstrap carousel with thumbnails is an improved version of the standard bootstrap
              carousel additionally equipped with thumbnails.</p>
            <hr class="my-4"> --}}
            <div class="row">
              <div class="col-2" style="border-left:1px solid #ccc">
                @foreach ($patient->files as $file)
                {{-- {{dd($file)}} --}}
                  <div class="thumb-container" data-type="{{$file['type']}}" data-details="{{$file['details']}}" data-date="{{$file['created_at']}}" style="border-bottom:1px solid #333"><img src="{{asset('storage/'.$file['name'])}}" alt=""></div>
                @endforeach
              </div>
              <div class="col-10">
                <div class="img-container">
                </div>
              </div>
            </div>
          </div>
          @else
            <h4 class="d-inline-block ml-2"> لا يوجد ملفات لهذا المريض هل تريد اضافه ملف ؟</h4>
            <a href="{{route('files.create', $patient->id)}}" class="btn btn-success">
                اضافه ملف +
            </a>
          @endif
            
        </div><!-- end card-body --> 

      </div><!-- /end card -->

    </div>

@endsection


{{-- Scripts --}}
@section('js_files')
    <script type="text/javascript" src="{{ @url('admin/js/sweetalert.min.js') }}"></script>
    <script>

      function allToDefault(clickedEl){
        $('.thumb-container').each(function(){
          $(this).css('opacity','.4');
        })
        $(clickedEl).css('opacity','1')
        
        var activeImg = clickedEl.firstChild;
        activeImg = activeImg.src;
        var image = "<img src='"+activeImg+"'>";
        $('.img-container').html(image);

        $('.d-none').removeClass('d-none');
        
        var type = $(clickedEl).attr('data-type');
        var date = $(clickedEl).attr('data-date');
        var details = $(clickedEl).attr('data-details');
        console.log(details);
        date = date.split(" ");
        $('#fileType').text(type);
        $('#fileDate').text(date[0]);
        $('#fileHour').text(date[1]);
        $('#fileDetails').text(details);

      }

      $('.thumb-container').on('click', function(){
        allToDefault(this);
      });

    </script>
@endsection