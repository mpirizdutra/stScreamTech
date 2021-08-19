<?php


class clsCliente
{


    public static $tablename = "cliente";



    public function __construct(){
        $this->id_cliente = "";
        $this->nombre="";
        $this->apellido="";
        $this->telefono="";
        $this->dni="";
        $this->email="";
        $this->activo="NOW()";
    }
    public static function user_id(){
        return $_SESSION["user_id"];
    }

    public static function getById($id){

        $sql = "select * from ".self::$tablename." where id_cliente=$id ";
        $query = Executor::doit($sql);
        return Model::one($query[0],new clsCliente());

    }
    public static function FechaUltimoEquipo($idcliente){
        return Executor::doit("SELECT  DISTINCT fecha_ingreso fecha FROM `equipo` WHERE id_cliente=$idcliente order by nr_orden DESC");
    }

    public static function getAll(){

        $sql = "select * from ".self::$tablename;
        $query = Executor::doit($sql);
        return Model::many($query[0],new clsCliente());
    }
      public static function getByDNI($id){
        $sql = "select * from ".self::$tablename." where dni='$id'";
        $query = Executor::doit($sql);
        return Model::one($query[0],new clsCliente());

    }
    //Executor::doit($sql);
    public static  function InsertarCliente($nombre,$apellido,$telefono,$dni,$email)
    {   $ID=0;
        $user_id=clsCliente::user_id();
        $sql="INSERT INTO `cliente`(`nombre`, `apellido`,telefono, `dni`, `email`,user_id) VALUES ('$nombre','$apellido','$telefono',$dni,'$email',$user_id)";
        if($email="NULL"){$sql="INSERT INTO `cliente`(`nombre`, `apellido`,telefono, `dni`, `email`,user_id) VALUES ('$nombre','$apellido','$telefono',$dni,NULL,$user_id)";}
        $res=Executor::doit($sql);;
        if($res[1]>0)
        {
              //id de la row
            $ID=$res[1];
        }


        return $ID;
    }
    //$IDcliente,$nombre,$apellido,$telefono,$dni,$email
    public static function EditarCleinte($ID,$nombre,$apellido,$telefono,$dni,$email){
        
         $consulta="UPDATE `cliente` SET `nombre`='$nombre',`apellido`='$apellido',`telefono`='$telefono',`dni`=$dni,email='$email', fecha_editar=CURRENT_TIMESTAMP() WHERE id_cliente=$ID;";
         return Executor::doit($consulta);
    }

    public static  function idCliente($nrorden){

        return Executor::doit("SELECT id_cliente FROM `equipo` WHERE nr_orden=$nrorden");
     }


    public static  function idCliente2($nrorden){
        $r=0;
        $res= Executor::doit("SELECT id_cliente FROM `equipo` WHERE nr_orden=$nrorden");
        if(mysqli_num_rows($res[0])>0){
            $row=mysqli_fetch_assoc($res[0]);
            $r=$row["id_cliente"];
        }
        return $r;
    }

    public static  function ClienteActivo($idcliente,$op){
        Executor::doit("UPDATE `cliente` SET  `activo`=$op WHERE `id_cliente`=$idcliente");
  }

    public static function ListarUltimo_cliente(){
        $user_id=clsCliente::user_id();
        $user_id="  C.user_id=$user_id ";
        if(clsCliente::user_id()==1){
            $user_id=" C.user_id>=1 ";
        }
        $consulta="SELECT  C.`id_cliente` id_cliente, `nombre`, `apellido`, `telefono`, `dni`, `email`,activo,nr_orden FROM `equipo` E,cliente C where C.`id_cliente`=E.`id_cliente` and $user_id   order by `nr_orden` desc LIMIT 1";
        $query=Executor::doit($consulta);
        return Model::many($query[0],new clsCliente());
    }

    public static function ListarUltimo_5_equipos(){
        $user_id=clsCliente::user_id();
        $user_id="  C.user_id=$user_id ";
        if(clsCliente::user_id()==1){
            $user_id=" C.user_id>=1 ";
        }
        $consulta="SELECT  C.`id_cliente` id_cliente, `nombre`, `apellido`, `telefono`, `dni`, `email`,activo,nr_orden FROM `equipo` E,cliente C where C.`id_cliente`=E.`id_cliente`    order by `nr_orden` desc LIMIT 5";
        $query=Executor::doit($consulta);
        return Model::many($query[0],new clsCliente());
    }


    public static function Listar_oficial_garantia($garantiza){
        $user_id=clsCliente::user_id();
        $user_id="  C.user_id=$user_id ";
        if(clsCliente::user_id()==1){
            $user_id=" C.user_id>=1 ";
        }
        $consulta="SELECT  C.`id_cliente` id_cliente, `nombre`, `apellido`, `telefono`, `dni`, `email`,activo,nr_orden FROM `equipo` E,cliente C where C.`id_cliente`=E.`id_cliente` and garantiza=$garantiza and $user_id   order by `nr_orden` desc";
        $query=Executor::doit($consulta);
        return Model::many($query[0],new clsCliente());
    }



    public static  function ListarClientes($Buscar){
        $user_id=clsCliente::user_id();
        $user_id="  user_id=$user_id ";
        if(clsCliente::user_id()==1){
            $user_id="  user_id>=1 ";
        }

       // $consulta="SELECT `id_cliente`, `nombre`, `apellido`, `telefono`, `dni`, `email`,activo FROM `cliente`  where  activo=1 and $user_id  order by id_cliente desc";

        //Buscar
        if($Buscar!=0){
            $Buscar=explode("=>",$Buscar);
            $pos=$Buscar[0];$text=$Buscar[1];


            switch($pos){

                case 1:{
                    $consulta="SELECT `id_cliente`, `nombre`, `apellido`, `telefono`, `dni`, `email`,activo FROM `cliente`  where $user_id  and (nombre like '%$text%' or apellido like '%$text%')  ";
                    break;
                }

                case 2:{
                    $consulta="SELECT `id_cliente`, `nombre`, `apellido`, `telefono`, `dni`, `email`,activo FROM `cliente`  where dni=$text and $user_id";
                    break;
                }

                case 3:{
                    $idCliente=self::IDclienteXequipo($text);
                    if($idCliente>0){
                        $consulta="SELECT `id_cliente`, `nombre`, `apellido`, `telefono`, `dni`, `email`,activo FROM `cliente`  where id_cliente=$idCliente and  $user_id";
                    }
                    /**  La idea es que no traiga nada*/
                    else{$consulta="SELECT `id_cliente`, `nombre`, `apellido`, `telefono`, `dni`, `email`,activo FROM `cliente`  where id_cliente=0";}


                    break;
                }

                case 4:{  //fabrica
                    $consulta="SELECT * FROM `cliente` WHERE id_cliente in (SELECT  `id_cliente` FROM `equipo` WHERE  id_estado=$text )";
                    break;
                }

                case 5:{
                    $consulta="SELECT * FROM `cliente` WHERE id_cliente in (SELECT  `id_cliente` FROM `equipo` WHERE  `tipoEquipo` like '%$text%' )";
                    break;
                }

                case 6:{
                    $consulta="SELECT * FROM `cliente` WHERE id_cliente in (SELECT  id_cliente FROM equipo WHERE  telefono like '%$text%' ) ";
                    break;
                }


            }

        }

        $query=Executor::doit($consulta);
        return Model::many($query[0],new clsCliente());
    }

    public static  function IDclienteXequipo($nr_orden){
        $idCliente=0;

        $res=Executor::doit("SELECT `id_cliente` FROM `equipo` WHERE  nr_orden=$nr_orden;");
        if(mysqli_num_rows($res[0])>0){

            $row=mysqli_fetch_assoc($res[0]);
            $idCliente=$row["id_cliente"];
        }

        return $idCliente;
    }







  /** Fin class */

}

?>