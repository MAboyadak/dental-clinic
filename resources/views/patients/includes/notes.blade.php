<div class="card">
    <div class="card-header">
        <a id="addNoteBtn" data-toggle="modal" data-target="#addNote" data-key="{{$patient->id}}" class="btn btn-success text-white">اضافة ملحوظه</a>     
    </div>
    <div class="card-header">
        <h4>جميع الملاحظات</h4>
    </div>

    <div class="card-body">
        @if ( $patient->notes()->exists() )
            <div class=" mt-2 mb-5">
                @for ($i = 0; $i < $notes->count(); $i++)
                    <div class="row">
                        <label class="col-2">الملاحظه رقم {{$i+1}}</label>
                        <label class="col-9">{{$notes[$i]->note}}</label>
                        <form id="deleteNote{{$notes[$i]->id}}" method="POST" action="{{route('note.destroy', $notes[$i]->id)}}" style="display:inline-block">
                            @csrf
                            <a class="btn btn-xs btn-danger text-white" title="مسح الملاحظه" onclick=" return ( confirm('هل انت متأكد من المسح ؟') ? $('#deleteNote{{$notes[$i]->id}}').submit() : '' ); ">
                                <i class="fa fa-trash"></i>
                            </a>
                        </form>
                    </div>
                    <hr class="my-4">
                @endfor
            </div>
        @endif
        
    </div><!-- end card-body --> 

  </div><!-- /end card -->