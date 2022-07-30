{{-- edit mediacl info --}}
<div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <div class="section-title mb-10">
                        <h5>{{__('تعديل المعلومات الطبيه')}}</h5>
                    </div>
                </div>
                <div>
                  <button type="button" class="close" style="display:inline-block;float:left;text-align: left" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
            </div>
            <form id="edit_medinfo" action="{{route('medicalinfo.store', $patient->id)}}" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    @csrf
                    {{-- <input type="hidden" id="driver_key" name="key" value=""> --}}
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                              <label >{{__('هل تعاني من ضغط الدم ؟')}}</label>
                              <select id="blood_pressure" class="form-control" name="blood_pressure">
                                <option value=1 >نعم</option>
                                <option value=0 selected>لا</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                              <label >{{__('هل تعاني من السكر ؟')}}</label>
                              <select id="diabetes" class="form-control" name="diabetes">
                                <option value=1 >نعم</option>
                                <option value=0 selected>لا</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                              <input class="form-control d-none" id="diabetes_details" placeholder=" نتيجه اخر تحليل .. " type="text" name="diabetes_details">
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                            <label >{{__('هل تعاني من اي امراض في القلب ؟	')}}</label>
                            <select id="heart" class="form-control" name="heart">
                              <option value=1 >نعم</option>
                              <option value=0 selected>لا</option>
                            </select>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                            <label >{{__('هل تعاني من حساسيه لنوعيه علاج محدده ؟	')}}</label>
                            <select id="sensitivity" class="form-control" name="sensitivity">
                              <option value=1 >نعم</option>
                              <option value=0 selected>لا</option>
                            </select>
                          </div>
                      </div>
                    </div>

                    <div class="row ">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                              <input class="form-control d-none" id="sensitivity_details" placeholder=" ما هي .." type="text" name="sensitivity_details">
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                            <label >{{__('هل تعاني من اي امراض اخري ؟	')}}</label>
                            <select id="other" class="form-control" name="other">
                              <option value=1 >نعم</option>
                              <option value=0 selected>لا</option>
                            </select>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                              <input id="other_details" class="form-control d-none" placeholder=" ما هي .." type="text" name="other_details">
                          </div>
                      </div>
                    </div>
                    @if ($patient->gender != 'male')
                      <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                              <label >{{__('هل يوجد حمل ؟')}}</label>
                              <select id="pregnant" class="form-control" name="pregnant">
                                <option value=1 >نعم</option>
                                <option value=0 selected>لا</option>
                              </select>
                            </div>
                        </div>
                      </div>

                      <div class="row" >
                        <div class="section-field col-md-12">
                            <div class="form-group">
                                <input class="form-control d-none" id="pregnant_details" placeholder="في اي شهر ؟" type="text" name="pregnant_details">
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                              <label >{{__('هل يوجد رضاعه ؟	')}}</label>
                              <select id="breast_feeding" class="form-control" name="breast_feeding">
                                <option value=1 >نعم</option>
                                <option value=0 selected>لا</option>
                              </select>
                            </div>
                        </div>
                      </div>
                    @endif

                  </div>  
            {{--End Modal Body  --}}
              
                <div class="modal-footer">
                    {{-- <input id="communicationID" type="hidden" name="id" value=""> --}}
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-check"></i> {{__('Save')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Add Note --}}
<div class="modal fade" id="addNote" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <div class="section-title mb-10">
                        <h5>{{__('اضافة ملاحظه للمريض')}}</h5>
                    </div>
                </div>
                <div>
                  <button type="button" class="close" style="display:inline-block;float:left;text-align: left" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
            </div>
            <form  action="{{route('note.store', $patient->id)}}" method="post">
                <div class="modal-body">
                    @csrf
                    {{-- <input type="hidden" id="driver_key" name="key" value=""> --}}
                    <div class="row">
                        <div class="section-field col-md-12">
                            <div class="form-group">
                              <textarea name="note" cols="60" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>  
                {{--End Modal Body  --}}
              
                <div class="modal-footer">
                    {{-- <input id="communicationID" type="hidden" name="id" value=""> --}}
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-check"></i> {{__('Save')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Add Program --}}
<div class="modal fade" id="addProgram" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <div class="modal-title">
                <div class="section-title mb-10">
                  <h5>{{__('اضافة برنامج جديد')}}</h5>
                </div>
              </div>
              <div>
                <button type="button" class="close" style="display:inline-block;float:left;text-align: left" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
          </div>
          <form  action="{{route('programs.store')}}" method="post">
              <div class="modal-body">
                  @csrf
                  <input type="hidden" name="patientId" value="{{$patient->id}}">
                  <div class="row">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                            <label for="">اسم البرنامج :</label>
                            <input type="text" name="title" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="">المشكلة :</label>
                            <input type="text" name="problem" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="">التكلفه :</label>
                            <input type="number" step="5" name="Cost" class="form-control">
                          </div>
                      </div>
                  </div>
              </div>  
              {{--End Modal Body  --}}
            
              <div class="modal-footer">
                  {{-- <input id="communicationID" type="hidden" name="id" value=""> --}}
                  <button type="submit" class="btn btn-primary pull-right">
                      <i class="fa fa-check"></i> {{__('Save')}}
                  </button>
              </div>
          </form>
      </div>
  </div>
</div>


{{-- POP UP IMAGE --}}
<div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">

          {{-- POPUP Image Container --}}
          {{-- <div id="popup-background" class="popup-background" style="display: none;">
          </div> --}}
          {{-- END POPUP --}}


          <div class="modal-header">
              <div class="modal-title">
                  <div id="popup-title"></div>
              </div>
              <div>
              </div>
          </div>
          <div class="modal-body text-center">
              <img id="popup-image" style="width: 65%" class="popup-image">
          </div>
      </div>
  </div>
</div>

{{-- Edit Program --}}
<div class="modal fade" id="editProgram" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <div class="modal-title">
                <div class="section-title mb-10">
                  <h5>{{__('تعديل البرنامج')}}</h5>
                </div>
              </div>
              <div>
                <button type="button" class="close" style="display:inline-block;float:left;text-align: left" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
          </div>
          <form  action="{{route('programs.update')}}" method="post">
              <div class="modal-body">
                  @csrf
                  <input type="hidden" name="program_id" id="program_id">
                  <div class="row">
                      <div class="section-field col-md-12">
                          <div class="form-group">
                            <label for="">اسم البرنامج :</label>
                            <input type="text" id="program-modal-title" name="title" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="">المشكلة :</label>
                            <input type="text" id="program-modal-problem" name="problem" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="">التكلفه :</label>
                            <input type="number" id="program-modal-cost" step="5" name="cost" class="form-control">
                          </div>
                      </div>
                  </div>
              </div>  
              {{--End Modal Body  --}}
            
              <div class="modal-footer">
                  {{-- <input id="communicationID" type="hidden" name="id" value=""> --}}
                  <button type="submit" class="btn btn-primary pull-right">
                      <i class="fa fa-check"></i> {{__('Save')}}
                  </button>
              </div>
          </form>
      </div>
  </div>
</div>


{{-- Add Appointment --}}
<div class="modal fade" id="addApp" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <div class="modal-title">
                  <div class="section-title mb-10">
                      <h5>{{__('حجز جديد')}}</h5>
                  </div>
              </div>
              <div>
                <button type="button" class="close" style="display:inline-block;float:left;text-align: left" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
          </div>
          <form action="{{ route('appointments.store') }}" method="post">
              <div class="modal-body">
                  @csrf
                  <input type="hidden" name="selectedPatient" value="{{$patient->id}}">
                  <div class="input-group ">
                    <label class="input-label">{{__('الميعاد')}}</label>
                    <div class="col-4 input-group">
                        <label>{{__('اليوم')}} : </label>
                        <input class="form-control datepicker" type="text" value="{{date('Y/m/d')}}" name="day" autocomplete="off">
                      </div>
                    <div class="offset-1"></div>
                    <div class="col-4 input-group">
                        <label>{{__('الساعه')}} : </label>
                        <input class="form-control" type="time" name="hour"  autocomplete="off">
                    </div>
                  </div>
              </div>  
              {{--End Modal Body  --}}
            
              <div class="modal-footer">
                  {{-- <input id="communicationID" type="hidden" name="id" value=""> --}}
                  <button type="submit" class="btn btn-primary pull-right">
                      <i class="fa fa-check"></i> {{__('حفظ')}}
                  </button>
              </div>
          </form>
      </div>
  </div>
</div>



{{-- Add Payment Modal --}}
<div class="modal fade" id="addPayment" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <div class="modal-title">
                  <div class="section-title mb-10">
                      <h5>{{__('دفع جديد')}}</h5>
                  </div>
              </div>
              <div>
                <button type="button" class="close" style="display:inline-block;float:left;text-align: left" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
          </div>
          <form action="{{ route('payment.store') }}" method="post">
              <div class="modal-body">
                  @csrf
                  <input type="hidden" name="selectedPatient" value="{{$patient->id}}">
                  <div class="input-group ">
                    {{-- <div class="col-5 input-group">
                        <label >{{__("المبلغ المطلوب")}} : </label>
                        <input class="form-control" type="number" name="wanted">
                    </div>
                    <span class="offset-2"></span> --}}

                    <div class="col-8 input-group">
                        <label >{{__("المبلغ المدفوع")}} : </label>
                        <input class="form-control" type="number" name="paid">
                    </div>
                </div>
              </div>  
              {{--End Modal Body  --}}
            
              <div class="modal-footer">
                  {{-- <input id="communicationID" type="hidden" name="id" value=""> --}}
                  <button type="submit" class="btn btn-primary pull-right">
                      <i class="fa fa-check"></i> {{__('حفظ')}}
                  </button>
              </div>
          </form>
      </div>
  </div>
</div>
