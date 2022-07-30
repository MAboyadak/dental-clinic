@extends('layouts/master')

@section('content')

<script>
  var storeUrl = "{{ route('medicalinfo.store',$patient->id) }}";
</script>
<div class="page-content">
  <div class="card card-info">
    <div class="card-header page-title">
        <h3 class="card-title">{{$patient->name}} {{$patient->age}} {{$patient->city}}</h3>
    </div>
  </div>
  <form action="{{ route('medicalinfo.store',$patient->id)}}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            <h4>Medical Info</h4>
        </div>
        <div class="card-body" style="text-align: start">

            <div class="row">
                <div class="section-field col-md-12">
                    <div class="form-group">
                      <label >{{__('هل تعاني من ضغط الدم ؟')}}</label>
                      <select id="blood_pressure" class="form-control" name="blood_pressure" >
                        <option value=1>نعم</option>
                        <option value=0 @if(! $medInfo['blood_pressure']) selected @endif>لا</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="section-field col-md-12">
                    <div class="form-group">
                      <label >{{__('هل تعاني من السكر ؟')}}</label>
                      <select id="diabetes" class="form-control" name="diabetes" >
                        <option value=1 >نعم</option>
                        <option value=0 @if(! $medInfo['diabetes']) selected @endif>لا</option>
                      </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
              <div class="section-field col-md-12">
                  <div class="form-group">
                      <input class="form-control d-none" id="diabetes_details" placeholder=" نتيجه اخر تحليل .. " type="text" name="diabetes_details" value="{{$medInfo['diabetes_details']}}">
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="section-field col-md-12">
                  <div class="form-group">
                    <label >{{__('هل تعاني من اي امراض في القلب ؟	')}}</label>
                    <select id="heart" class="form-control" name="heart">
                      <option value=1 >نعم</option>
                      <option value=0 @if(! $medInfo['heart']) selected @endif>لا</option>
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
                      <option value=0 @if(! $medInfo['sensitivity']) selected @endif>لا</option>
                    </select>
                  </div>
              </div>
            </div>

            <div class="row ">
              <div class="section-field col-md-12">
                  <div class="form-group">
                      <input class="form-control d-none" id="sensitivity_details" placeholder=" ما هي .." type="text" name="sensitivity_details" value="{{$medInfo['sensitivity_details']}}">
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="section-field col-md-12">
                  <div class="form-group">
                    <label >{{__('هل تعاني من اي امراض اخري ؟	')}}</label>
                    <select id="other" class="form-control" name="other">
                      <option value=1 >نعم</option>
                      <option value=0 @if(! $medInfo['other']) selected @endif>لا</option>>لا</option>
                    </select>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="section-field col-md-12">
                  <div class="form-group">
                      <input id="other_details" class="form-control d-none" placeholder=" ما هي .." type="text" name="other_details" value="{{$medInfo['other_details']}}">
                  </div>
              </div>
            </div>
            {{-- @if ($patient->gender != 'male') --}}
              <div class="row">
                <div class="section-field col-md-12">
                    <div class="form-group">
                      <label >{{__('هل يوجد حمل ؟')}}</label>
                      <select id="pregnant" class="form-control" name="pregnant" >
                        <option value=1 >نعم</option>
                        <option value=0 @if(! $medInfo['pregnant']) selected @endif>لا</option>
                      </select>
                    </div>
                </div>
              </div>

              <div class="row" >
                <div class="section-field col-md-12">
                    <div class="form-group">
                        <input class="form-control d-none" id="pregnant_details" placeholder="في اي شهر ؟" type="text" name="pregnant_details" value="{{$medInfo['pregnant_details']}}">
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="section-field col-md-12">
                    <div class="form-group">
                      <label >{{__('هل يوجد رضاعه ؟	')}}</label>
                      <select id="breast_feeding" class="form-control" name="breast_feeding">
                        <option value=1 >نعم</option>
                        <option value=0 @if(! $medInfo['breast_feeding']) selected @endif>لا</option>
                      </select>
                    </div>
                </div>
              </div>
            {{-- @endif --}}

        </div><!-- end card-body --> 

        <div class="card-footer text-center">
            <button type="submit" style="width:20%" class="btn btn-primary text-white">Save</button>
        </div>
        <!-- /.card-footer -->      

    </div>      <!-- /end card -->

  </form>
</div>

@endsection

@section('js_files')
<script>

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
@endsection