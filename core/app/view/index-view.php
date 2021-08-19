<?php

//
/** *
 *Cuando inicio secion y y la $_COOKIE["informe_estado"] no esta seteada
 * Nos redirecciona al telegram para notificar el informe de los
 * ingresado, presupuesto, listo y no reparado
 */
if(!isset($_COOKIE["informe_estado"])){
    //desabilite el inform de equipo por telegram solo queda cuando se ingresa un equipo nuevo
   // Core::redir("./?view=telegram&hola=1");
}
else{
 //   Core::redir("./?view=st_Equipos");
}

Core::redir("./?view=st_Equipos");

?>