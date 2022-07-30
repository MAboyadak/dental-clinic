<div class="card">
    <div class="card-header">
        <h4>الروشته</h4>
    </div>
    <div class="card-body">
        @if (!$presc || !$presc->medicines)
            <h3>لا توجد روشته لهذا السيشن</h3>
        @else
            <a class="btn btn-danger mb-2" href="/prescription/{{$presc->id}}" target="_blank">طباعه الروشته <i style="font-size: 18px" class="fa fa-print"></i></a>
            <table class="table table-stripped table-bordered">
                <tr>
                    <th>الدواء</th>
                    <th>عدد الايام</th>
                    <th>التكرار</th>
                    <th>التعليمات</th>
                </tr>
                <tbody>
                    {{-- {{dd($presc->medicines)}} --}}
                    @if (!$presc)
                        <th style="font-size: 22px;" colspan="4">لا يوجد</th>
                    @else
                        @foreach ($presc->medicines as $med)
                            <tr>
                                <td>{{$med->name}}</td>
                                <td>{{$med->days}}</td>
                                <td>{{$med->repeats}}</td>
                                <td>{{$med->instructions}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @endif
        
    </div>
</div>


{{-- <div class="card">
    <div class="card-header">
        <h4>المعاد القادم</h4>
    </div>
    <div class="card-body">
        <div class="input-group ">
            <div class="col-4 input-group">
                <label class="input-label">{{__("اليوم")}}</label>
                <h4>{{$nextApp->day}}</h4>
            </div>

            <div class="col-4 input-group">
                <label class="input-label">{{__("الساعه")}}</label>
                <h4>{{$nextApp->hour}}</h4>
            </div>
        </div>
    </div>
    <!-- /.card-footer -->
</div> --}}