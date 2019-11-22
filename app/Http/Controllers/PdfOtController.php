<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ots;
use App\Clientes;
use App\Http\Controllers\OtServiciosController;
use App\Contactos;
use App\Localidades;
use App\Provincias;
use App\Http\Controllers\OtProductosController;
use App\Repositories\MetodoEnsayos\MetodoEnsayosRepository;
use App\Http\Controllers\MetodoEnsayosController;
use App\Contratistas;

class PdfOtController extends Controller
{
  
    public function imprimir($id){

        $ot = Ots::find($id);
        $contacto1 = Contactos ::find($ot->contacto1_id);
        $contacto2 = Contactos ::find($ot->contacto2_id);
        $contacto3 = Contactos ::find($ot->contacto3_id);

        

        $responsable_ot = User :: find($ot->responsable_ot_id);
        $generador_ot = User:: find($ot->user_id);
        $cliente = Clientes::find($ot->cliente_id);   
        $localidad = Localidades::find($ot->localidad_id);
        $provincia = Provincias::find($localidad->provincia_id); 
        $geo = 'https://www.google.com/maps/search/?api=1&query='.$ot->lat.','.$ot->lon;
      
        
        $MetodoEnsayosRepository = new MetodoEnsayosRepository();
        $metodos_ensayos = (new MetodoEnsayosController($MetodoEnsayosRepository))->otMetodosEnsayo($ot->id);
        
        $ot_servicios = (new OtServiciosController)->show($ot->id);
        $ot_productos = (new OtProductosController)->show($ot->id);
        $ot_epps = (new OtEppsController)->show($ot->id);
        $ot_riesgos = (new OtRiesgosController)->show($ot->id);
        $ot_calidad_placas = (new OtCalidadPlacasController)->show($ot->id);    
        $evaluador = User::find($ot->firma);  
        $contratista = Contratistas::find($ot->contratista_id);

        $pdf = \PDF::loadView('reportes.ots.ot',compact('ot',
                                                        'cliente',
                                                        'contratista',
                                                        'ot_calidad_placas',
                                                        'ot_servicios',
                                                        'ot_productos',
                                                        'ot_epps',
                                                        'ot_riesgos',
                                                        'contacto1',
                                                        'contacto2',
                                                        'contacto3',
                                                        'responsable_ot',
                                                        'generador_ot',
                                                         'localidad',
                                                         'provincia',
                                                         'metodos_ensayos',
                                                         'geo',
                                                         'evaluador'))->setPaper('a4','portrait')->setWarnings(false);

        return $pdf->stream();
        
    }



}
