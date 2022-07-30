<div class="card">
    <div class="card-header">
        <a id="addAppBtn" data-toggle="modal" data-target="#addApp" data-key="{{$patient->id}}" class="btn btn-success text-white">حجز جديد</a>
    </div>
    <div class="card-header">
        <h4>جميع الزيارات</h4>
    </div>
    <div class="card-body">
        <form method="post">
        @csrf
        {{-- <h5 class="my-2">البحث بالتاريخ</h5>
        <div class="row">
            <div class="input-group ">
                <div class="col-4 input-group">
                    <label class="input-label">{{__("من يوم")}}</label>
                    <input class="form-control" type="date" name="startDate" id="startDate">
                </div>
                <span class="offset-2"></span>

                <div class="col-4 input-group">
                    <label class="input-label">{{__("الي يوم")}}</label>
                    <input class="form-control" type="date" name="endDate" id="endDate">
                </div>
                <input type="hidden" id="patientId" data-id="{{$appointments[0]->patient_id}}">
                <div class="col-2 align-self-center"><button class="btn btn-block btn-success" id="searchDateBtn"type="button">بحث</button></div>
            </div>
        </div> --}}
        </form>

        <div class="table-responsive">
            <table class="table p-3 table-hover table-borderless tablesorter">
                <thead class="border-checkbox-section">
                    <th>{{__('اليوم')}}</th>
                    <th>{{__('الساعه')}}</th>
                    <th>{{__('المشكله')}}</th>
                    <th>{{__('العمل')}}</th>
                    <th>{{__('المطلوب يومها')}}</th>
                    <th>{{__('المدفوع يومها')}}</th>
                    {{-- <th>{{__('المتبقي يومها')}}</th>
                    <th>{{__('المطلوب اجمالا')}}</th>
                    <th>{{__('المدفوع اجمالا')}}</th>
                    <th>{{__('المتبقي اجمالا')}}</th>
                    <th>{{__('اكشن')}}</th> --}}
                </thead>
                <tbody class="border-checkbox-section " id="tbs">
                    @foreach ($appointments as $appointment)                        
                        <tr >
                            <td>{{$appointment->day}}</td>
                            <td>{{$appointment->hour}}</td>
                            @if (!$appointment->session)
                                <td></td>
                                <td></td>
                                <td></td>
                            @else
                                <td>{{$appointment->session->problem}}</td>
                                <td>{{$appointment->session->work}}</td>
                                <td>{{$appointment->session->cost}}</td>
                                @if (!$appointment->session->payment)
                                    <td></td>
                                @else
                                    <td>{{$appointment->session->payment->paid}}</td>
                                @endif
                            @endif
                            {{-- <td>{{$appointment->where('day','=',$appointments->day)->SUM('wanted')}}</td>
                            <td>{{$appointment->where('day','=',$appointments->day)->SUM('paid')}}</td> --}}
                            {{-- <td>{{$payments->where('day','=',$appointments[$i]->day)->SUM('wanted') - $payments->where('day','=',$appointments[$i]->day)->SUM('paid')}}</td> --}}
                            {{-- <td>{{$payments->SUM('wanted')}}</td>
                            <td>{{$payments->SUM('paid')}}</td>
                            <td>{{$payments->SUM('wanted') - $payments->SUM('paid')}}</td>
                            <td><a class="btn btn-xs btn-danger text-white ml-2"><i class="fa fa-trash" onclick="deleteApp({{$appointments[$i]->id}})" ></i></a></td> --}}
                        </tr>                    
                    @endforeach
                </tbody>
                {{ $appointments->links() }}
            </table>
            <hr>
            {{ $appointments->links() }}

        </div>
        
    </div><!-- end card-body --> 

  </div><!-- /end card -->