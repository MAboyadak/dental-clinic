@extends('layouts/master')


@section('css_files')
  <link rel="stylesheet" type="text/css" href="{{ @url('admin/css/sweetalert.css') }}">
@endsection

{{-- Modals --}}

@section('modals')
<div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <div class="section-title mb-10">
                        <h5>{{__('تعديل المعلومات الطبيه')}}</h5>
                    </div>
                </div>
                <div>
                  <button type="button" class="close" style="display:inline-block;float:left;text-align: left" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
            </div>
            <form id="edit_medinfo" action="{{route('medicalinfo.store', $patient->id)}}" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    @csrf
                    {{-- <input type="hidden" id="driver_key" name="key" value=""> --}}
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                              <label >{{__('هل تعاني من ضغط الدم ؟')}}</label>
                              <select id="blood_pressure" class="form-control" name="blood_pressure">
                                <option value=1 >نعم</option>
                                <option value=0 selected>لا</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                              <label >{{__('هل تعاني من السكر ؟')}}</label>
                              <select id="diabetes" class="form-control" name="diabetes">
                                <option value=1 >نعم</option>
                                <option value=0 selected>لا</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                              <input class="form-control d-none" id="diabetes_details" placeholder=" نتيجه اخر تحليل .. " type="text" name="diabetes_details">
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                            <label >{{__('هل تعاني من اي امراض في القلب ؟	')}}</label>
                            <select id="heart" class="form-control" name="heart">
                              <option value=1 >نعم</option>
                              <option value=0 selected>لا</option>
                            </select>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                            <label >{{__('هل تعاني من حساسيه لنوعيه علاج محدده ؟	')}}</label>
                            <select id="sensitivity" class="form-control" name="sensitivity">
                              <option value=1 >نعم</option>
                              <option value=0 selected>لا</option>
                            </select>
                          </div>
                      </div>
                    </div>

                    <div class="row ">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                              <input class="form-control d-none" id="sensitivity_details" placeholder=" ما هي .." type="text" name="sensitivity_details">
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                            <label >{{__('هل تعاني من اي امراض اخري ؟	')}}</label>
                            <select id="other" class="form-control" name="other">
                              <option value=1 >نعم</option>
                              <option value=0 selected>لا</option>
                            </select>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                              <input id="other_details" class="form-control d-none" placeholder=" ما هي .." type="text" name="other_details">
                          </div>
                      </div>
                    </div>
                    @if ($patient->gender != 'male')
                      <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                              <label >{{__('هل يوجد حمل ؟')}}</label>
                              <select id="pregnant" class="form-control" name="pregnant">
                                <option value=1 >نعم</option>
                                <option value=0 selected>لا</option>
                              </select>
                            </div>
                        </div>
                      </div>

                      <div class="row" >
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <input class="form-control d-none" id="pregnant_details" placeholder="في اي شهر ؟" type="text" name="pregnant_details">
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                              <label >{{__('هل يوجد رضاعه ؟	')}}</label>
                              <select id="breast_feeding" class="form-control" name="breast_feeding">
                                <option value=1 >نعم</option>
                                <option value=0 selected>لا</option>
                              </select>
                            </div>
                        </div>
                      </div>
                    @endif

                  </div>  
            {{--End Modal Body  --}}
              
                <div class="modal-footer">
                    {{-- <input id="communicationID" type="hidden" name="id" value=""> --}}
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-check"></i> {{__('Save')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
{{-- End Modals --}}

@section('content')

  <div class="page-content">
    <div class="card card-info">
      <div class="card-header page-title">
        <h3 class="card-title">{{$patient->name}}</h3>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <a id="editBtn" data-toggle="modal" data-target="#editForm" data-key="{{$patient->id}}" class="btn btn-success text-white">تعديل المعلومات الطبيه</a>      
        {{-- <a href="#" data-target="#editForm" data-toggle="modal" class="btn btn-success">+ Edit Medical Info </a> --}}
      </div>
      <div class="card-header">
        <h4>Medical Info details</h4>
      </div>
      {{-- {{dd($patient->medicalinfo)}} --}}
      <div class="card-body">
        @if ( $patient->medicalinfo()->exists() )
          <table class="table table-stripped table-bordered">
            <tr>
              <th >هل تعاني من ضغط الدم ؟</th>
              <td class="text-center">
                @if (isset($patient->medicalinfo->blood_pressure) && $patient->medicalinfo->blood_pressure== true)
                  <i style="color:green;font-size:20px" class="fa fa-check"></i>                  
                @endif
              </td>
            </tr>
            <tr>
              <th >هل تعاني من السكر ؟</th>
              <td class="text-center">
                @if (isset($patient->medicalinfo->diabetes) &&  $patient->medicalinfo->diabetes == true)
                <i style="color:green;font-size:20px" class="fa fa-check"></i>
                @endif
              </td>
            </tr>
            <tr>
              <th >ما هي نتيجه اخر تحليل ؟</th>
              <td class="text-center">
                @if (isset($patient->medicalinfo->diabetes_details) && !empty($patient->medicalinfo->diabetes_details))
                  {{$patient->medicalinfo->diabetes_details}}
                @endif
              </td>
            </tr>
            <tr>
              <th >هل تعاني من اي امراض في القلب ؟</th>
              <td class="text-center">
                @if (isset($patient->medicalinfo->heart) && $patient->medicalinfo->heart == true)
                <i style="color:green;font-size:20px" class="fa fa-check"></i>
                @endif
              </td>
            </tr>
            <tr>
              <th >هل تعاني من حساسيه لنوعيه علاج محدده ؟</th>
              <td class="text-center">
                @if (isset($patient->medicalinfo->sensitivity) && $patient->medicalinfo->sensitivity == true)
                <i style="color:green;font-size:20px" class="fa fa-check"></i>
                @endif
              </td>
            </tr>
            <tr>
              <th >ما هي</th>
              <td class="text-center">
                @if (isset($patient->medicalinfo->sensitivity_details) && !empty($patient->medicalinfo->sensitivity_details))
                  {{$patient->medicalinfo->sensitivity_details}}
                @endif
              </td>
            </tr>
            <tr>
              <th >هل تعاني من اي امراض اخري ؟</th>
              <td class="text-center">
                @if (isset($patient->medicalinfo->other) && $patient->medicalinfo->other == true)
                  <i style="color:green;font-size:20px" class="fa fa-check"></i>
                @endif
              </td>
            </tr>
            <tr>
              <th >ما هي</th>
              <td class="text-center">
                @if (isset($patient->medicalinfo->other_details) && !empty($patient->medicalinfo->other_details))
                  {{$patient->medicalinfo->other_details}}
                @endif
              </td>
            </tr>
            <tr>
              <th >هل يوجد حمل ؟</th>
              <td class="text-center">
                @if (isset($patient->medicalinfo->pregnant) && $patient->medicalinfo->pregnant == true)
                <i style="color:green;font-size:20px" class="fa fa-check"></i>
                @endif
              </td>
            </tr>
            <tr>
              <th >في اي شهر ؟</th>
              <td class="text-center">
                @if (isset($patient->medicalinfo->pregnant_details) && !empty($patient->medicalinfo->pregnant_details))
                  {{$patient->medicalinfo->pregnant_details}}
                @endif
              </td>
            </tr>
            <tr>
              <th >هل يوجد رضاعه ؟</th>
              <td class="text-center">
                @if (isset($patient->medicalinfo->breast_feeding) && $patient->medicalinfo->breast_feeding == true)
                  <i style="color:green;font-size:20px" class="fa fa-check"></i>
                @endif
              </td>
            </tr>
          </table>

      {{-- Else --}}
        @else

          <table class="table table-stripped table-bordered">
            <tr>
              <th >هل تعاني من ضغط الدم ؟</th>
              <td class="text-center"></td>
            </tr>
            <tr>
              <th >هل تعاني من السكر ؟</th>
              <td class="text-center">
                
              </td>
            </tr>
            <tr>
              <th >ما هي نتيجه اخر تحليل ؟</th>
              <td class="text-center">
                
              </td>
            </tr>
            <tr>
              <th >هل تعاني من اي امراض في القلب ؟</th>
              <td class="text-center">
                
              </td>
            </tr>
            <tr>
              <th >هل تعاني من حساسيه لنوعيه علاج محدده ؟</th>
              <td class="text-center">
                
              </td>
            </tr>
            <tr>
              <th >ما هي</th>
              <td class="text-center">
                
              </td>
            </tr>
            <tr>
              <th >هل تعاني من اي امراض اخري ؟</th>
              <td class="text-center">
                
              </td>
            </tr>
            <tr>
              <th >ما هي</th>
              <td class="text-center">
                
              </td>
            </tr>
            <tr>
              <th >هل يوجد حمل ؟</th>
              <td class="text-center">
                
              </td>
            </tr>
            <tr>
              <th >في اي شهر ؟</th>
              <td class="text-center">
                
              </td>
            </tr>
            <tr>
              <th >هل يوجد رضاعه ؟</th>
              <td class="text-center">
                
              </td>
            </tr>
          </table>
        @endif
          
      </div><!-- end card-body --> 

    </div>      <!-- /end card -->

</div>

@endsection


{{-- Scripts --}}
@section('js_files')

<script type="text/javascript">
  $("#editBtn").on('click', function(e){
      // var patientId = $(this).data('key');
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{route('medicalinfo.get',$patient->id)}}",
          type: "get",
          // data: {key:patientId},
          success:function(resp){
            if(resp != 'false'){
              // console.log(resp);
              if(resp.diabetes == 1){$(diabetes_details).removeClass('d-none')}
              if(resp.sensitivity == 1){$(sensitivity_details).removeClass('d-none')}
              if(resp.other == 1){$(other_details).removeClass('d-none')}
              if(resp.pregnant == 1){$(pregnant_details).removeClass('d-none')}
              $("#blood_pressure").val(resp.blood_pressure);
              $("#diabetes").val(resp.diabetes);
              $("#diabetes_details").val(resp.diabetes_details);
              $("#heart").val(resp.heart);
              $("#sensitivity").val(resp.sensitivity);
              $("#sensitivity_details").val(resp.sensitivity_details);
              $("#other").val(resp.other);
              $("#other_details").val(resp.other_details);
              $("#pregnant").val(resp.pregnant);
              $("#pregnant_details").val(resp.pregnant_details);
              $("#breast_feeding").val(resp.breast_feeding);
            }
            else{
              // console.log(resp);
              // console.log('akjds27sy8qhlald8napet14a');
            }
          }
      });
  });
</script>

<script>
  $('#diabetes').on('change', function(e) {
    if($(this).val() == true){
      if(! $('#diabetes_details').hasClass('d-none')){
        return;
      }
      $('#diabetes_details').removeClass('d-none');
    }else{
      $('#diabetes_details').addClass('d-none');
      $('#diabetes_details').val('');
    }
  });

  $('#sensitivity').on('change', function(e) {
    if($(this).val() == true){
      if(! $('#sensitivity_details').hasClass('d-none')){
        return;
      }
      $('#sensitivity_details').removeClass('d-none');
    }else{
      $('#sensitivity_details').addClass('d-none');
      $('#sensitivity_details').val('');
    }
  });

  $('#other').on('change', function(e) {
    if($(this).val() == true){
      if(! $('#other_details').hasClass('d-none')){
        return;
      }
      $('#other_details').removeClass('d-none');
    }else{
      $('#other_details').addClass('d-none');
      $('#other_details').val('');
    }
  });

  $('#pregnant').on('change', function(e) {
    if($(this).val() == true){
      if(! $('#pregnant_details').hasClass('d-none')){
        return;
      }
      $('#pregnant_details').removeClass('d-none');
    }else{
      $('#pregnant_details').addClass('d-none');
      $('#pregnant_details').val('');
    }
  });
</script>
<script type="text/javascript" src="{{ @url('admin/js/sweetalert.min.js') }}"></script>
@endsection