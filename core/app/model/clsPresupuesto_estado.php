<?php


class clsPresupuesto_estado
{
    public static $tablename = " estadopresupuesto ";

    public function __construct(){
        $this->idEs_pre = "";
        $this->nombre="";

    }

    public static function getById($id){
        $sql = "select * from ".self::$tablename." where idEs_pre=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0],new clsPresupuesto_estado());

    }

    public static function getAll(){
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0],new clsPresupuesto_estado());
    }





}

?>