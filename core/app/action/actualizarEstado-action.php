<?php
ValidacionSesion::Validar();
if(ValidacionSesion::$isLoggedIn) {

    if (isset($_POST["ActualizarEstado"]) && isset($_POST["idEquipo"])) {
        $idEstado = $_POST["idEstado"];
        $idEquipo = $_POST["idEquipo"];


        clsEquipo::ActualizarEstado($idEquipo, $idEstado);
        $estado = clsEstado::getById($idEstado);

        echo $estado->estado;


    }


}else{Core::redir("./");}


?>
