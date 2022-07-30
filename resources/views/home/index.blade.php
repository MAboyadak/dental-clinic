@extends('layouts.master')
@section('css_files')
  <link rel="stylesheet" href="{{'css/select2.min.css'}}">
  <link rel="stylesheet" href="{{'admin/css/sweetalert.css'}}">
@endsection

@section('modals')
    {{-- Add Payment Modal --}}
  <div class="modal fade" id="addPayment"  {{--tabindex="-1"--}} role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <div class="section-title mb-10">
                        <h5>{{__('دفع جديد')}}</h5>
                    </div>
                </div>
                <div>
                  <button type="button" class="close" style="display:inline-block;float:left;text-align: left" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
            </div>
            <form action="{{ route('payment.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="input-group">
                      <label class="input-label" style="line-height:1">{{__('اسم المريض')}}</label>
                      <div class="col-sm-10">
                          <select id="selectedPatient" name="selectedPatient">
                              @foreach ($patients as $patient)
                                <option value="{{$patient->id}}">{{$patient->name}} {{$patient->age}} {{$patient->city}}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="input-group ">
                      {{-- <div class="col-5 input-group">
                          <label >{{__("المبلغ المطلوب")}} : </label>
                          <input class="form-control" type="number" name="wanted">
                      </div>
                      <span class="offset-2"></span> --}}

                      <div class="col-6 input-group">
                          <label >{{__("المبلغ المدفوع")}} : </label>
                          <input class="form-control" type="number" name="paid">
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


@endsection

@section('content')
  <div id="loading">
    <img id="loading-image" src="{{asset("img/ajax-loader.gif")}}" alt="Loading..." />
  </div>
    <!-- Main content -->
    <div class="page-content">

      <div class="row bg-info justify-content-around p-2 text-center">
          <a id="newBtn" href="#">
            <i class="fa fa-plus-circle" style="border-radius: 50%; max-width:100px;font-size:65px"></i>
            <h2>مريض جديد+</h2>
          </a>
          {{-- <a id="patientsBtn" href="#">
            <i class="fa fa-users" style="border-radius: 50%; max-width:100px;font-size:65px"></i>
            <h2>المرضي</h2>
          </a> --}}
          <a id="patientsBtn" href="#">
            <i class="fa fa-users" style="border-radius: 50%; max-width:100px;font-size:65px"></i>
            <h2>قائمة المرضي</h2>
          </a>
          <a id="allBtn" href="#">
            <i class="fa fa-home" style="border-radius: 50%; max-width:100px;font-size:65px"></i>
            <h2>اللوحه الرئيسية</h2>
          </a>
          <a id="revisitBtn" href="#">
            <i class="fa fa-retweet" style="border-radius: 50%; max-width:100px;font-size:65px"></i>
            <h2>اعادة+</h2>
          </a>
          <a href="#" data-toggle="modal" data-target="#addPayment" data-key="" >
            <i class="fa fa-dollar-sign " style="border-radius: 50%; max-width:100px;font-size:65px"></i>
            <h2>دفع نقود</h2>
          </a>
      </div>
      <div class="row">
        <div class="card w-100" id="body">
          <h4 class="bg-info text-white p-2 mt-2 mr-2" style="width: 220px">الحالات المتبقيه اليوم : <span id="appsCount">{{$appsCount}}</span></h4>
          <br>
          <div id="patients" class="d-none">
            @include('home.partials.patients')
          </div>
          <div id="new" class="d-none">
            @include('home.partials.new')
          </div>
          <div id="revisit" class="d-none">
            @include('home.partials.revisit')
          </div>
          <div id="apps" class="d-none">
            @include('home.partials.appointments')
          </div>
        </div>
      </div>

    </div>
@endsection

@section('js_files')

<script src="/admin/js/sweetalert.min.js"></script>

{{-- Nav Buttons Click Listener --}}
<script type="text/javascript">
  function allToDefault(){
    $('#patients').addClass('d-none');
    $('#new').addClass('d-none');
    $('#revisit').addClass('d-none');
    $('#apps').addClass('d-none');
  }

    $("#patientsBtn").on('click',function(){
      allToDefault();
      $('#patients').removeClass('d-none');
    });

    $("#newBtn").on('click',function(){
      allToDefault();
      $('#new').removeClass('d-none');
    });

    $("#revisitBtn").on('click',function(){
      allToDefault();
      $('#revisit').removeClass('d-none');
    });
</script>

{{-- Data table for patients table --}}
<script type="text/javascript">
  $("#patientsTbl").dataTable();
</script>

{{-- include select.js to make search  --}}
<script src="{{'js/select2.min.js'}}"></script>
<script>
  $(function () {
    $("select").select2();
  });
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

{{-- All Apps , Delete Apps SWAL , Done Apps SWAL --}}
<script>
    
  allToDefault();
  $('#apps').removeClass('d-none');
  refreshTable()
  $("#allBtn").on('click',function(){
    allToDefault();
    $('#apps').removeClass('d-none');
    refreshTable()
  });

  function refreshTable(){
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{route('home.gettodayapps')}}",
      type: "get",
      success:function(resp){
        // console.log(resp);
        // return
        
        $('#tbs').children().remove();
        if(resp.length < 2)return;
        $('#appsCount').html(resp[resp.length -1 ]);

        var tr;
        // var myRoute;
        
        resp.forEach((el,index,arr) => {
          // console.log(el);
          // console.log(index);
          // console.log(arr);
          // console.log('endIteration');
          // return;

          // if(arr.length - 1 == index){return;}
          if(typeof(el) == 'number')return;

          if(!el.patient.name) {el.patient.name = "";}
          if(!el.patient.age) {el.patient.age = "";}
          if(!el.patient.city) {el.patient.city = "";}
          if(!el.patient.number) {el.patient.number = "";}
          // if(!el.paid) {el.paid = "";}

          tr = '<tr class="trow" >';
          tr += '<td>'+el.patient.name+'</td>';
          tr += '<td>'+el.patient.age+'</td>';
          tr += '<td>'+el.patient.city+'</td>';
          tr += '<td>'+el.patient.number+'</td>';
          tr += '<td>'+el.hour+'</td>';
          // tr += '<td>'+el.allWanted+'</td>';
          // tr += '<td>'+el.allPaid+'</td>';
          // tr += '<td>'+el.allRemained+'</td>';
        if(!el.session)
        {
          tr += '<td style="background:#333;color:white">لم يتم الكشف بعد</td>';
          tr += '<td style="background:#333;color:white">';
          tr += '<input disabled type="number" class="form-control" placeholder="المبلغ المدفوع ..." style="border:none;border-bottom:1px solid #ccc;outline:none;background:#ccc;" id="'+el.id+'" name="paid">';
          tr += '</td>';
          tr += '<td style="background:#333;color:white"></td>';
        }else{
          if (el.session.cost && !el.session.payment) {
            tr += '<td style="background:#333;color:white">'+el.session.cost+'</td>';
            tr += '<td style="background:#333;color:white">';
            tr += '<input type="number" class="form-control" placeholder="المبلغ المدفوع ..." style="border:none;border-bottom:1px solid #ccc;outline:none;" id="'+el.id+'" name="paid">';
            tr += '</td>';
            tr += '<td style="background:#333;color:white">'+el.session.cost+'</td>'; 
          } else if(!el.session.cost && !el.session.payment) {
            tr += '<td style="background:#333;color:white">لم يتم التحديد</td>';
            tr += '<td style="background:#333;color:white">';
            tr += '<input type="number" class="form-control" placeholder="المبلغ المدفوع ..." style="border:none;border-bottom:1px solid #ccc;outline:none;" id="'+el.id+'" name="paid">';
            tr += '</td>';
            tr += '<td style="background:#333;color:white">0</td>'; 
          }else{
            tr += '<td style="background:#333;color:white">'+el.session.cost+'</td>';
            tr += '<td style="background:#333;color:white">';
            tr += '<input type="number" class="form-control" value="'+el.session.payment.paid+'" style="border:none;border-bottom:1px solid #ccc;outline:none;" id="'+el.id+'" name="paid">';
            tr += '</td>';
            tr += '<td style="background:#333;color:white">'+(el.session.cost - el.session.payment.paid) +'</td>';
          }
        }
        tr += '<td><a class="btn btn-xs btn-danger text-white ml-2"><i class="fa fa-trash" onclick="deleteApp('+el.id+')" ></i></a>';
        // tr +=  '<a class="btn btn-xs btn-success text-white ml-2" style="width:26px"><i class="fas fa-dollar-sign"></i></a>';
        tr +=  '<a class="btn btn-xs btn-success text-white ml-2"><i class="fa fa-check" onclick="doneApp('+el.id+')"></i></a></td>';
        tr += '</tr>';
        $('#tbs').append(tr);
        })
      }
    });
  }

  setInterval(refreshTable,25000);

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
      // $("#allBtn").click();
    });
  }

  function doneApp(myId)
  {
    var paid = $('#'+myId).val();
    // console.log(paid);
    if(!paid){
      swal("يجب ادخال المدفوع !", "", "error");
      return;
    }
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'POST',
          url: "{{route('home.endapp')}}",
          data: {id:myId,paid:paid},
          cache:false,
          // success:function(result){
          //   console.log(result);
          // }
      });
      swal("Done !", "", "success");
      $("#allBtn").click();
  }
</script>

{{-- Search by date --}}
{{-- <script>
  $('#BetweenTwoDatesAppsBtn').on('click',function(){ // between two dates in appointments
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();
    // console.log(startDate + ' : ' + endDate)

    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:'POST',
      url: "{{route('home.search')}}",
      data: {startDate:startDate,endDate:endDate},
      // cache:false
      success:function(resp){
        // console.log(resp);
        if(! resp){return}
        $('#tbs').children().remove();
        var tableBody = $('#tbs');
        // var i = 0;

        resp.forEach(app => {
            var tr  =  "<tr>";
            tr +=  "<td>"+app.patient['name']+"</td>";
            tr +=  "<td>"+app.patient['age']+"</td>";
            tr +=  "<td>"+app.patient['city']+"</td>";
            tr +=  "<td>"+app.patient['number']+"</td>";
            tr +=  "<td>"+app.day+"</td>";
            tr +=  "<td>"+app.hour+"</td>";
            tr +=  "<td>"+app.wanted+"</td>";
            tr +=  "<td>"+app.paid+"</td>";
            // tr +=  "<td>"+app.remained+"</td>";
            tr +=  "<td><a class='btn btn-xs btn-danger text-white ml-2'><i class='fa fa-trash' onclick=deleteApp("+app.id+")></i></a></td>";
            tr +=  "</tr>";
            tableBody.append(tr);
            
        })
      }
    });
  });
</script> --}}

{{-- scroll down page height --}}
{{-- <script>
  $('.time').focus(function(){
    var height = $(document).height();
    console.log(height);
    $(window).scrollTop(height);
  });
</script> --}}

<script>
  $('#dayAppsBtn').on('click',function(){ // when creating new patient and appointment 
    var dayToSearch = $('#dayToSearch').val();
    // console.log(startDate + ' : ' + endDate)

    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:'POST',
      url: "{{route('home.searchDay')}}",
      data: {dayToSearch:dayToSearch},
      success:function(resp){
        $('#tbs2').children().remove();
        if(resp == 'error') return;
        if(resp == 'empty') {$('#tbs2').append('<tr><td colspan="6">لا يوجد مواعيد في هذا اليوم</td></tr>'); return;}
        var tableBody = $('#tbs2');
        resp.forEach(app => {
            var tr  =  "<tr>";
            tr +=  "<td>"+app.patient['name']+"</td>";
            tr +=  "<td>"+app.patient['age']+"</td>";
            tr +=  "<td>"+app.patient['city']+"</td>";
            tr +=  "<td>"+app.patient['number']+"</td>";
            tr +=  "<td>"+app.hour+"</td>";
            tr +=  "<td><a class='btn btn-xs btn-danger text-white ml-2'><i class='fa fa-trash' onclick=deleteApp("+app.id+")></i></a></td>";
            tr +=  "</tr>";
            tableBody.append(tr);
            
        })
      }
    });
  });
</script>

<script>
  $('#dayAppsBtnRe').on('click',function(){ // when creating new appointment for existing patient 
    var dayToSearch = $('#dayToSearchRe').val();
    // console.log(startDate + ' : ' + endDate)

    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:'POST',
      url: "{{route('home.searchDay')}}",
      data: {dayToSearch:dayToSearch},
      success:function(resp){
        // console.log(resp);
        $('#tbs3').children().remove();
        if(resp == 'error') return;
        if(resp == 'empty') {$('#tbs3').append('<tr><td colspan="6">لا يوجد مواعيد في هذا اليوم</td></tr>'); return;}
        var tableBody = $('#tbs3');
        resp.forEach(app => {
            var tr  =  "<tr>";
            tr +=  "<td>"+app.patient['name']+"</td>";
            tr +=  "<td>"+app.patient['age']+"</td>";
            tr +=  "<td>"+app.patient['city']+"</td>";
            tr +=  "<td>"+app.patient['number']+"</td>";
            tr +=  "<td>"+app.hour+"</td>";
            tr +=  "<td><a class='btn btn-xs btn-danger text-white ml-2'><i class='fa fa-trash' onclick=deleteApp("+app.id+")></i></a></td>";
            tr +=  "</tr>";
            tableBody.append(tr);
            
        })
      }
    });
  });
</script>

<script>

(function( factory ) {
	if ( typeof define === "function" && define.amd ) {

		// AMD. Register as an anonymous module.
		define([ "../jquery.ui.datepicker" ], factory );
	} else {

		// Browser globals
		factory( jQuery.datepicker );
	}
}(function( datepicker ) {
	datepicker.regional['ar'] = {
		prevText: '',
		nextText: '',
		currentText: 'اليوم',
		monthNames: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو',
		'يوليو', 'اغسطس', 'سبتمبر',	'اكتوبر', 'نوفمبر', 'ديسمبر'],
		monthNamesShort: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو',
		'يوليو', 'اغسطس', 'سبتمبر',	'اكتوبر', 'نوفمبر', 'ديسمبر'],
		dayNames: ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
		dayNamesShort: ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
		dayNamesMin: ['حد', 'اتنثن', 'ثلاث', 'اربع', 'خميس', 'جمعه', 'سبت'],
		weekHeader: 'أسبوع',
		dateFormat: 'yy/mm/dd',
		firstDay: 6,
  		isRTL: true,
		showMonthAfterYear: false,
		yearSuffix: ''};
	datepicker.setDefaults(datepicker.regional['ar']);

	return datepicker.regional['ar'];

}));
// initialize datepicker
$( ".datepicker" ).datepicker({
    isRTL:true,
    changeMonth: true,
    changeYear: true
});
</script>

@endsection

