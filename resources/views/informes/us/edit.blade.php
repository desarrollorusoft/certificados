@extends('layouts.enod.master')


@section('css')

<link rel="stylesheet"  href="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet"  href="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
   
@endsection


@section('contenido') 
 <div id="app">

   

  <informe-us  
   
     metodo ="{{$metodo}}"
     :otdata  ="{{$ot}}"
     :informedata ="{{$informe}}"    
     :informe_usdata ="{{$informe_us}}"
     :materialdata="{{$informe_material}}"
     :diametrodata="{{$informe_diametro}}"
     :diametro_espesordata="{{$informe_diametroEspesor}}"
     :interno_equipodata="{{$informe_interno_equipo}}"
     :tecnicadata="{{$informe_tecnica}}" 
     :procedimientodata="{{$informe_procedimiento}}" 
     :norma_evaluaciondata="{{$informe_norma_evaluacion}}"
     :norma_ensayodata="{{$informe_norma_ensayo}}"
     :ejecutor_ensayodata="{{$informe_ejecutor_ensayo}}"
     :estado_superficiedata="{{$informe_estado_superficie}}"
     :calibraciones_data = "{{ $calibraciones}}"
     :tabla_us_pa_data = "{{ $tabla_us_pa}}"
     :tabla_me_data = "{{ $tabla_me}}"
     editmode  
    
  ></informe-us>

 </div>

@endsection


@section('script')

<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'user' => Auth::user()
    ]) !!};
</script>

    <script type="text/javascript" src="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/lodash.js')}}"></script>





@endsection