<form enctype="multipart/form-data" action="{{ route('patients.store') }}" method="POST">
    @csrf
    <h4 style="color:#6B94CE;font-weight:bold">Tooth Condition</h4>
    <div class="row">
      <div class="col-12">
          Normal    <input type="radio" name="cond" value="normal"> <br>
          Extracted <input type="radio" name="cond" value="extracted"><br>
          Bad       <input onclick="viewDetails()" type="radio" name="cond" value="bad"><br>
          Treated   <input type="radio" name="cond" value="treated"><br>
      </div>
    </div>

    <div class="row">
      <h4 style="color:#6B94CE;font-weight:bold">Details</h4>
      <div class="col-6">
          
          Caries    <input type="radio" name="cond" value="normal"> <br>
          Implant <input type="radio" name="cond" value="extracted"><br>
          Mobility       <input onclick="viewDetails()" type="radio" name="cond" value="bad"><br>
          Impacted   <input type="radio" name="cond" value="treated"><br>
          RCT   <input type="radio" name="cond" value="treated"><br>
      </div>
      <div class="col-6">
          Crown    <input type="radio" name="cond" value="normal"> <br>
          RCT&Crown <input type="radio" name="cond" value="extracted"><br>
          Implant&Crown       <input onclick="viewDetails()" type="radio" name="cond" value="bad"><br>
          Fracture Crown   <input type="radio" name="cond" value="treated"><br>
          R R   <input type="radio" name="cond" value="treated"><br>
      </div>
    </div>
    

  </form>