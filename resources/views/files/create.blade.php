@extends('layouts/master')

@section('content')
<div class="page-content">
    <div class="card card-info">
        <div class="card-header page-title">
            <h3 class="card-title">{{$patient->name .'-'. $patient->age . '-' .$patient->city }}</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <form enctype="multipart/form-data" action="{{ route('files.store', $patient->id) }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h4>{{__('اضافة ملفات')}}</h4>
            </div>
            <div class="card-body">
                <div class="input-group">
                    <label class="input-label">رفع الملف :</label>

                    <div class="col-sm-5">
                        <input id="file" name="file" type="file" class="form-control">
                    </div>
                </div> 
                <div class="input-group">
                    <label class="input-label">نوع الملف المرفوع :</label>

                    <div class="col-sm-5">
                        <select class="form-control" name="type">
                            <option value='اشاعه' selected>اشاعه</option>
                            <option value='غير ذلك' >غير ذلك</option>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <label class="input-label">التفاصيل :</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" name="details" cols="30" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" style="width:20%" class="btn btn-primary text-white ">Save</button>
            </div>
            <!-- /.card-footer -->
        </div>
        
    </form>
</div>
@endsection