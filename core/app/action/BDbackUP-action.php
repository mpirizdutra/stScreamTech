<?php

ValidacionSesion::Validar();
if(ValidacionSesion::$isLoggedIn) {
 /** Listado de movimiento de caja */
 if (isset($_POST["BaseDatosRespaldo"])) {
  //echo "sdsad";
  $r = new Backup_Database ();

  $r->backupTables();
 }

}else{Core::redir("./");}
?>
