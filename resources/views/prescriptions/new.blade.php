@extends('layouts/master')

@section('css_files')
  <link rel="stylesheet" href="/css/select2.min.css">
@endsection

@section('content')
<div class="page-content">
    <div class="card card-info">
        <div class="card-header page-title">
            <h3 class="card-title">{{__('Create Prescription')}}</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <form action="{{ route('prescription.newStore') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h4>{{__('Choose Patient')}}</h4>
            </div>
            <div class="card-body">
                <div class="input-group">
                    <label>Patient Name :</label>
                    <div class="col-sm-10">
                        <select name="selectedPatient" class="form-control" id="patientNameSelectBox">
                            @foreach ($patients as $patient)
                                <option value="{{$patient->id}}">{{$patient->name}} {{$patient->age}} {{$patient->city}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Add Medicines</h4>
            </div>
            <div class="card-body">
                {{-- <div class="hr-line-dashed"></div> --}}
                <div class="input-group mb-3">
                    <label>{{__('Patient Problem')}} :</label>
                    <div class="col-sm-10">
                        <textarea name="problem" id="" cols="50" rows="3"></textarea>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group ">
                    <div class="col-12 m-0">
                        <div id="emptyname" class="bg-danger text-white p-2 mb-2 d-none">* Medicine name can\'t be empty.</div>
                        <div class="row" id="medicine-container">
                            <div class="col-3 col-md-3">
                                <label for="">
                                    Medicine
                                </label>
                                <input id="medicine" type="text" class="form-control">
                            </div>                            
                            <div class="col-3 col-md-2">
                                <label for="">
                                    Days
                                </label>
                                <input id="days" type="number" class="form-control">
                            </div>
                            <div class="col-3 col-md-2">
                                <label for="">
                                    Repeats
                                </label>
                                <input id="repeats" type="number" class="form-control">
                            </div>
                            <div class="col-3 col-md-3">
                                <label for="">
                                    Instructions
                                </label>
                                <textarea id="instructions" type="text" class="form-control"></textarea>
                            </div>
                            <div class="col-12 col-md-2 align-self-end">
                                <button class="btn btn-info text-white" type="button" onclick="addMedicine(event)">Add Medicine</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Add Payment</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="offset-1"></div>
                    <label >{{__('المبلغ المطلوب')}} :</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="number" name="wanted">
                    </div>
                    <div class="offset-2"></div>
                    <label >{{__('المبلغ المدفوع')}} :</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="number" name="paid">
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

@section('js_files')
<script src="/js/select2.min.js"></script>
<script>
  $(function () {
    $("select").select2();
  });
</script>
@endsection