<?php
include "../core/autoload.php";

if(isset($_GET["telegram"])){
    if(clsValidar::validarID($_GET["telegram"])){
        $Equipo=$_GET["telegram"];

        core::redir("http://serviciotecnico.screamtech.com.ar/index.php?orden=$Equipo");

    }
}

?>