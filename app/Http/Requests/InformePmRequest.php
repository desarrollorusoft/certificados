<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformePmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $concentracion_max = $this->metodo_trabajo_pm['concentracion_max'];
        $concentracion_min = $this->metodo_trabajo_pm['concentracion_min'];

        $condicional = [      
           
         'concentracion' => 'required|numeric|between:'. $concentracion_min . ','. $concentracion_max 
            
        ];

        $validacion = [

            'numero_inf'                =>'required | integer| digits_between:1,3',
            'fecha'                     => 'required',
            'componente'                => 'required|Max:20',
            'material'                  => 'required',
            'plano_isom'                => 'required|Max:10',
            'diametro'                  => 'required',
            'procedimiento_soldadura'   => 'required|Max:20', 
            'eps'                       => 'Max:30',
            'pqr'                       => 'Max:30',             
            'tecnica'                   => 'required',  
            'vehiculo'                  => 'Max:20',
            'aditivo'                   => 'Max:20',          
            'procedimiento'             => 'required',         
            'norma_evaluacion'          => 'required',
            'norma_ensayo'              => 'required',  
            'tipo_magnetizacion'        => 'required',  
            'magnetizacion'             => 'required', 
            'color_particula'           => 'required', 
            'iluminacion'               => 'required', 
            'desmagnetizacion_sn'       => 'required', 
            'voltaje'                   => 'required', 
            'am'                        => 'required',            
            'ejecutor_ensayo'           => 'required',
            'observaciones'             => 'Max:250',  
            'detalles.*.detalle'        => 'required|Max:250',         
            'detalles.*.pieza'          => 'required|Max:10',
            'detalles.*.numero'         => 'required|integer',
            
        ];

    $validacion_completa =array_merge($condicional,$validacion);

    return $validacion_completa;
   
    }

    public function attributes()
    {
        return [
            'numero_inf'                  => 'número de informe',    
            'norma_evaluacion'            => 'norma evaluación',
            'norma_ensayo'                => 'norma ensayo',
            'ejecutor_ensayo'             => 'ejecutor ensayo',  
            'procedimiento_soldadura'     => 'procedimiento soldadura', 
            'tipo_magnetizacion'          => 'tipo magnetización',
            'detalles.*.detalle'          => 'detalle',
            'detalles.*.pieza'            => 'pieza',
            'detalles.*.numero'           => 'número', 
            'desmagnetizacion_sn'         => 'desmagnetización',    
            ];
    }
}