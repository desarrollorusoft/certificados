@extends('layouts.enod.master')

@section('contenido')

<div class="ayuda_enod">
       <div class="row">
			<div class="col-sm-12">
			  <h1>Generar informes RI<br></h1>
			  <p></p>
			  <h2>Encabezados<br></h2>
			  <p>Al ingresar a generar el informe, si es que la OT está generada como <strong>Multiobra</strong>, es necesario especificar a que obra corresponde el informe en el encabezado principal: </p>
			 </div>

			 <div class="col-sm-8 col-sm-offset-2">
            	  <img  class="img-responsive" src="{{ asset('img/ayuda/Encabezado_principal.PNG') }}" />
 			</div>
		   	<div class="col-sm-12">
				<p>Luego, hay que especificar, en la carga del segundo encabezado, si el informe RI corresponde a <strong>Planta</strong> o a <strong>Ducto</strong>. Si bién la carga de datos es similar, hay que remarcar que la numeración del informe difiere.<br>
				Para <strong>Ducto</strong>, depende del <strong>PK y Tipo Soldadura </strong> (previamente definidos en los precedimientos del cliente) que se antepone al Tipo de informe y a un número correlativo por OT.<br>
				Para <strong>Planta</strong>, los campos <strong>PK y Tipo Soldadura </strong> (de debe definir al menos un tipo de soldadura) están deshabilitados y el número de informe es simplemente el Tipo de informe y un número correlativo por OT.<br>
				Ejemplo:<br></p>
			</div>
			<div class="col-sm-8 col-sm-offset-2">
            	  <p>  <strong>N° informe Ducto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> <strong>N° informe Planta</strong>    </p>
				  <p>  &nbsp;150-LR-RI001 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; RI001 <br> </p>
			</div>
		   <div class="col-sm-12">
			   <p>Ahora es momento de completar cada uno de los campos del siguiente cuadro teniendo en cuenta que los que tienen un asterisco (*), son datos obligatorios:<br></p>
		   </div>
		   <div class="col-sm-8 col-sm-offset-2">
            	  <img  class="img-responsive" src="{{ asset('img/ayuda/Encabezado_RI.PNG') }}" />
 			</div>
			<div class="col-sm-12">
			<p>Tener en cuenta:</p>
			<ul>
				<li><strong>Tipo Sol:</strong> En el caso de <strong>Ducto</strong> se debe seleccionar uno de los tipos de soldaduras especificados en procedimientos de clientes para la <strong>obra</strong>. Se completará automáticamente EPS y PQR. En caso de ser un informe de <strong>Reparación</strong>, es necesario seleccionar el check R y debe estar espcificado para la <strong>obra</strong>, el tipo de soldadura <strong>R</strong> con sus respectivos EPS y PQR.
				<img  class="img-responsive" src="{{ asset('img/ayuda/pk_sol.PNG') }}" </li>
				<li><strong>Espesor:</strong> Si el espesor deseado, no está disponible en la lista, es posible editar y colocar el deseado. </li>
				<li><strong>EPS:</strong> Seleccionar uno de los <strong>EPS</strong> definidos para <strong>Planta</strong>. Se completará automáticamente <strong>PQR</strong>.(sólo para Planta)</li>
				<li><strong>PQR:</strong> Existe la posibilidad de seleccionar uno de los <strong>PQR</strong> definidos para <strong>Planta</strong>.  Se completará automáticamente <strong>EPS</strong>.(sólo para Planta)  </li>
				<li><strong>Equipo:</strong> La selección del equipo empleado, autocompleta los datos de la fuente que contiene o Kv y mA en caso de ser un equipo RX.</li>
				<li><strong>Técnica:</strong> Según la que se seleccione, se visualizará el gráfico y se calcula la distancia fuente/film.</li>
			</ul>
			<h2>Modelos 3D<br></h2>
			<p>Esta sección permite seleccionar uno o mas modelos 3D, que deben existir en el repositorio de modelos. En los informes pdf, se visualiza una captura de imagen y la posibilidad de visualizar el modelo en el visualizador 3D</p>
			</div>
			<div class="col-sm-8 col-sm-offset-2">
            	  <img  class="img-responsive" src="{{ asset('img/ayuda/Modelo_3d.PNG') }}" />
 			</div>
		   <div class="col-sm-12">
		   	<h2>Elementos/posiciones<br></h2>
			<p>Esta sección es donde se cargan los elementos o costuras, con las distinas posiciones de placa y la densidad correspondiente. Para facilitar la operatoria, se incluye la <strong> clonación</strong>, que permite replicar en una nueva costura, las posiciones de placas existentes. El formato de las posiciones debe ser <strong>n-n</strong> o una <strong>letra</strong> para el caso de los diámetros mas chicos.<br> Cuando se trate de un informe de <strong>Reparación</strong> en el campo <strong>Elemento</strong> se despliega una lista, solo con las costuras rechazadas en la <strong>Pk</strong> actual.<br>Ver ejemplo:</p>
			</div>
			<div class="col-sm-8 col-sm-offset-2">
            	  <img  class="img-responsive" src="{{ asset('img/ayuda/Agregar_costuras.gif') }}" />
 			</div>
		   	<div class="col-sm-12">
		   	<h2>Indicaciones<br></h2>
			<p>Esta sección es donde se cargan las <strong>indicaciones</strong> y los <strong>rechazos</strong> de la posición de placa que esta seleccionada en la seccion anterior. El sistema considera indicación cuando <strong>NO</strong> se especifica posición de la anomalía. Al especificarse posición, el sistema lo considera <strong>Rechazo</strong> y marca la costura cargada en la sección anterior como no aceptable (el usuario puede manualmente modificar este estado). Las posiciones de los defectos deben cargarse en el mismo formato que se cargaron las posiciones de placa, <strong>n-n</strong> (debe estar dentro del rango de la poscion de placa) o <strong>letra</strong>( misma letra que se especificó la placa.<br> y ademas es necesario indicar si es  un defecto de  <strong>RAIZ</strong>, (1° pasada) <strong>RELLENO</strong> (pasadas intermedias) o <strong>SOBREMONTA</strong> (última pasada), Ver ejemplo:</p>
			</div>
			<div class="col-sm-8 col-sm-offset-2">
            	  <img  class="img-responsive" src="{{ asset('img/ayuda/Agregar_indicaciones.gif') }}" />
 			</div>
		   	<div class="col-sm-12">
		   	<h2>Pasadas<br></h2>
			<p>Esta sección es donde se cargan los soldadores responsables de las costuras en cada pasada. Cuando estamos en un informe de <strong>Planta</strong> solo se permite registrar una pasada. En el caso de <strong>Ducto</strong> es posible registrar los soldadores de hasta seis pasadas.<br> Aquí, también existe las posibilidad de <strong>clonar</strong> los saldadores de todas las pasadas a partir de los registrados en una costura. Tener en cuenta que los soldadores deben estar asignados a la OT, para aparecer en la lista desplegable.<br> Ver ejemplo:</p>
			</div>
			<div class="col-sm-8 col-sm-offset-2">
            	  <img  class="img-responsive" src="{{ asset('img/ayuda/Agregar_pasadas_manual.gif') }}" /><br>
 			</div>
		   <div class="col-sm-12">
			<p>Además, es posible importar todas las pasadas desde un achivo de CSV. Este archivo debe respetar el formato establecido y no es necesario que los codigos de soldadores, esten asociados a la OT y tampoco al cliente (se crean y asignan automáticamente). Tener en cuenta que el sistema solo importa el <strong>Pk</strong> que se indicó en el encabezado del informe <br> Ver ejemplo:</p>
			</div>
			<div class="col-sm-8 col-sm-offset-2">
            	  <img  class="img-responsive" src="{{ asset('img/ayuda/Agregar_pasadas_archivo.gif') }}" /><br>
 			</div>
		   	<div class="col-sm-12">
			<p>Por último, es posible ingresar una observacion y guardar el informe.</p>
			</div>
			<div class="col-sm-12">
				<h3>Artículos relacionados&nbsp;</h3>
				<p><a href="Ayuda_nueva_ot.html">Cómo crear una Orden de trabajo (OT)&nbsp;</a></p>
				<p><a href="Asignar_soldador.html">Asignar soldadores y usuarios de clientes a Orden de trabajo (OT)&nbsp;</a></p>
				<p><a href="crear_informes.html"> Creación de informes&nbsp;</a></p>
			</div>

        </div>
    </div>

@endsection