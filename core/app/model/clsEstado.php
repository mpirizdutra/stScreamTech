<?php
class clsEstado {
	public static $tablename = "estado_equipo";

	public function __construct(){
		$this->id_estado = "";
        $this->estado="";
		
	}

   public static function getById($id){
		$sql = "select * from ".self::$tablename." where id_estado=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new clsEstado());

	}  
            
    public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new clsEstado());
	}


    public static function ActualizarEstado($idEquipo,$idEstado){
        $sql = "update ".self::$tablename." set id_estado=$idEstado where nr_orden=$idEquipo";
        Executor::doit($sql);

    }

    public static function Nombre_estado($idEstado){
        return clsEstado::getById($idEstado);

    }
        
        
    
 

}

?>