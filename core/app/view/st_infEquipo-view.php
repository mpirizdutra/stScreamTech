<?php
$Idcliente=0;
$nrEquipo=0;
$volver_si=false;
$url="";
if(isset($_GET["volver"])){
$volver_si=true;
$url=$_GET["volver"]."&equipos=".$_GET["equipos"];
}
if(isset($_GET["cliente"])){
   if(isset($_GET["volver"])) {
       if (!$volver_si) {
           $_SESSION["msj"] = "<div class='alert alert-warning' role='alert'> <strong>Alerta!</strong> Se perdio la referencia del cliente. </div>";
           Core::redir("./?view=st_Equipos");
       }
   }
}
if(isset($_GET["equipo"])&&clsSeguridad::validarID($_GET["equipo"])){


    $nrEquipo=$_GET["equipo"];
    $Equipo=clsEquipo::getById($nrEquipo);

    $Garantiza=clsGarantiza::nombre_garantiza($nrEquipo);

    $name_Tipo_equipo=clsTipoEquipo::name_tipo_equipo($nrEquipo);
    $Tipo_equipo=$name_Tipo_equipo->equipo;

    if(!count($Equipo)>0){
        $_SESSION["msj"]="<div class='alert alert-warning' role='alert'><strong>El equipo nr. #$nrEquipo !</strong> no exite.</div>";
        Core::redir("./?view=st_Equipos");
    }else{$_SESSION["EquipBuscar"]=$nrEquipo;}
    $c=null;
    if(!$volver_si) {
        $Idcliente=$_GET["cliente"];
        $c = clsCliente::getById($Idcliente);
    }
    else{
        $c=clsCliente::getById(clsCliente::idCliente2($nrEquipo));

    }
    if(!count($c)>0){
        $_SESSION["msj"]="<div class='alert alert-warning' role='alert'><strong>El siguiente numero #$Idcliente !</strong> de cliente no exite.</div>";
        Core::redir("./?view=st_Equipos");
    }
    error_reporting(0);
    $idGarantia=$Equipo->id_garantia_garantia;
}
else{
    $_SESSION["msj"]="<div class='alert alert-warning' role='alert'> <strong>Alerta!</strong> Se perdio la referencia del Equipo. </div>";
    Core::redir("./?view=st_Equipos");

}





?>

<div class="row">
    <div class="col-md-12">
        <a style="margin-left: 10px;font-size: 20px" href=" <?php if(!$volver_si){ ?> ./ <?php } else{ ?> ./?view=<?php echo $url; } ?> "><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
        <hr>
        <h1><i class="glyphicon glyphicon-phone"></i>  Equipo</h1>

        <form id="FormEquipos"  >

            <div class='col-md-12 col-xs-12' >


                <div class="row">
                    <br />


                    <br />


                </div>
                <br />
                <div class="row">
                    <?php $cliente=clsCliente::getById($Idcliente); ?>
                    <h4 style="color: #428bca !important;">Datos del Cliente <strong> <?php echo "#".$cliente->id_cliente ?></strong></h4>
                    <br />
                    <div class="col-md-12 col-xs-12">
                        <?php

                        if(count($cliente)>0){
                            ?>
                            <h4><strong>Nombre y Apellido:</strong> <?php echo clsFunciones::MayusculaPrimera($cliente->nombre." ".$cliente->apellido); ?></h4>
                            <h4><strong>D.N.I:</strong> <?php echo $cliente->dni; ?></h4>
                            <h4><strong>Nr. Telefono:</strong> <?php echo $cliente->telefono; ?></h4>
                            <?php
                        }
                        ?>


                    </div>
                    <br /><br />

                </div>
                <!-- Datos del cliente<<< -->


                <!-- >>> Datos del Equipo -->
                <hr />



                <div class='row' id="DatosEquipo" >

                    <div class="col-md-12 col-xs-12" >

                        <h4 style="margin-left: 5px;color: #428bca !important;" id="DEh5"> <?php if($Garantiza!=""){ ?> Garantiza <strong style="font-size: 20px"><?php echo "#".$Garantiza; } ?></strong></h4>
                        <br />

                        <h4 style="margin-left: 5px;color: #428bca !important;" id="DEh4">Datos del Equipo <strong><?php echo "#".$nrEquipo; ?></strong></h4>
                        <br />


                        <div class="col-md-6 col-xs-12">


                                <label for="fecha" >Fecha de ingreso</label>
                                <div class="input-group form-group" >
                                                                 <span class="">
                                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                                     <?php  echo clsFunciones::fecha2($Equipo->fecha_ingreso,0); ?>
                                                                 </span>
                                </div>



                            <label>Descripcion:</label>
                            <div class="input-group form-group  ">

                                    <span >
                                            <span class="glyphicon glyphicon-phone" style="padding-right: 5px"></span>
                                             <span style="color:green;font-size: 20px"><?php echo $Tipo_equipo.": "; ?></span><?php echo $Equipo->tipoEquipo; ?>
                                    </span>

                            </div>

                            <label>Imei:</label>
                            <div class="input-group form-group  ">

                                    <span >
                                            <span class="glyphicon glyphicon-sort-by-order-alt" style="padding-right: 5px"></span>
                                            <?php if($Equipo->imei!="NULL"){echo $Equipo->imei;}else{echo "No registra";} ?>
                                    </span>

                            </div>

                            <label>Nr. serie:</label>
                            <div class="input-group form-group  ">

                                    <span >
                                            <span class="glyphicon glyphicon-barcode" style="padding-right: 5px"></span>
                                            <?php if($Equipo->Nserie!="NULL"){ echo $Equipo->Nserie;}else{echo "No registra.";} ?>
                                    </span>

                            </div>

                            <label>Estado de Garantia:</label>
                            <div class="input-group form-group  ">

                                    <span >
                                            <span class="glyphicon glyphicon-hourglass" style="padding-right: 5px"></span>

                                        <?php
                                                switch ($idGarantia){
                                                    case 1:{echo "Sin garantia.";break;}
                                                    case 2:{echo "Garantia Fabrica.";break;}
                                                    case 3:{echo "Garantia Extendida.";break;}
                                                }

                                            ?>
                                    </span>

                            </div>

                        </div>
                    </div>

                </div>


            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <hr />
                    <br />
                    <h4 style="color: #428bca !important;">Posible Fallas</h4>
                    <br />
                </div>

                <div class="col-mds-12 col-xs-12">
                    <p>
                        <?php

                            echo clsFunciones::fallaPrint(clsEquipo::FallasActivaeInactivas($nrEquipo,$Equipo->id_tipo_equipo,1));

                        ?>
                    </p>
                </div>
                <div class="col-md-12 col-xs-12">
                    <hr />
                    <br />
                    <h4 style="color: #428bca !important;">Descripcion</h4>
                    <br />
                </div>
                <div class="col-mds-12 col-xs-12">

                    <p>
                        <?php echo $Equipo->descripcion; ?>
                    </p>
                </div>

            </div>

                <!-- <<< -->
        </form>

    </div>
</div>


<!--
       #############################################################
       #############################################################
 -->


<script>

    $(document).ready(function(){




    });

</script>

