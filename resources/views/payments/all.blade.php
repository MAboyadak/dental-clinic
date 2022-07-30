@extends('layouts/master')

@section('content')
<!-- Main content -->

<div class="page-content">
    <div class="card card-info">
        <div class="card-header page-title">
            <h3 class="card-title">{{__('قائمه المرضي')}}</h3>
        </div>
    </div>
    <div class="card" style="background:white">
        <div class="card-header" style="background:white">
            <a href="{{route('user.create')}}" class="btn btn-success">+ اضف مستخدم </a>
        </div>

        <div class="card-body p-3">
            @if (count($users) > 0 )
            <div class="table-responsive">
                <table id="dataTable" class="table p-3 table-hover table-borderless tablesorter">
                    <thead class="border-checkbox-section">
                        <th>{{__('الاسم')}}</th>
                        <th>{{__('الباسورد')}}</th>
                        <th>{{__('الوظيفه')}}</th>
                        <th>{{__('Action')}}</th>
                    </thead>
                    <tbody class="border-checkbox-section">                    
                        @foreach ($users as $user)
                            <tr >
                                <td>{{$user->name}}</td>
                                <td>{{$user->password}}</td>
                                <td>@if($user->is_admin == 0){{__('عامل')}} @else{{__('طبيب')}}@endif</td>
                                <td>
                                    <form id="deletePatient" method="POST" action="{{ route('user.destroy', $user->id) }}" style="display:inline-block">
                                        @csrf
                                        <a class="btn btn-xs btn-danger text-white" title="Delete User" onclick=" return ( confirm('هل انت متاكد من المسح') ? document.getElementById('deletePatient').submit() : '' ); ">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <h2 class="p-3">There No users.</h2>
            @endif
          
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
@endsection
@section('js_files')
    <script type="text/javascript">
        $("#dataTable").dataTable();
    </script>
@endsection
