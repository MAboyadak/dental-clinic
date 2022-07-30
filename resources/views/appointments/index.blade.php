@extends('layouts/master')

@section('css_files')
  <link rel="stylesheet" href="/css/select2.min.css">
@endsection

@section('modals')
{{-- Add Appointment --}}
<div class="modal fade" id="addApp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <div class="section-title mb-10">
                        <h5>{{__('حجز جديد')}}</h5>
                    </div>
                </div>
                <div>
                  <button type="button" class="close" style="display:inline-block;float:left;text-align: left" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
            </div>
            <form action="{{ route('appointments.store') }}" method="post">
                <div class="modal-body">
                    @csrf

                    <div class="input-group">
                        <label class="input-label" style="line-height:1">{{__('الاسم')}}</label>
                        <div class="col-sm-10">
                          <select name="selectedPatient" class="form-control" id="patientNameSelectBox">
                              @foreach ($patients as $patient)
                              <option value="{{$patient->id}}">{{$patient->name}} {{$patient->age}} {{$patient->city}}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="input-group ">
                      <div class="col-5 input-group">
                          <label class="input-label">{{__("اليوم")}}</label>
                          <input class="form-control" type="date" value="{{date('Y-m-d')}}" name="day">
                      </div>
                      <span class="offset-2"></span>
  
                      <div class="col-5 input-group">
                          <label class="input-label">{{__("الساعه")}}</label>
                          <input class="form-control" type="time" value="{{date('H:i')}}" name="hour">
                      </div>
                  </div>
                </div>  
                {{--End Modal Body  --}}
              
                <div class="modal-footer">
                    {{-- <input id="communicationID" type="hidden" name="id" value=""> --}}
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-check"></i> {{__('حفظ')}}
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
    
    <div class="card" style="background:white">
        <div class="card-header card-info page-title">
            <h3 class="card-title">تاريخ الحجوزات</h3>
        </div>
        {{-- <div class="card-header" style="background:white">
            <a data-toggle="modal" data-target="#addApp" data-key="{{$patient->id}}" class="btn btn-success text-white">ميعاد جديد +</a>
        </div> --}}

        <div class="card-body p-3">
            @if (count($appointments) > 0 )
            
                <table id="dataTable" class="table p-3 table-hover table-borderless tablesorter">
                    <thead class="border-checkbox-section text-center">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>اسم المريض</th>
                            <th>المشكلة</th>
                            <th>الشغل</th>
                            <th>اليوم</th>
                            <th>الساعه</th>
                            {{-- <th>Prescription</th> --}}
                            <th style="width: 200px">عمليات</th>
                        </tr>
                    </thead>
                    @foreach ($appointments as $appointment)
                        <tr class="text-center">
                            <td>{{$appointment->id}}</td>
                            <td>{{$appointment->patient->name}}</td>
                            @if (!$appointment->session)
                                <td></td>
                                <td></td>
                            @else
                                <td>{{$appointment->session->problem}}</td>
                                <td>{{$appointment->session->work}}</td>
                            @endif
                            <td>{{$appointment->day}}</td>
                            <td>{{$appointment->hour}}</td>
                            <td>
                                <a class="btn btn-xs btn-danger text-white ml-2"><i class="fa fa-trash" onclick="deleteApp({{$appointment->id}})" ></i></a>
                                {{-- @if (isset($appointment->p_id) && !empty($appointment->p_id))
                                    <a class="btn btn-xs btn-success text-white" title="Show Patient Data" href="{{route('prescription.show', $appointment['p_id'])}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endif --}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h2 class="p-3">No appointments.</h2>
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
<script src="/admin/js/sweetalert.min.js"></script>
<script>
    function deleteApp(myId)
    {
      swal({
        title: "{{__('هل انت متاكد ؟')}}",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "الغاء",
        confirmButtonClass: "btn-danger",
        confirmButtonText: "{{__('نعم , قم بالمسح')}}",
        closeOnConfirm: false
      },
      function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url: "{{route('home.delapp')}}",
            data: {id:myId},
            cache:false
        });
        swal("تم المسح !", "", "success");
        window.setTimeout(function(){

      // Move to a new location or you can do something else
        var refresh = "{{route('appointments.index')}}"
        window.location.href = refresh;

        }, 500);
      });
    }
</script>

<script src="/js/select2.min.js"></script>
<script>
  $(function () {
    $("select").select2();
  });
</script>
  

    
@endsection