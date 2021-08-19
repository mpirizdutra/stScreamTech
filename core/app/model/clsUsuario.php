<?php


class clsUsuario
{

    public static $tablename = "usuario";

//`idUsuario`, `nombreUsuario`, `clave`, `email`, `permiso`, `estado` FROM `usuario` WHERE 1
    public function __construct(){
        $this->usuario_id = "";
        $this->usuario_nombre="";
        $this->usuario_password="";
        $this->usuario_email="";

    }



/*
    public static function obtenerUsuario($user,$clave){
        $sql="call sp_obtenerDatosUsuario('$user','$clave')";
        $query = Executor::doit($sql);
        return Model::one($query[0],new clsUsuario());
    }
    */
    
 
    
    
   public static function getMemberByUsername($username) {
        
        $query = "Select * from usuarios where usuario_nombre = '$username'";
        $query = Executor::doit($query);
        return   Model::one($query[0],new clsUsuario());
    }
    
    public static function editarSesion($idUsuario){
        
        Executor::doit("call Editar_fecha_sesion($idUsuario);");
    }

    public function addUser(){
        $query = "INSERT INTO `usuarios`(`usuario_nombre`, `usuario_password`,`permiso`) VALUES ('$this->usuario_nombre','$this->usuario_password',5)";

        return  Executor::doit($query);
    }

}

?>