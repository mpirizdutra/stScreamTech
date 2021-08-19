<?php


class clsBarCode
{
    public static $tablename = "barcode";



    public function __construct(){
        $this->id_barcode = "";
        $this->codigo_barra="";

    }

    public static function getById($id){

        $sql = "select * from ".self::$tablename." where id_barcode=$id ";
        $query = Executor::doit($sql);
        return Model::one($query[0],new clsBarCode());

    }


    public static function getAll(){

        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0],new clsBarCode());
    }

    public static function getAll_activos(){

        $sql = "select * from ".self::$tablename." where activo=1";
        $query = Executor::doit($sql);
        return Model::many($query[0],new clsBarCode());
    }


    //Executor::doit($sql);
    public static  function addBarcode()
    {
        $sql="";
        $j=0;
        $cant=250;
        //INSERT INTO barcode (codigo_barra) VALUES (), o ;
        for($i=0;$i<$cant;$i++){

                if ($i < $cant-1) {
                    $sql .= "(),";
                } else {
                    $sql .= "();";
                }




        }
       $res= Executor::doit("INSERT INTO barcode () VALUES ".$sql);
        return $res[1];

    }

    public static function Barra_numericas(){
            $barra=array();$i=0;
            $numeros=clsBarCode::getAll_activos();
            if(count($numeros)>0){
                foreach ($numeros as $numero) {

                    $barra[$i]=clsFunciones::completar_ceros($numero->id_barcode);
                    $i++;
                }
            }
            return $barra;
    }


    public static function vincular_barra($nr,$nr_orden){
        $sql="UPDATE `equipo` SET  barCode='$nr' where `nr_orden`=$nr_orden";
        $query = Executor::doit($sql);
        self::baja_code($nr);
        return $query[0];
    }


    public static function baja_code($nr){
        $sql="UPDATE `barcode` SET `activo`=0 WHERE `id_barcode`=$nr";
        $query = Executor::doit($sql);
         $query[0];
    }



}

