<div class="col-12">
  <div class="row">
    <div class="col-md-7">
      <form enctype="multipart/form-data" action="{{ route('patients.store') }}" method="POST">
        @csrf
          <div class="input-group">
            <label class="input-label">{{__('الاسم')}}</label>
    
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="ادخل الاسم">
            </div>
          </div>
          <div class="input-group">
            <label class="input-label">{{__('السن')}}</label>
    
            <div class="col-sm-10">
                <input type="number" name="age" class="form-control" placeholder="ادخل السن">
            </div>
          </div>
          <div class="input-group">
            <label class="input-label">{{__('المدينه')}}</label>
    
            <div class="col-sm-10">
                <input type="text" name="city" class="form-control" placeholder="ادخل المدينه">
            </div>
          </div>
          <div class="input-group">
            <label class="input-label">{{__('الوظيفه')}}</label>
    
            <div class="col-sm-10">
                <input type="text" name="job" class="form-control" placeholder="ادخل الوظيفه">
            </div>
          </div>
          <div class="input-group">
            <label class="input-label">{{__('رقم المحمول')}}</label>
    
            <div class="col-sm-10">
                <input type="number" name="number" class="form-control" placeholder="ادخل الرقم">
            </div>
          </div>
          <div class="input-group">
            <label class="input-label">{{__('صورة المريض')}}</label>
    
            <div class="col-sm-10">
                <input id="file" name="file" type="file" class="form-control">
            </div>
          </div>
          <div class="input-group">
            <label class="input-label">{{__('الميعاد')}}</label>
            <div class="col-4 input-group">
                <label>{{__('اليوم')}} : </label>
                <input class="form-control datepicker" type="text" value="{{date('Y-m-d')}}" name="day" autocomplete="off">
            </div>
            {{-- <div class="offset-1"></div> --}}
            <div class="col-6 input-group">
                <label>{{__('الساعه')}} : </label>
                <input class="form-control" name="hour" autocomplete="off">
            </div>
          </div>
        <div class="p-3 text-center">
          <button id="saveNewPatient" type="submit" style="width:20%" class="btn btn-primary text-white ">{{__('Save')}}</button>
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
                <input class="form-control datepicker" type="text" name="dayToSearch" id="dayToSearch" autocomplete="off">
            </div>
            <span class="offset-1"></span>
            <div class="col-3 align-self-center"><button class="btn btn-block btn-success" id="dayAppsBtn"type="button">بحث</button></div>
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
        <tbody id="tbs2" class="border-checkbox-section bg-white">                    
            
        </tbody>
      </table>
    </div>    
  </div>
  
</div>