<div class="card">
    <div class="card-header">
      <h4>تعديل</h4>
    </div>
    <div class="card-body">
      <div class="row p-2 text-center">
        <div class="col-md-2 col-12 p-3" style="background:#274b6ce0;color:white">
          <h4 class="mb-3" style="font-weight:bold;">قائمه الاسنان المضافة</h4>
          <div class="row">
            <div class="col-6 bg-success">
              <ul id="picked_list" style="padding:0px;margin:0px">
                <li>لا يوجد حتي الان</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-1 align-self-center">
          <button type="button" class="btn btn-info text-white" style="font-weight:bold" onclick="addTooth()"><i class="fa fa-plus"></i></button>
        </div>
        <div class="col-2 p-1">
          @include('sessions.inc.sectors')
        </div>
        <div class="col-2"><textarea placeholder="تفاصيل السنة / الضرس .." id="description"  class="form-control" style="width:80%" rows="7"></textarea></div>
          
        <div class="col-md-2 col-12">
          <div class="row text-left ml-5">
            <div class="col-12"><h4 style="color:#6B94CE;font-weight:bold">Condition</h4></div>
            <div class="col-12">
              Normal <input type="radio" name="condition" value="normal" onclick="viewDetails()" checked><br>
              Extracted <input type="radio" name="condition" value="extracted" onclick="viewDetails()"><br>
              Bad <input type="radio" name="condition" value="bad" onclick="viewDetails()"><br>
              Treated <input type="radio" name="condition" value="treated" onclick="viewDetails()"><br>
            </div>
            <div class="col-12 mt-3"><h4 style="color:#6B94CE;font-weight:bold">Details</h4></div>
            <div class="col">
              Caries <input type="radio" name="detail" value="Caries" disabled> <br>
              Implant <input type="radio" name="detail" value="Implant"disabled> <br>
              {{-- <input type="radio" name="detail" value="Mobility"disabled> Mobility<br>
              <input type="radio" name="detail" value="Impacted"disabled> Impacted<br>
              <input type="radio" name="detail" value="RCT"disabled> RCT<br>
            
              <input type="radio" name="detail" value="Crown"disabled> Crown<br>
              <input type="radio" name="detail" value="RCT&Crown"disabled> RCT&Crown<br>
              <input type="radio" name="detail" value="Implant&Crown"disabled> Implant&Crown<br>
              <input type="radio" name="detail" value="Fracture Crown"disabled> Fracture Crown<br>
              <input type="radio" name="detail" value="R R"disabled> R R<br> --}}
            </div>
            
          </div>
        </div>
        
        <div class="col-md-3 col-12 p-1" style="background:#4a7cc794">
          @include('teeth.inc.teeth')
        </div>
        
        
      </div><!-- end row --> 
    </div><!-- end card-body --> 

  </div>      <!-- /end card -->