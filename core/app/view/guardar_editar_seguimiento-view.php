<?php


$_SESSION["msj"]="<div class='alert alert-warning'> Faltan datos </div>";
if( isset($_POST["nrOrden"])&& strlen($_POST["descripcion"])>4 &&$_POST["estado_Equipo"]>0 ){

    $dat=explode("-",$_POST["estado_Equipo"]);


    $tipo_estado=$dat[0];
    $verde_naranja=$dat[1];
    $nrOrden=$_POST["nrOrden"];
    $fecha=$_POST["fecha"];
    $descripcion=$_POST["descripcion"];
    $total=0;
    if(isset($_POST["total"])){
        $total=$_POST["total"];
    }
    else{
        $total=$_POST["total2"];
    }



   $presupuesto=new clsPresupuesto();
   $presupuesto->idEs_pre=$tipo_estado;
   $presupuesto->nr_orden=$nrOrden;
   $presupuesto->fecha=$fecha;
   $presupuesto->detalle=$descripcion;

   $presupuesto->presupuesto=$total;


   //naranja inserta
    if($verde_naranja==2){

        $presupuesto->add();

            $valores=estado_presupuesto($tipo_estado,$fecha);
            clsEquipo::fecha_estado_presupuesto($nrOrden,$valores);

        //solo puede ser reparado o no reparado
        if($tipo_estado>2){
           $val= reparado_O_noReparado($nrOrden,$tipo_estado);
            clsEquipo::Reparado_O_NoReparado_presupuesto($val);

        }
    }
       //verde actualiza
    if($verde_naranja==1){



        $presupuesto->update();


            $valores=estado_presupuesto($tipo_estado,$fecha);
            clsEquipo::fecha_estado_presupuesto($nrOrden,$valores);

    }

    $_SESSION["msj"]="<div class='alert alert-success'> Guardado correctamente. </div>";



    if(!isset($_GET["volver"])&&!isset($_GET["equipos"])){
        core::redir("./?view=Presupuestos&equipo=$nrOrden");
    }
    else{

        $equipo=$_GET["equipos"];


        core::redir("./?view=ListadoTelegram&equipos=$equipo");
    }


}
else{

    core::redir("./?view=Presupuestos&equipo=$nrOrden");
}







function estado_presupuesto($estado_p,$fecha){
    $res="id_estado=";
    $fechas="";
    switch ($estado_p){
        // diagnostico
        case 1:{$res.=4;$fechas="fecha_presupuesto=DATE_FORMAT('$fecha', '%Y-%m-%d')";break;}
        //pedido
        case 2:{$res.=14;$fechas="fecha_pedido=DATE_FORMAT('$fecha', '%Y-%m-%d')";break;}

        //no reparado
        case 3:{$res.=13;$fechas="fecha_no_reparado=DATE_FORMAT('$fecha', '%Y-%m-%d')";break;}
        //reparado
        case 4:{$res.=7;$fechas="fecha_listo=DATE_FORMAT('$fecha', '%Y-%m-%d')";break;}
    }

    return $res.",".$fechas;
}




//la idea es que cambie el estado (general) del equpo
function reparado_O_noReparado($nr_orden,$idTipo){
    $valores=array("a","b");

    switch ($idTipo) {

        case 3:
            {//No reparado
                $valores[0]=" nr_orden=$nr_orden and idEs_pre=4;";
                $valores[1]=" UPDATE equipo SET fecha_listo=null  WHERE nr_orden=$nr_orden; ";

                break;
            }

        case 4:{//reparado
            $valores[0]=" nr_orden=$nr_orden and idEs_pre=3;";
            $valores[1]=" UPDATE equipo SET fecha_no_reparado=null  WHERE nr_orden=$nr_orden; ";

            break;
        }
    }

   return $valores;
}


?>