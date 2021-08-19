<?php


class clsDescarga
{
    public static $tablename = "descargas";



    public function __construct(){
        $this->idDescarga = "";
        $this->name="";
        $this->url="";
        $this->fecha="";

    }

//SELECT `idDescarga`, `name`, `url`, `fecha` FROM `descargas` WHERE 1


    public static function getById($id){
        $sql = "select * from ".self::$tablename." where idDescarga=$id";

        $query = Executor::doit($sql);
        return Model::one($query[0],new clsDescarga());

    }

    public static function getAll(){
        $sql = "select * from ".self::$tablename;

        $query = Executor::doit($sql);
        return Model::many($query[0],new clsDescarga());

    }


    public function addUrl(){
        $sql="INSERT INTO ".self::$tablename."(name,url) VALUES ('$this->name','$this->url')";


        $query = Executor::doit($sql);
        return  $query[1];
    }


    public function UpdateUrl(){
        $sql = "UPDATE ".self::$tablename." SET name='$this->name', url='$this->url' where idDescarga=$this->idDescarga";

        $query = Executor::doit($sql);
        return  $query[1];
    }


}