@extends('layouts/master')

@section('content')

{{-- <script>
  var storeUrl = "{{ route('teeth.store',$patient->id) }}";
</script> --}}
@section('modals')
    
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
                <img id="popup-image" class="popup-image">
            </div>
        </div>
    </div>
  </div>
@endsection

<div class="page-content">
  
  <form action="{{ route('store.file')}}" method="POST">
    @csrf
    {{-- <input type="hidden" name="program_id" id="program_id" value="{{$program->id}}">
    <input type="hidden" name="patient_id" id="patient_id" value="{{$patient->id}}"> --}}
    
    @include('sessions.inc.patient-info')
    @include('sessions.inc.session-details-show')
    @include('sessions.inc.teeth-details-show')

    @include('sessions.inc.prescription-show')
  </form>
</div>

@endsection

{{-- Scripts --}}
@section('js_files')

<script>  var teeth = {!! $session->teeth !!}; </script>
<script src="/js/showTeeth.js"></script>
<script>
  showTeeth();
</script>
@endsection