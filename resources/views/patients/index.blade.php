@extends('layouts/master')

@section('css_files')
  <link rel="stylesheet" href="/admin/css/sweetalert.css">
@endsection

@section('modals')

{{-- Edit Patient Modal --}}
<div class="modal fade" id="editPatient" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <div class="section-title mb-10">
                        <h5>{{__('تعديل بيانات المريض')}}</h5>
                    </div>
                </div>
                <div>
                    <button type="button" class="close" style="display:inline-block;float:left;text-align: left" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
            </div>
            <form action="{{ route('patients.update') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input id="patientId" type="hidden" name="patientId">
                    <div class="input-group">
                        <label class="input-label">{{__('الاسم')}}</label>
                
                        <div class="col-sm-10">
                            <input id="patientName" type="text" name="name" class="form-control" placeholder="ادخل الاسم">
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="input-label">{{__('السن')}}</label>
                
                        <div class="col-sm-10">
                            <input id="patientAge" type="text" name="age" class="form-control" placeholder="ادخل السن">
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="input-label">{{__('المدينه')}}</label>
                
                        <div class="col-sm-10">
                            <input id="patientCity" type="text" name="city" class="form-control" placeholder="ادخل المدينه">
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="input-label">{{__('الوظيفه')}}</label>
                
                        <div class="col-sm-10">
                            <input id="patientJob" type="text" name="job" class="form-control" placeholder="ادخل الوظيفه">
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="input-label">{{__('رقم المحمول')}}</label>
                
                        <div class="col-sm-10">
                            <input id="patientNumber" type="text" name="number" class="form-control" placeholder="ادخل الرقم">
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <label class="input-label">{{__('صورة المريض')}}</label>
                
                        <div class="col-sm-10">
                            <input id="patientFile" name="file" type="file" class="form-control">
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

<div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            {{-- POPUP Image Container --}}
            {{-- <div id="popup-background" class="popup-background" style="display: none;">
            </div> --}}
            {{-- END POPUP --}}


            <div class="modal-header">
                <div class="modal-title">
                    <div id="popup-title"></div>
                </div>
                <div>
                </div>
            </div>
            <div class="modal-body text-center">
                <img id="popup-image" style="width: 65%" class="popup-image">
            </div>
        </div>
    </div>
</div>
      

@endsection

@section('content')
<!-- Main content -->

<div class="page-content">
    {{-- <div class="card card-info"> --}}
        
    {{-- </div> --}}
    <div class="card" style="background:white">
        <div class="card-header card-info page-title">
            <h3 class="card-title">قائمة المرضي</h3>
        </div>
        <div class="card-header" style="background:white">
            <a href="{{route('patients.create')}}" class="btn btn-success">+ اضافة مريض </a>
        </div>

        <div class="card-body p-3">
            @if (count($patients) > 0 )
            <div class="table-responsive">
                <table id="dataTable" class="table p-3 table-hover table-borderless tablesorter">
                    <thead class="border-checkbox-section">
                        <th>{{__('الاسم')}}</th>
                        <th>{{__('السن')}}</th>
                        <th>{{__('المدينه')}}</th>
                        <th>{{__('المحمول')}}</th>
                        <th>{{__('الوظيفه')}}</th>
                        <th>{{__('المطلوب')}}</th>
                        <th>{{__('المدفوع')}}</th>
                        <th>{{__('المتبقي')}}</th>
                        <th>{{__('اخر زيارة')}}</th>
                        {{-- <th>{{__('المشكلة')}}</th> --}}
                        <th>{{__('الصورة الشخصيه')}}</th>
                        <th>{{__('العمليات')}}</th>
                    </thead>
                    <tbody class="">                    
                        @foreach ($patients as $patient)
                            <tr >
                                <td>{{$patient->name}}</td>
                                <td>{{$patient->age}}</td>
                                <td>{{$patient->city}}</td>
                                <td>{{$patient->number}}</td>
                                <td>{{$patient->job}}</td>
                                <td>{{$patient->programs->SUM('cost')}}</td>
                                <td>{{$patient->payments->SUM('paid')}}</td>
                                <td>{{$patient->programs->SUM('cost') - $patient->payments->SUM('paid')}}</td>
                                @if ($patient->appointments->count() < 1)
                                    <td>لا يوجد زيارات سابقه</td>
                                @else
                                    <td>{{$patient->appointments[$patient->appointments->count() - 1]->day}} {{$patient->appointments[$patient->appointments->count() - 1]->hour}}</td>
                                @endif
                            @if (!empty($patient->image))
                                <td><img style="height:40px;border-radius:40%" class="image-popup" data-toggle="modal" data-target="#image-modal"  src="{{asset('storage/'.$patient->image)}}" alt="الصورة الشخصيه ل{{$patient->name}}"></td>
                            @else
                                <td></td>
                            @endif
                                <td>
                                    <a class="btn btn-xs btn-success text-white" href="{{route('patients.show',$patient->id)}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="editPatientBtn text-white btn btn-xs btn-info" data-toggle="modal" data-target="#editPatient" data-key="{{$patient->id}}" >
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-xs btn-danger text-white">
                                        <i class="fa fa-trash" onclick="deletePatient({{$patient->id}})"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            


            @else
                <h2 class="p-3">لا يوجد مرضي.</h2>
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
{{-- <script src="/js/popup-image.js"></script> --}}

<script>
    function deletePatient(myId)
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
            url: "{{route('patients.destroy')}}",
            data: {id:myId},
            cache:false
        });
        swal("تم المسح !", "", "success");
        window.setTimeout(function(){

    // Move to a new location or you can do something else
        var refresh = "{{route('patients.index')}}"
        window.location.href = refresh;

        }, 1000);
    });
    }
</script>    


{{-- Edit patient form  --}}
<script type="text/javascript">
    $(".editPatientBtn").on('click', function(e){
        var patientId = $(this).data('key');
        // console.log(patientId);
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('patients.get')}}",
            type: "post",
            data: {id:patientId},
            success:function(resp){
                // console.log(resp);
                $('#patientId').val(patientId);
                if(resp.name){$("#patientName").val(resp.name)} else{$("#patientName").val('')}
                if(resp.age){$("#patientAge").val(resp.age)} else{$("#patientAge").val('')}
                if(resp.number){$("#patientNumber").val(resp.number)} else{$("#patientNumber").val('')}
                if(resp.city){$("#patientCity").val(resp.city)} else{$("#patientCity").val('')}
                if(resp.job){$("#patientJob").val(resp.job)} else{$("#patientJob").val('')}
            }
          });
    });
</script>
@endsection
