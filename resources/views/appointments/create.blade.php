@extends('layouts/master')

@section('content')
<div class="page-content">
    <div class="card card-info">
        <div class="card-header page-title">
            <h3 class="card-title"><a href="{{route('patient.show',$patient->id)}}">{{$patient->name .' '. $patient->age . ' ' .$patient->city }}</a></h3>
        </div>
    </div>
    <!-- /.card-header -->
    <form action="{{ route('appointment.store', $patient->id) }}" method="POST">
        @csrf
        <input type="hidden" name="selectedPatient" value="{{$patient->id}}">
        <div class="card">
            <div class="card-header">
                <h4>حجز موعد</h4>
            </div>
            <div class="card-body">
                <div class="input-group ">
                    <div class="col-5 input-group">
                        <label class="input-label">{{__("اليوم")}}</label>
                        <input class="form-control" type="date" value="{{date('Y-m-d')}}" name="day">
                    </div>
                    <span class="offset-2"></span>

                    <div class="col-5 input-group">
                        <label class="input-label">{{__("الساعه")}}</label>
                        <input class="form-control" type="time" value="{{date('H:i')}}" name="hour">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block text-white ">{{__("حفظ")}}</button>
            </div>
            <!-- /.card-footer -->
        </div>
    </form>
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