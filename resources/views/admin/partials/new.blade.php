<form enctype="multipart/form-data" action="{{ route('home.store') }}" method="POST">
  @csrf
  <div class="card-body">
    <div class="input-group">
      <label class="input-label">{{__('الاسم')}}</label>

      <div class="col-sm-10">
          <input type="text" name="name" class="form-control" placeholder="ادخل الاسم">
      </div>
    </div>
    <div class="input-group">
      <label class="input-label">{{__('السن')}}</label>

      <div class="col-sm-10">
          <input type="text" name="age" class="form-control" placeholder="ادخل السن">
      </div>
    </div>
    <div class="input-group">
      <label class="input-label">{{__('المدينه')}}</label>

      <div class="col-sm-10">
          <input type="text" name="city" class="form-control" placeholder="ادخل المدينه">
      </div>
    </div>
    <div class="input-group">
      <label class="input-label">{{__('رقم المحمول')}}</label>

      <div class="col-sm-10">
          <input type="text" name="number" class="form-control" placeholder="ادخل الرقم">
      </div>
    </div>
    
    <div class="input-group">
      <label class="input-label">{{__('صورة المريض')}}</label>

      <div class="col-sm-10">
          <input id="file" name="file" type="file" class="form-control">
      </div>
    </div>
    <div class="input-group ">
      <label class="input-label">{{__('الميعاد')}}</label>
      <div class="col-4 input-group">
          <label>{{__('اليوم')}} :</label>
          <input class="form-control" type="date" value="{{date('Y-m-d')}}" name="day">
      </div>
      <div class="offset-1"></div>
      <div class="col-4 input-group">
          <label>{{__('الساعه')}} :</label>
          <input class="form-control" type="time" value="{{date('H:i')}}" name="hour">
      </div>
    </div>
  </div>
  <div class="card-footer text-center">
    <button id="saveNewPatient" type="submit" style="width:20%" class="btn btn-primary text-white ">{{__('Save')}}</button>
  </div>
</form>
