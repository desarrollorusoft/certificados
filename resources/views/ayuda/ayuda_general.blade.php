@extends('layouts.enod.master')

@section('contenido')

<a name="-tablero-principal" />

<div class="ayuda_enod">
       <div class="row">
        <div class="col-sm-12">
            <h1>AYUDA GENERAL</h1>
            <p><a href="{{ route('ayuda-cambiar-clave') }}">Cómo cambiar o restablecer la contraseña de tu cuenta&nbsp;</a></p>
			<p><a href="{{ route('ayuda-buscar-formularios') }}">Buscar en los formularios de la aplicación&nbsp;</a></p>
			<p><a href="{{ route('ayuda-visualizar-ot') }}">Visualización general de una Orden de trabajo (OT) &nbsp;</a></p>

		</div>
        <div class="col-sm-12">
          <h3>Tablero Principal&nbsp;</h3>
       	    <p><a href="{{ route('ayuda-crear-ot') }}">Cómo crear una Orden de trabajo (OT)&nbsp;</a></p> <!-- CLIENTE NO VE  -->

			<p><a href="{{ route('ayuda-asignar-soldadores-y-usuarios') }}">Asignar soldadores y usuarios de clientes a Orden de trabajo (OT)&nbsp;</a></p> <!-- CLIENTE NO VE  -->

			<p><a href="http://desarrollorusoft.com.ar" target="_blank"> Estados de una Orden de trabajo (OT)&nbsp;</a></p>

			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Asignar operadores a una Orden de trabajo (OT)&nbsp;</a></p> <!-- CLIENTE NO VE  -->

			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Visualizar documentación de operadores asignados a una Orden de trabajo (OT)&nbsp;</a></p>

			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Asignar vehículos y documentación complementaria a Orden de trabajo (OT)&nbsp;</a></p> <!-- CLIENTE NO VE  -->

			<p><a href="http://desarrollorusoft.com.ar" target="_blank"> Visualizar documentación de vehículos y documentación complementaria asigandos a Orden de trabajo (OT)&nbsp;</a></p>

			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Creación de remitos&nbsp;</a></p> <!-- CLIENTE NO VE  -->

			<p><a href="{{ route('ayuda-generar-informes') }}"> Creación de informes&nbsp;</a></p>
			<!-- CLIENTE NO VE  -->

			<p><a href="http://desarrollorusoft.com.ar" target="_blank"> Visualización de informes&nbsp;</a></p>

			<p><a href="http://desarrollorusoft.com.ar" target="_blank"> Creación de partes diarios&nbsp;</a></p>
			<!-- CLIENTE NO VE  -->

			<p><a href="http://desarrollorusoft.com.ar" target="_blank"> Visualización de partes diarios&nbsp;</a></p>

			<p><a href="http://desarrollorusoft.com.ar" target="_blank"> Creación de certificados&nbsp;</a></p>
			<!-- CLIENTE NO VE  -->

            <a name="-maestros" />
			<p><a href="http://desarrollorusoft.com.ar" target="_blank"> Visualización de certificados&nbsp;</a></p>
        </div>

        <div class="col-sm-12">
            <h3>Maestros&nbsp;</h3> <!-- CLIENTE NO VE  -->
            <p><a href="http://desarrollorusoft.com.ar" target="_blank">Consideraciones generales&nbsp;</a></p>

			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar usuarios&nbsp;</a></p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar clientes&nbsp;</a></p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar comitentes&nbsp;</a></p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar materiales&nbsp;</a></p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar normas&nbsp;</a></p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar documentaciones&nbsp;</a></p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar Unidades de medidas&nbsp;</a></p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar medidas&nbsp;</a></p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar servicios&nbsp;</a></p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar productos&nbsp;</a></p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar soldadores&nbsp;</a></p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar equipos&nbsp;</a></p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar interno equipos&nbsp;</a>
			</p>
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar fuentes&nbsp;</a></p>
            <p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar interno fuente&nbsp;</a></p>
            <a name="-dosimetria" />
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar roles&nbsp;</a></p>
        </div>

		<div class="col-sm-12">
          <h3>Dosimetría&nbsp;</h3>
          	<p><a href="http://desarrollorusoft.com.ar" target="_blank">Activar operador&nbsp;</a></p>
			<!-- CLIENTE NO VE  -->
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Como registrar dosimetría operador&nbsp;</a></p><!-- CLIENTE NO VE  -->
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Como registrar dosimetría RX&nbsp;</a></p><!-- CLIENTE NO VE  -->
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar estados film&nbsp;</a></p><!-- CLIENTE NO VE  -->
            <p><a href="http://desarrollorusoft.com.ar" target="_blank">Visualizar resumen dosimetría&nbsp;</a></p>
            <a name="-multimedia" />
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Visualizar reporte de altas y baja de film&nbsp;</a></p><!-- CLIENTE NO VE  -->
        </div>

		<div class="col-md-12">
          <h3>Multimedia&nbsp;</h3>
          	<p><a href="http://desarrollorusoft.com.ar" target="_blank">Gestionar contenido&nbsp;</a></p>
			<!-- CLIENTE NO VE  -->
			<p><a href="http://desarrollorusoft.com.ar" target="_blank">Visualizar contenido&nbsp;</a></p>
        </div>

      </div>
  </div>

@endsection