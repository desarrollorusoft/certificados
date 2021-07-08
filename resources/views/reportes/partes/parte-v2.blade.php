<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PARTE DIARIO Nº: {{ $nro }}</title>
    <link rel="stylesheet" href="{{ asset('/css/reportes/pdf.css') }}" media="all" />

</head>

<style>

    @page { margin: 260px 40px 233px 40px !important;
            padding: 0px 0px 0px 0px !important; }

header {
    position:fixed;
    top: -237px;
}

footer {
    position: fixed; bottom:0px;
    padding-top: 0px;
}

</style>

<body>
<header>
    @include('reportes.partial.header-principal-portrait')
    @include('reportes.partial.linea-amarilla')
    @include('reportes.partial.header-cliente-comitente-portrait')
    @include('reportes.partial.linea-gris')
    @include('reportes.partial.header-proyecto-parte-portrait')
    @include('reportes.partial.linea-amarilla')
</header>
<footer>

    @include('reportes.partial.linea-amarilla')
    @include('reportes.partial.observaciones')
    @include('reportes.partial.linea-amarilla')
    @include('reportes.partes.partial.firmas')
</footer>


<main>

    @include('reportes.partes.partial.header-detalle-parte')

    @if(count($vehiculos) > 0)

        @include('reportes.partial.linea-amarilla-fina')

        <table width="100%" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <td style="font-size: 12px;height: 20px; text-align: left;" colspan="6"><b>VEHÍCULOS</td>
                </tr>
                <tr>
                    <th style="font-size: 12px;height: 20px;width: 20px;text-align: left;">&nbsp;</th>
                    <th style="font-size: 12px;height: 20px;width: 140px;text-align: left;">Marca</th>
                    <th style="font-size: 12px;height: 20px;width: 140px;text-align: left;">Modelo</th>
                    <th style="font-size: 12px;height: 20px;width: 120px;text-align: left;">Tipo</th>
                    <th style="font-size: 12px;height: 20px;width: 120px;text-align: left;">Patente</th>
                    <th style="font-size: 12px;height: 20px;width: 80px;text-align: left;">Km inicial</th>
                    <th style="font-size: 12px;height: 20px;text-align: left;">km final</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehiculos as $vehiculo)
                    <tr>
                        <th style="font-size: 12px;height: 20px;width: 20px;text-align: left;">&nbsp;</th>
                        <td style="font-size: 12px;height: 20px;width: 140px;text-align: left;">{{$vehiculo->marca}}</td>
                        <td style="font-size: 12px;height: 20px;width: 140px;text-align: left;">{{$vehiculo->modelo}}</td>
                        <td style="font-size: 12px;height: 20px;width: 120px;text-align: left;">{{$vehiculo->tipo}}</td>
                        <td style="font-size: 12px;height: 20px;width: 120px;text-align: left;">{{$vehiculo->patente}}</td>
                        <td style="font-size: 12px;height: 20px;width: 80px;text-align: left;">{{$vehiculo->km_inicial}}</td>
                        <td style="font-size: 12px;height: 20px;text-align: left;">{{$vehiculo->km_final}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if(count($responsables) > 0)

        @include('reportes.partial.linea-amarilla-fina')

        <table width="100%" style="border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="font-size: 12px;height: 20px; text-align: left;" colspan="2"><b>RESPONSABLES</td>
                </tr>

                    @foreach ($responsables as $responsable)

                        @if($loop->odd)

                            <tr>
                            <td style="font-size: 12px;height: 20px; width:365px;">{{$responsable->nombre}} <em>({{ strtolower($responsable->responsabilidad)}})</em></td>
                        @else
                            <td style="font-size: 12px;height: 20px;">{{$responsable->nombre}} <em>({{ strtolower($responsable->responsabilidad)}})</em></td>
                            </tr>

                        @endif

                        @if ($loop->last && $loop->odd)
                            <td style="font-size: 12px;height: 20px;">&nbsp;</td>
                            </tr>
                        @endif
                    @endforeach

            </tbody>
        </table>
    @endif

    @if(count($servicios) > 0)

        @include('reportes.partial.linea-amarilla-fina')

        <table width="100%" style="margin-top: -5px;margin-bottom: 10px;">
            <tbody>

                <tr>
                    <td style="font-size: 12px;height: 30px;" colspan="3"><b>SERVICIOS: </b></td>
                </tr>
                <tr>

                    <td style="font-size: 12px;width: 100px;margin-left: 4px;"><b>Metodo Ensayo: </b></td>
                    <td style="font-size: 12px;width: 500px;" ><b>Descripción </b></td>
                    <td style="font-size: 12px;text-align: center;"><b>Cantidad </b></td>
                </tr>
                @foreach($servicios as $servicio)

                    @if (($estado == 'original' && $servicio->cant_original !='')||($estado == 'final' && $servicio->cant_final !=''))

                        <tr>

                            <td style="font-size: 12px;width: 100px;"><span>{{$servicio->metodo}}</span></td>
                            <td style="font-size: 12px;width: 500px;"><span>{{$servicio->servicio_descripcion}}</span> </td>
                            <td style="font-size: 12px;text-align: center;text-align: center;">

                                @if($estado == 'original')
                                    {{$servicio->cant_original}}
                                @else
                                    {{$servicio->cant_final}}
                                @endif

                            </td>
                        </tr>

                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- DETALLE INFORME RI -->

    @php
     $ExisteRI = false;
     $ExisteRIManual = false;
        if(count($informes_ri_adicionales) >0)
           $ExisteRIManual = true;
    @endphp

    @foreach ($parte_detalle as $item)

        @if ($item->metodo == 'RI')
            @php $ExisteRI = true; @endphp
        @endif

    @endforeach

    @if ($ExisteRI || $ExisteRIManual)
        @include('reportes.partial.linea-amarilla-fina')
        <table width="100%" style="margin-top: -5px;">
            </tbody>
                <tr>
                    <td style="font-size: 12px;height: 30px;" colspan="5"><b>METODO ENSAYO: RI </b></td>
                </tr>
                @if ($estado == 'original')
                    <tr>
                        <td style="font-size: 13px;height: 30px" colspan="5"><b style="margin-left: 6px;">Placas Repetidas Total: </b>{{ $parte->placas_repetidas }}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 13px;height: 30px" colspan="5"><b style="margin-left: 6px;">Placas Testigos Total: </b>{{ $parte->placas_testigos }}</td>
                    </tr>
                @endif
                    <tr>
                        <td style="font-size: 12px;width: 50px;">&nbsp;</td>
                        <td style="font-size: 12px;width: 180px; text-align: center;"><b>Costuras</b></td>
                        <td style="font-size: 12px;width: 180px; text-align: center;"><b>Pulgadas</b></td>
                        <td style="font-size: 12px;width: 180px; text-align: center;"><b>Placas</b></td>
                        <td style="font-size: 12px; text-align: center;"><b>Cm </b></td>
                    </tr>
                @foreach ($parte_detalle as $item)
                    @if ($item->metodo == 'RI')
                        <tr>
                            <td style="font-size: 12px;height: 20px;">{{$item->numero_formateado}}</td>
                            <td style="font-size: 12px; text-align: center;">{{$item->costura}}</td>
                            <td style="font-size: 12px; text-align: center;">{{$item->pulgadas}}</td>
                            <td style="font-size: 12px; text-align: center;">{{$item->placas}}</td>
                            <td style="font-size: 12px; text-align: center;">{{$item->cm}}</td>
                        </tr>
                    @endif
                @endforeach

                @foreach ($informes_ri_adicionales as $item)
                        <tr>
                            <td style="font-size: 12px;height: 20px;">MANUAL</td>
                            <td style="font-size: 12px; text-align: center;">{{$item->costura}}</td>
                            <td style="font-size: 12px; text-align: center;">{{$item->pulgadas}}</td>
                            <td style="font-size: 12px; text-align: center;">{{$item->placas}}</td>
                            <td style="font-size: 12px; text-align: center;">{{$item->cm}}</td>
                        </tr>

                @endforeach
            </tbody>
        </table>
    @endif



    <!-- DETALLE INFORME PM -->

    @php $ExistePM = false @endphp

    @foreach ($parte_detalle as $item)

        @if ($item->metodo == 'PM')
            @php $ExistePM = true @endphp
        @endif

    @endforeach

    @if ($ExistePM)
        @include('reportes.partial.linea-amarilla-fina')
        <table width="100%" style="margin-top: -5px;">
            <tbody>
                <tr>
                    <td style="font-size: 12px;height: 30px;" colspan="5"><b>METODO ENSAYO: PM </b></td>
                </tr>
                @foreach ($informes_detalle as $item)
                    @if ($item->metodo == 'PM')
                        <tr>
                            <td style="font-size: 12px;height: 20px;" colspan="5"><b style="margin-left: 8px;">{{$item->numero_formateado}} </b></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;width: 50px;">&nbsp;</td>
                            <td style="font-size: 12px;text-align: center;width: 180px;"><b>Elemento </b></td>
                            <td style="font-size: 12px;width: 180px;">&nbsp;</td>
                            <td style="font-size: 12px;width: 180px;">&nbsp;</td>
                            <td style="font-size: 12px;text-align: center;"><b>Cm</b></td>
                        </tr>
                        @foreach ($parte_detalle as $item_pm)
                            @if ($item->informe_id == $item_pm->informe_id)
                                <tr>
                                    <td style="font-size: 12px;text-align: center;">&nbsp;</td>
                                    <td style="font-size: 12px;text-align: center; ">{{$item_pm->pieza}}</td>
                                    <td style="font-size: 12px;text-align: center;">&nbsp;</td>
                                    <td style="font-size: 12px;text-align: center;">&nbsp;</td>
                                    <td style="font-size: 12px;text-align: center;">{{$item_pm->cm}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach

            </tbody>
        </table>
    @endif



    <!-- DETALLE INFORME LP -->

    @php $ExisteLP = false @endphp

    @foreach ($parte_detalle as $item)

        @if ($item->metodo == 'LP')
            @php $ExisteLP = true @endphp
        @endif

    @endforeach

    @if ($ExisteLP)
        @include('reportes.partial.linea-amarilla-fina')
        <table width="100%" style="margin-top: -5px;">
            <tbody>
                <tr>
                    <td style="font-size: 12px;height: 30px;" colspan="5"><b>METODO ENSAYO: LP </b></td>
                </tr>
                @foreach ($informes_detalle as $item)
                    @if ($item->metodo == 'LP')
                        <tr>
                            <td style="font-size: 12px;height: 20px;" colspan="5"><b style="margin-left: 8px;">{{$item->numero_formateado}} </b></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;text-align: center;width: 50px;"><b>&nbsp;</b></td>
                            <td style="font-size: 12px;text-align: center;width: 180px; "><b>Elemento </b></td>
                            <td style="font-size: 12px;width: 180px;">&nbsp;</td>
                            <td style="font-size: 12px;width: 180px;">&nbsp;</td>
                            <td style="font-size: 12px;text-align: center;"><b>Cm</b></td>
                        </tr>
                        @foreach ($parte_detalle as $item_lp)
                            @if ($item->informe_id == $item_lp->informe_id)
                                <tr>
                                    <td style="font-size: 12px;text-align: center;"><b>&nbsp;</b></td>
                                    <td style="font-size: 12px;text-align: center; ">{{$item_lp->pieza}}</td>
                                    <td style="font-size: 12px;text-align: center;">&nbsp;</td>
                                    <td style="font-size: 12px;text-align: center;">&nbsp;</td>
                                    <td style="font-size: 12px;text-align: center;">{{$item_lp->cm}}</td>
                                </tr>
                                @endif
                            @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif




    <!-- DETALLE INFORME US -->

    @php $ExisteUS = false @endphp

    @foreach ($parte_detalle as $item)

        @if ($item->metodo == 'US')
            @php $ExisteUS = true @endphp
        @endif

    @endforeach


    @if ($ExisteUS)
        @include('reportes.partial.linea-amarilla-fina')
        <table width="100%" style="margin-top: -5px;">
            <tbody>
                @if ($ExisteUS)
                    <tr>
                        <td style="font-size: 12px;height: 30px;" colspan="5"><b>METODO ENSAYO: US </b></td>
                    </tr>
                    @foreach ($informes_detalle as $item)
                        @if ($item->metodo == 'US')
                            <tr>
                                <td style="font-size: 12px;height: 20px;" colspan="5"><b style="margin-left: 8px;">{{$item->numero_formateado}} </b></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px;text-align: center;width: 50px;"><b>&nbsp;</b></td>
                                <td style="font-size: 12px;text-align: center;width: 180px; "><b>Elemento </b></td>
                                <td style="font-size: 12px;text-align: center;width: 180px;"><b>Diametro </b></td>
                                <td style="font-size: 12px;width: 180px;">&nbsp;</td>
                                <td style="font-size: 12px;text-align: center;"><b>Cm</b></td>
                            </tr>
                            @foreach ($parte_detalle as $item_us)
                                @if ($item->informe_id == $item_us->informe_id)
                                    <tr>
                                        <td style="font-size: 12px;text-align: center;"><b>&nbsp;</b></td>
                                        <td style="font-size: 12px;text-align: center; ">{{$item_us->pieza}}</td>
                                        <td style="font-size: 12px;text-align: center;">{{$item_us->pulgadas}}</td>
                                        <td style="font-size: 12px;text-align: center;">&nbsp;</td>
                                        <td style="font-size: 12px;text-align: center;">{{$item_us->cm}}</td>
                                    </tr>
                                    @endif
                                @endforeach
                        @endif
                    @endforeach

                @endif
            </tbody>
        </table>
    @endif
</main>

@include('reportes.partial.nro_pagina')

<script type="text/php">

    if ( isset($pdf) ) {
        $x = 518;
        $y = 78;
        $text = "RG.62 Rev.01";
        $font = $fontMetrics->get_font("serif", "normal");
        $size = 8;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);

    }

</script>
</body>

</html>
