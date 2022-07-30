@extends('layouts.master')

@section('content')
    <!-- Main content -->
    <div class="page-content">
      <div class="row">
        <div class="col-xl-3 col-md-6">
              <div class="card">
                  <div class="card-block">
                      <div class="row align-items-center m-l-0">
                          <div class="col-auto">
                              <i class="fa fa-users"></i>
                          </div>
                          <div class="col-auto">
                              <h6 class=" m-b-10">عدد الحالات اليوم</h6>
                              <h2 class="m-b-0">4</h2>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-3 col-md-6">
              <div class="card">
                  <div class="card-block">
                      <div class="row align-items-center m-l-0">
                          <div class="col-auto">
                              <i class="fa fa-users"></i>
                          </div>
                          <div class="col-auto">
                              <h6 class=" m-b-10">عددالحالات اخر 30 يوم</h6>
                              <h2 class="m-b-0">79</h2>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-3 col-md-6">
              <div class="card">
                  <div class="card-block">
                      <div class="row align-items-center m-l-0">
                          <div class="col-auto">
                              <i class="fa fa-users"></i>
                          </div>
                          <div class="col-auto">
                              <h6 class=" m-b-10">عدد الحالات اخر 7 ايام</h6>
                              <h2 class="m-b-0">25</h2>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row align-items-center m-l-0">
                        <div class="col-auto">
                            <i class="fa fa-user f-30 text-c-red"></i>
                        </div>
                        <div class="col-auto">
                            <h6 class=" m-b-10">عدد الحالات اخر 365 ايام</h6>
                            <h2 class="m-b-0">420</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div> <!-- End container -->
      
@endsection
