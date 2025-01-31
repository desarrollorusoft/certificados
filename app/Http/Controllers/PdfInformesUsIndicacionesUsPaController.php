<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Informe;
use App\InformesUs;
use App\Ots;
use App\Clientes;
use App\Materiales;
use App\NormaEnsayos;
use App\NormaEvaluaciones;
use App\OtOperarios;
use App\OtProcedimientosPropios;
use App\InternoEquipos;
use App\Documentaciones;
use App\Iluminaciones;
use App\DiametrosEspesor;
use App\Contratistas;
use App\Tecnicas;
use App\EstadosSuperficies;
use App\DetalleUsPaUs;
use App\User;
use App\OtTipoSoldaduras;
use App\MetodoEnsayos;
use App\FirmaUsuario;

class PdfInformesUsIndicacionesUsPaController extends Controller
{
    public function imprimir($id){

        /* header */

        $informe = Informe::findOrFail($id);
        $numero_repetido = $informe->numero_repetido;

        $metodo_ensayo = MetodoEnsayos::find($informe->metodo_ensayo_id);
         $informe_us = InformesUs::where('informe_id',$informe->id)->firstOrFail();
         $ot = Ots::findOrFail($informe->ot_id);
         $cliente = Clientes::findOrFail($ot->cliente_id);
         $ot_tipo_soldadura = OtTipoSoldaduras::where('id',$informe->ot_tipo_soldadura_id)->with('Tiposoldadura')->first();
         $material = Materiales::findOrFail($informe->material_id);
         $norma_ensayo = NormaEnsayos::findOrFail($informe->norma_ensayo_id);
         $norma_evaluacion = NormaEvaluaciones::findOrFail($informe->norma_evaluacion_id);
         $ot_procedimiento_propio = OtProcedimientosPropios::findOrFail($informe->procedimiento_informe_id);
         $procedimiento_inf = Documentaciones::findOrFail($ot_procedimiento_propio->documentacion_id);
         $diametro_espesor = $informe->diametro_espesor_id ? DiametrosEspesor::findOrFail($informe->diametro_espesor_id) : null;
         $tecnica = Tecnicas::findOrFail($informe->tecnica_id);
         $interno_equipo = InternoEquipos::findOrFail($informe->interno_equipo_id)->with('equipo')->first();
         $ot_operador = OtOperarios::findOrFail($informe->ejecutor_ensayo_id);
         $ejecutor_ensayo = User::findOrFail($ot_operador->user_id);
         $evaluador = User::find($informe->firma);
         $firma = (new \App\Http\Controllers\UserController)->getFirma($informe->firma,$metodo_ensayo->id);
         $contratista = Contratistas::find($ot->contratista_id);
         $estado_superficie = EstadosSuperficies::find($informe_us->estado_superficie_id);
         $indicaciones_us_pa = DetalleUsPaUs::where('informe_us_id',$informe_us->id)->get();

         /*  Encabezado */

         $titulo = "INFORME DE ULTRASONIDO"." (" . mb_strtoupper($tecnica->descripcion,"UTF-8") . ")";

         $nro = $numero_repetido === 1 ? FormatearNumeroInforme($informe->numero,$tecnica->codigo) .' - Rev.'. FormatearNumeroConCeros($informe->revision,2) : FormatearNumeroInforme($informe->numero,$tecnica->codigo) .'-'.$numero_repetido .' - Rev.'. FormatearNumeroConCeros($informe->revision,2) ;
         $fecha = date('d-m-Y', strtotime($informe->fecha));
         $tipo_reporte = "INFORME N°";

         $pdf = PDF::loadView('reportes.informes.us-indicaciones-us-pa-v2',compact('ot','titulo','nro','tipo_reporte','fecha','metodo_ensayo',
                                                                'norma_ensayo',
                                                                'norma_evaluacion',
                                                                'procedimiento_inf',
                                                                'diametro_espesor',
                                                                'ot_tipo_soldadura',
                                                                'tecnica',
                                                                'interno_equipo',
                                                                'ejecutor_ensayo',
                                                                'cliente',
                                                                'contratista',
                                                                'informe',
                                                                'informe_us',
                                                                'material',
                                                                'numero_repetido',
                                                                'estado_superficie',
                                                                'indicaciones_us_pa',
                                                                'evaluador',
                                                                'firma',

                                                                ))->setPaper('a4','portrait')->setWarnings(false);


           return $pdf->stream();
}
}
