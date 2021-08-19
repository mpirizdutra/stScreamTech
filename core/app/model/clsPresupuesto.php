<?php
class clsPresupuesto {
	public static $tablename = "presupuesto";

// `id_Presupuesto`, `nr_orden`, `idEs_pre`, `fecha`, `detalle`, `presupuesto`, `aprobado` 

	public function __construct(){

        $this->nr_orden="";
		$this->idEs_pre="";
		$this->fecha="";
        $this->detalle="";
        $this->presupuesto="";
        $this->aprobado="";
       
        
	}

   public static function getById($id){
		$sql = "select * from ".self::$tablename." where nr_orden=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new clsPresupuesto());

	}

    public static function getById2_presupuesto($id){
        $sql = "select * from ".self::$tablename." where nr_orden=$id and presupuesto > 0";
        $query = Executor::doit($sql);
        return Model::one($query[0],new clsPresupuesto());

    }

    public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new clsPresupuesto());
	}    
                    

    



    public static function Tienepresupuesto($nrorden){
        $r=0;
        $sql="SELECT `presupuesto` FROM `presupuesto` WHERE `nr_orden`=$nrorden";
        $query= Executor::doit($sql);
        return Model::one($query[0],new clsPresupuesto());
    }


    public static function  pasos_estado($nrOrden){

        $sql="SELECT * FROM `presupuesto` WHERE `nr_orden`=$nrOrden";
        $query= Executor::doit($sql);
        return Model::many($query[0],new clsPresupuesto());
    }

    public function add(){
        $sql="INSERT INTO ".self::$tablename." (`nr_orden`, `idEs_pre`, `fecha`, `detalle`,presupuesto) ";
        $sql.=" VALUES ($this->nr_orden,$this->idEs_pre,'$this->fecha','$this->detalle',$this->presupuesto);";
        return Executor::doit($sql);
    }
//UPDATE `presupuesto` SET `fecha`=[value-3],`detalle`=[value-4] WHERE `nr_orden`= and `idEs_pre`=
    public function update(){
        $sql="UPDATE ".self::$tablename." SET  fecha='$this->fecha', detalle='$this->detalle',presupuesto=$this->presupuesto ";
        $sql.=" WHERE nr_orden=$this->nr_orden and idEs_pre=$this->idEs_pre ";
        return Executor::doit($sql);
    }



 /**
  *  ##########  FIN CLASS ############
  *
  */

}

?>