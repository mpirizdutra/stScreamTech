<?php


$_SESSION["msj"]="<div class='alert alert-warning'> Faltan datos </div>";
if( isset($_POST["nrOrden"])&& strlen($_POST["descripcion"])>4 &&$_POST["estado_garantiza"]>0 ){



    $dat=explode("-",$_POST["estado_garantiza"]);

    $tipo_garantizar=$dat[0];
    $verde_naranja=$dat[1];

    $nrOrden=$_POST["nrOrden"];
    $fecha=$_POST["fecha"];
    $descripcion=$_POST["descripcion"];

    $e_g=new clsGarantiza_equipo();
    $e_g->id_estado_garantiza=$tipo_garantizar;
    $e_g->nr_orden_garantiza=$nrOrden;
    $e_g->fecha=$fecha;
    $e_g->descripcion=$descripcion;


    if($verde_naranja==1){

        $e_g->update();

            $valores=estado_presupuesto($tipo_garantizar,$fecha);
            clsEquipo::fecha_estado_garantiza($nrOrden,$valores);

    }
    if($verde_naranja==2){

        $e_g->add();

            $valores=estado_presupuesto($tipo_garantizar,$fecha);
            clsEquipo::fecha_estado_garantiza($nrOrden,$valores);


        if($tipo_garantizar>2){
            $val= reparado_O_noReparado($nrOrden,$tipo_garantizar);
            clsEquipo::Reparado_O_NoReparado_garantizar($val);
        }
    }

    $_SESSION["msj"]="<div class='alert alert-success'> Guardado correctamente. </div>";




    if(!isset($_GET["volver"])&&!isset($_GET["equipos"])){
        core::redir("./?view=GarantizarEquipo&equipo=$nrOrden");
    }
    else{

        $equipo=$_GET["equipos"];


        core::redir("./?view=ListadoTelegram&equipos=$equipo");
    }

}
else{

    core::redir("./?view=GarantizarEquipo&equipo=$nrOrden");
}








function estado_presupuesto($estado_p,$fecha){
    $res="id_estado=";
    $fechas="";
    switch ($estado_p){
        // diagnostico
        case 1:{$res.=4;$fechas="fecha_presupuesto=DATE_FORMAT('$fecha', '%Y-%m-%d')";break;}

        //pedido
        case 2:{$res.=14;$fechas="fecha_pedido=DATE_FORMAT('$fecha', '%Y-%m-%d')";break;}

        //reparado
        case 3:{$res.=7;$fechas="fecha_listo=DATE_FORMAT('$fecha', '%Y-%m-%d')";break;}

        //no reparado
        case 4:{$res.=13;$fechas="fecha_no_reparado=DATE_FORMAT('$fecha', '%Y-%m-%d')";break;}
    }

    return $res.",".$fechas;
}



//la idea es que cambie el estado (general) del equpo
function reparado_O_noReparado($nr_orden,$idTipo){
    $valores=array("a","b");

    switch ($idTipo) {


        case 3:{//reparado
            $valores[0]=" nr_orden_garantiza=$nr_orden and id_estado_garantiza=4;";
            $valores[1]=" UPDATE equipo SET fecha_no_reparado=null  WHERE nr_orden=$nr_orden; ";

            break;
        }



        case 4:
            {//No reparado
                $valores[0]=" nr_orden_garantiza=$nr_orden and id_estado_garantiza=3;";
                $valores[1]=" UPDATE equipo SET fecha_listo=null  WHERE nr_orden=$nr_orden; ";

                break;
            }




    }

    return $valores;
}




function cambiarEstado($nrOrden,$idTipo){
    $id_tipo=1;

    switch ($idTipo) {
        case 1:{//diagnostico
            $id_tipo=4;
            break;
        }
        case 2: {//pedido
            $id_tipo=4;
            break;
        }
        case 3:
            {// reparado
                $id_tipo=7;
                break;
            }

        case 4:{//No reparado
            $id_tipo=13;
            break;
        }
    }

    clsEquipo::guardarEstado($nrOrden,$id_tipo);
}


?>