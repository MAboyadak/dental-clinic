@extends('layouts/master')

@section('content')
<div class="page-content">
    
    <!-- /.card-header -->
    <form enctype="multipart/form-data" action="{{ route('patients.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header page-title">
                <h3 class="card-title ">{{__('Create Patient')}}</h3>
            </div>
            <div class="row justify-content-around card-body">
                <div class="col-6 p-2" style="border-left: #ccc 1px dotted">
                    {{-- <div class="card-header"> --}}
                        
                        <h4>{{__('بيانات المريض')}}</h4>
                        <br>
                    {{-- </div> --}}
                    <!-- form start -->
                    <div>
                        <div class="input-group">
                            <label class="input-label">{{__('اسم المريض')}}</label>

                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" placeholder="ادخل الاسم">
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="input-label">{{__('السن')}}</label>
                
                            <div class="col-sm-10">
                                <input type="text" name="age" class="form-control" placeholder="ادخل السن">
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="input-label">{{__('المدينه')}}</label>
                
                            <div class="col-sm-10">
                                <input type="text" name="city" class="form-control" placeholder="ادخل المدينه">
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="input-label">{{__('رقم المحمول')}}</label>
                
                            <div class="col-sm-10">
                                <input type="text" name="number" class="form-control" placeholder="ادخل الرقم">
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="input-label">{{__('الوظيفه')}}</label>
                
                            <div class="col-sm-10">
                                <input type="text" name="job" class="form-control" placeholder="ادخل الوظيفه">
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="input-label">{{__('رفع صورة')}}</label>
                
                            <div class="col-sm-10">
                                <input id="file" name="file" type="file" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="col-5 m-1 p-2">
                    
                    <h4>{{__('حجز موعد')}}</h4>
                    <br>
                    <div>
                        <div class="input-group ">
                            {{-- <label class="input-label">{{__('الميعاد')}}</label> --}}
                            <div class="col-10 input-group">
                                <label>{{__('اليوم')}} : </label>
                                <input class="form-control datepicker" type="text" value="{{date('Y/m/d')}}" name="day" autocomplete="off">
                            </div>
                            {{-- <div class="offset-1"></div> --}}
                            <div class="col-10 input-group">
                                <label>{{__('الساعه')}} : </label>
                                <input class="form-control" type="time" name="hour" autocomplete="off">
                            </div>
                          </div>
                    </div>
                </div>
                
            </div>
            
            <div class="card-footer row justify-content-center">
                <button type="submit" class="col-5 btn btn-primary text-white ">{{__('Save')}}</button>
            </div>
            <!-- /.card-footer -->
        </div>
    </form>

</div>
    
@endsection
