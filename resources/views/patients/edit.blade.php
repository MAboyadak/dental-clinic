@extends('layouts/master')

@section('content')
    <div class="card card-info">
        <div class="card-header page-title">
            <h3 class="card-title ">Edit Patient</h3>
        </div>
    </div>
    <!-- /.card-header -->

    <!-- form start -->
    <div class="card">
        <div class="card-header">
            <h4>Patient Data</h4>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{ route('patients.update', $current_patient->id) }}" method="POST">
                @csrf
                @method('PUT')        
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
        
                        <div class="col-sm-10">
                            <input type="text" value="{{$current_patient->name}}" name="name" class="form-control" placeholder="ادخل الاسم">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Age</label>
            
                        <div class="col-sm-10">
                            <input type="text" value="{{$current_patient->age}}" name="age" class="form-control" placeholder="ادخل السن">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">City</label>
            
                        <div class="col-sm-10">
                            <input type="text" value="{{$current_patient->city}}" name="city" class="form-control" placeholder="ادخل المدينه">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Mobile Number</label>
            
                        <div class="col-sm-10">
                            <input type="text" value="{{$current_patient->number}}" name="number" class="form-control" placeholder="ادخل الرقم">
                        </div>
                    </div>
                
                </div>
                <!-- /.card-body -->
        
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block text-white ">Save</button>
                </div>
                <!-- /.card-footer --> 
            </form>
        </div>
    </div>

    
@endsection