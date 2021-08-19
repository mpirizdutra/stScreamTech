<?php
/**
 *Las funciones tienen que estar afuera del isset
 *
 *
 */
ValidacionSesion::Validar();
if(ValidacionSesion::$isLoggedIn) {
 /** *
  * ##### Listar clientes ->equiposs #####
  *
  */
 if(isset($_POST["ListarClietes"])){

            $E_entregados = $_POST["ListarClietes"];
            //$dat = explode("=>", $_POST["Buscar"]);
            //$pos = $dat[0];
            //$busca = $dat[1];
            //$res = 0;


        $Ultimo_ingresado=0;
        if(isset($_POST["ultimo"])){
            $Ultimo_ingresado=$_POST["ultimo"];
        }


    //falta poner en la ionterfas el boton
       ListarCliEqu($_POST["Buscar"],$E_entregados,$Ultimo_ingresado);




    }





 /** Equipo entregado */


 if(isset($_POST["equipo_entregado"])){
     $nr_orden=$_POST["equipo_entregado"];
     $res=clsEquipo::Equipo_entregado($nr_orden);

      $_SESSION["msj"]="<div class='alert alert-success'>El equipo esta entregado.</div>";
 }



/** *
* ### Equipo Nuevo ###
*/


    if(isset($_POST["MasEquipos"])){
        $msj="";
        $garantiza=0;$name_garantia="";
        if(isset($_POST["garantiza"])){
            $garantiza=$_POST["garantiza"];
        }
        $name_garantia=clsFunciones::garantiza($garantiza);


        $email="NULL";

        $imei="NULL";
        $prestadora="NULL";
        $serie="NULL";
        $selectTipo=$_POST["selectTipo"];
        $garantias=$_POST["Garantia"];
        $Equipo_modelo=$_POST["tipoEquipo"];
        $descripcion=$_POST["descripcion"];
        $fallas="";
        //FALLAS
        $equipo=$_POST["Equipos"];//explode("=>",$_POST["Equipos"]);

        if(isset($_POST["email"])){
            if($_POST["email"]!=""){
                $email=$_POST["email"];
            }
        }


        if(isset($_POST["imei"])){
            if($_POST["imei"]!=""){
                $imei=$_POST["imei"];
            }
        }

        if(isset($_POST["serie"])){
            if($_POST["serie"]!=""){
                $serie=$_POST["serie"];
            }
        }

        $IDclientes=$_POST["MasEquipos"];

        if($IDclientes>0)
        {
            //cliente nuevo



            //$nrOrden=$oBD->InsertarEquipo($IDclientes,fecha($_POST["fecha"],1),fecha($_POST["fechaEntrega"],1),$equipo[0],$equipo[2]);
            $nrOrden=clsEquipo::InsertarEquipo($IDclientes,$selectTipo,$garantias,$serie,$imei,clsFunciones::fecha2($_POST["fecha"],1),$Equipo_modelo,$descripcion,$garantiza);

            if($nrOrden>0)
            {

                $fallas=clsIngreso_edit::EquipoDat($equipo,$nrOrden);
                if($fallas!=""){


                    $res=clsIngreso_edit::insertarFallas($fallas);

                        if($res[0]>0){

                            $_SESSION["EquipoNR"]=$nrOrden;
                            $_SESSION["EquipBuscar"]=$nrOrden;

                            /**  Armado de la notificacion */
                            $id_user= $_SESSION["user_id"];
                            $usuario=" ScreamTech ";
                            if($id_user==2){
                                $usuario=" Intech ";
                            }
                            $name_garantia2="";
                            if($name_garantia!="no"){
                                $name_garantia2=$name_garantia;
                            }


                            $fallas=clsIngreso_edit::name_fallas($equipo);
                            $tipo_equipo=clsFunciones::Tipo_equipo($selectTipo);
                             $url_orden="<a href='http://serviciotecnico.screamtech.com.ar/notificar/telegramUrl.php?telegram=$nrOrden'>#$nrOrden</a>";
                            $msj="Orden: $url_orden  |  $tipo_equipo: $Equipo_modelo \n\n";

                            $msj.="Falla: $fallas. \n";
                            $msj.="Detalle: $descripcion.\n";
                            $m="Ingreso de un nuevo equipo.\n\n";
                            if($name_garantia2!=""){
                                $m="Ingreso de un nuevo equipo en garantia | $name_garantia2\n\n";
                            }


                            $msj=$m."Usuario: ".$usuario.".\n\n".$msj;
                            /** Notificar telegram bot */
                            $_SESSION["msj_telegram"]=$msj;
                            echo 1;


                        }

                    else{ echo 0;}

                }



            }




        }



    }



/**  MaS equipo<<<<<*/



/** ###### Editar Equipos  ########## */

    if(isset($_POST["EnviarEditarEquipo"])){
        
        $nrOrden=$_POST["EnviarEditarEquipo"];
        
        $email="NULL";
        $numeroSerie="NULL";
        $imei="NULL";
        $serie="NULL";
        
        $selectTipo=$_POST["selectTipo"];
        $garantias=$_POST["Garantia"];
        $Equipo_modelo=$_POST["tipoEquipo"];
        $descripcion=$_POST["descripcion"];
        $fallas="";
        //FALLAS
        $equipo=$_POST["Equipos"];//explode("=>",$_POST["Equipos"]);
    
        if(isset($_POST["email"])){
            if($_POST["email"]!=""){
                $email=$_POST["email"];
            }
        }
    
    
        if(isset($_POST["imei"])){
            if($_POST["imei"]!=""){
                $imei=$_POST["imei"];
            }
        }
    
        if(isset($_POST["serie"])){
            if($_POST["serie"]!=""){
                $serie=$_POST["serie"];
            }
        }
        
        
    $fallas="";    
    if($nrOrden>0){
        
        $r=0;
            
               
        $res=clsEquipo::EditarEquipo($nrOrden,$selectTipo,$garantias,$serie,$imei,clsFunciones::fecha2($_POST["fecha"],1),$Equipo_modelo,$descripcion);
        $fallas=clsIngreso_edit::EquipoDat($equipo,$nrOrden);
        $r=0;
        
            if($res[0]>0){
                //Borrar
                
                $res=clsEquipo::BorrarFallas($nrOrden);
                
                if($res[0]>0){
                    //insertar nuevas fallas
                    $res2=clsIngreso_edit::insertarFallas($fallas);
                    
                    
                        if($res2[0]>0){
                            //$_SESSION["msj"]="<div class='alert alert-info' role='alert'>Equipo nr. <strong>#$nrOrden !</strong> se edito correctamente . </div>";
                            $_SESSION["EquipoNR"]=$nrOrden;
                            $_SESSION["EquipBuscar"]=$nrOrden;
                           $r=1;
                        }
                      
                }
            }
        
    }
    echo $r;
        
    }
    
/** >>>Editar Equipos */






if(isset($_POST["EditarFallas"])){
    $nrOrden=$_POST["EditarFallas"];
    $TipoEquipo=$_POST["TipoEquipo"];
    
    $equipo=clsEquipo::getById($nrOrden);
    if(count($equipo)>0){
            
           
            
            $Des=clsEquipo::FallasActivaeInactivas($nrOrden,$TipoEquipo,0);  
            $Act=clsEquipo::FallasActivaeInactivas($nrOrden,$TipoEquipo,1);        
            
            
            
            
            $count=mysqli_num_rows($Des[0]);
            if($count>0){ 
            
            $dat1=clsIngreso_edit::armadoDatEquipo($Des);
            $dat2=clsIngreso_edit::armadoDatEquipo($Act);
            
            
            
            
 ?>
  
                    <div class="col-md-12" id="Equipo0">
                        
                        
                        <div class="row" style="margin-bottom: 10px;">
                            <table class="table table-striped">
                                    
                                    <?php 
                                      clsIngreso_edit::InputsFallas($dat2,"checked='checked'",$count);
                                      clsIngreso_edit::InputsFallas($dat1,"",$count);
                                        
                                    ?>
                       
                            
                             </table>
                            </div>
                            <div class="form-group">
                              <label for="requisitos">Observaciones</label>
                              <textarea class="form-control tipo textarea" rows="3" maxlength="500" name="descripcion" id="descripcion"     placeholder="Falla y observaciones" ></textarea> 
                           </div>
                       
                   </div>
                
                
      
 
 
 <?php           
            
        } 
    }
  }


/** Presupuesto editado o insertar */
    if(isset($_POST["Presupuesto"])){
        $r=0;
        $nrOrden=$_POST["Presupuesto"];
        $fecha= clsFunciones::fecha2($_POST["fecha"],1);
        $estaPresupuesto=$_POST["EstadoPresupuesto"];
        $detalle=$_POST["descripcion"];
        $PresupuestoTotal=$_POST["PresupuestoTotal"];
        $presupuesto=clsPresupuesto::getById($nrOrden);
        
        
        //edicion
        if(count($presupuesto)>0){
          
            $idPres=$presupuesto->id_Presupuesto; 
            $actulizar=clsPresupuesto::ActualizarPresupuesto($idPres,$fecha,$detalle,$PresupuestoTotal,$estaPresupuesto);
            
             if($actulizar[0]>0){
                $r=1;  
                $_SESSION["EquipoNR"]=$nrOrden;
                $_SESSION["EquipBuscar"]=$nrOrden;
             }
            
        }
        //Insert
        else{
            $res=clsPresupuesto::insertarPresupuesto($nrOrden,$fecha,$detalle,$PresupuestoTotal,$estaPresupuesto);
             if($res[1]>0){ //donde $res[1] ---- es el insert id
                $r=1;
                $_SESSION["EquipoNR"]=$nrOrden;
                $_SESSION["EquipBuscar"]=$nrOrden;
             }
        }
        
        echo $r;
    }


/** <<<< */


    // Armado de fallas
    if(isset($_POST["AddEquipos"])){
        $tipo=0;
        $tipo=$_POST["AddEquipos"];
        $cant=0;

        $res=clsEquipo::EquipoFallas($tipo);
        clsIngreso_edit::Fallas($res,$cant);



    }

    /** *
     *  ##### Ingreso Cliente | Equipo
     */

    if(isset($_POST["ClienteEquipos"])){



    $pos=7;
    $email="NULL";
    $numeroSerie="NULL";
    $imei="NULL";
   
    $serie="NULL";
    $selectTipo=$_POST["selectTipo"];
    $garantias=$_POST["Garantia"];
    $Equipo_modelo=$_POST["tipoEquipo"];
    $descripcion=$_POST["descripcion"];
    $fallas="";
    //FALLAS
    $equipo=$_POST["Equipos"];//explode("=>",$_POST["Equipos"]);

    if(isset($_POST["email"])){
        if($_POST["email"]!=""){
            $email=$_POST["email"];
        }
    }


    if(isset($_POST["imei"])){
        if($_POST["imei"]!=""){
            $imei=$_POST["imei"];
        }
    }

    if(isset($_POST["serie"])){
        if($_POST["serie"]!=""){
            $serie=$_POST["serie"];
        }
    }


    $IDclientes=clsCliente::InsertarCliente($_POST["nombre"],$_POST["apellido"],$_POST["telefono"],$_POST["dni"],$_POST["email"]);

    if($IDclientes>0)
    {
        //cliente nuevo

        if($equipo!="")
        {//NOTA $equipo tiene tipo fallas

            $nrOrden=clsEquipo::InsertarEquipo($IDclientes,$selectTipo,$garantias,$serie,$imei,clsFunciones::fecha2($_POST["fecha"],1),$Equipo_modelo,$descripcion);

            if($nrOrden>0)
            {
                //fallas


                $fallas=clsIngreso_edit::EquipoDat($equipo,$nrOrden);
                if($fallas!=""){

                    $res=clsIngreso_edit::insertarFallas($fallas);

                    if($res[0]>0)
                    {

                            echo $IDclientes;

                    }
                    else{echo 0;}
                }
                else{echo 1;}

            }
            else{echo 0;}
        }
        else{echo 0;}



    }
    else{

        // cliente exitente
        //Aca inserto los equipos para clientes exitentes \||| verifico por dni si realmente exite el dni es un atributo unico)
        $IDclientes=clsCliente::idCliente($_POST["dni"]);

        if($IDclientes>0)
        {

            if($equipo!="") //contiene string con las fallas
            {
                clsCliente::ClienteActivo($IDclientes,1);//activa al cliente dado de baja
                //devuelve el nr orden
                $nrOrden=clsEquipo::InsertarEquipo($IDclientes,$selectTipo,$garantias,$serie,$imei,clsFunciones::fecha2($_POST["fecha"],1),$Equipo_modelo,$descripcion);



                if($nrOrden>0){
                    //fallas
                    $fallas=clsIngreso_edit::EquipoDat($equipo,$nrOrden);
                    if($fallas!=""){


                        $res=clsIngreso_edit::insertarFallas($fallas);


                            if($res[0]>0){

                                 echo $IDclientes;
                            }

                    }

                }
                else{echo 0;}
            }



        }
        else{
            //el cliente  NO  exite
            echo 0;
        }
    }



}

    /** <<< */




/** Guardar Estado Equipo */

if(isset($_POST["EstadoSlGuarda"])){
    $res=0;
    $nrOrden=$_POST["EstadoSlGuarda"];
    $selectOption=$_POST["selectEstado"];

    $select=clsEquipo::guardarEstado($nrOrden,$selectOption);
    $res=$select[0];
    echo $res;
}


if(isset($_POST["Cambiar_equipo_garantia"])){

$nr_orden=$_POST["Cambiar_equipo_garantia"];
$tipo=$_POST["Selecttipo"];

    $res=clsEquipo::cambiar_garantizados($nr_orden,$tipo);
    echo $res[0];
}


/** Cargar estado select */
if(isset($_POST["Estado"])){

    $Selec= clsEquipo::EstadoEquipo($_POST["Estado"]);
    $idEstado=0;
    if(mysqli_num_rows($Selec[0])>0){
        $res=mysqli_fetch_assoc($Selec[0]);
        $idEstado=$res["id_estado"];
    }
    $Orden_Info = array(
        1 => "Estado Actual",
        2 => "Estado Final",
        3 => "Equipos CDR",
        4 => "Envios#BS.AS",
    );

    $Estados=clsEquipo::EstadoEquipo(0);

    $ord=2;

        if(mysqli_num_rows($Estados[0])>0){

            while($row=mysqli_fetch_assoc($Estados[0])){
                if($idEstado==$row["id_estado"]){
                    ?>


                    <option value="<?php echo $row["id_estado"];  ?>" selected="selected" ><?php echo $row["estado"]; ?></option>
                    <?php

                }
                else{

                    if($ord==$row["orden"]) {


                        ?>
                        <option value="" disabled=""></option>

                        <option value="" disabled="">---------<?php echo $Orden_Info[$ord]; ?>-----------------------
                        </option>
                        <option value="<?php echo $row["id_estado"]; ?>"><?php echo $row["estado"]; ?></option>


                        <?php
                        $ord++;

                    }
                    else{

                            ?>
                            <option value="<?php echo $row["id_estado"]; ?>"><?php echo $row["estado"]; ?></option>
                            <?php

                    }
                }





            }

        }



}

/** CAmbiar o agregar un numero garantizado */
if(isset($_POST["Cambiar_Orden_garantiza"])){
    $nr_orden=$_POST["Cambiar_Orden_garantiza"];
    $nr_garantiza=$_POST["nr_garantia"];
   $res=clsEquipo::cambiar_orden_garantiza($nr_orden,$nr_garantiza);
   if($res[0]>0){
       echo 1;
   }
   else{
       echo 0;
   }
}





}else{Core::redir("./");}
  /** 
  ########### Funciones #############
  
  */


    function ListarCliEqu($Buscar,$entregados,$ultimo){





        $E_entregados=$entregados;//es una parametro que viene de la interfasce donde cuando por ejemplo se busque por nombre y tildamos buscar todos , nos va a buscar  los equipos sin importar el estado
        $NOactivos=0;
        if(isset($Buscar)){
            $Buscar=$_POST["Buscar"];
            $NOactivos=1;
        }
        else{$NOactivos=0; }

        $clientes=NULL;
        if($ultimo==0){
            $clientes=clsCliente::ListarClientes($Buscar);
        }
        if($ultimo==10){
            $clientes= clsCliente::ListarUltimo_cliente();
        }
        if($ultimo==11){
            //$clientes=clsCliente::ListarUltimo_5_equipos();
            $clientes= clsCliente::ListarUltimo_5_equipos();
        }

        if($ultimo!=0 && $ultimo!=10 && $ultimo!=11){
            $clientes=clsCliente::Listar_oficial_garantia($ultimo);
        }

        /** Es para obtener el numero de orden que puso en buscar , para usarlo a la hora de resaltar el nr orden que se busca y no perderse. Solo funciona para las busqueda por nr orden*/
        $dat=explode("=>",$Buscar);
        $pos=$dat[0];$buscaOrden=0;
        if($dat[0]==3){$buscaOrden=$dat[1];}
        /** <<<<<<<<<*/



        if(count($clientes)>0){
            ?>

            <div class="panel-group" id="menu_Equipos">
                <?php
                foreach( $clientes as $cliente){
                    if($ultimo>0){$buscaOrden=$cliente->nr_orden;}
                    if($NOactivos){


                        ?>


                        <div class="panel panel-default" style="margin-bottom: 5px;margin-top:10px">
                            <div class="panel-heading">
                                <h4 class="panel-title">

                                    <table class='table' style="margin:0px;">
                                        <tr>

                                            <!--td style="padding:0px; border: 0;width: 3%;"><strong>#<?php //echo $cliente->id_cliente; ?></strong></td-->
                                            <td style="padding:0px; border: 0;" class="listCliente">
                                                <a data-toggle="collapse" data-parent="#menu_Equipos"  href="#Mostrar<?php echo $cliente->id_cliente; ?>"  ><?php echo "$cliente->nombre $cliente->apellido"."|"; ?></a>
                                            </td>
                                            <td style="padding:0px; border: 0;" class="listCliente tdOcultar">
                                                <span class="glyphicon glyphicon-sort-by-order " style="color:#428bca;margin-right: 2px;" ></span> <a data-toggle="collapse" data-parent="#menu_Equipos"  href="#Mostrar<?php echo $cliente->id_cliente; ?>"  ><?php echo $cliente->dni."|";?></a>
                                            </td>
                                            <td style="padding:0px; border: 0;"  class="tdOcultar2">
                                                <a   style="cursor:pointer"   >
                                                    <span class="glyphicon glyphicon-phone" ></span> <?php echo $cliente->telefono;?>
                                                </a>

                                            </td>

                                            <td style="padding:0px; border: 0;" class="listCliente tdOcultar" >
                                                <span class="glyphicon glyphicon-envelope" style="color:#428bca;margin-right: 2px;"></span><a data-toggle="collapse" data-parent="#menu_Equipos"  href="#Mostrar<?php echo $cliente->id_cliente; ?>"  ><?php echo $cliente->email."|";?></a>
                                            </td>


                                            <td  style="padding:0px; border: 0;text-align: right" class="acciones_botones"  id="_<?php echo $cliente->id_cliente; ?>">


                                                <?php
                                                $detect = new Mobile_Detect();
                                                if ($detect->isAndroidOS() ||$detect->isMobile()){

                                                    ?>
                                                    <a id="btnWhatsappMovil" href="contactosMjs/whatsapp.php?telefono=<?php echo $cliente->telefono;?>&nombre_dni=<?php echo clsFunciones::remplazar_espacio_caracter($cliente->nombre).$cliente->dni; ?>"    style="margin-right:3px;cursor:pointer;"  class="btn btn-success btn-sm " data-toggle="tooltip" data-placement="bottom" title="Iniciar chat" >
                                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                                    </a>

                                                    <?php

                                                }
                                                else{
                                                    ?>
                                                    <a id="btnWhatsapp" href="<?php echo clsFunciones::whatsapp("Hola buenas, soy del servicio tecnico",$cliente->telefono); ?>"  target="_blank"  style="margin-right:3px;cursor:pointer;"  class="btn btn-success btn-sm " data-toggle="tooltip" data-placement="bottom" title="Iniciar chat" >
                                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                                    </a>
                                                    <?php
                                                }

                                                ?>




                                                <a href="index.php?view=st_clienteQR&cliente=<?php echo $cliente->id_cliente; ?>"  style="margin-right:3px;cursor:pointer;"  class="btn btn-primary btn-sm acciones btnTop_espacio" data-toggle="tooltip" data-placement="bottom" title="Qr Contacto" >
                                                    <span class=" glyphicon glyphicon-qrcode" ></span>
                                                </a>



                                                <?php if(clsCliente::user_id()==1){ ?>
                                                    <a href="http://ventas.screamtech.com.ar/index.php?view=venderStCliente&nr=<?php echo $cliente->dni; ?>" target="_blank" style="margin-right:3px;cursor:pointer;background-color: #503cbc;border-color: #503cbc;"  class="btn btn-primary btn-sm " data-toggle="tooltip" data-placement="bottom" title="Vender | Cliente" >
                                                        <span class="glyphicon glyphicon-shopping-cart" ></span>
                                                    </a>
                                                <?php } ?>



                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle btn_360_top" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="index.php?view=st_NuevoEquipo&cliente=<?php echo $cliente->id_cliente; ?>"  style="margin-right:3px;cursor:pointer"   >
                                                                Equipo
                                                            </a>

                                                        </li>
                                                        <li>

                                                            <a href="index.php?view=Equipo_Garantia&cliente=<?php echo $cliente->id_cliente; ?>"  style="margin-right:3px;cursor:pointer"    >
                                                               Garantias
                                                            </a>
                                                        </li>



                                                    </ul>
                                                </div>


                                                <a href="index.php?view=st_EditarCliente&cliente=<?php echo $cliente->id_cliente; ?>"  style="margin-right:3px;cursor:pointer"  class="btn btn-primary btn-sm acciones   btn_360_top "  data-toggle="tooltip" data-placement="bottom" title="Editar cliente">
                                                    <span class="glyphicon glyphicon-pencil" ></span>
                                                </a>



                                                <a    href="./?view=st_imprimir&cliente=<?php echo $cliente->id_cliente; ?>"  style="margin-right:3px;"  class="btn btn-success btn-sm acciones   btn_360_top "  >
                                                    <span class="glyphicon glyphicon-print" ></span>
                                                </a>

                                            </td>
                                        </tr>
                                    </table>

                                </h4>
                            </div>
                            <!-- $$buscaOrden se ultilisa solo en busqueda por nr orden y te lo expande solo-->
                            <div id="Mostrar<?php echo $cliente->id_cliente; ?>" class="panel-collapse collapse <?php if($buscaOrden>0){echo "in";} ?>" style="color: rgb(255, 255, 255);background-color: black;<?php if($buscaOrden>0){"height:auto;";} ?>">
                                <div class="panel-body">
                                    <table class="table" style="margin:0;">
                                        <?php

                                        $res2=clsEquipo::ListarEquipo($cliente->id_cliente);

                                        $cant=0;$i=0;$linea=0;
                                        $cant=mysqli_num_rows($res2[0]);
                                        $Garantiza="";

                                        while ($row2 = mysqli_fetch_assoc($res2[0])) {
                                            //TR se le da altura para que los menu de editar o presupuesto se puedan ver. Si es uno solo o si son mas de uno solo al ultimo tr se le da altura

                                                $Garantiza=clsGarantiza::nombre_garantiza($row2["nr_orden"]);
                                                 $e_g=clsGarantiza_equipo::get_nr_orden($row2["nr_orden"]);
                                            if($row2["id_estado"]!=5){
                                                ?>

                                                <tr  style="<?php if($cant==1){ echo "height:108px;";} if($i==$cant-1){echo "height:108px;";} if($buscaOrden==$row2["nr_orden"]){echo ";color:#42ca8c;";}  ?>" >



                                                    <td style=" <?php if($linea==0){echo "border: 0;";} ?>" >
                                                        #<?php echo $row2["nr_orden"]; ?>
                                                    </td>
                                                    <td style=" <?php if($linea==0){echo "border: 0;";} ?>" class="tdOcultar">
                                                        <?php echo clsFunciones:: fecha2($row2["fecha_ingreso"],0) ;?>
                                                    </td>

                                                    <td style=" <?php if($linea==0){echo "border: 0;";} ?>">
                                                        <?php
                                                        $name_Tipo_equipo=clsTipoEquipo::name_tipo_equipo($row2["nr_orden"]);
                                                        $Tipo_equipo=$name_Tipo_equipo->equipo;
                                                        ?>
                                                       <?php echo "$Tipo_equipo: ".$row2["tipoEquipo"];?>



                                                    </td>


                                                    <?php

                                                    $presu=clsPresupuesto::getById2_presupuesto($row2["nr_orden"]);
                                                    $class="btn btn-primary btn-sm acciones";
                                                    $msj="Presupuesto";
                                                    $cantPres=0;
                                                    if(count($presu)>0){
                                                        $cantPres=count($presu);
                                                        $class="btn btn-success  btn-sm acciones";
                                                        if($presu->presupuesto>0){$msj="$".$presu->presupuesto;}
                                                    }
                                                    ?>


                                                    <td style=" <?php if($linea==0){echo "border: 0;";} ?>">
                                                        <strong>
                                                            <?php
                                                            if( $row2["id_estado"]==7){
                                                                if($cantPres > 0){
                                                                    echo $row2["estado"]. "<span style='color: #fff;'> | </span>"."<strong style='color:#3c8dbc;'>$".$presu->presupuesto."</strong>";
                                                                }else{ echo $row2["estado"];}

                                                            }
                                                            else{ echo $row2["estado"];}

                                                            ?>

                                                        </strong>
                                                    </td>


                                                </tr>

                                                <!-- Botones acciones -->
                                                <tr id="<?php echo $cliente->id_cliente."#".$row2["nr_orden"];  ?>">

                                                    <td colspan="4" style="border: 0;text-align: right">
                                                        <!-- Editar y Reingreso -->
                                                        <a  href="index.php?view=st_infEquipo&cliente=<?php echo $cliente->id_cliente; ?>&equipo=<?php echo $row2["nr_orden"]; ?> " style="margin-right:5px;cursor:pointer" class="btn btn-primary btn-sm acciones btnTop_espacio" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ver">
                                                            <span class="glyphicon glyphicon-info-sign"></span>
                                                        </a>

                                                        <a  href="index.php?view=st_EditarEquipo&cliente=<?php echo $cliente->id_cliente; ?>&equipo=<?php echo $row2["nr_orden"]; ?> " style="margin-right:5px;cursor:pointer" class="btn btn-primary btn-sm acciones btnTop_espacio" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Editar">
                                                            <span class="glyphicon glyphicon-pencil"></span>
                                                        </a>


                                                        <?php


                                                        if($Garantiza!=""){
                                                            ?>
                                                            <a id="<?php echo $row2["nr_orden"]; ?>"   style="margin-right:3px;cursor:pointer"  class="btn btn-info btn-sm acciones btn_Nr_garantiza"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Numero Orden de la garantia">
                                                                <span class="glyphicon glyphicon-sort-by-order" id="<?php echo $row2["orden_garantia"]; ?>"></span>
                                                            </a>
                                                            <?php
                                                        }

                                                        ?>

                                                        <?php

                                                        if($Garantiza!=""){
                                                            ?>

                                                            <a  href="index.php?view=GarantizarEquipo&equipo=<?php echo $row2["nr_orden"]; ?> " style="margin-right:5px;cursor:pointer; <?php if(count($e_g)>0){ ?> background-color: #503cbc;border-color: #503cbc; <?php } ?>" class="<?php echo $class." btnTop_espacio"; ?> " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Garantiza">
                                                                <span class="glyphicon glyphicon-send"></span>
                                                            </a>



                                                            <a   id="<?php echo $row2["nr_orden"]; ?>" style="margin-right:5px;cursor:pointer" class=" btn btn-warning btn-sm btn_Editar_equipo_garantia" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cambiar Equipo">
                                                                <span class="glyphicon glyphicon-repeat"></span>
                                                            </a>

                                                            <?php
                                                        }else{

                                                            ?>

                                                            <a  href="index.php?view=Presupuestos&equipo=<?php echo $row2["nr_orden"]; ?> " style="margin-right:5px;cursor:pointer" class="<?php echo $class." btnTop_espacio"; ?> " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $msj; ?>">
                                                                <span class="glyphicon glyphicon-usd"></span>
                                                            </a>


                                                            <a   id="<?php echo $row2["nr_orden"]; ?>" style="margin-right:5px;cursor:pointer" class=" btn btn-warning btn-sm  btn_Editar_equipo_garantia" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cambiar garantia">
                                                                <span class="glyphicon glyphicon-repeat"></span>
                                                            </a>

                                                            <?php

                                                        }

                                                        ?>





                                                        <a    href="./?view=st_imprimirEquipo&equipo=<?php echo $row2["nr_orden"]; ?>"  style="margin-right:3px;"  class="btn btn-success  btn-sm acciones btnTop_espacio"  >
                                                            <span class="glyphicon glyphicon-print" ></span>
                                                        </a>


                                                        <?php

                                                        //Solo funciona si ek boton esta listo o no reparado
                                                        if($row2["id_estado"]==7||$row2["id_estado"]==13){

                                                            ?>


                                                            <a id="<?php echo $row2["nr_orden"]; ?>"   style="cursor:pointer"  class="btn btn-danger btn-sm acciones btn_entregado"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Entregado">
                                                                <span class="glyphicon glyphicon-check"  style="padding-left: 5px"> ENTREGAR </span>
                                                            </a>
                                                        <?php } ?>


                                                    </td>



                                                </tr>


                                                <?php
                                            }

                                            else{
                                                $Garantiza="";
                                                if($E_entregados==1){

                                                    $Garantiza=clsGarantiza::nombre_garantiza($row2["nr_orden"]);
                                                    $e_g=clsGarantiza_equipo::get_nr_orden($row2["nr_orden"]);


                                                    $presu=clsPresupuesto::getById($row2["nr_orden"]);
                                                    $class="btn btn-primary btn-sm acciones";
                                                    $msj="Presupuesto";
                                                    $cantPres=0;
                                                    if(count($presu)>0){
                                                        $cantPres=count($presu);
                                                        $class="btn btn-success  btn-sm acciones";
                                                        if($presu->presupuesto>0){$msj="$".$presu->presupuesto;}
                                                    }

                                                    ?>
                                                   <tr  style="<?php if($cant==1){ echo "height:108px;";} if($i==$cant-1){echo "height:108px;";} if($buscaOrden==$row2["nr_orden"]){echo ";color:#42ca8c;";}  ?>" >



                                                        <td style="<?php if($linea==0){echo "border:0;";} ?>" >
                                                            <strong>#<?php echo $row2["nr_orden"]; ?></strong>
                                                        </td>
                                                        <td style="<?php if($linea==0){echo "border:0;";} ?>" class="tdOcultar">
                                                            <strong><?php echo clsFunciones::fecha2($row2["fecha_ingreso"],0) ;?></strong>
                                                        </td>

                                                        <td style="<?php if($linea==0){echo "border:0;";} ?>">
                                                            <?php
                                                            $name_Tipo_equipo=clsTipoEquipo::name_tipo_equipo($row2["nr_orden"]);
                                                            $Tipo_equipo=$name_Tipo_equipo->equipo;
                                                            ?>
                                                            <strong><?php echo "$Tipo_equipo: ".$row2["tipoEquipo"];?></strong>
                                                        </td>

                                                        <!--td style="border: 0;">
                                                     <strong><?php //echo AcortarCadena($row2["descripcion"]);?></strong>
                                                 </td-->
                                                        <td style="<?php if($linea==0){echo "border:0;";} ?>">
                                                            <strong>#<?php echo $row2["estado"];?></strong>
                                                        </td>
                                                   </tr>

                                                    <!-- Botones acciones -->
                                                    <tr id="<?php echo $cliente->id_cliente."#".$row2["nr_orden"];  ?>">

                                                        <td colspan="4" style="border: 0;text-align: right">
                                                            <!-- Editar y Reingreso -->
                                                            <a  href="index.php?view=st_infEquipo&cliente=<?php echo $cliente->id_cliente; ?>&equipo=<?php echo $row2["nr_orden"]; ?> " style="margin-right:5px;cursor:pointer" class="btn btn-primary btn-sm acciones btnTop_espacio" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ver">
                                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                            </a>

                                                            <a  href="index.php?view=st_EditarEquipo&cliente=<?php echo $cliente->id_cliente; ?>&equipo=<?php echo $row2["nr_orden"]; ?> " style="margin-right:5px;cursor:pointer" class="btn btn-primary btn-sm acciones btnTop_espacio" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Editar">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </a>


                                                            <?php


                                                            if($Garantiza!=""){
                                                                ?>
                                                                <a id="<?php echo $row2["nr_orden"]; ?>"   style="margin-right:3px;cursor:pointer"  class="btn btn-info btn-sm acciones btn_Nr_garantiza"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Numero Orden de la garantia">
                                                                    <span class="glyphicon glyphicon-sort-by-order" id="<?php echo $row2["orden_garantia"]; ?>"></span>
                                                                </a>
                                                                <?php
                                                            }

                                                            ?>

                                                            <?php

                                                            if($Garantiza!=""){
                                                                ?>

                                                                <a  href="index.php?view=GarantizarEquipo&equipo=<?php echo $row2["nr_orden"]; ?> " style="margin-right:5px;cursor:pointer; <?php if(count($e_g)>0){ ?> background-color: #503cbc;border-color: #503cbc; <?php } ?>" class="<?php echo $class." btnTop_espacio"; ?> " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Garantiza">
                                                                    <span class="glyphicon glyphicon-send"></span>
                                                                </a>



                                                                <a   id="<?php echo $row2["nr_orden"]; ?>" style="margin-right:5px;cursor:pointer" class=" btn btn-warning btn-sm btn_Editar_equipo_garantia" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cambiar Equipo">
                                                                    <span class="glyphicon glyphicon-repeat"></span>
                                                                </a>

                                                                <?php
                                                            }else{

                                                                ?>

                                                                <a  href="index.php?view=Presupuestos&equipo=<?php echo $row2["nr_orden"]; ?> " style="margin-right:5px;cursor:pointer" class="<?php echo $class." btnTop_espacio"; ?> " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $msj; ?>">
                                                                    <span class="glyphicon glyphicon-usd"></span>
                                                                </a>


                                                                <a   id="<?php echo $row2["nr_orden"]; ?>" style="margin-right:5px;cursor:pointer" class=" btn btn-warning btn-sm  btn_Editar_equipo_garantia" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cambiar garantia">
                                                                    <span class="glyphicon glyphicon-repeat"></span>
                                                                </a>

                                                                <?php

                                                            }

                                                            ?>





                                                            <a    href="./?view=st_imprimirEquipo&equipo=<?php echo $row2["nr_orden"]; ?>"  style="margin-right:3px;"  class="btn btn-success  btn-sm acciones btnTop_espacio"  >
                                                                <span class="glyphicon glyphicon-print" ></span>
                                                            </a>


                                                            <?php

                                                            //Solo funciona si ek boton esta listo o no reparado
                                                            if($row2["id_estado"]==7||$row2["id_estado"]==13){

                                                                ?>


                                                                <a id="<?php echo $row2["nr_orden"]; ?>"   style="cursor:pointer"  class="btn btn-danger btn-sm acciones btn_entregado"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Entregado">
                                                                    <span class="glyphicon glyphicon-check"  style="padding-left: 5px"> ENTREGAR </span>
                                                                </a>
                                                            <?php } ?>


                                                        </td>



                                                    </tr>





                                                    <?php

                                                }

                                            }

                                            $i++;
                                            $linea++;

                                        }


                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>



                        <?php
                    }

                }//while
                ?>
            </div> <!-- Cierre del panel grup -->
            <?php
        }//if






    }

    /** *
     *   L.C.E <<<
     */





?>