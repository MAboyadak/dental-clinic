<div class="card">
    <div class="card-header">
      <a href="{{route('teeth.create',$patient->id)}}" class="btn btn-success text-white">تعديل الاسنان</a>      
    </div>
    <div class="card-header">
      <h4>Teeth details</h4>
    </div>
    <div class="card-body">
      <div class="row p-2 text-center">
        
        <div class="col-md-9 col-12 p-1">
          <table class="table table-stripped table-bordered">
            <tr>
                <th>Left</th>
                <th>Top</th>
                <th>Right</th>
                <th>Bottom</th>
                <th>Condition</th>
                <th>Details</th>
                <th>Description</th>
            </tr>
            <tr>
              <td id="left"></td>
              <td id="top"></td>
              <td id="right"></td>
              <td id="bottom"></td>
              <td id="condition"></td>
              <td id="detail"></td>
              <td id="description"></td>
              
            </tr>
          </table>
        </div>
        <div class="col-md-3 col-12 p-1" style="background:#89f3d194">
          @include('teeth.inc.teeth')
        </div>
      </div><!-- end row --> 
    </div><!-- end card-body --> 

  </div>      <!-- /end card -->