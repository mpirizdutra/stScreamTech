<?php
ValidacionSesion::Validar();
if(ValidacionSesion::$isLoggedIn) {
    if(isset($_POST["Usuarios"])){
        $id=0;
        $user=$_POST["nombre"];
        $password=$_POST["clave"];

        $encriptar=password_hash($password, PASSWORD_DEFAULT);
        $Ousuario=new clsUsuario();
        $Ousuario->usuario_nombre=$user;
        $Ousuario->usuario_password=$encriptar;
        $res=$Ousuario->addUser();
        $_SESSION["msj"]="<div class='alert alert-warning' >El usuario <?php echo $user;?>  ya exite.</div>";

        if($res[1]>0){
            $id=$res[1];
            $_SESSION["msj"]="<div class='alert alert-success' >El usuario <?php echo $user;?> se agrego correctamente.</div>";

        }
       echo $id;

    }

}else{Core::redir("./");}



?>
