<div class="row m-2 mt-3 card-body">

    @foreach ($patient->programs as $program)

      <div class="col-4">
        <div class="accordion" id="accordion-{{$program->id}}">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-9">
                  <a class="btn btn-block text-right" style="font-size: 18px" type="button" data-toggle="collapse" data-target="#collapse{{$program->id}}" aria-expanded="true" >
                    {{$program->title}}
                  </a>
                </div>
                {{-- <div class="offset-1"></div> --}}
                <div class="col-3">
                  <button class="btn text-left mr-3" data-toggle="modal" data-target="#editProgram" onclick="editProgramModal({{$program->id}})" style="font-size: 16px;background-color:rgb(119 107 186);color:white;font-family:'Cairo'">Edit <i class="fa fa-pen"></i></button>
                </div>
              </div>
            </div>
    
            <div id="collapse{{$program->id}}" class="collapse" aria-labelledby="headingOne" data-parent="accordion-{{$program->id}}">
              <div class="card-body">

                <div class="mb-3" style="color: white;background: #86aeae;padding: 5px;width:240px">
                  المشكلة : <span class="mr-5">{{$program->problem}}</span><br>
                  التكـلفـه : <span class="mr-5">{{$program->cost}}</span><br>  
                  التاريـخ : <span class="mr-5">{{$program->created_at->toDateString()}}</span>

                </div>
                <a href="{{route('sessions.create',$program->id)}}" class="btn btn-primary mt-1 mb-3 text-white">
                    جلسة جديده <i class="fa fa-plus"></i>
                </a>

                @if (!$program->sessions)
                  <div>
                    <h4>لا يوجد جلسات سابقه.</h4>
                    {{-- <a href="route" class="btn btn-click btn-primary">اضافة برنامج جديد</a> --}}
                  </div>
                @else
                <ol>
                  @foreach ($program->sessions as $session)
                    <li style="width:190px"><a href="{{route('sessions.show',$session->id)}}"> {{$session->title}}</a> <span class="float-left">{{$session->cost}} جنيه</span></li>
                  @endforeach
                </ol>
                @endif

              </div>
            </div>
          </div>
          
        </div>
      </div>

    @endforeach

  </div>