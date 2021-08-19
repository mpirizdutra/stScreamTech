<?php
ValidacionSesion::Validar();
if(ValidacionSesion::$isLoggedIn) {
 if(isset($_POST["EditarCliente"])){
    $r=0;
    $IDcliente=$_POST["EditarCliente"];
    $email="NULL";
    if(isset($_POST["email"])){
        $email=$_POST["email"];
    }
    $nombre=$_POST["nombre"];
    $apellido=$_POST["apellido"];
    $telefono=$_POST["telefono"];
    $dni=$_POST["dni"];
    
    $res=clsCliente::EditarCleinte($IDcliente,$nombre,$apellido,$telefono,$dni,$email);
    
    if($res[0]>0){
         $r=1;
        $_SESSION["msj"]="<div class='alert alert-success' role='alert'>Cliente editado correctamente.</div>";
        //$_SESSION["EquipoNR"]=$IDcliente;
    }
    else{
         $_SESSION["msj"]="<div class='alert alert-warning' role='alert'>No se pudo editar . Cliente nr. #$IDcliente !</div>";
        
    }
    //else{echo 0};
    
    echo $r;
 }
 
 
 
 
 if(isset($_POST["Buscarcliente"])){
    $IDcliente=$_POST["Buscarcliente"];
    $id=0;
    $cliente=clsCliente::getByDNI($IDcliente);
    if(count($cliente)>0){
        $id=$cliente->id_cliente;
    }
    echo $id;
    
 }
 
 
 if(isset($_POST["ClienteNuevo"])){
    
    $nombre=$_POST["nombre"];
    $apellido=$_POST["apellido"];
    $telefono=$_POST["telefono"];
    $dni=$_POST["dni"];
    $email="NULL";
    if(isset($_POST["email"])){
        $email=$_POST["email"];
    }
    $ID=0;
    $ID=clsCliente::InsertarCliente($nombre,$apellido,$telefono,$dni,$email);
    
    echo $ID;
    
 }



}else{Core::redir("./");}
 

?>