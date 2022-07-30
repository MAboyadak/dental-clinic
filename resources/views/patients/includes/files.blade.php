<div class="card">
    <div class="card-header">
        <a href="{{route('files.create',$patient->id)}}" class="btn btn-success text-white">اضافة ملف +</a>      
    </div>
    <div class="card-header">
        <h4>All Files</h4>
    </div>

    <div class="card-body">
      @if ( $patient->files()->exists() )
      <div class="container mt-2 mb-5 imginfo d-none">
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
        
        <div class="row">
          <div class="col-2" style="border-left:1px solid #ccc">
            @foreach ($files as $file)
              <div class="thumb-container" data-type="{{$file['type']}}" data-details="{{$file['details']}}" data-date="{{$file['created_at']}}" style="border-bottom:1px solid #333"><img src="{{asset('storage/'.$file['name'])}}" alt=""></div>
            @endforeach
          </div>
          <div class="col-10">
            <div style="cursor: pointer" class="img-container" data-toggle="modal" data-target="#image-modal">
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