<div class="card">    
    <div class="card-header">
        <h4>{{__('اضافة تفاصيل الجلسه')}}</h4>
    </div>
    <!-- form start -->
    <div class="card-body">
        <div class="input-group">
            <label class="input-label">{{__('العمل')}}</label>

            <div class="col-sm-10">
                <input type="text" id="work" name="work" class="form-control">
            </div>
        </div>
        <div class="input-group">
            <label class="input-label">{{__('تكلفه الجلسه')}}</label>

            <div class="col-sm-10">
                <input type="number" id="cost" name="cost" class="form-control">
            </div>
        </div>
        <div class="input-group">
            <label class="input-label">{{__('ملاحظات')}}</label>

            <div class="col-sm-10">
                <textarea type="text" id="notes" cols="30" rows="4" name="note" class="form-control"></textarea>
            </div>
        </div>
        <div class="input-group">
            <label class="input-label">{{__('ارفاق صورة')}}</label>

            <div class="col-sm-10">
                <input type="file" id="file" name="file">
            </div>
        </div>        
    </div>
    <!-- /.card-body -->
    
</div>