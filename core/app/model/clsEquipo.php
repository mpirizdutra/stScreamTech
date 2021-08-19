<?php
class clsEquipo {
	public static $tablename = "equipo";



public function __construct(){
		$this->nr_orden = "";
        $this->user_id="";
		$this->id_estado="";
		$this->id_cliente="";
		$this->id_tipo_equipo="";
        $this->id_garantia_garantia="";
		$this->Nserie="";
		$this->imei="";
        $this->fecha_ingreso="";
        $this->fecha_listo="";
        $this->fecha_ingreso="";
        $this->fecha_presupuesto="";
        $this->fecha_no_reparado="";
        $this->tipoEquipo="";
        $this->descripcion="";

        
        
	}


    public static function user_id(){
        return $_SESSION["user_id"];
    }
   public static function getById($id){
		$sql = "select `nr_orden`, `user_id`, `id_estado`, `id_cliente`, `id_tipo_equipo`, `id_garantia_garantia`, `Nserie`, `imei`,`fecha_ingreso`, `tipoEquipo`,`descripcion`,barCode from ".self::$tablename." where nr_orden=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new clsEquipo());

	}

    public static function getByCodigoBarras($nr_orden){
        $sql = "select `nr_orden` from ".self::$tablename." where nr_orden='$nr_orden'";
        $query = Executor::doit($sql);
        return Model::one($query[0],new clsEquipo());

    }
            
    public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new clsEquipo());
	}    
                    

    
    public static function Haypresupuesto($nr_orden){
        $sql = "select * from presupuesto where nr_orden=$nr_orden";
		$query = Executor::doit($sql);
		return Model::one($query[0],new clsEquipo());
    }
        
    //SELECT `id_Presupuesto`, `nr_orden`, `fecha`, `detalle`, `presupuesto`, `aprobado` FROM `presupuesto` WHERE 1
    
	public static function add($nr_orden, $detalle, $presupuesto){
		$sql = "insert into presupuesto (`nr_orden`, `fecha`, `detalle`, `presupuesto`) ";
		$sql .= "value ($nr_orden,NOW(),'$detalle',$presupuesto)";
		return Executor::doit($sql);
	}
    
    public static function update($nr_orden,$detalle,$presu){
		$sql = "update presupuesto set detalle='$detalle',presupuesto=$presu  where nr_orden=$nr_orden";
		return Executor::doit($sql);
	}



    //devuelve todas las fallas
 public static function EquipoFallas($tipo){

        $sql="SELECT  orden,id_falla,falla FROM tipo_equipo_has_tipo_falla,tipo_falla where id_falla=`tipo_falla_id_falla`  order by  orden asc";
        if($tipo!=0){
            $sql="SELECT  orden,id_falla,falla FROM tipo_equipo_has_tipo_falla,tipo_falla where id_falla=`tipo_falla_id_falla` and tipo_equipo_id_tipo=$tipo order by  orden asc";
        }
        return Executor::doit($sql);
    }

//Executor::doit($sql);  $nrOrden=clsEquipo::InsertarEquipo($IDclientes,$selectTipo,$garantias,$serie,$imei,clsFunciones::fecha2($_POST["fecha"],1),$Equipo_modelo,$descripcion);
 public static  function InsertarEquipo($idCliente,$id_tipo,$id_garantia,$nrSerie,$imei,$fecha,$tipo,$desc,$garantiza)
 {
     $value="";
     $ID=0;
     $user_id=clsCliente::user_id();                                      //`id_cliente`, `id_tipo_equipo`, `id_garantia_garantia`, `Nserie`, `imei`, `fecha_ingreso`, `tipoEquipo`, `descripcion`, `fecha_entrega`,
     $res=Executor::doit("INSERT INTO `equipo`(id_cliente,id_tipo_equipo,id_garantia_garantia,Nserie,imei,fecha_ingreso,tipoEquipo,descripcion,garantiza,user_id) VALUES ($idCliente,$id_tipo,$id_garantia,'$nrSerie','$imei','$fecha','$tipo','$desc',$garantiza,$user_id)");

     if($res[1]>0){

             $ID=$res[1];
     }
     return $ID;
 }



    public static  function ListarEquipo($idCliente){


      return  Executor::doit("SELECT `nr_orden`, E.`id_estado`, `id_cliente`,id_tipo_equipo, `fecha_ingreso`, `tipoEquipo`, `descripcion`,Es.estado,orden_garantia FROM `equipo` E,estado_equipo Es   where id_cliente=$idCliente and E.id_estado=Es.id_estado order by nr_orden desc");

    }

    public static function Lista_equipos_id($id_orden,$estado){
        $sql ="SELECT `nr_orden`, E.`id_estado`, `id_cliente`,id_tipo_equipo, `fecha_ingreso`, `tipoEquipo`, `descripcion`,Es.estado FROM `equipo` E,estado_equipo Es   where nr_orden=$id_orden and E.id_estado=Es.id_estado and E.id_estado=$estado order by nr_orden desc";

        $query = Executor::doit($sql);
        return Model::many($query[0],new clsEquipo());
    }

    public static  function ListarEquipo_Cli($idcliente){
        $sql="SELECT nr_orden FROM equipo where id_cliente=$idcliente order by nr_orden desc";
        $query=Executor::doit($sql);
        return Model::many($query[0],new clsEquipo());
    }

    public static function ListarEquipo2($idCliente){
        $query=Executor::doit("SELECT * FROM equipo  where id_cliente=$idCliente order by nr_orden asc ");

        $cant=mysqli_num_rows($query[0]);
         if($cant>1){
             return Model::many($query[0],new clsEquipo());
         }
         else{return Model::one($query[0],new clsEquipo());}

    }

    public static function ListarEquipo3($nrOrden){


        return Executor::doit("SELECT * FROM `equipo` E,estado_equipo Es WHERE  E.id_estado=Es.id_estado and  `nr_orden` in $nrOrden   order by `fecha_ingreso` desc");

    }

    public static function FallasActivaeInactivas($nrOrden,$tipo,$Act){



        $consulta="select A.T_falla id_falla,falla from (select tipo_falla_id_falla T_falla from (SELECT  T.id_falla id_falla FROM `tipo_falla` T  WHERE  NOT EXISTS
                    (SELECT id_falla from falla_equipo F where nr_orden=$nrOrden and F.id_falla=T.id_falla  ) ) as F,tipo_equipo_has_tipo_falla TE 
                    where F.id_falla=TE.tipo_falla_id_falla and tipo_equipo_id_tipo=$tipo) as A,tipo_falla B where A.T_falla=B.id_falla order by A.T_falla;";

        if($Act){$consulta="SELECT F.id_falla,falla from falla_equipo F,tipo_falla T  where nr_orden=$nrOrden and F.id_falla=T.id_falla order by falla asc";}
        return Executor::doit($consulta );


    }

    public static function SecPrintHtml(){
        return Executor::doit("SELECT * FROM `inf_sistema`");
    }


    public static   function ListarEquipoNrOrden($nrOrden){
      return  Executor::doit("SELECT `nr_orden`, E.`id_estado`, `id_cliente`, `fecha_ingreso`, `tipoEquipo`, `descripcion`,Es.estado FROM `equipo` E,estado_equipo Es WHERE nr_orden=$nrOrden and   E.id_estado=Es.id_estado;");


    }
    //segun la lista de nr orden pasados
   /* public static   function ListarEquipo2($nrOrden){

       return Executor::doit("SELECT `nr_orden`, E.`id_estado`, `id_cliente`,id_tipo_equipo,`id_garantia_garantia`, `Nserie`, `imei`, `prestadora`, `fecha_ingreso`, `tipoEquipo`, `descripcion`, `fecha_Salida`,fecha_entrega,Es.estado FROM `equipo` E,estado_equipo Es WHERE  E.id_estado=Es.id_estado and  `nr_orden` in $nrOrden   order by `fecha_ingreso` asc");

    }*/

    public static function Idequipo_cliente($IDCliente){
        $ID=0;

        $res=Executor::doit("SELECT nr_orden FROM `equipo` WHERE `id_cliente`=$IDCliente order by nr_orden desc limit 1");

        if(mysqli_num_rows($res[0])>0){
            $row=mysqli_fetch_assoc($res[0]);
            $ID=$row["nr_orden"];
        }
        return $ID;
    }
    

    
    
    public static function TipoEquipo($nrOrden){
        $dat=0;
            
            $res= Executor::doit("SELECT `id_tipo_equipo` FROM `equipo` WHERE nr_orden=$nrOrden");
            
                if(mysqli_num_rows($res[0])>0){
                    $row=mysqli_fetch_array($res[0]);
                    $dat=$row["id_tipo_equipo"];
                }
            
        return $dat;
    }
    
    public static function TipoEquiposSelect(){
        $consulta="SELECT * FROM `tipo_equipo`;";
        
        return Executor::doit($consulta);  
    }
    
    public static function GarantiaEquipos(){
        
        
        return Executor::doit("SELECT * FROM  garantia;");
    }
    
  public static  function EditarEquipo($nrOrden,$selectTipo,$garantias,$serie,$imei, $fecha,$Equipo_modelo,$descripcion){
        
        return Executor::doit("UPDATE equipo SET id_tipo_equipo=$selectTipo, id_garantia_garantia=$garantias,Nserie='$serie',imei='$imei',fecha_ingreso='$fecha', tipoEquipo='$Equipo_modelo',descripcion='$descripcion',fecha_editar=CURRENT_TIMESTAMP() WHERE nr_orden=$nrOrden;");
    }
    
    
  public static function BorrarFallas($nrOrden){
        
        return Executor::doit("DELETE FROM falla_equipo WHERE nr_orden=$nrOrden");
    }


    /** Imprimir */

   public static function AlturaPapel(){
       return Executor::doit("SELECT * FROM config_imprimir");

    }
    
  /** Estado * */

  public static  function EstadoEquipo($nrOrden){

      $consulta="SELECT id_estado FROM `equipo` where activo=1  and nr_orden=$nrOrden ;";
      if($nrOrden==0){
          $consulta="SELECT * FROM `estado_equipo` where activo=1  order by orden asc";
      }
      return Executor::doit($consulta);

  }

  public static  function guardarEstado($nrOrden,$idEstado){

      return Executor::doit("UPDATE `equipo` SET `id_estado`=$idEstado WHERE `nr_orden`=$nrOrden");
  }



    public static function Equipo_estado_id($id_estado){
        $fecha_estados=clsFunciones::fecha_estado($id_estado);
        $sql=" SELECT `nr_orden`,`id_estado`, `id_tipo_equipo`, `id_garantia_garantia`, $fecha_estados as fecha_estado,DATE_FORMAT(NOW(),'%Y-%m-%d') fecha FROM equipo WHERE id_estado=$id_estado and  $fecha_estados BETWEEN date_add(DATE_FORMAT(NOW(), '%Y-%m-%d'),INTERVAL -210 day) and DATE_FORMAT(NOW(), '%Y-%m-%d')  order by `fecha_ingreso` desc";
        $query=Executor::doit($sql);
        return Model::many($query[0],new clsEquipo());
  }






  public static function Equipo_entregado($nr_orden){
      return Executor::doit("UPDATE equipo SET id_estado=5,fecha_entrega=DATE_FORMAT(NOW(), '%Y-%m-%d') WHERE nr_orden=$nr_orden;");

  }

  public static function fecha_estado_presupuesto($nr_orden,$valores){


      $sql="UPDATE equipo SET $valores WHERE nr_orden=$nr_orden;";

      return Executor::doit($sql);



  }


    public static function fecha_estado_garantiza($nr_orden,$valores){
        $sql="UPDATE equipo SET $valores WHERE nr_orden=$nr_orden;";

        return Executor::doit($sql);
    }


    public static function Reparado_O_NoReparado_presupuesto($valores){
        $sql="DELETE FROM `presupuesto` WHERE $valores[0]";

         Executor::doit($sql);
         //actualizar fecha
         $sql=$valores[1];
        Executor::doit($sql);

    }

    public static function Reparado_O_NoReparado_garantizar($valores){
        $sql="DELETE FROM `garantiza` WHERE $valores[0]";

        Executor::doit($sql);
        //actualizar fecha
        $sql=$valores[1];
        Executor::doit($sql);

    }


    public static  function cambiar_garantizados($nr_orden,$tipo){
        $sql="UPDATE equipo SET garantiza=$tipo  WHERE nr_orden=$nr_orden;";

        return Executor::doit($sql);
    }


    public static function cambiar_orden_garantiza($nr_orden,$nr_garantiza){
        $sql="UPDATE equipo SET orden_garantia=$nr_garantiza  WHERE nr_orden=$nr_orden;";

        return Executor::doit($sql);
    }


    public static function name_idfalla($id_falla){
        $sql="SELECT falla FROM `tipo_falla` WHERE `id_falla`=$id_falla";
        $query=Executor::doit($sql);
        return Model::one($query[0],new clsEquipo());
    }


//SELECT * FROM informe_sitema_telegram  ORDER by id_informe DESC LIMIT 1

    /** La idea es que se haga una sola ves el informe idependientemete del equipo */
    public static  function informe(){
        //`id_informe`, `fecha_informe`, `fecha_caduca`
        $sql="SELECT fecha_informe,DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i:%s') fecha FROM informe_sitema_telegram";
        $query=Executor::doit($sql);
        return Model::one($query[0],new clsEquipo());
    }

    public static  function add_informe($fecha_caduca){
        //`id_informe`, `fecha_informe`, `fecha_caduca`
        $sql="INSERT INTO `informe_sitema_telegram`(`fecha_informe`) VALUES ('$fecha_caduca')";
        Executor::doit($sql);
    }

    public static  function del_informe(){
        //`id_informe`, `fecha_informe`, `fecha_caduca`
        $sql="DELETE FROM `informe_sitema_telegram` ";
        Executor::doit($sql);
    }


 /**
  *  ##########  FIN CLASS ############
  *
  */

}



?>