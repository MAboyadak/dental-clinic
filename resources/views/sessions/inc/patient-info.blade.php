<div class="card">
  <div class="card-header">
      <h4>البيانات الشخصيه</h4>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6 col-sm-12">
          @if (!empty($patient->image))
          
              <img src="{{asset('storage/'.$patient->image)}}" style="max-height:210px" alt="">
          
          @else
          <img src="/img/doctor.png" style="max-height:240px;border-radius:50%" alt="">
          @endif

      </div>

      <div class="col-md-6 col-sm-12">
          {{-- <h5 class="my-2"><strong class="show-span">{{__('اي دي')}} :</strong> {{$patient->id}} </h5> --}}
          <h5 class="my-2"><strong class="show-span">{{__('اسم المريض')}} :</strong> {{$patient->name}}</h5>
          <h5 class="my-2"><strong class="show-span">{{__('اسم البرنامج')}} :</strong> {{$program->title}}</h5>
          {{-- <h5 class="my-2"><strong class="show-span">{{__('السن')}} :</strong> {{$patient->age}}</h5> --}}
          {{-- <h5 class="my-2"><strong class="show-span">{{__('المدينه')}} :</strong> {{$patient->city}}</h5> --}}
          <h5 class="my-2"><strong class="show-span">{{__('التكلفه الكلية للبرنامج')}} :</strong>{{$program->cost}}</h5>
          <h5 class="my-2"><strong class="show-span">{{__('عدد جلسات البرنامج حتي الان')}} :</strong>{{$program->sessions->count()}}</h5>
          <h5 class="my-2"><strong class="show-span">{{__('تكلفه الجلسات السابقه')}} :</strong>{{$program->sessions->SUM('cost')}}</h5>
          <h5 class="my-2"><strong class="show-span">{{__('المدفوع للجلسات السابقه')}} :</strong>{{$program->sessions->SUM('paid')}}</h5>
          <h5 class="my-2"><strong class="show-span">{{__('المتبقي عليه من الجلسات السابقه')}} :</strong>{{$program->sessions->SUM('cost') - $program->sessions->SUM('paid')}}</h5>
          {{-- <h5 class="my-2"><strong class="show-span">{{__('تاريخ الاضافة')}} :</strong> {{$patient->created_at}}</h5> --}}
      </div>

    </div>

  </div>        
</div> {{-- end card --}}