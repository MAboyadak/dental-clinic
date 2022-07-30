<form enctype="multipart/form-data" action="{{ route('home.revisit') }}" method="POST">
  @csrf
  <div class="card-body">
    <div class="input-group">
      <label class="input-label" style="line-height:1">{{__('الاسم')}}</label>
      <div class="col-sm-10">
        <select name="selectedPatient" class="form-control" id="patientNameSelectBox">
            @foreach ($patients as $patient)
            <option value="{{$patient->id}}">{{$patient->name}} {{$patient->age}} {{$patient->city}}</option>
            @endforeach
        </select>
      </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="input-group ">
      <label class="input-label">{{__('الميعاد')}}</label>
      <div class="col-4 input-group">
          <label>{{__('اليوم')}} : </label>
          <input class="form-control" type="date" value="{{date('Y-m-d')}}" name="day">
      </div>
      <div class="offset-1"></div>
      <div class="col-4 input-group">
          <label>{{__('الساعه')}} : </label>
          <input class="form-control" type="time" value="{{date('H:i')}}" name="hour">
      </div>
    </div>
  </div>
  <div class="card-footer text-center">
    <button type="submit" style="width:20%" class="btn btn-primary text-white ">{{__('Save')}}</button>
  </div>
</form>