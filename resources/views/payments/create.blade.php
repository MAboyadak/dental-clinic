@extends('layouts/master')
@section('css_files')
  <link rel="stylesheet" href="/css/select2.min.css">
  {{-- <link rel="stylesheet" href="/admin/css/sweetalert.css"> --}}
@endsection
@section('content')
<div class="page-content">
    <div class="card card-info">
        <div class="card-header page-title">
            <h3 class="card-title ">{{__('اضافة مدفوعات للمريض')}}</h3>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('payment.store') }}" method="POST">
                @csrf
                <div class="card-body">
                <div class="input-group">
                    <label class="input-label" style="line-height:1">{{__('اسم المريض')}}</label>
                    <div class="col-sm-10">
                        <select name="selectedPatient" class="form-control" id="patientNameSelectBox">
                            @foreach ($patients as $patient)
                            <option value="{{$patient->id}}">{{$patient->name}} {{$patient->age}} {{$patient->city}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="input-group ">
                    <div class="row">
                        <label >{{__('المبلغ المطلوب')}} :</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="number" name="wanted">
                        </div>
                        <div class="offset-1"></div>
                        <label >{{__('المبلغ المدفوع')}} :</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="number" name="paid">
                        </div>
                    </div>
                </div>
                </div>
                <div class="card-footer text-center">
                <button type="submit" style="width:20%" class="btn btn-primary text-white ">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
      


</div>
    
@endsection
@section('js_files')
    <script src="/js/select2.min.js"></script>
    <script>
    $(function () {
        $("select").select2();
    });
    </script>
@endsection