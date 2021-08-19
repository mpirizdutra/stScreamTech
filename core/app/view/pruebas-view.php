<?php


$caduca= 86400;
   // date_format(time()+86400,"Y%-m%-f% ")


/*
clsFunciones::json_cookie("informe",1,$caduca) ;
echo "<br/>";
if(isset($_COOKIE["informe"])){
  echo  clsFunciones::json_cookie_descode($_COOKIE["informe"]);
}*/

echo date("Y-m-d H:i:s",time() + $caduca);
//echo informe2();
function informe2(){
    $Hay_informe=clsEquipo::informe();
     $res=false;
    $fecha_actual=date_create($Hay_informe->fecha);
    $fecha_caduca=date_create($Hay_informe->fecha_informe);

    //echo "actual:".date_format($fecha_actual,"Y-m-d H:i:s")." >  caduca:".date_format($fecha_caduca,"Y-m-d H:i:s");;
    //echo "<br/>";
    if($fecha_actual>$fecha_caduca){
       $res=true;
    }

    return $res;
}

?>