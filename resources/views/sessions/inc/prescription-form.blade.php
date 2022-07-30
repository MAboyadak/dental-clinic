<div class="card">
    <div class="card-header">
        <h4>اضافة الروشته</h4>
    </div>
    <div class="card-body">
        {{-- <div class="row justify-content-around">
            <div class="input-group col-5">
                <label>{{__('المشكله')}}&nbsp;&nbsp;</label>
                <textarea class="form-control" name="problem" id="" cols="40" rows="3"></textarea>
            </div>
            <div class="input-group col-5">
                <label>{{__('العمل')}}&nbsp;&nbsp;</label>
                <textarea class="form-control" name="work" id="" cols="40" rows="3"></textarea>
            </div>
        </div> --}}
        <div class="hr-line-dashed"></div>
        <div class="form-group ">
            <div class="col-12 m-0">
                <div id="emptyname" class="bg-danger text-white p-2 mb-2 d-none">* اسم الدواء لا يمكن ان يكون فارغ.</div>
                <div class="row" id="medicine-container">
                    <div class="col-3 col-md-3">
                        <label for="">
                            الدواء
                        </label>
                        <input id="medicine" type="text" class="form-control">
                    </div>                            
                    <div class="col-3 col-md-2">
                        <label for="">
                            الايام
                        </label>
                        <input id="days" type="number" class="form-control">
                    </div>
                    <div class="col-3 col-md-2">
                        <label for="">
                            التكرار
                        </label>
                        <input id="repeats" type="number" class="form-control">
                    </div>
                    <div class="col-3 col-md-3">
                        <label for="">
                            التعليمات
                        </label>
                        <textarea id="instructions" type="text" class="form-control"></textarea>
                    </div>
                    <div class="col-12 col-md-2 align-self-center">
                        <button class="btn btn-info text-white" type="button" onclick="addMedicine(event)"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <h4>المعاد القادم</h4>
    </div>
    <div class="card-body">
        <div class="input-group ">
            <div class="col-5 input-group">
                <label class="input-label">{{__("اليوم")}}</label>
                <input class="form-control" id="day" type="date" name="day">
            </div>
            <span class="offset-2"></span>

            <div class="col-5 input-group">
                <label class="input-label">{{__("الساعه")}}</label>
                <input class="form-control" id="hour" type="time" name="hour">
            </div>
            </div>
    </div>
    <div class="card-footer text-center">
        <button type="submit" onclick="submitData(event)" style="width:20%" class="btn btn-primary text-white ">Save</button>
    </div>
    <!-- /.card-footer -->
</div>