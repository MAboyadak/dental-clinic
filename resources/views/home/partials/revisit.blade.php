<div class="col-12">
  <div class="row">
    <div class="col-md-7">
      <form  action="{{ route('home.revisit') }}" method="POST">
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
                <input class="form-control datepicker" type="text" value="{{date('Y/m/d')}}" name="day" autocomplete="off">
            </div>
            {{-- <div class="offset-1"></div> --}}
            <div class="col-6 input-group">
                <label>{{__('الساعه')}} : </label>
                <input class="form-control" type="time" value="{{date('H:i')}}" name="hour" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <button type="submit" style="width:20%" class="btn btn-primary text-white ">{{__('Save')}}</button>
        </div>
      </form>      
    </div>
    <div class="col-md-5 bg-dark text-white" style="border-right:1px solid #333">
      <form method="post">
        @csrf
        <h5 class="my-2">البحث بالتاريخ</h5>
        <div class="row">
          <div class="input-group ">
            <div class="col-7 input-group">
                <label class="ml-2">{{__("اختار اليوم :")}}</label>
                <input class="form-control datepicker" type="text" name="dayToSearch" id="dayToSearchRe" autocomplete="off">
            </div>
            <span class="offset-1"></span>
            <div class="col-3 align-self-center"><button class="btn btn-block btn-success" id="dayAppsBtnRe"type="button">بحث</button></div>
          </div>
        </div>
      </form>
      <table id="dataTable" class="table p-3 table-hover table-bordered tablesorter">
        <thead class="border-checkbox-section">
          <th>{{__('الاسم')}}</th>
          <th>{{__('السن')}}</th>
          <th>{{__('المدينه')}}</th>
          <th>{{__('رقم الموبايل')}}</th>
          <th>{{__('الساعه')}}</th>
          <th>{{__('عمليات')}}</th>
        </thead>
        <tbody id="tbs3" class="border-checkbox-section bg-white">                    
            
        </tbody>
      </table>
    </div>    
  </div>
  
</div>