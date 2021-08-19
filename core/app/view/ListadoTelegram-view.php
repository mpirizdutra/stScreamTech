<?php

$estado=0;
$nr_orden=0;
$estado_name="";
if(!isset($_GET["equipos"])){
   core::redir("http://serviciotecnico.screamtech.com.ar/");
}
$volver="";
$Ordenes_equipos=explode("-",$_GET["equipos"]);

if(validar_equipos($Ordenes_equipos)){


    //EStado esta en la posicion 0
    $estado=$Ordenes_equipos[0];

    $nr_orden=$_GET["equipos"];
    $volver="&equipos=$nr_orden";
    $estado_name=estados_generales($estado);
    $estado_quitar=$estado;




}
else{
    core::redir("http://serviciotecnico.screamtech.com.ar/");
}


//resibo string con las ordenes separadon cada numero con -
function validar_equipos($dat){

    $r=0;
    $res=false;
    for($i=0;$i<count($dat);$i++){
        if(clsSeguridad::validarID($dat[$i])){
            $r++;
        }
    }
    if($r==count($dat)){
        $res=true;
    }


    return $res;

}

function estados_generales($id_estado){
    $estado="Ingresado";
    switch ($id_estado){

        case 1:{$estado="Ingresado";break;}
        case 4:{$estado="Presupuesto | Diagnostico";break;}
        case 7:{$estado="Listo";break;}
        case 13:{$estado="No reparado";;break;}
        default:{break;}
    }
    return $estado;
}




?>

<script type="text/javascript">

    var LISTA="index.php?view=ListadoTelegram<?php echo $volver; ?>";

</script>

<div class="row">
    <div class=" col-md-12 col-xs-12">

        <hr>

        <h3><i class="glyphicon glyphicon-phone"></i> Lista de equipos  (<?php echo $estado_name; ?>)</h3>

        <h4>Buenas suerte !!!!</h4>
        <hr/>

    </div>

    <div class=" col-md-12 col-xs-12">



        <table class="table" style="margin:0;">
            <?php



            $cant=0;
            if(count($Ordenes_equipos)>0){
                for($i=0;$i<count($Ordenes_equipos);$i++) {
                    $equipo = clsEquipo::Lista_equipos_id($Ordenes_equipos[$i],$estado_quitar);


                    $Garantiza = "";
                    $linea=0;
                    foreach ($equipo as $row2) {
                        //TR se le da altura para que los menu de editar o presupuesto se puedan ver. Si es uno solo o si son mas de uno solo al ultimo tr se le da altura

                        $Garantiza = clsGarantiza::nombre_garantiza($row2->nr_orden);
                        $e_g = clsGarantiza_equipo::get_nr_orden($row2->nr_orden);
                        if ($row2->id_estado != 5) {
                            ?>

                            <tr >


                                <td >
                                    #<?php echo $row2->nr_orden; ?>
                                </td>
                                <td class="tdOcultar">
                                    <?php echo clsFunciones:: fecha2($row2->fecha_ingreso, 0); ?>
                                </td>

                                <td >
                                    <?php echo $row2->tipoEquipo; ?>

                                </td>


                                <?php

                                $presu = clsPresupuesto::getById2_presupuesto($row2->nr_orden);
                                $class = "btn btn-primary btn-sm acciones";
                                $msj = "Presupuesto";
                                $cantPres = 0;
                                if (count($presu) > 0) {
                                    $cantPres = count($presu);
                                    $class = "btn btn-success  btn-sm acciones";
                                    if ($presu->presupuesto > 0) {
                                        $msj = "$" . $presu->presupuesto;
                                    }
                                }
                                ?>


                                <td >
                                    <strong>
                                        <?php
                                        if ($row2->id_estado == 4 || $row2->id_estado == 7) {
                                            if ($cantPres > 0) {
                                                echo $row2->estado . "<span style='color: #fff;'> | </span>" . "<strong style='color:#3c8dbc;'>$" . $presu->presupuesto . "</strong>";
                                            } else {
                                                echo $row2->estado;
                                            }

                                        } else {
                                            echo $row2->estado;
                                        }

                                        ?>

                                    </strong>
                                </td>

                                <td class="btns" style=" text-align: right; id="<?php echo 1 . "#" . $row2->nr_orden; ?>">

                                <!-- ver -->
                                <a href="index.php?view=st_infEquipo&equipo=<?php echo $row2->nr_orden; ?>&volver=ListadoTelegram<?php echo $volver; ?> "
                                   style="margin-right:5px;cursor:pointer"
                                   class="btn btn-primary btn-sm acciones btnTop_espacio" data-toggle="tooltip"
                                   data-placement="bottom" title="" data-original-title="Ver">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                </a>




                                <!-- Presupuesto, Notificar, Estado garantia, -->

                                <?php

                                if ($Garantiza != "") {
                                    ?>

                                    <a href="index.php?view=GarantizarEquipo&equipo=<?php echo $row2->nr_orden; ?>&volver=ListadoTelegram<?php echo $volver; ?>  "
                                       style="margin-right:5px;cursor:pointer; <?php if (count($e_g) > 0) { ?> background-color: #503cbc;border-color: #503cbc; <?php } ?>"
                                       class="<?php echo $class . " btnTop_espacio"; ?> " data-toggle="tooltip"
                                       data-placement="bottom" title="" data-original-title="Garantiza">
                                        <span class="glyphicon glyphicon-send"></span>
                                    </a>

                                    <?php
                                } else {

                                    ?>
                                    <a href="index.php?view=Presupuestos&equipo=<?php echo $row2->nr_orden; ?>&volver=ListadoTelegram<?php echo $volver; ?>  "
                                       style="margin-right:5px;cursor:pointer"
                                       class="<?php echo $class . " btnTop_espacio"; ?>">
                                        <span class="glyphicon glyphicon-usd"></span>
                                    </a>

                                    <?php

                                }


                                    if($estado==7||$estado==13){
                                ?>

                                        <a id="<?php echo $row2->nr_orden; ?>" style="cursor:pointer" class="btn btn-danger btn-sm acciones btn_entregado" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Entregado">
                                            <span class="glyphicon glyphicon-check" style="padding-left: 5px"> ENTREGAR </span>
                                        </a>

                                <?php } ?>


                                <!--a href="./?view=st_imprimirEquipo&equipo=<?php //echo //$row2->nr_orden; ?>&volver=ListadoTelegram<?php //echo $volver; ?>"
                                   style="margin-right:3px;" class="btn btn-success btn-sm acciones btnTop_espacio" target="_blank">
                                    <span class="glyphicon glyphicon-print"></span>
                                </a!-->


                                </td>
                            </tr>
                            <?php
                        }


                    }

                }

            }


            ?>
        </table>






    </div>

</div>


<!--
       #############################################################
       #############################################################
 -->


<script>

    $(document).ready(function(){


        $("a.btn_entregado").click(function(){
            var id= $(this).attr("id");

           equipo_entregado(id);
        });



        function equipo_entregado(orden){
            var dat="equipo_entregado="+orden;
            $("div#inf").empty();

            $.ajax({
                type: 'POST',
                url:  './?action=st_Equipos',
                data: dat,
                success: function(res) {

                   window.location=LISTA;
                }
            });
        }


   });

</script>


