<?php


class clsImprimir
{
    public static $tablename = "imprimir_html";

    public function __construct(){
        $this->id = "";
        $this->id_user="";
        $this->sec1="";
        $this->sec2="";
        $this->sec3="";
        $this->sec4="";
        $this->sec5="";
        $this->foto1="";
        $this->foto2="NOW()";
    }

    public static function getById($id){
        $sql = "select * from ".self::$tablename." where id=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0],new clsImprimir());

    }

    public static function getAll(){
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0],new clsImprimir());
    }
    
     public static function getByUser_id($id){
        $sql = "select * from ".self::$tablename." where id_user=$id";
        $query = Executor::doit($sql);
        return Model::one($query[0],new clsImprimir());

    }

    public static function EquipoPrintselect($nrOrden){

        return Executor::doit("SELECT `nr_orden`,`fecha_ingreso`,`tipoEquipo`,`descripcion`,estado estado FROM `equipo` E,estado_equipo ES where E.`id_estado`=ES.`id_estado` AND nr_orden=$nrOrden;");
    }

    public static function Update($sec1,$sec2,$sec3,$sec4,$sec5,$id){

        return Executor::doit("UPDATE `imprimir_html` SET sec1='$sec1',sec2='$sec2',sec3='$sec3',sec4='$sec4',sec5='$sec5'  where id=$id");
    }





}



?>