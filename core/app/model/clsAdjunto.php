<?php
class clsAdjunto {
	public static $tablename = "adjuntos";
//`idAdjuntos`, `nombre_archivo`, `url`, `fecha_vencimiento`

	public function __construct(){
		$this->idAdjuntos = "";
        $this->nombre_archivo = "";
		$this->url = "";
		$this->fecha_vencimiento = "NULL";
        $this->etiqueta="NULL";
        $this->observaciones="NULL";
	
    }
    //devuelve todo los adjuntos de un chofer
    public static function ID_adjunto_chofer($id)
    {
        $sql="SELECT  idAdjuntos,nombre_archivo, url, fecha_vencimiento,etiqueta,observaciones FROM choferes_has_adjuntos ,adjuntos  WHERE idAdjuntos=`Adjuntos_idAdjuntos` and `choferes_idchoferes`=$id";
        $query=Executor::doit($sql);
        return Model::many($query[0],new clsAdjunto());
    }
    
     public static function ID_adjunto_camion($id)
    {
        $sql="SELECT  idAdjuntos,nombre_archivo, url, fecha_vencimiento,etiqueta,observaciones FROM camiones_has_adjuntos ,adjuntos  WHERE idAdjuntos=`Adjuntos_idAdjuntos` and camiones_idCamion=$id";
        $query=Executor::doit($sql);
        return Model::many($query[0],new clsAdjunto());
    }
    
    
	public function add_Adjunto(){
		$sql = "INSERT INTO ".self::$tablename." ( dni, cuil, nombre, apellido, fecha_nacimiento, domicilio, telefono) ";
		$sql .= "value ('$this->dni','$this->cuil','$this->nombre','$this->apellido','$this->fecha_nacimiento','$this->domicilio','$this->telefono');";
	  return Executor::doit($sql);
	}



	public function update_Adjunto(){
		$sql = "update ".self::$tablename." set dni='$this->dni',cuil='$this->cuil',nombre='$this->nombre',apellido='$this->apellido',fecha_nacimiento='$this->fecha_nacimiento',domicilio='$this->domicilio',telefono='$this->telefono' where idAdjuntoes=$this->idAdjuntoes";
		return Executor::doit($sql);
	}




	public static function getById($id){
		$sql = "select * from ".self::$tablename." where idAdjuntoes=$id";
        $query = Executor::doit($sql);
		return Model::one($query[0],new clsAdjunto());
      
	}



	public static function getAll(){
		$sql = "select *  from ".self::$tablename;
		$query = Executor::doit($sql);
		
        return Model::many($query[0],new clsAdjunto());
       
	}
    
    
    public static function BuscarAdjunto($op,$dato){
        
        $cosulta="SELECT * FROM  chof";
        switch($op){
            //cuit
            case 1:{
                   
                    $cosulta="SELECT * FROM ".self::$tablename." where dni like '$dato%'";
                   
                    break;
            } 
            //razon social  
            case 2:{
                 $cosulta="SELECT * FROM ".self::$tablename." WHERE  concat_ws(' ',apellido,nombre) like '%$dato%'";
                 
                 break;
            }
            default:{break;}
            
        }
        
        $query = Executor::doit($cosulta);
        return Model::many($query[0],new clsAdjunto());
    }
   


}

?>