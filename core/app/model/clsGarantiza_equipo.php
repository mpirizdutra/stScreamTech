<?php


class clsGarantiza_equipo
{



    public static $tablename = " garantiza ";

    public function __construct(){
        $this->id_estado_garantiza = "";
        $this->nr_orden_garantiza="";
        $this->fecha="";
        $this->descripcion="";

    }


    public static function getAll(){
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0],new clsGarantiza_equipo());
    }

    public static function get_nr_orden($nr_orden){
        $sql = "select * from ".self::$tablename." where nr_orden_garantiza=$nr_orden; ";
        $query = Executor::doit($sql);
        return Model::many($query[0],new clsGarantiza_equipo());
    }

//INSERT INTO `garantiza`(`id_estado_garantiza`, `nr_orden_garantiza`, `fecha`, `descripcion`) VALUES ()
    public function add(){
        $sql = "INSERT INTO ".self::$tablename." (`id_estado_garantiza`, `nr_orden_garantiza`, `fecha`, `descripcion`) ";
        $sql.="VALUES ($this->id_estado_garantiza,$this->nr_orden_garantiza,'$this->fecha','$this->descripcion')";
        return Executor::doit($sql);

    }

//UPDATE `garantiza` SET `fecha`=,`descripcion`= WHERE `id_estado_garantiza`= and `nr_orden_garantiza`=
    public function update(){
        $sql = "UPDATE ".self::$tablename." SET  fecha='$this->fecha' ,descripcion='$this->descripcion'  WHERE id_estado_garantiza=$this->id_estado_garantiza and nr_orden_garantiza=$this->nr_orden_garantiza";

        return Executor::doit($sql);

    }


}


?>