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
use App\CalibracionesUs;
use App\DetalleUsPaUs;
use App\User;

class PdfInformesUsIndicacionesUsPaController extends Controller
{
    public function imprimir($id){      

        /* header */
      
         $informe = Informe::findOrFail($id);       
         $informe_us = InformesUs::where('informe_id',$informe->id)->firstOrFail();
         $ot = Ots::findOrFail($informe->ot_id);
         $cliente = Clientes::findOrFail($ot->cliente_id);           
         $material = Materiales::findOrFail($informe->material_id);   
         $norma_ensayo = NormaEnsayos::findOrFail($informe->norma_ensayo_id);   
         $norma_evaluacion = NormaEvaluaciones::findOrFail($informe->norma_evaluacion_id); 
         $ot_procedimiento_propio = OtProcedimientosPropios::findOrFail($informe->procedimiento_informe_id);
         $procedimiento_inf = Documentaciones::findOrFail($ot_procedimiento_propio->documentacion_id);       
         $diametro_espesor = DiametrosEspesor::findOrFail($informe->diametro_espesor_id);
         $tecnica = Tecnicas::findOrFail($informe->tecnica_id);
         $interno_equipo = InternoEquipos::findOrFail($informe->interno_equipo_id)->with('equipo')->first(); 
         $ot_operador = OtOperarios::findOrFail($informe->ejecutor_ensayo_id);
         $ejecutor_ensayo = User::findOrFail($ot_operador->user_id);
         $evaluador = User::find($informe->firma);
         $contratista = Contratistas::find($ot->contratista_id);
         $estado_superficie = EstadosSuperficies::find($informe_us->estado_superficie_id);
         $indicaciones_us_pa = DetalleUsPaUs::where('informe_us_id',$informe_us->id)->get();
       
        $pdf = PDF::loadView('reportes.informes.us-indicaciones-us-pa',compact('ot',
                                                                'norma_ensayo',
                                                                'norma_evaluacion',
                                                                'procedimiento_inf',                                                               
                                                                'fuente',
                                                                'diametro_espesor',
                                                                'tecnica',
                                                                'interno_equipo',
                                                                'ejecutor_ensayo',
                                                                'cliente',
                                                                'contratista',
                                                                'informe',
                                                                'informe_us',
                                                                'material',
                                                                'estado_superficie',
                                                                'indicaciones_us_pa',
                                                                'evaluador'
                                                        
                                                                ))->setPaper('a4','portrait')->setWarnings(false);


           return $pdf->stream(); 
}
}