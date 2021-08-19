<?php
include "../core/app/model/clsSeguridad.php";
include "../core/app/model/clsEquipo.php";
if(!isset($_GET["equipo"])&&!isset($_GET["estado"])){
    redir("http://screamtech.com.ar/");
}
if(clsSeguridad::validarID($_GET["equipo"])&& clsSeguridad::validarID($_GET["estado"])){


    //EStado siguiente
    $estado=$_GET["estado"];
    $nr_orden=$_GET["equipo"];
    $id_estado=0;
    $id_estado=estados_generales($estado);



}
else{
    redir("http://screamtech.com.ar/");
}






 function redir($url){
    echo "<script>window.location='".$url."';</script>";
}

function estado_siguiente($id_estado){
    $id=4;
    switch ($id_estado){

        //$id_estado=1 >  Presupuesto_Diagnostico (4)
        case 1:{$id=4;break;}
        //$id_estado=4 >  Listo (7)
        case 4:{$id=7;break;}
        //No reparado queda como no reparado
        case 13:{$id=5;break;}
        //$id_estado=4 >  Listo (7)
        case 7:{$id=5;break;}
        default:{break;}
    }
    return $id;
}

?>