@extends('layouts/master')

@section('content')
<div class="page-content">

    <!-- /.card-header -->
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header page-title">
                <h3 class="card-title ">{{__('اضافة مستخدم')}}</h3>
            </div>
            <div class="card-header">
                <h4>{{__('بيانات المستخدم')}}</h4>
            </div>
            <!-- form start -->
            <div class="card-body">
                <div class="input-group">
                    <label class="input-label">{{__('الاسم')}}</label>

                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" placeholder="ادخل الاسم">
                    </div>
                </div>
                <div class="input-group">
                    <label class="input-label">{{__('الباسورد')}}</label>
        
                    <div class="col-sm-10">
                        <input type="text" name="password" class="form-control" placeholder="ادخل الباسورد">
                    </div>
                </div>
                <div class="form-group p-3 mt-3">
                     <label class="w-12 input-label">طبيب (ادمن)</label> <input type="radio" name="isAdmin" value="1">  <br>
                     <label class="w-12 input-label">عامل (مستخدم عادي)</label> <input type="radio" name="isAdmin" value="0">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block text-white ">{{__('Save')}}</button>
            </div>
            <!-- /.card-footer -->
        </div>
        
            
    </form>

</div>
    
@endsection