@extends('layouts/master')

@section('content')
<!-- Main content -->

<div class="page-content">
    <div class="card card-info">
        <div class="card-header page-title">
            <h3 class="card-title">Teeth of Patients</h3>
        </div>
    </div>
    <div class="card" style="background:white">
        <div class="card-body p-3">
            @if (count($patients) > 0 )
            
                <table id="dataTable" class="table p-3 table-hover table-borderless tablesorter">
                    <thead class="border-checkbox-section">
                        <tr>
                            <th>Patient Name</th>
                            <th>Bad Teeth</th>
                            <th>Treated Teeth</th>
                            <th>Extracted Teeth</th>
                            <th style="width: 200px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="border-checkbox-section">
                        @foreach ($patients as $patient)
                            <tr >
                                <td>{{$patient->name}}</td>
                                <td>{{$patient->teeth()->where('condition', 'bad')->count()}}</td>
                                <td>{{$patient->teeth()->where('condition', 'treated')->count()}}</td>
                                <td>{{$patient->teeth()->where('condition', 'extracted')->count()}}</td>
                                <td>
                                    <a href="{{route('teeth.show', $patient->id)}}" class="btn btn-xs btn-success text-white" title="Show Patient Data" >
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-xs btn-danger text-white" onclick="return(confirm('Are you sure to delete this record ?') ? document.getElementById('deleteTeeth').submit() : '' )">
                                        <form id="deleteTeeth" action="{{ route('teeth.destroy', $patient->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h2 class="p-3">No Patients has ad teeth now.</h2>
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