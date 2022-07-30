  <div class="card-body">
    {{-- <form method="post">
      @csrf
      <h5 class="my-2">بحث الحجوزات بالتاريخ</h5>
      <div class="row">
        <div class="input-group ">
          <div class="col-4 input-group">
              <label class="input-label">{{__("من يوم")}}</label>
              <input class="form-control datepicker" type="text" name="startDate" id="startDate" autocomplete="off">
          </div>
          <span class="offset-2"></span>

          <div class="col-4 input-group">
              <label class="input-label">{{__("الي يوم")}}</label>
              <input class="form-control datepicker" type="text" name="endDate" id="endDate" autocomplete="off">
          </div>
          <div class="col-2 align-self-center"><button class="btn btn-block btn-success" id="BetweenTwoDatesAppsBtn"type="button">بحث</button></div>
        </div>
      </div>
    </form> --}}
    <div class="table-responsive">
      <table id="dataTable" class="table p-3 table-hover table-bordered tablesorter">
          <thead class="border-checkbox-section">
              <th>{{__('الاسم')}}</th>
              <th>{{__('السن')}}</th>
              <th>{{__('المدينه')}}</th>
              <th>{{__('رقم الموبايل')}}</th>
              <th>{{__('الساعه')}}</th>
              <th>{{__('المطلوب')}}</th>
              <th>{{__('المدفوع')}}</th>
              <th>{{__('المتبقي')}}</th>
              <th>{{__('عمليات')}}</th>
          </thead>
          <tbody id="tbs" class="border-checkbox-section">
              
          </tbody>
      </table>
    </div>
  </div>