@extends('layouts/print')

@section('content')
<!-- Main content -->
    <a style="position: fixed;left:47%;cursor:pointer" class="btn btn-primary no-print" href="{{route('patients.show',$patient->id)}}">عودة للمريض</a>
    <br>
    <img src="/img/printer.png" alt="" class="no-print mt-4" onclick="window.print();">
    <div class="row mb-4">
        <div class="col-5">
            <h3>دكتور</h3>
            <h2>محمد حمدي السيد</h2>
            <h4>اخصائى الاسنان <br> زراعه حشو خلع تركيب <br> بمستشفي المبرة بدسوق <br> ماجستير تقويم الاسنان - جامعه عين شمس</h4>
        </div>
        <div class="offset-2"></div>
        <div class="col-5">
            <h3>.Dr</h3>
            <h2>Mohamed Hamdy El Sayed</h2>
            <h3 style="line-height:2">Dental Specialist</h3>
        </div>
        
    </div>

    <div class="row my-2 text-right p-2" style="border-top:2px solid #333;border-bottom:2px solid #333">
        <div class="offset-1"></div>
        <div class="col-3">
            <label>الاسم :</label>
            <label>أ/ {{$patient->name}}</label>
        </div>
        <div class="offset-1"></div>
        <div class="col-3">
            <label>السن :</label>
            <label>{{$patient->age}}</label>
        </div>
        <div class="offset-1"></div>
        <div class="col-3">
            <label>التاريخ :</label>
            <label>{{$prescription->day}}</label>
        </div>
    </div>
    {{-- <div class="card" style="-webkit-print-color-adjust: exact;">
        <div class="card-header" style="-webkit-print-color-adjust: exact;">
            <h3>المشكلة</h3>
        </div>
        <div class="card-body p-3" style="-webkit-print-color-adjust: exact;font-size:18px">
            <p>{{$prescription->problem}}</p>
        </div>
    </div> --}}
    <div class="card" style="-webkit-print-color-adjust: exact;">
        <div class="card-header" style="-webkit-print-color-adjust: exact;">
            <h3>الأدوية</h3>
        </div>
        <div class="card-body p-3" style="-webkit-print-color-adjust: exact;">
            @if (count($medicines) > 0 )
            <div class="table-responsive">
                <table class="table p-3 table-hover table-borderless tablesorter">
                    <thead class="border-checkbox-section">
                        <tr style="font-size:22px">
                            <th>اسم الدواء</th>
                            <th>عدد الأيام</th>
                            <th>عدد المرات</th>
                            <th>تعليمات</th>
                        </tr>
                    </thead>
                    <tbody class="border-checkbox-section">
                        @foreach ($medicines as $medicine)
                            <tr style="font-size:18px">
                                <td>{{$medicine->name}}</td>
                                <td>{{$medicine->days}}</td>
                                <td>{{$medicine->repeats}}</td>
                                <td>{{$medicine->instructions}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <h2 class="p-3">No Medicines.</h2>
            @endif
          
        </div>
    </div>
    <div style="-webkit-print-color-adjust: exact;border-top:2px solid #333;">
        <div style="-webkit-print-color-adjust: exact;">
            <h5 class="mt-4">العنوان : ش المركز طوالي الدور الثاني علوي
                تليفون : 01010568214</h5>
        </div>
    </div>

@endsection

@section('js_files')
<script>
    $(document).ready(function(){
        window.print();
        window.onafterprint = window.close();
        // window.location.href = '/home';
        return;
    });
</script>
@endsection