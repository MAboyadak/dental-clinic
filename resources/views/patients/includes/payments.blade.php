<div class="card">
    <div class="card-header">
        <a id="addPayment" data-toggle="modal" data-target="#addPayment" data-key="{{$patient->id}}" class="btn btn-success text-white">اضافة مدفوعات</a>
    </div>
    <div class="card-header">
        <h4>جميع المدفوعات</h4>
    </div>
    <div class="card-body">
        @if ($payments->count() == 0)
            <h3>لا يوجد اي مدفوعات مسبقا</h3>
        @else
            <div class="table-responsive">
                <table class="table p-3 table-hover table-borderless tablesorter">
                    <thead class="border-checkbox-section">
                        <th>{{__('اليوم')}}</th>
                        <th>{{__('الساعه')}}</th>
                        {{-- <th>{{__('المشكله')}}</th>
                        <th>{{__('العمل')}}</th>
                        <th>{{__('المطلوب')}}</th> --}}
                        <th >{{__('المدفوع')}}</th>
                    </thead>
                    <tbody class="border-checkbox-section " id="tbs">
                        @foreach ($payments as $payment)                            
                            <tr>
                                <td>{{$payment->day}}</td>
                                <td>{{$payment->hour}}</td>
                                {{-- <td></td> --}}
                                {{-- <td>@if($appointments->where('day','=',$payment->day)->first()){{$appointments->where('day','=',$payment->day)->first()->work}}@endif</td> --}}
                                {{-- <td>{{$appointments->where('day','=',$payment->day)->first()->work}}</td> --}}
                                {{-- <td>{{$payment->wanted}}</td> --}}
                                <td >{{$payment->paid}}</td>
                            </tr>                    
                        @endforeach
                        
                    </tbody>
                    {{ $payments->links() }}
                </table>
                <hr>
                {{ $payments->links() }}
            </div>
        @endif
        
    </div><!-- end card-body --> 

  </div><!-- /end card -->