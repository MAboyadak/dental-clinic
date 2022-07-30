<div class="card">    
    <div class="card-header">
        <h4>{{__(' تفاصيل الجلسه')}}</h4>
    </div>
    <!-- form start -->
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="dataTable" class="table p-3 table-hover table-borderless tablesorter">
                <thead class="border-checkbox-section">
                    <th>{{__('#')}}</th>
                    <th>{{__('العمل')}}</th>
                    <th>{{__('التكلفه')}}</th>
                    {{-- <th>{{__('ما تم دفعه')}}</th> --}}
                    {{-- <th>{{__('متبقي')}}</th> --}}
                    <th>{{__('الملاحظات')}}</th>
                    <th>{{__('الصورة المرفقه')}}</th>
                </thead>
                <tbody class="">
                    <tr>
                        <td>{{$session->id}}</td>
                        <td>{{$session->work}}</td>
                        <td>{{$session->cost}}</td>
                        {{-- <td>{{$session->cost - $session->payment->paid}}</td> --}}
                        {{-- <td>{{$session->payment->paid}}</td> --}}
                        <td>
                            @if (!$session->note)
                                
                            @else
                                {{$session->note->note}}
                            @endif
                        </td>
                        {{-- {{dd($session->file->name)}} --}}
                        <td>
                            @if (!$session->file)
                                
                            @else
                                <img data-toggle="modal" data-target="#image-modal" width="40px" src="{{asset('storage/'.$session->file->name)}}">
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
      
    </div>
    <!-- /.card-body -->
    
</div>