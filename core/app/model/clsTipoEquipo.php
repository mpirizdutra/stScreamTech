<?php


class clsTipoEquipo
{
    public static $tablename = "tipo_equipo";

    public function __construct(){
        $this->id_tipo = "";
        $this->equipo="";

    }


    public static function getAll(){
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0],new clsTipoEquipo());
    }

    public static  function name_tipo_equipo($nrOrden){

        $sql = "SELECT equipo FROM equipo,tipo_equipo WHERE id_tipo_equipo=id_tipo and nr_orden=$nrOrden;";
        $query = Executor::doit($sql);
        return Model::one($query[0],new clsTipoEquipo());
    }

}