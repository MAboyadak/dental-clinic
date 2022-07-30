@extends('layouts/master')

@section('content')
<!-- Main content -->

<div class="page-content">
    <div class="card card-info">
        <div class="card-header page-title">
            <h3 class="card-title">Files</h3>
        </div>
    </div>
    <div class="card" style="background:white">
        
        <div class="card-body p-0">
            @if (count($patients) > 0 )
            
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Patient Name</th>
                        <th>Files</th>
                        <th style="width: 200px">Action</th>
                    </tr>

                    @foreach ($patients as $patient)
                        <tr >
                            <td></td>
                            <td>{{$patient->name}}</td>
                            <td>{{$patient->files()->count()}}</td>
                            <td>
                                <a href="{{route('files.show', $patient->id)}}" class="btn btn-xs btn-success text-white" title="Show Patient Data" >
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a class="btn btn-xs btn-danger text-white" onclick="return(confirm('Are you sure to delete this record ?') ? document.getElementById('deleteFiles').submit() : '' )">
                                    <form id="deleteFiles" action="{{ route('files.destroy', [$patient->id,1]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    {{$patients->links()}}

                </table>
                    {{$patients->links()}}
            @else
                <h2 class="p-3">No Files</h2>
            @endif
          
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
@endsection