<?php

if(isset($_GET["codigo"])){
    //echo $_GET["codigo"];

    //$_SESSION["EquipBuscar"]
    //$Equipo=clsEquipo::getById($nrEquipo);
    $id_equipo=clsEquipo::getByCodigoBarras((int)$_GET["codigo"]);
    if(count($id_equipo)>0){
        $_SESSION["EquipBuscar"]=$id_equipo->nr_orden;
        $_SESSION["msj"]="<div class='alert alert-success'>Codigo: ".$_GET['codigo']."-> Equipo: ".$id_equipo->nr_orden."</div>";
    }
    else{
        $_SESSION["msj"]="<div class='alert alert-warning'>Este codigo de barra no pertenece a ningun equipo</div>";
    }

    core::redir("http://serviciotecnico.screamtech.com.ar/");
}
else{

    core::redir("http://serviciotecnico.screamtech.com.ar/");
}

?>