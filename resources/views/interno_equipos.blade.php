@extends('layouts.enod.master')

@section('contenido')

<div id="app">

   <abm-maestro modelo= "interno_equipos" ></abm-maestro>

</div>
@endsection


@section('script')

<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'user' => Auth::user()
    ]) !!};
</script>

@endsection