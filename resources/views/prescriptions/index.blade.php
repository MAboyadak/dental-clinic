@extends('layouts/master')
@section('modals')
<div class="modal fade" id="singleEmailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-title">
                    <div class="section-title mb-10">
                        <h6>{{__('Edit Prescription')}}</h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('prescriptions.update')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="prescription_key" name="key" value="">
                    <div class="input-group mb-3">
                        <label class="input-label">{{__('Patient Problem')}} :</label>
                        <div class="col-sm-10">
                            <textarea name="problem" id="problem" cols="80" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="row">
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
                <div class="modal-footer">
                    <input id="communicationID" type="hidden" name="id" value="">
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-check"></i> {{__('Save')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Main content -->

<div class="page-content">
    <div class="card card-info">
        <div class="card-header page-title">
            <h3 class="card-title">Prescriptions List</h3>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="{{route('prescription.new')}}" class="btn btn-success text-white">{{__('Create Prescription')}}</a>      
        </div>
        <div class="card-body p-3">
            @if (count($prescriptions) > 0 )
            <div class="table-responsive">
                <table id="dataTable" class="table p-3 table-hover table-borderless tablesorter">
                    <thead class="border-checkbox-section">
                        <tr>
                            <th>Prescription Date</th>
                            <th>Patient Name</th>
                            <th>Medicines Count</th>
                            <th style="width: 200px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="border-checkbox-section">
                        @foreach ($prescriptions as $prescription)
                            <tr >
                                <td>{{$prescription->created_at}}</td>
                                <td>{{$prescription->patient->name}}</td>
                                <td>{{$prescription->medicines->count()}}</td>
                                <td>
                                    <a class="btn btn-xs btn-success text-white" title="Show Patient Data" href="{{route('prescription.show',$prescription->id)}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-xs btn-info text-white edit" data-toggle="modal" data-target="#singleEmailModal" data-key="{{$prescription->id}}" data-placement="left" title="{{__('Edit')}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-xs btn-danger text-white alert-confirm delete" href="#" data-toggle="tooltip" data-placement="left" title="{{__('Delete')}}" data-value="{{$prescription->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <h2 class="p-3">No Prescriptions.</h2>
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
    <script type="text/javascript">
        $("#dataTable").on('click', '.edit', function(e){
            $('#medicine-container').nextAll().remove();
            var el = $(this);
            var key = el.data('key');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('prescription.get')}}",
                type: "POST",
                data: {key:key},
                success:function(resp){

                    $("#prescription_key").val(resp.id);
                    $("#problem").val(resp.problem);
                                        
                    var medicines = resp.medicines;
                    medicines.forEach(element => {
                        div = '<div class="hr-line-dashed"></div><div class="row"><div class="col-3 col-md-3"><label for="">Medicine</label><input type="text" name="medicines[]" class="form-control" value="'+element.name+'" readonly></div><div class="col-3 col-md-2"><label for="">Days</label><input type="number" name="days[]" class="form-control" value='+element.days+' readonly></div><div class="col-3 col-md-2"><label for="">Repeats</label><input type="number" name="repeats[]" class="form-control" value='+element.repeats+'  readonly></div><div class="col-3 col-md-3"><label for="">Instructions</label><textarea name="instructions[]" class="form-control" value=""'+element.instructions+'" readonly>'+element.instructions+'</textarea></div><div class="col-12 col-md-2 align-self-end"><button class="btn btn-info text-white" type="button" onclick="dropMedicine(event)">Drop</button></div></div>'
                        $(div).insertAfter('#medicine-container');
                    });
                    // $("#last_name").val(resp.last_Name);
                    // $("#password").val(resp.password);
                    // $("#phone").val(resp.phone);
                    // $("#color").val(resp.car_Color);
                }
            });
        });
    </script>
@endsection