<div class="card-body">
    @if (count($patients) > 0 )
    <div class="table-responsive">
        {{-- <table id="dataTable" class="table p-3 table-hover table-borderless tablesorter"> --}}
        <table id="patientsTbl" class="table p-3 table-hover table-borderless tablesorter">
            <thead class="border-checkbox-section">
                <th>{{__('الاسم')}}</th>
                <th>{{__('السن')}}</th>
                <th>{{__('المدينه')}}</th>
                <th>{{__('المحمول')}}</th>
                <th>{{__('الوظيفه')}}</th>
                <th>{{__('المطلوب')}}</th>
                <th>{{__('المدفوع')}}</th>
                <th>{{__('المتبقي')}}</th>
                <th>{{__('تاريخ اخر زيارة')}}</th>
                {{-- <th>{{__('اخر مشكلة')}}</th> --}}
                <th>{{__('الصورة الشخصيه')}}</th>
                <th></th>
            </thead>
            <tbody class="">                    
                @foreach ($patients as $patient)
                    <tr >
                        <td>{{$patient->name}}</td>
                        <td>{{$patient->age}}</td>
                        <td>{{$patient->city}}</td>
                        <td>{{$patient->number}}</td>
                        <td>{{$patient->job}}</td>
                        <td>{{$patient->wanted}}</td>
                        <td>{{$patient->paid}}</td>
                        <td>{{$patient->wanted - $patient->paid}}</td>
                        @if ($patient->appointments->count() < 1)
                            <td>لا يوجد زيارات سابقه</td>
                        @else
                        <td>{{$patient->appointments[$patient->appointments->count() - 1]->day}} {{$patient->appointments[$patient->appointments->count() - 1]->hour}}</td>
                        @endif
                        @if (!empty($patient->image))
                        <td><img style="height:50px;border-radius:40%" src="{{asset('storage/'.$patient->image)}}" alt="Patient Image"></td>
                        @else
                        <td></td>
                        @endif
                        <td>
                            <a class="btn btn-xs btn-info text-white" title="Show Patient Data" href="{{route('patients.show',$patient->id)}}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="editPatientBtn text-white btn btn-xs btn-success" data-toggle="modal" data-target="#editPatient" data-key="{{$patient->id}}" >
                                <i class="fa fa-edit"></i>
                            </a>
                            {{-- <a class="btn btn-xs btn-danger text-white ml-2"><i class="fa fa-trash" onclick="deletePatient({{$patient->id}})" ></i></a> --}}
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