<?php
ValidacionSesion::Validar();
if(ValidacionSesion::$isLoggedIn) {
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

}else{Core::redir("./");}
?>