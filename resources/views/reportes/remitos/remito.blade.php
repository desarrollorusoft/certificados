<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   

 <style>
       

@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: 210mm;
    height: 297mm;
  }
  /* ... the rest of the rules ... */
}
header .fecha span {

    font-size: 20px;
}         

header .fecha .dia {

    position: absolute;
    top: 150px;
    left: 550px;
}

header .fecha .mes {

    position: absolute;
    top: 150px;
    left: 580px;
}

header .fecha .anio {

    position: absolute;
    top: 150px;
    left: 610px;
}

header .receptor  {

    position: absolute;
    top: 200px;
    left: 100px;

}

header .destino {

    position: absolute;
    top: 240px;
    left:100px;

}

.detalle {

    position: absolute;
    top: 340px;
    left:100px;
}

 </style>  
</head>

<body onload="Imprimir()">
    
<header>
    <div class="fecha">   
        <div class="dia">
            <span>{{date('d', strtotime($remito->fecha))}}</span>
        </div>   
        <div class="mes">
            <span>{{ date('m', strtotime($remito->fecha))}}</span>
        </div>  
        <div class="anio">
           <span>{{ date('Y', strtotime($remito->fecha))}}</span>
        </div>  
    </div>
    <div class="receptor" >
            <span>{{$remito->receptor}}</span>
    </div>
    <div class="destino" >
        <span>{{$remito->destino}}</span>
    </div>
</header>   

<div class="detalle">

    @foreach ( $detalle as $producto )

        <span class="cantidad">{{ $producto->cantidad}} </span>    
        <span  class="producto">{{ $producto->producto}} </span>    
        <span  class="medida">{{ $producto->medida}} {{ $producto->unidad_medida}}</span><br>    
        
    @endforeach

</div>



<script>
function Imprimir() {
    window.print();
}
</script>
</body>
</html>