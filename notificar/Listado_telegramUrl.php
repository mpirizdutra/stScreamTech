<?php

if(isset($_GET["telegram"])){

   $equipos=$_GET["telegram"];

  redir("http://serviciotecnico.screamtech.com.ar/index.php?view=ListadoTelegram&equipos=$equipos");

}


function redir($url){
    echo "<script>window.location='".$url."';</script>";
}

?>