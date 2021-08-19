<?php
class clsCliente {
	public static $tablename = "clientes";
//`cuit`, `razon_social`, `direccion`, `telefono`, 

	public function __construct(){
		$this->idclientes = "";
        $this->cuit = "";
		$this->razon_social = "";
		$this->direccion = "";
		$this->telefono = "";
    }
//(\"$this->cuit\",\"$this->razon_social\",\"$this->direccion\",\"$this->telefono\")
	public function add_client(){
		$sql = "insert into clientes (cuit,razon_social,direccion,telefono) ";
		$sql .= "value ('$this->cuit','$this->razon_social','$this->direccion','$this->telefono');";
	  return Executor::doit($sql);
	}



	public function update_client(){
		$sql = "update ".self::$tablename." set cuit='$this->cuit',razon_social='$this->razon_social',direccion='$this->direccion',telefono='$this->telefono' where idclientes=$this->idclientes";
		return Executor::doit($sql);
	}




	public static function getById($id){
		$sql = "select * from ".self::$tablename." where idclientes=$id";
        $query = Executor::doit($sql);
		return Model::one($query[0],new clsCliente());
      
	}



	public static function getAll(){
		$sql = "select `idclientes`, `cuit`, `razon_social`, `direccion`, `telefono` from ".self::$tablename;
		$query = Executor::doit($sql);
		
        return Model::many($query[0],new clsCliente());
       
	}
    
    
    public static function BuscarCliente($op,$dato){
        
        $cosulta="SELECT * FROM `clientes`";
        switch($op){
            //cuit
            case 1:{
                    $cant=strlen($dato);
                    $cuit=$dato;
                    $cosulta="SELECT `idclientes`, `cuit`, `razon_social`, `direccion`, `telefono` FROM ".self::$tablename." where cuit like '$cuit%'";
                    if($cant==11){
                        $cuit1=substr($dato, 0,2);$cuit2=substr($dato, 2,8);$cuit3=substr($dato, 10,11);
                        $cuit=$cuit1."-".$cuit2."-".$cuit3;
                        $cosulta="SELECT `idclientes`, `cuit`, `razon_social`, `direccion`, `telefono` FROM ".self::$tablename." where cuit ='$cuit'";
                    }
                    break;
            } 
            //razon social  
            case 2:{
                 $cosulta="SELECT `idclientes`, `cuit`, `razon_social`, `direccion`, `telefono` FROM ".self::$tablename." where razon_social like '%$dato%'";
                 
                 break;
            }
            default:{break;}
            
        }
        
        $query = Executor::doit($cosulta);
        return Model::many($query[0],new clsCliente());
    }
   


}

?>