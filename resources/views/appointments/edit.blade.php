@extends('layouts/master')

@section('content')
    <div class="card">
        <div class="card-header page-title">
            <h3 class="card-title">Create Appointment</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <form enctype="multipart/form-data" action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h4>Appointment Time</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-2"><label for="inputEmail3">Patient Name :</label></div>
                        <div class="col-sm-8">
                            <select name="selectedPatient" class="form-control" id="patientNameSelectBox">
                                <option value="{{$appointment->patient->id}}" selected hidden>{{$appointment->patient->name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-sm-2"><label for="inputEmail3">Day & Hour :</label></div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-5">
                                <div class="row">
                                    <div class="col-sm-2 align-self-center">
                                        <label class="ml-2 m-0">Day</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" value="{{$appointment->day}}" name="day">
                                    </div>
                                </div>
                            </div>
                            <div class="offset-2"></div>
                            <div class="col-5">
                                <div class="row">
                                    <div class="col-sm-2 align-self-center">
                                        <label class="ml-2 m-0">Hour</label>
                                    </div>
                                    <div class="col-10">
                                        <input class="form-control" type="time" value="{{$appointment->hour}}" name="hour">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block text-white ">Save</button>
            </div>
            <!-- /.card-footer -->
        </div>
    </form>


    
@endsection