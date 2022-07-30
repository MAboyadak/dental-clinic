@extends('layouts/master')

@section('content')
<div class="page-content">
    <div class="card card-info">
        <div class="card-header page-title">
            <h3 class="card-title">{{__('Create Prescription')}}</h3>
        </div>
    </div>
    
    <!-- /.card-header -->
    <form enctype="multipart/form-data" action="{{ route('prescriptions.store', $patient->id) }}" method="POST">
        @csrf
        <div class="card">

            <div class="card-header">
                <h4>Add Medicines</h4>
            </div>
            <div class="card-body">
                {{-- <div class="row justify-content-around">
                    <div class="input-group col-5">
                        <label>{{__('المشكله')}}&nbsp;&nbsp;</label>
                        <textarea class="form-control" name="problem" id="" cols="40" rows="3"></textarea>
                    </div>
                    <div class="input-group col-5">
                        <label>{{__('العمل')}}&nbsp;&nbsp;</label>
                        <textarea class="form-control" name="work" id="" cols="40" rows="3"></textarea>
                    </div>
                </div> --}}
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
                            <div class="col-12 col-md-2 align-self-center">
                                <button class="btn btn-info text-white" type="button" onclick="addMedicine(event)"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" style="width:20%" class="btn btn-primary text-white ">Save</button>
            </div>
        </div>

        {{-- <div class="card">
            <div class="card-header">
                <h4>اضافة دفع</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-around">
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
        <div class="card">
            <div class="card-header">
                <h4>المعاد القادم</h4>
            </div>
            <div class="card-body">
                <div class="input-group ">
                    <div class="col-5 input-group">
                        <label class="input-label">{{__("اليوم")}}</label>
                        <input class="form-control" type="date" name="day">
                    </div>
                    <span class="offset-2"></span>

                    <div class="col-5 input-group">
                        <label class="input-label">{{__("الساعه")}}</label>
                        <input class="form-control" type="time" name="hour">
                    </div>
                    </div>
            </div>
            <!-- /.card-footer -->
        </div> --}}
        
    </form>
</div>
@endsection