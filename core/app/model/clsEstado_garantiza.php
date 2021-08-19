<?php

class clsEstado_garantiza
{

    public static $tablename = " estado_garantiza ";

    public function __construct(){
        $this->id_garantiza = "";
        $this->estado_garantiza="";

    }


    public static function getAll(){
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0],new clsEstado_garantiza());
    }




}

?>