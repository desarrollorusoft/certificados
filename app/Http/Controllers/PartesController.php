<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ParteRequest;
use App\Ots;
use App\Partes;
use App\ParteDetalles;
use App\ParteOperadores;
use App\Medidas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
use App\Informes;
use \stdClass;


class PartesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($ot_id)
    {
        $user = auth()->user()->name;
        $header_titulo = "Parte Diario";
        $header_descripcion ="Crear";         
        $ot = Ots::findOrFail($ot_id);      

        return view('partes.index', compact('ot',                                            
                                             'user',                                              
                                             'header_titulo',
                                             'header_descripcion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParteRequest $request)
    {
        $parte  = new Partes;          
       

        DB::beginTransaction();
        try {          
        
          $parte  = $this->saveParte($request,$parte);
          $this->saveResponsables($request->responsables,$parte);
          $this->saveParteDetalleRi($request->informes_ri,$parte);
         
          DB::commit(); 
    
        } catch (Exception $e) {
    
          DB::rollback();
          throw $e;      
          
        }
    }

    public function saveResponsables($responsables, $parte){

          $parte_id = $parte->id;
             
                $ot_operarios = ParteOperadores::where('parte_id',$parte_id)->get();

                foreach ($ot_operarios as $ot_operario) {
                  $existe = false;
                    foreach ($responsables as $responsable) {

                        if( ($ot_operario['user_id'] == $responsable['user']['id'])){
                          $existe = true;
                        }
                  
                    }

                  if (!$existe){
                    ParteOperadores::where('parte_id',$parte_id)
                                    ->where('user_id',$ot_operario['user_id'])
                                    ->delete();
                    }
                }
             
               foreach ( $responsables as $responsable) {

                    $ot_operarios_update =ParteOperadores::firstOrCreate(
                        ['parte_id' =>  $parte_id,'user_id' => $responsable['user']['id'],'responsabilidad'=>$responsable['responsabilidad']],
                        ['parte_id' =>  $parte_id,'user_id' => $responsable['user']['id'],'responsabilidad'=>$responsable['responsabilidad']]

                    );
       
                $ot_operarios_update->save();
                }
        /*
        foreach ($responsables as $responsable) {
           
            $parteOperador                   = new ParteOperadores;
            $parteOperador->parte_id         = $parte->id;            
            $parteOperador->user_id          = $responsable['operador']['id'];        
            $parteOperador->responsabilidad  = $responsable['responsabilidad'];     
            $parteOperador->save();
           
        }
        */
    }

    public function saveParte($request,$parte){

        $user_id = null;
        
        if (Auth::check())
        {
             $user_id = $userId = Auth::id();    
        }

        $parte->ot_id = $request->ot['id'];
        $parte->fecha = date('Y-m-d',strtotime($request->fecha));
        $parte->tipo_servicio = $request->tipo_servicio;
        $parte->horario = $request->horario;
        $parte->movilidad_propia_sn = $request->movilidad_propia_sn;
        $parte->patente = $request->patente;
        $parte->km_inicial = $request->km_inicial;
        $parte->km_final = $request->km_final;
        $parte->user_id = $user_id;
        $parte->observaciones = $request->observaciones;
        $parte->save();

       
        return $parte;
    }

    public function saveParteDetalleRi($informes_ri,$parte){

        foreach ($informes_ri as $informe) {
           
            $parteDetalle  = new ParteDetalles;
            $parteDetalle->parte_id = $parte->id;            
            $parteDetalle->informe_id =$informe['id'];   
            $parteDetalle->costura_original = $informe['costura_original'];      
            $parteDetalle->costura_final = $informe['costura_final'];
            $parteDetalle->pulgadas_original = $informe['pulgadas_original'];
            $parteDetalle->pulgadas_final = $informe['pulgadas_final'];          
            $parteDetalle->placas_original = $informe['placas_original']; 
            $parteDetalle->placas_final = $informe['placas_final'];            
            $parteDetalle->cm = $informe['cm']['id'];      
     
            $parteDetalle->save();

            (new \App\Http\Controllers\InformesController)->setParteId($parte->id,$informe['id']);
           
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ot_id,$id)
    {
        $header_titulo = "Parte Diario";
        $header_descripcion ="Editar";       
        $accion = 'edit';      
        $user = auth()->user()->name;
        $parte = Partes::findOrFail($id);
        $ot = Ots::findOrFail($ot_id);

        
        $responsables = ParteOperadores::where('parte_operadores.parte_id',$id)
                                        ->select('parte_operadores.*')
                                        ->with('user')
                                        ->get();

        $informes_ri  = DB::table('parte_detalles')
                            ->join('informes','informes.id','=','parte_detalles.informe_id')
                            ->join('metodo_ensayos','metodo_ensayos.id','=','informes.metodo_ensayo_id')                            
                             ->where('parte_detalles.parte_id',$id)
                             ->selectRaw('parte_detalles.* , 0 as informe_sel,CONCAT(metodo_ensayos.metodo,LPAD(informes.numero, 3, "0")) as numero_formateado,DATE_FORMAT(informes.fecha,"%d/%m/%Y")as fecha_formateada')
                             ->get();
                             
         foreach ($informes_ri as $informe_ri) {

            $obj = new stdClass();
            $obj = Medidas::find($informe_ri->cm);
            $informe_ri->cm = $obj;
            
         }               
        

        return view('partes.edit', compact('parte',
                                            'responsables',
                                            'informes_ri',
                                            'ot',                                            
                                            'user',                                              
                                            'header_titulo',
                                            'header_descripcion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParteRequest $request, $id)
    {
        $parte  = Partes::find($id);  
        DB::beginTransaction();
        try {    
           
            $parte  = $this->saveParte($request,$parte);
            $this->saveResponsables($request->responsables,$parte);
            $this->saveParteDetalleRi($request->informes_ri,$parte);
            ParteDetalles::where('parte_id',$parte->id)->delete();
            $this->saveParteDetalleRi($request->informes_ri,$parte);
            
            DB::commit();
            
            } catch (Exception $e) {
    
            DB::rollback();
            throw $e;      
            
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getInformeRiParte($id){

        $informe_ri = DB::select('select
                                    COUNT(DISTINCT(juntas.codigo)) as costuras,
                                    diametros_espesor.diametro as pulgadas,       
                                    COUNT(posicion.id) as placas
                                    FROM informes 
                                    
                                    inner join informes_ri on informes.id = informes_ri.informe_id
                                    left join juntas on juntas.informe_ri_id = informes_ri.id
                                    left join posicion on posicion.junta_id = juntas.id
                                    inner join diametros_espesor on informes.diametro_espesor_id = diametros_espesor.id
                                    WHERE
                                    informes.id=:id group by diametro',['id' => $id ]);

      $informe_ri = Collection::make($informe_ri);


      return $informe_ri;

    }

}