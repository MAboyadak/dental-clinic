@extends('layouts.master')
@section('css_files')
  <link rel="stylesheet" href="/css/select2.min.css">
  <link rel="stylesheet" href="/admin/css/sweetalert.css">
@endsection


@section('content')
    <!-- Main content -->
    <div class="page-content mt-2">

      <div class="card w-100" style="height:78vh" id="body">
        <div class="card-header">
          <h4>المواعيد اليوم</h4>
        </div>
        <div id="all">
          @include('admin.partials.appointments')
        </div>
      </div>
      {{-- <div class="card w-100 h-100">
        <div class="card-header">
          <h4>المواعيد غدا</h4>
        </div>
        <div>
          @include('admin.partials.appointments')
        </div>
      </div> --}}

    </div>
@endsection

@section('js_files')

<script>
  function refreshTable(){
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{route('admin.gettodayapps')}}",
      type: "get",
      success:function(resp){
        console.log(resp);
        // return
        $('#tbs').children().remove();
        if(resp.length < 2)return;
        $('#appsCount').html(resp[resp.length - 1]);
        var tr;
        // var myRoute;
        resp.forEach(el => {
          if(typeof(el) == 'number')return;
          console.log(el);
          var patientShowUrl = '{{route("patients.show",":id")}}';
          patientShowUrl = patientShowUrl.replace(':id',el.patient.id);
          

          // console.log(el);
          if(!el.patient.name) {el.patient.name = "";}
          if(!el.patient.age) {el.patient.age = "";}
          if(!el.patient.city) {el.patient.city = "";}
          if(!el.patient.number) {el.patient.number = "";}
          
          // if(!el.paid) {el.paid = "";}
          // console.log(el.patient.id);
          tr = '<tr class="trow" >';
          tr += '<td>'+el.patient.name+'</td>';
          tr += '<td>'+el.patient.age+'</td>';
          tr += '<td>'+el.patient.city+'</td>';
          tr += '<td>'+el.patient.number+'</td>';
          tr += '<td>'+el.hour+'</td>';
        if(!el.session)
        {
          tr += '<td>لم يتم الكشف بعد</td> <td>لم يتم الكشف بعد</td>';
        }
        else if(!el.session.payment){
          tr += '<td>0</td> <td>0</td>';
        }
        else{
          tr += '<td>'+el.session.cost+'</td>';
          tr += '<td>'+el.session.payment.paid+'</td>';
        }
          tr +=  '<td>';
          if (el.done == 0) {
            tr += '<a href="'+patientShowUrl+'" class="btn btn-primary text-white" title="الدخول لبيانات المريض"><i class="fa fa-angle-double-left"></i></a>';
          } else {
            var sessionUrl = '{{route("sessions.show",":id")}}';
            sessionUrl = sessionUrl.replace(':id',el.session.id);
            tr += '<a href="'+sessionUrl+'" class="btn btn-dark text-white" title="عرض التفاصيل"><i class="fa fa-check" style="font-size: 16px"></i></a>';
          }
          tr += '</td>';
          tr += '</tr>';
            $('#tbs').append(tr);
        });
      }

    });
  }
  setInterval(refreshTable,5000);

  // function doneDoc(id){
  //   // console.log(id);
  //   url = '{{route("admin.donedocapp",":id")}}';
  //   url = url.replace(':id',id);
  //   $.ajax({
  //     headers: {
  //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     },
  //     url: url,
  //     // data
  //     type: "post",
  //     success:function(resp){
  //     //  console.log(resp);
  //     }
  //   });
  // }
</script>

@endsection