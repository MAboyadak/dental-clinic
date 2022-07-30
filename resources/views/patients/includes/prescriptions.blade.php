<div class="card">
    <div class="card-header">
        <a href="{{route('prescriptions.create',$patient->id)}}" class="btn btn-success text-white">{{__('اضافة روشتة')}}</a>
    </div> 
    <div class="card-header">
        <h4>جميع الروشتات</h4>
    </div>
    <div class="card-body">
        @if ($prescriptions->count() == 0)
            <h3>لا يوجد اي روشتات مسبقا</h3>
        @else
            <div class="table-responsive">
                <table class="table p-3 table-hover table-borderless tablesorter">
                    <thead class="border-checkbox-section">
                        <th>{{__('اليوم')}}</th>
                        <th>{{__('الساعه')}}</th>
                        {{-- <th>{{__('المشكله')}}</th> --}}
                        {{-- <th>{{__('العمل')}}</th> --}}
                        <th>{{__('تفاصيل')}}</th>
                    </thead>
                    <tbody class="border-checkbox-section " id="tbs">            
                        @foreach($prescriptions as $prescription)
                            <tr >
                                <td>{{$prescription->day}}</td>
                                <td>{{$prescription->hour}}</td>
                                {{-- <td>{{$prescription->problem}}</td> --}}
                                {{-- <td>{{$prescription->work}}</td> --}}
                                <td>
                                    <button class="btn btn-xs btn-success text-white" 
                                            onclick="window.open('{{route('prescriptions.show',$prescription->id)}}', '_blank','location=yes,height=740,width=1000,scrollbars=yes,status=yes')"
                                            title="تفاصيل الروشته">
                                        <i class="fa fa-eye"></i>
                                </button>
                                    <a class="btn btn-xs btn-danger text-white ml-2"><i class="fa fa-trash" onclick="deletePresc({{$prescription->id}})" ></i></a>
                                </td>
                            </tr>                    
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        
    </div><!-- end card-body --> 

  </div><!-- /end card -->