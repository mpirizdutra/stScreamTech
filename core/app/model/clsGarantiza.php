<?php


class clsGarantiza
{


    public static $tablename = " garantias ";

    public function __construct(){
        $this->id_garantia = "";
        $this->nombre="";

    }


    public static function getAll(){
        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0],new clsGarantiza());
    }


    public static  function nombre_garantiza($nr_orden){
        $res="";
        $sql = "SELECT nombre FROM equipo,garantias WHERE id_garantia=garantiza and nr_orden=$nr_orden;";
        $query = Executor::doit($sql);
        if(mysqli_num_rows($query[0])>0){
            $res= Model::one($query[0],new clsGarantiza());
            $res=$res->nombre;
        }
        return $res;
    }

}


?>