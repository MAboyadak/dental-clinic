@extends('layouts/master')

@section('content')

{{-- <script>
  var storeUrl = "{{ route('teeth.store',$patient->id) }}";
</script> --}}

<div class="page-content">
  
  <form action="{{ route('store.file')}}" method="POST">
    @csrf
    <input type="hidden" name="program_id" id="program_id" value="{{$program->id}}">
    <input type="hidden" name="patient_id" id="patient_id" value="{{$patient->id}}">
    @include('sessions.inc.patient-info')

    @include('sessions.inc.teeth-details-form')

    @include('sessions.inc.session-details-form')
    @include('sessions.inc.prescription-form')
  </form>
</div>

@endsection

{{-- Scripts --}}
@section('js_files')

<script>  var teeth = {!! $patient->teeth !!}; </script>
<script src="/js/showTeeth.js"></script>
<script>
  showTeethConditions();
</script>

<script>
    var storeUrl = "{{ route('sessions.store') }}";
    var patientId = {!! $patient->id !!} ;
</script>
<script src="/js/createTeeth.js"></script>
@endsection