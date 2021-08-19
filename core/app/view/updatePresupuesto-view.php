<?php

if(isset($_POST["nrOrden"])&&isset($_POST["Descripcion"])&&isset($_POST["PresupuestoTotal"])){
    if($_POST["nrOrden"]>0){
        $nrOrden=$_POST["nrOrden"];
        $detalle=$_POST["Descripcion"];
        $presupuesto=$_POST["PresupuestoTotal"];
        
        $equipo=clsEquipo::Haypresupuesto($nrOrden);
        
        if(count($equipo)>0){
            
            $r=clsEquipo::update($nrOrden,$detalle,$presupuesto);
             if($r[0]>1){
                $_SESSION["errorP"]= "<div class='alert alert-warning' role='alert'>Faltan datos</div>";
             }
            else{$_SESSION["msj"]= "<div class='alert alert-success' role='alert'>Presupuesto guardado</div>";}
        }
        else{
            
            $res=clsEquipo::add($nrOrden,$detalle,$presupuesto);
            if($res[1]<1){
                $_SESSION["errorP"]= "<div class='alert alert-warning' role='alert'>Faltan datos 2</div>";
            }
            else{$_SESSION["msj"]= "<div class='alert alert-success' role='alert'>Presupuesto guardado</div>";}
            
        }
            
            print "<script>window.location='index.php?view=st_presupuesto&idEquipo=$nrOrden';</script>";
   }
   else{
    
        print "<script>window.location='logout.php';</script>";
   
   }

}
else{print "<script>window.location='logout.php';</script>";}


?>