@extends('layouts/master')

@section('css_files')
  <link rel="stylesheet" href="/css/select2.min.css">
  <link rel="stylesheet" href="/admin/css/sweetalert.css">

  <style>
    section{
      padding: 60px 0;
    }

    /* #accordion-style-1 h1,
    #accordion-style-1 a{
        color:#007b5e;
    } */
    #accordion-style-1 .btn-link {
        font-weight: 500;
        font-family: 'Cairo';
        color: #3ba09be0;
        background-color: transparent;
        text-decoration: none !important;
        font-size: 17px;
        font-weight: bold;
      padding-left: 25px;
    }

    #accordion-style-1 .card-body {
        border-top: 2px solid #007b5e;
    }

    #accordion-style-1 .card-header .btn.collapsed .fa.main{
      display:none;
    }

    #accordion-style-1 .card-header .btn .fa.main{
      background: #007b5e;
        padding: 13px 11px;
        color: #ffffff;
        width: 35px;
        height: 41px;
        position: absolute;
        left: -1px;
        top: 10px;
        border-top-right-radius: 7px;
        border-bottom-right-radius: 7px;
      display:block;
    }

  </style>

@endsection

@section('modals')
  @include('patients.includes.modals')
@endsection 

{{-- End Modals --}}



@section('content')
<div class="page-content">

    @if (! Auth()->user()->is_admin)
    <div class="bg-info justify-content-around p-2 text-center">
      <a id="newBtn" href="/">
        <i class="fa fa-home" style="border-radius: 50%; max-width:100px;font-size:65px"></i>
        <h2>الصفحه الرئيسية</h2>
      </a>
    </div>
    @endif
    {{-- Patient Info --}}
  <div class="card">
    <div class="card-header">
        <h4>البيانات الشخصيه</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 col-sm-12">
            @if (!empty($patient->image))
            
                <img data-toggle="modal" data-target="#image-modal" src="{{asset('storage/'.$patient->image)}}" style="max-height:210px" alt="">
            
            @else
            <img  src="/img/doctor.png" style="max-height:240px;border-radius:50%" alt="">
            @endif

        </div>

        <div class="col-md-6 col-sm-12">
            <h5 class="my-2"><strong class="show-span">{{__('اي دي')}} :</strong> {{$patient->id}} </h5>
            <h5 class="my-2"><strong class="show-span">{{__('اسم المريض')}} :</strong> {{$patient->name}}</h5>
            <h5 class="my-2"><strong class="show-span">{{__('رقم المحمول')}} :</strong> {{$patient->number}}</h5>
            <h5 class="my-2"><strong class="show-span">{{__('السن')}} :</strong> {{$patient->age}}</h5>
            <h5 class="my-2"><strong class="show-span">{{__('المدينه')}} :</strong> {{$patient->city}}</h5>
            <h5 class="my-2"><strong class="show-span">{{__('المطلوب اجمالا')}} :</strong>{{$patient->programs->SUM('cost')}}</h5>
            <h5 class="my-2"><strong class="show-span">{{__('المدفوع اجمالا')}} :</strong>{{$patient->payments->SUM('paid')}}</h5>
            <h5 class="my-2"><strong class="show-span">{{__('المتبقي عليه')}} :</strong>{{$patient->programs->SUM('cost') - $patient->payments->SUM('paid')}}</h5>
            <h5 class="my-2"><strong class="show-span">{{__('تاريخ الاضافة')}} :</strong> {{$patient->created_at}}</h5>
        </div>

      </div>

      <div class="row justify-content-center text-center my-3">
        @if ($is_admin)
          <div class="patientBtnContainer">
            <div class="my-3">
              <a id="medicalInfoBtn" class="btn patient-btn text-white">
                  {{__('المعلومات الطبيه')}} <i class="mr-1 fa fa-pen"></i>
              </a>
            </div>
            <div class="my-3">
              <a href="{{route('medicalinfo.edit', $patient->id)}}" class="btn patient-btn text-white">
                  {{__('تعديل ')}} <i class="mr-1 fa fa-pen"></i>
              </a>
            </div>
          </div>
        @endif
        
        @if ($is_admin)
          <div class="patientBtnContainer">
            <div class=" my-3">
              <a id="teethBtn" class="btn patient-btn text-white">
                  <i class="fa fa-alert"></i>{{__('الاسنان')}}
              </a>
            </div>
            <div class="my-3">
              <a href="{{route('teeth.create', $patient->id)}}" class="btn patient-btn text-white">
                  <i class="fa fa-alert"></i>{{__('تعديل')}}
              </a>
            </div>
          </div>
        @endif

        @if ($is_admin)
          <div class="patientBtnContainer">
            <div class=" my-3">
              <a id="filesBtn" class="btn patient-btn text-white">
                  <i class="fa fa-alert"></i>{{__('الاشاعات')}}
              </a>
            </div>
            <div class=" my-3">
              <a href="{{route('files.create', $patient->id)}}" class="btn patient-btn text-white">
                  <i class="fa fa-alert"></i>{{__('اضافة')}}
              </a>
            </div>
          </div>
        @endif

          
          {{-- <div class="patientBtnContainer">
            <div class=" my-3">
              <a id="prescriptionsBtn" class="btn patient-btn ">
                  <i class="fa fa-alert"></i>{{__('الروشتات')}}
              </a>
            </div>
            <div class=" my-3">
              <a href="{{route('prescription.create', $patient->id)}}" class="btn patient-btn ">
                  <i class="fa fa-alert"></i>{{__('اضافة')}}
              </a>
            </div>
          </div> --}}


          <div class="patientBtnContainer">
            <div class=" my-3">
              <a id="appointmentsBtn" class="btn patient-btn text-white">
                  <i class="fa fa-alert"></i>{{__('الحجوزات')}}
              </a>
            </div>
            <div class=" my-3">
              <a data-toggle="modal" data-target="#addApp" data-key="{{$patient->id}}" class="btn patient-btn text-white" onclick="zindex()">اضافه</a>
            </div>
          </div>


        @if ($is_admin)
          <div class="patientBtnContainer">
            <div class=" my-3">
              <a id="notesBtn" class="btn patient-btn text-white">
                <i class="fa fa-alert"></i>{{__('الملاحظات')}}
              </a>  
            </div>
            <div class=" my-3">
              <a data-toggle="modal" data-target="#addNote" data-key="{{$patient->id}}" class="btn patient-btn text-white">
                <i class="fa fa-alert"></i>{{__('اضافة')}}
              </a>  
            </div>
          </div>
        @endif

          
          
          <div class="patientBtnContainer">
            <div class=" my-3">
              <a id="paymentsBtn" class="btn patient-btn text-white">
                <i class="fa fa-alert"></i>{{__('المدفوعات')}}
              </a>  
            </div>
            <div class=" my-3">
              <a data-toggle="modal" data-target="#addPayment" data-key="{{$patient->id}}" class="btn patient-btn text-white">
                <i class="fa fa-alert"></i>{{__('اضافة')}}
              </a>  
            </div>
          </div>


          @if ($is_admin)
          <div class="patientBtnContainer">
            <div class=" my-3">
              <a id="prescriptionsBtn" class="btn patient-btn text-white">
                <i class="fa fa-alert"></i>{{__('الروشتات')}}
              </a>  
            </div>
            <div class=" my-3">
              <a href="{{route('prescriptions.create', $patient->id)}}" class="btn patient-btn ">
                <i class="fa fa-alert"></i>{{__('اضافة')}}
              </a>  
            </div>
          </div>
          @endif

      </div>

    </div>        
  </div> {{-- end card --}}
    





    {{-- TEETH --}}
    <div id="teethDiv" class="patientInfoDiv d-none">
    @include('patients.includes.teeth')
    </div>



    {{-- Medical_INFO --}}
    <div id="medicalInfoDiv" class="patientInfoDiv d-none">
      @include('patients.includes.medical_info')
    </div>



    {{-- FILES --}}
    <div id="filesDiv" class="patientInfoDiv d-none">
    @include('patients.includes.files')
    </div>



    {{-- Notes --}}
    <div id="notesDiv" class="patientInfoDiv d-none">
    @include('patients.includes.notes')
    </div>



    {{-- Appointments --}}
    <div id="appointmentsDiv" class="patientInfoDiv d-none">
    @include('patients.includes.appointments')
    </div>

    {{-- Payments --}}
    <div id="paymentsDiv" class="patientInfoDiv d-none">
      @include('patients.includes.payments')
    </div>


    {{-- Payments --}}
    <div id="prescriptionsDiv" class="patientInfoDiv d-none">
      @include('patients.includes.prescriptions')
    </div>


    @if ($is_admin)
      <div class="card" style="height: auto">

        <div class="card-header">
          <h3>البرامج الخاصه به</h3>
        </div>
        <div class="card-header">
          <a data-toggle="modal" data-target="#addProgram" data-key="{{$patient->id}}" class="btn btn-success mt-1 mb-3 text-white">
            {{__('اضافة برنامج جديد')}}
          </a>
        </div>
    
        @if (count($patient->programs)==0)
    
            <div class="card-body">
              <h3>لا يوجد برامج سابقه.</h3>
              {{-- <a href="route" class="btn btn-click btn-primary">اضافة برنامج جديد</a> --}}
            </div>
    
        @else
    
          @include('patients.includes.programs')
          
        @endif
        
      </div>
    @endif
  </div> {{-- end page content--}}

    
@endsection

{{-- Scripts --}}
@section('js_files')

<script src="/admin/js/sweetalert.min.js"></script>

{{-- Modal and edit for medical info  --}}
{{-- <script type="text/javascript">
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
</script> --}}


{{-- Buttons Click --}}
<script>
  $('.patient-btn').on('click',function(){
    var id = this.id;
    hideDivs();
    switch (id) {
      case "medicalInfoBtn":
        $('#medicalInfoDiv').removeClass('d-none');
        break;

      case "teethBtn":
        $('#teethDiv').removeClass('d-none');
        break;

      case "filesBtn":
        $('#filesDiv').removeClass('d-none');
        break;

      case "prescriptionsBtn":
        $('#prescriptionsDiv').removeClass('d-none');
        break;

      case "appointmentsBtn":
        $('#appointmentsDiv').removeClass('d-none');
        break;

      case "paymentsBtn":
        $('#paymentsDiv').removeClass('d-none');
        break;

      case "notesBtn":
        $('#notesDiv').removeClass('d-none');
        break;
    }
  })

  function hideDivs(){
    $('.patientInfoDiv').each(function(){
      if(! $(this).hasClass('d-none')){
        $(this).addClass('d-none');
      };
    });
  }
</script>

{{-- Show Colored Teeth and clicked teeth script--}}
<script src="/js/showTeeth.js"></script>
{{-- the function itself --}}
<script>
    var teeth = {!! $teeth !!};
    // console.log(teeth);
  showTeeth();
</script>

{{-- img thumbs click --}}
<script>
</script>

{{-- Delete Appointments ajax with swal --}}
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
      var refresh = "{{route('patients.show',"$patient->id")}}"
      window.location.href = refresh;

      }, 2000);
    });
  }
</script>
 
{{-- Delete Prescription --}}
   {{-- // myurl = myurl.replace(':id', myId); --}}
<script>
  function deletePresc(myId)
  {
      myurl = '{{route("prescriptions.delpresc",":id")}}';
      url = myurl.replace(':id',myId)
      // console.log(url);
   
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
          url: url,
          // data: {id:myId},
          cache:false
      });
      swal("تم المسح !", "", "success");
      window.setTimeout(function(){

    // Move to a new location or you can do something else
      var refresh = "{{route('patients.show',"$patient->id")}}"
      window.location.href = refresh;

      }, 500);
    });
  }
</script>

{{-- Search by date --}}
{{-- <script>
  $('#searchDateBtn').on('click',function(){
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();
    // console.log(startDate + ' : ' + endDate)
    var patientId = $('#patientId').attr('data-id');
    // return console.log(patientId);
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:'POST',
      url: "{{route('appointments.search')}}",
      data: {startDate:startDate,endDate:endDate,id:patientId},
      // cache:false
      success:function(resp){
        // console.log(resp);
        if(! resp){return}
        $('#tbs').children().remove();
        var tableBody = $('#tbs');
        // var i = 0;
        
        resp.forEach(app => {
          // console.log(app);
          // console.log(app.problem);
          // console.log(app.wanted);
          // console.log(' ');
          if(!app.problem){app.problem = '';}
          if(!app.work){app.work = '';}
          var tr  =  "<tr>";
          tr +=  "<td>"+app.day+"</td>";
          tr +=  "<td>"+app.hour+"</td>";
          tr +=  "<td>"+app.problem+"</td>";
          tr +=  "<td>"+app.work+"</td>";
          tr +=  "<td>"+app.wanted+"</td>";
          tr +=  "<td>"+app.paid+"</td>";
            // tr +=  "<td>"+app.remained+"</td>";
            // tr +=  "<td>"+app.allWanted+"</td>";
            // tr +=  "<td>"+app.allPaid+"</td>";
            // tr +=  "<td>"+app.allRemained+"</td>";
            // tr +=  "<td><a class='btn btn-xs btn-danger text-white ml-2'><i class='fa fa-trash' onclick=deleteApp("+app.id+")></i></a></td>";
            tr +=  "</tr>";
            tableBody.append(tr);
        })
      }
    });
  });
</script> --}}

<script>
  function editProgramModal(el){
      // console.log(el);
      $('#program_id').val(el);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{route('getProgram')}}",
        type : "post",
        data : {id:el},
        success: function(result){
          $('#program-modal-title').val(result.title);
          $('#program-modal-problem').val(result.problem);
          $('#program-modal-cost').val(result.cost);
        }
      })
      // console.log($('#program_id'));
  }
</script>

<script>

  function allToDefault(clickedEl){
    $('.thumb-container').each(function(){
      $(this).css('opacity','.4');
    })
    $(clickedEl).css('opacity','1')
    
    var activeImg = clickedEl.firstChild;
    activeImg = activeImg.src;
    var image = "<img src='"+activeImg+"'>";
    $('.img-container').html(image);

    // $('.d-none').removeClass('d-none');
    $('.imginfo').removeClass('d-none');
    
    var type = $(clickedEl).attr('data-type');
    var date = $(clickedEl).attr('data-date');
    var details = $(clickedEl).attr('data-details');
    // console.log(details);
    date = date.split(" ");
    $('#fileType').text(type);
    $('#fileDate').text(date[0]);
    $('#fileHour').text(date[1]);
    $('#fileDetails').text(details);

  }

  $('.thumb-container').on('click', function(){
    allToDefault(this);
  });

</script>

<script>

  </script>

  <script>
    function zindex()
    {
      $("#ui-datepicker-div").css("z-index", "9999");
    }
  </script>
@endsection