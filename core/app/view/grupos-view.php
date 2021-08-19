<?php

$estado=0;
$nr_orden=0;
$estado_name="";
if(!isset($_GET["equipo2"])&&!isset($_GET["estado"])){
    core::redir("http://screamtech.com.ar/");
}
$volver="";
if(validar_equipos($_GET["equipo2"])&& clsSeguridad::validarID($_GET["estado"])){


    //EStado siguiente
    $estado=$_GET["estado"];
    $nr_orden=$_GET["equipo2"];
    $estado_name=estados_generales($estado);
    $volver="&equipo2=$nr_orden&estado=$estado";




}
else{
    core::redir("http://screamtech.com.ar/");
}


//resibo string con las ordenes separadon cada numero con -
function validar_equipos($equipos){
    $dat=explode("-",$equipos);
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
        case 4:{$estado="Presupuesto_Diagnostico";break;}
        case 7:{$estado="Listo";break;}
        case 13:{$estado="No reparado";;break;}
        default:{break;}
    }
    return $estado;
}




?>


<div class="row">
    <div class=" col-md-12 col-xs-12">
        <a href="./"><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
        <hr>

        <h3><i class="glyphicon glyphicon-phone"></i> Grupo de Equipos con estado <?php echo $estado_name; ?></h3>

        <h4>Listado de los equipos</h4>
        <hr/>

    </div>

    <div class=" col-md-12 col-xs-12">



        <table class="table" style="margin:0;">
            <?php


            $dat=explode("-",$nr_orden);
            $cant=0;
            if(count($dat)>0){
                for($i=0;$i<count($dat);$i++) {
                    $equipo = clsEquipo::Lista_equipos_id($dat[$i]);


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

                                <td style=" text-align: right; id="<?php echo 1 . "#" . $row2->nr_orden; ?>">

                                    <!-- Editar y Reingreso -->
                                    <a href="index.php?view=st_infEquipo&equipo=<?php echo $row2->nr_orden; ?>&volver=grupos<?php echo $volver; ?> "
                                       style="margin-right:5px;cursor:pointer"
                                       class="btn btn-primary btn-sm acciones btnTop_espacio" data-toggle="tooltip"
                                       data-placement="bottom" title="" data-original-title="Ver">
                                        <span class="glyphicon glyphicon-info-sign"></span>
                                    </a>




                                    <!-- Presupuesto, Notificar, Estado garantia, -->

                                    <?php

                                    if ($Garantiza != "") {
                                        ?>

                                        <a href="index.php?view=GarantizarEquipo&equipo=<?php echo $row2->nr_orden; ?>&volver=grupos<?php echo $volver; ?>  "
                                           style="margin-right:5px;cursor:pointer; <?php if (count($e_g) > 0) { ?> background-color: #503cbc;border-color: #503cbc; <?php } ?>"
                                           class="<?php echo $class . " btnTop_espacio"; ?> " data-toggle="tooltip"
                                           data-placement="bottom" title="" data-original-title="Garantiza">
                                            <span class="glyphicon glyphicon-send"></span>
                                        </a>

                                        <?php
                                    } else {

                                        ?>
                                        <a href="index.php?view=Presupuestos&equipo=<?php echo $row2->nr_orden; ?>&volver=grupos<?php echo $volver; ?>  "
                                           style="margin-right:5px;cursor:pointer"
                                           class="<?php echo $class . " btnTop_espacio"; ?> " data-toggle="tooltip"
                                           data-placement="bottom" title="" data-original-title="<?php echo $msj; ?>">
                                            <span class="glyphicon glyphicon-usd"></span>
                                        </a>

                                        <?php

                                    }

                                    ?>






                                    <a href="./?view=st_imprimirEquipo&equipo=<?php echo $row2->nr_orden; ?>&volver=grupos<?php echo $volver; ?>"
                                       style="margin-right:3px;" class="btn btn-success btn-sm acciones btnTop_espacio">
                                        <span class="glyphicon glyphicon-print"></span>
                                    </a>


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


        var CantFallas=0;//saber si ahi fallas;
        var TIPO_EQUIPO=0;




        /** ##############################
         *   Nuevo equipo
         *  #############################
         *  */


        $('form#FormNuevos').submit(function() {

            $("div#inf").empty();
            if(IDcliente>0){
                var dat="EditarCliente="+IDcliente+"&";




                dat+=$(this).serialize();//aca guardo todo el form

                $.ajax({
                    type: 'POST',
                    url:  './?action=st_Cliente',
                    data: dat,
                    beforeSend: function () {

                        LoadingGif("form#FormNuevos button#btnMasEquipo","form#FormNuevos div#imgGuardar","form#FormNuevos div#inf",1);
                    },
                    success: function(res) {
                        //alert("resultado:"+res);
                        if(res>0){

                            $("div#inf").append("<div class='alert alert-success'>Se guardo correctamente.</div>");
                            reset("form#FormNuevos");
                            $("div#inf").empty();
                            LoadingGif("form#FormNuevos button#btnMasEquipo","form#FormNuevos div#imgGuardar","form#FormNuevos div#inf",0);
                            window.location='index.php?view=st_Equipos';


                        }
                        else{
                            $("div#inf").append("<div class='alert alert-warning'>Ocurri&oacute; un error o el numero de telefono ya se registro.</div>");
                            LoadingGif("form#FormNuevos button#btnMasEquipo","form#FormNuevos div#imgGuardar","form#FormNuevos div#inf",0);
                        }

                    }
                });
                //LoadingGif("form#FormAddMasE button#btnMasEquipo","form#FormAddMasE div#imgGuardar","form#FormAddMasE div#inf",0);
            }
            else{$("div#inf").append("<div class='alert alert-warning'>Ocurri&oacute; un error. (no hay cliente) </div>");}



            return false;
        });



        /** <<<<<I.C.E */

        /**#############################
         * ############################# */

        /** Funciones generales */


        function ResetSelect(){

            $("div#DatosIdiomas").css('display','none');
            $('select.SelectListados').each(function(){
                $(this).prop('selectedIndex',' ');

            });
            desabilitarInput(0,"select#idioma");
            desabilitarInput(0,"select#localidad");

        }


        function desabilitarInput(op,elem){
            if(op){$(elem).prop('disabled', false);}
            else{$(elem).prop('disabled', true);}
        }


        function BorrarMsj(IDmsj){
            $(IDmsj).empty();
        }

        function reset(form){
            $(form).each(function(){
                this.reset();
            });


        }

        //borra los equipos generador botno mas equipos
        $("div#ContEquipos").on("click","button#BorrarEquipos",function(){

            //idPag=Cursos.parent().attr('id');
            var Padre=$(this).parent();
            var id=Padre.attr("id");

            $("div#ContEquipos div#"+id).remove();

        });




        /** F.G <<< */



        /**
         *  Armado de Fallas
         *
         * */





        /** A.F <<<*/

        /**
         *  LoadingGif
         * */

        function LoadingGif(btn,gif,inf,op){
            if(op){
                $(inf).css("display","none");
                $(gif).css("display","block");
                desabilitarInput(0,btn);
            }
            else{
                $(inf).css("display","block");
                $(gif).css("display","none");
                desabilitarInput(1,btn);
            }

        }

        /** L.G <<< */

        /** ######## FIN ######*/


    });

</script>


