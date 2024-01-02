<table width="100%">
    <tbody>
        <tr>
            <td style="border: 1px solid #000;background:#D8D8D8;text-align: center;" >
            REGISTRO DE MEDICIONES
        </td>
        </tr>
    </tbody>
</table>

@foreach ($informes_us_me as $informe_us_me)

        @php
            $pos_gen = 1;
            $pos_pos = 1;
            $max_cant_genetratices_fila = $informe_us_me->cantidad_generatrices_linea_pdf_me;
            $genetratrices_fila = $max_cant_genetratices_fila;
        @endphp

        <table style="margin-top: 15px">
            <tbody>
                <tr>
                    <td style="font-size: 14px;height:20px;"><span style="margin-left: 1px;"><strong>{{ strtoupper($informe_us_me->elemento_me)}}</strong> </span></td>
                </tr>
                <tr>
                    <td style="font-size: 14px;height:20px;"><span style="margin-left: 1px;"><strong>Ø : {{ $informe_us_me->diametro_me}}</strong> </span></td>
                </tr>
            </tbody>
        </table>

        @while($pos_gen <= $informe_us_me->cantidad_generatrices_me)
            <table class="bordered">
                <thead>
                    <tr>
                        <th style="font-size: 13px; text-align: left;width:28px;text-align: center;background:#D8D8D8"  class="bordered-td">&nbsp;</th>
                        @while( ($pos_gen <= $genetratrices_fila) && ($pos_gen <= $informe_us_me->cantidad_generatrices_me))
                                <th style="font-size: 13px; text-align: left;width:28px;text-align: center;background:#D8D8D8" class="bordered-td">
                                    {{ $informe_us_me->mediciones[$pos_gen][0] }}
                                </th>
                                {{ $pos_gen = $pos_gen + 1}}
                        @endwhile
                        @if ($pos_gen == $informe_us_me->cantidad_generatrices_me + 1)
                            <th style="font-size: 13px; text-align: left;width:28px;text-align: center;background:#D8D8D8" class="bordered-td">
                                {{ $informe_us_me->mediciones[$pos_gen][0] }}
                            </th>
                        @endif
                        {{ $genetratrices_fila = $genetratrices_fila + $max_cant_genetratices_fila }}
                    </tr>
                  </thead>
                  <tbody>

                      @for ($pos_pos_fila = 1 ; $pos_pos_fila <= $informe_us_me->cantidad_posiciones_me; $pos_pos_fila++)
                        {{ $pos_gen_fila = ($genetratrices_fila - (2*$max_cant_genetratices_fila)+1) }}
                        <tr>
                            <td style="font-size: 13px; text-align: left;width:28px;text-align: center" class="bordered-td">
                                {{ $informe_us_me->mediciones[0][$pos_pos_fila] }}
                            </td>
                            @while ($pos_gen_fila < $pos_gen)
                                @if ($informe_us_me->mediciones[$pos_gen_fila][$pos_pos_fila])
                                    @if ($informe_us_me->mediciones[$pos_gen_fila][$pos_pos_fila] == -1)
                                        <td style="font-size: 13px; text-align: left;width:28px;text-align: center" class="bordered-td">
                                            S/A
                                        </td>
                                   @elseif(($informe_us_me->espesor_minimo_me) && (strval($informe_us_me->mediciones[$pos_gen_fila][$pos_pos_fila]) < strval($informe_us_me->espesor_minimo_me)))
                                        <td style="font-size: 13px; text-align: left;width:28px;text-align: center;color:red" class="bordered-td">
                                            {{ $informe_us_me->mediciones[$pos_gen_fila][$pos_pos_fila] }}
                                        </td>
                                   @else
                                        <td style="font-size: 13px; text-align: left;width:28px;text-align: center" class="bordered-td">
                                            {{ $informe_us_me->mediciones[$pos_gen_fila][$pos_pos_fila] }}
                                        </td>
                                   @endif
                                @else
                                <td style="font-size: 13px; text-align: left;width:28px;text-align: center" class="bordered-td">
                                  -
                                </td>
                                @endif
                            {{ $pos_gen_fila = $pos_gen_fila + 1 }}
                            @endwhile
                            @if ($pos_gen_fila == $informe_us_me->cantidad_generatrices_me + 1)
                                <td style="font-size: 13px; text-align: left;width:28px;text-align: center;background:#D8D8D8" class="bordered-td">
                                    @if ($informe_us_me->mediciones[$pos_gen_fila][$pos_pos_fila])
                                        {{$informe_us_me->mediciones[$pos_gen_fila][$pos_pos_fila]->codigo }}
                                    @else
                                    &nbsp;
                                    @endif
                                </td>
                            @endif
                        </tr>

                    @endfor
                </tbody>
            </table>
        @endwhile
@endforeach


@if( $informe_us->path1_indicacion || $informe_us->path2_indicacion )
<div class="page_break"></div>
<table width="100%">
    <tbody>
        <tr>
            <td style="border: 1px solid #000;background:#D8D8D8;text-align: center;" >
           IMAGENES INDICACIONES
        </td>
        </tr>
    </tbody>
</table>
<table style="text-align: center;margin-top: 5px;" width="100%" >
    <tbody>
        <tr>
            <td>
                <table>
                    <tbody>
                        <tr>
                            <td style="text-align: center; width: 680px;height: 275px;">

                                @if ($informe_us->path1_indicacion)
                                    <img src="{{ public_path($informe_us->path1_indicacion) }}" alt="" style="width: 700px;height: 270px;">
                                @endif

                            </td>

                        </tr>
                        <tr>
                            <td style="text-align: center; width: 680px;height: 275px;">

                                @if ($informe_us->path2_indicacion)
                                    <img src="{{ public_path($informe_us->path2_indicacion) }}" alt="" style="width: 700px;height: 270px;">
                                @endif

                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
@endif

@if($informe_us->path3_indicacion || $informe_us->path4_indicacion)
<div class="page_break"></div>
<table width="100%">
    <tbody>
        <tr>
            <td style="border: 1px solid #000;background:#D8D8D8;text-align: center;" >
           IMAGENES INDICACIONES
        </td>
        </tr>
    </tbody>
</table>
<table style="text-align: center;margin-top: 5px;" width="100%" >
    <tbody>
        <tr>
            <td>
                <table>
                    <tbody>
                        <tr>
                            <td style="text-align: center; width: 680px;height: 275px;">

                                @if ($informe_us->path3_indicacion)
                                    <img src="{{ public_path($informe_us->path3_indicacion) }}" alt="" style="width: 700px;height: 270px;">
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; width: 680px;height: 275px;">

                                @if ($informe_us->path4_indicacion)
                                    <img src="{{ public_path($informe_us->path4_indicacion) }}" alt="" style="width: 700px;height: 270px;">
                                @endif

                            </td>

                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
@endif