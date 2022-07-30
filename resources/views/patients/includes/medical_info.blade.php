<div class="card">
    <div class="card-header">
        {{-- <a id="editBtn" data-toggle="modal" data-target="#editForm" data-key="{{$patient->id}}" class="btn btn-success text-white">تعديل المعلومات الطبيه</a> --}}
        <a href="{{route('medicalinfo.edit',$patient->id)}}" class="btn btn-success text-white">تعديل المعلومات الطبيه</a>
    </div>
    <div class="card-header">
        <h4>المعلومات الطبيه</h4>
    </div>
    <div class="card-body">
        @if ( $patient->medicalinfo()->exists() )
          <table class="table table-stripped table-bordered">
            <tr>
              <th >هل تعاني من ضغط الدم ؟</th>
              <td class="text-center">
                @if (isset($medicalinfo->blood_pressure) && $medicalinfo->blood_pressure== true)
                  <i style="color:green;font-size:20px" class="fa fa-check"></i>                  
                @endif
              </td>
            </tr>
            <tr>
              <th >هل تعاني من السكر ؟</th>
              <td class="text-center">
                @if (isset($medicalinfo->diabetes) &&  $medicalinfo->diabetes == true)
                <i style="color:green;font-size:20px" class="fa fa-check"></i>
                @endif
              </td>
            </tr>
            <tr>
              <th >ما هي نتيجه اخر تحليل ؟</th>
              <td class="text-center">
                @if (isset($medicalinfo->diabetes_details) && !empty($medicalinfo->diabetes_details))
                  {{$medicalinfo->diabetes_details}}
                @endif
              </td>
            </tr>
            <tr>
              <th >هل تعاني من اي امراض في القلب ؟</th>
              <td class="text-center">
                @if (isset($medicalinfo->heart) && $medicalinfo->heart == true)
                <i style="color:green;font-size:20px" class="fa fa-check"></i>
                @endif
              </td>
            </tr>
            <tr>
              <th >هل تعاني من حساسيه لنوعيه علاج محدده ؟</th>
              <td class="text-center">
                @if (isset($medicalinfo->sensitivity) && $medicalinfo->sensitivity == true)
                <i style="color:green;font-size:20px" class="fa fa-check"></i>
                @endif
              </td>
            </tr>
            <tr>
              <th >ما هي</th>
              <td class="text-center">
                @if (isset($medicalinfo->sensitivity_details) && !empty($medicalinfo->sensitivity_details))
                  {{$medicalinfo->sensitivity_details}}
                @endif
              </td>
            </tr>
            <tr>
              <th >هل تعاني من اي امراض اخري ؟</th>
              <td class="text-center">
                @if (isset($medicalinfo->other) && $medicalinfo->other == true)
                  <i style="color:green;font-size:20px" class="fa fa-check"></i>
                @endif
              </td>
            </tr>
            <tr>
              <th >ما هي</th>
              <td class="text-center">
                @if (isset($medicalinfo->other_details) && !empty($medicalinfo->other_details))
                  {{$medicalinfo->other_details}}
                @endif
              </td>
            </tr>
            <tr>
              <th >هل يوجد حمل ؟</th>
              <td class="text-center">
                @if (isset($medicalinfo->pregnant) && $medicalinfo->pregnant == true)
                <i style="color:green;font-size:20px" class="fa fa-check"></i>
                @endif
              </td>
            </tr>
            <tr>
              <th >في اي شهر ؟</th>
              <td class="text-center">
                @if (isset($medicalinfo->pregnant_details) && !empty($medicalinfo->pregnant_details))
                  {{$medicalinfo->pregnant_details}}
                @endif
              </td>
            </tr>
            <tr>
              <th >هل يوجد رضاعه ؟</th>
              <td class="text-center">
                @if (isset($medicalinfo->breast_feeding) && $medicalinfo->breast_feeding == true)
                  <i style="color:green;font-size:20px" class="fa fa-check"></i>
                @endif
              </td>
            </tr>
          </table>        
        @endif
    </div>
</div>