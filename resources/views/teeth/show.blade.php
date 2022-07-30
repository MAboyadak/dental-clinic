@extends('layouts/master')

@section('content')


  <div class="page-content">
    <div class="card card-info">
      <div class="card-header page-title">
        <h3 class="card-title"><a href="{{route('patient.show',$patient->id)}}">{{$patient->name}}</a></h3>
      </div>
    </div>
        
    <div class="card">
      <div class="card-header">
        {{-- <a id="editBtn" data-toggle="modal" data-target="#editForm" data-key="{{$patient->id}}" class="btn btn-success text-white">تعديل الاسنان</a>       --}}
        <a href="{{route('teeth.create',$patient->id)}}" class="btn btn-success text-white">تعديل الاسنان</a>      
      </div>
      <div class="card-header">
        <h4>Teeth details</h4>
      </div>
      <div class="card-body">
        <div class="row p-2 text-center">
          
          <div class="col-md-9 col-12 p-1">
            <table class="table table-stripped table-bordered">
              <tr>
                  <th>Left</th>
                  <th>Top</th>
                  <th>Right</th>
                  <th>Bottom</th>
                  <th>Condition</th>
                  <th>Details</th>
                  <th>Description</th>
              </tr>
              <tr>
                <td id="left"></td>
                <td id="top"></td>
                <td id="right"></td>
                <td id="bottom"></td>
                <td id="condition"></td>
                <td id="detail"></td>
                <td id="description"></td>
                
              </tr>
            </table>
          </div>
          <div class="col-md-3 col-12 p-1" style="background:#89f3d194">
            @include('teeth.inc.teeth')
          </div>
        </div><!-- end row --> 
      </div><!-- end card-body --> 

    </div>      <!-- /end card -->
  </div>
    
@endsection

{{-- Scripts --}}
@section('js_files')

<script>  var teeth = {!! $patient->teeth !!}; </script>
<script src="/js/showTeeth.js"></script>
<script>
  showTeeth();
</script>

{{-- <script>
  $("#editBtn").on('click', function(e){
      // var patientId = $(this).data('key');
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{route('teeth.get',$patient->id)}}",
          type: "get",
          // data: {key:patientId},
          success:function(resp){
            if(resp != 'false'){
              console.log(resp);
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
              console.log(resp);
              console.log('akjds27sy8qhlald8napet14a');
            }
          }
      });
  });
</script> --}}
@endsection