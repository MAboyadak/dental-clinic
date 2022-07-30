  <div class="card-body">
    <h4 class="bg-info text-white p-2" style="width: 220px">الحالات المتبقيه اليوم : <span id="appsCount">{{$appsCount}}</span></h4>
    <br>
    <div class="table-responsive">
      <table id="dataTable" class="table p-3 table-hover table-bordered tablesorter h-100">
          <thead style="background:#5974d5;color:white;text-align:center">
              <th>{{__('الاسم')}}</th>
              <th>{{__('السن')}}</th>
              <th>{{__('المدينه')}}</th>
              <th>{{__('رقم الموبايل')}}</th>
              <th>{{__('الساعه')}}</th>
              <th>{{__('المطلوب')}}</th>
              <th>{{__('المدفوع')}}</th>
              {{-- <th>{{__('المطلوب')}}</th>
              <th>{{__('المدفوع')}}</th> --}}
              <th>{{__('عمليات')}}</th>
          </thead>
          <tbody id="tbs" class="text-center">                    
            @foreach ($appointments as $app)
              <tr >
                <td>{{$app->patient->name}}</td>
                <td>{{$app->patient->age}}</td>
                <td>{{$app->patient->city}}</td>
                <td>{{$app->patient->number}}</td>
                <td>{{$app->hour}}</td>
              @if (isset($app->session))
                @if (isset($app->session->payment))
                  <td>{{$app->session->payment->wanted}}</td>
                  <td>{{$app->session->payment->paid}}</td>
                @else
                  <td>0</td>  
                  <td>0</td>
                @endif
              @else
                <td>لم يتم الكشف بعد</td>
                <td>لم يتم الكشف بعد</td>
              @endif
                
                <td>
                  {{-- <a class="btn btn-xs btn-danger text-white ml-2"><i class="fa fa-trash" onclick="deleteApp('+el.appId+')" ></i></a> --}}
                  @if ($app->done == 0)
                  <a href="{{route('patients.show',$app->patient->id)}}" class="btn btn-primary text-white" style="width:30%" title="الدخول لبيانات المريض"><i class="fa fa-angle-double-left"></i></a>
                  @else
                  {{-- {{dd($app)}} --}}
                  <a href="{{route('sessions.show',$app->session->id)}}" class="btn btn-dark text-white" title="عرض التفاصيل"><i style="font-size: 16px" class="fa fa-check"></i></a>
                  @endif
                </td>
              </tr>
            @endforeach
            {{$appointments->links()}}
          </tbody>

      </table>
      {{$appointments->links()}}

  </div>
  </div>