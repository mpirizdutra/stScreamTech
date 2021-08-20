<?php
$nrEquipo=0;

$volver_si=false;
$url="";
if(isset($_GET["volver"])){
    $volver_si=true;
    $url=$_GET["volver"]."&equipos=".$_GET["equipos"];
}


if(isset($_GET["equipo"])&&clsSeguridad::validarID($_GET["equipo"])){

    $nrEquipo=$_GET["equipo"];
    $Eq=clsEquipo::getById($nrEquipo);
    $_SESSION["EquipBuscar"]=$nrEquipo;
    if(!count($Eq)>0){
        $_SESSION["msj"]="<div class='alert alert-warning' role='alert'><strong>El equipo nr. #$nrEquipo !</strong> no exite.</div>";
        Core::redir("./?view=st_Equipos");
    }



}
else{
    $_SESSION["msj"]="<div class='alert alert-warning' role='alert'> <strong>Alerta!</strong> Se perdio la referencia del equipo. </div>";
    Core::redir("./?view=st_Equipos");

}




$total=0;

//`id_Presupuesto`, `nr_orden`, `idEs_pre`, `fecha`, `detalle`, `presupuesto`, `aprobado`

?>
<script>
    var nrOrden=0;

    nrOrden=<?php echo $nrEquipo; ?>;



</script>
<style>
    .verde{color:green;}
    .naranja{color:red;}
</style>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <a href=" <?php if(!$volver_si){ ?> ./ <?php } else{ ?> ./?view=<?php echo $url; } ?> "><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
        <hr>
        <?php
        if(isset($_SESSION["msj"])){
            echo $_SESSION["msj"];
            unset($_SESSION["msj"]);
        }
        ?>

    </div>


    <div class="col-md-4 col-xs-12">


        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">


            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Informacion Cliente | Equipo
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                    <?php
                        if($nrEquipo>0){
                            $Equipo=clsEquipo::getById($nrEquipo);

                            $Garantiza=clsGarantiza::nombre_garantiza($nrEquipo);

                            $name_Tipo_equipo=clsTipoEquipo::name_tipo_equipo($nrEquipo);
                            $Tipo_equipo=$name_Tipo_equipo->equipo;

                            $cliente=clsCliente::getById(clsCliente::idCliente2($nrEquipo));
                            if(count($cliente)>0){
                                ?>
                                <h4><strong>Nombre y Apellido:</strong> <?php echo clsFunciones::MayusculaPrimera($cliente->nombre." ".$cliente->apellido); ?></h4>
                                <h4><strong>D.N.I:</strong> <?php echo $cliente->dni; ?></h4>
                                <h4><strong>Nr. Telefono:</strong> <?php echo $cliente->telefono; ?></h4>
                                <?php
                            }
                            ?>
                            <br/>
                            <h4><strong>Datos del equipo: <span style="color:green;">#<?php echo $nrEquipo; if($Garantiza!=""){ echo " | Garantiza:$Garantiza"; } ?></span></strong></h4>
                            <h4><strong>Tipo de Equipo:</strong> <?php echo $Tipo_equipo." ".$Equipo->tipoEquipo; ?> </h4>
                            <h4><strong>Detalle:</strong> <?php  echo $Equipo->descripcion; ?> </h4>

                            <h4><strong>Fallas:</strong> <?php  echo  clsFunciones::fallaPrint(clsEquipo::FallasActivaeInactivas($nrEquipo,$Equipo->id_tipo_equipo,1));; ?> </h4>

                            <?php

                        }

                    ?>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xs-12">
        <br/>
        <h3><i class="glyphicon glyphicon-phone"></i> Seguimiento del Equipo </h3>


        <form id="FormNuevos"    method="POST" action="./?view=guardar_editar_seguimiento<?php
            if($volver_si){echo "&volver=".$url;}
        ?>">

            <div class='col-md-12' >









                <div class="row">
                    <hr/>
                    <br/>
                    <p class="alert alert-info"><strong>Los estado de <span style="color:red">color rojo</span> no tienen ninguna entrada.</strong></p>

                    <br/>
                    <h4>Estado del equipo</h4>
                    <div class="col-md-12 col-xs-12">
                        <div class="col-md-6 col-xs-12" id="Estados_garantiza">
                            <?php
                            $estado_p=clsPresupuesto_estado::getAll();
                            $E_G=clsPresupuesto::pasos_estado($nrEquipo);
                            $cant=false;

                            foreach($estado_p as $estado){
                                if(count($E_G)>0){
                                    foreach ($E_G as $e){

                                        if($estado->idEs_pre==$e->idEs_pre){

                                            $cant=true;
                                            ?>
                                            <label class="radio-inline verde">
                                                <input type="radio" class="g_e"  name="estado_Equipo" id="<?php echo $estado->idEs_pre; ?>" value="<?php echo $estado->idEs_pre."-1"; ?>"  /> <?php echo $estado->nombre; ?>


                                            </label>
                                            <?php

                                        }

                                    }
                                    if($cant==false){

                                        ?>
                                        <label class="radio-inline naranja">
                                            <input type="radio" class="g_e"  name="estado_Equipo" id="<?php echo $estado->idEs_pre; ?>" value="<?php echo $estado->idEs_pre."-2"; ?>"  /> <?php echo $estado->nombre; ?>

                                        </label>

                                        <?php
                                    }
                                    else{ $cant=false;}

                                }
                                else{
                                    ?>

                                    <label class="radio-inline naranja">
                                        <input type="radio" class="g_e"  name="estado_Equipo" id="<?php echo $estado->idEs_pre; ?>" value="<?php echo $estado->idEs_pre."-2"; ?>"  /> <?php echo $estado->nombre; ?>

                                    </label>


                                    <?php
                                }

                            }

                            ?>


                        </div>

                        <div id="Contenido_descripcion" style="display: none">

                            <?php
                            $cantidad_E_G=0;
                            $cantidad_E_G=count($E_G);
                            if(count($E_G)>0){
                                foreach ($E_G as $e_g){
                                    if($e_g->idEs_pre==4){
                                        $total=$e_g->presupuesto;
                                    }
                                    ?>

                                    <div id="cont_value_<?php echo $e_g->idEs_pre;?>">
                                        <h1><?php echo clsFunciones::fecha2($e_g->fecha,1); ?></h1>
                                        <h2><?php echo $e_g->detalle; ?></h2>
                                    </div>


                                    <?php
                                }
                            }

                            ?>

                        </div>
                    </div>
                    <br/>
                    <hr/>
                    <div class="col-md-12 col-xs-12">
                        <a id="<?php echo $nrEquipo; ?>"  style="cursor:pointer;display:none" class="btn btn-danger btn-sm btn_entregado" >
                            <span class="glyphicon glyphicon-check" style="padding-left: 5px"> ENTREGAR </span>
                        </a>  
                    </div>

                </div>
                <br/>
                <br/>





                <div class="row">


                    <h4>Descripcion <span id="detalle_g" style="color:dodgerblue"></span></h4>



                    <div class="col-md-3 col-xs-12">
                        <label for="fecha">Fecha</label>
                        <div class="input-group form-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input  type="hidden" name="nrOrden" value="<?php echo $nrEquipo; ?>" />
                            <input type="date" class="form-control" name="fecha" id="fecha"  value="<?php echo date('Y-m-d'); ?>"/>
                        </div>
                    </div>


                    <div class="col-md-12 col-xs-12">

                        <div class="form-group">

                            <textarea class="form-control" rows="5" maxlength="3500" name="descripcion" id="descripcion" required="required" placeholder="Detalle"></textarea>
                        </div>


                        <div class="form-group">

                            <input type="number" class="form-control" min="0" maxlength="6" name="total"  id="L_total" placeholder="Presupuesto $" value="<?php echo $total; ?>" />
                            <input type="hidden" class="form-control" min="0" maxlength="6" name="total2"  id="total2" placeholder=" " value="<?php echo $total; ?>" />

                        </div>

                    </div>

                </div>




                <!--Datos del Equipo<<<<-->
                <div class="col-md-12" style="clear: both;padding-bottom: 10px;" >
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-8" id="inf" style="padding-left: 0;text-align: center;">

                            </div>
                            <div class="col-md-8" id="imgGuardar" style="padding-left: 0;text-align: center;display:none">
                                <img  src="plugins/dist/img/guardar.gif" />
                            </div>
                            <?php
                            if(isset($_SESSION["user_id"])){

                                if($_SESSION["permiso"]==10){
                                    ?>

                                    <button name="mysubmit" type="submit" id="btnGuardarCliente" data-loading-text="Guardando..." class="btn btn-primary pull-right"  style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
                                    <?php
                                }
                            }

                            ?>



                        </div>
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


        /** boton entregados */    
        $("div#TabEqRe").on("click","td a.btn_entregado",function(){
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

                window.location='./';
            }
        });
    }



        var CantFallas=0;//saber si ahi fallas;
        var TIPO_EQUIPO=0;
        var Equipo_garantiza=0;
        var fecha="<?php echo date('Y-m-d'); ?>";
        Equipo_garantiza=<?php echo $cantidad_E_G; ?>;
        $("form input#L_total").prop('disabled', true);
        /** Garantiza */

        var value_garantia=0;var descripcion="";var fecha2=";"

        $('div#Estados_garantiza input.g_e').change(function(){
            $("input#fecha").val(fecha);
            value_garantia=$(this).attr("id");
            text_value=$(this).parent().text();
            $("h4 span#detalle_g").empty();
            $("h4 span#detalle_g").append(text_value);
            if(Equipo_garantiza>0) {
                fecha2 = $("div#Contenido_descripcion div#cont_value_" + value_garantia + " h1").text();
                descripcion = $("div#Contenido_descripcion div#cont_value_" + value_garantia + " h2").text();

                $("textarea#descripcion").text(descripcion);

                if(fecha2!=""){
                    $("input#fecha").val(fecha2);
                }


            }

            if(value_garantia==4){

                $("form input#L_total").prop('disabled', false);
            }
            else{

                $("form input#L_total").prop('disabled', true);
            }


        });

        defautl_presupuesto();
        function defautl_presupuesto(){
            var id=$('div#Estados_garantiza input.g_e:first').attr("id")
            value_garantia=id;

            $("input#fecha").val(fecha);
            //value_garantia=$(this).attr("id");
            text_value=$('div#Estados_garantiza input.g_e:first').parent().text();
            $("h4 span#detalle_g").empty();
            $("h4 span#detalle_g").append(text_value);
            if(Equipo_garantiza>0) {
                fecha2 = $("div#Contenido_descripcion div#cont_value_" + value_garantia + " h1").text();
                descripcion = $("div#Contenido_descripcion div#cont_value_" + value_garantia + " h2").text();

                $("textarea#descripcion").text(descripcion);

                if(fecha2!=""){
                    $("input#fecha").val(fecha2);
                }


                $("div#Estados_garantiza input.g_e:first").attr('checked', true);

            }

            if(value_garantia==4){

                $("form input#L_total").prop('disabled', false);
            }
            else{

                $("form input#L_total").prop('disabled', true);
            }

        }


        /** ##############################
         *   Nuevo equipo
         *  #############################
         *  */



        $("form#FormNuevos").on("submit",function(e){

            $("div#inf").empty();
            if(value_garantia<=0){
                $("div#inf").append("<div class='alert alert-warning'>Faltan datos </div>");
                e.preventDefault();
            }
            var Total=$("form input#L_total").val();

            if(value_garantia==4){
                if(Total==0){
                    $("div#inf").append("<div class='alert alert-warning'>El equipo reparado deve tener un precio. </div>");
                    e.preventDefault();
                }
            }


        });



        /** <<<<<I.C.E */

        /**#############################
         * ############################# */

        /** Funciones generales */

        //LoadingGif("form#FormIngreso button#btnAddIngreso","form#FormIngreso div#imgGuardar","form#FormIngreso div#inf",1);
        function AccionesAjax(dat){
            $.ajax({
                url : 'php/CargarCurso.php',
                type : 'POST',
                data :dat,
                success : function(res){
                    //alert(res);
                    ListarCursos(PagActual);

                }
            });

        }

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



        //ControlPrint

        function ControlPrint(IDcliente){
            IDCLIENTE=IDcliente;
            $("div#mdImprimir div#imprimirTodo").empty();
            $("div#mdImprimir div#ControlPrint").empty();
            $("div#inf").empty();
            var dat="ControlPrint="+IDcliente+"&Reingresos="+0+"&";
            ModalOpen="div#mdImprimir";

            $.ajax({
                type: 'POST',
                url:  'php/controlador.php',
                data: dat,
                success: function(res) {
                    //alert(res);
                    $("div#mdImprimir div#ControlPrint").append(res);

                }
            });
            QR(2);

        }
        //ReingresoNrOrden
        /**function ControlPrintR($nrOrden){
        IDCLIENTE=IDcliente;
        $("div#mdImprimirReingreso div#imprimirTodoR").empty();
        $("div#mdImprimirReingreso div#ControlPrintR").empty();
        $("div#inf").empty();
        var dat="ControlPrint="+$nrOrden+"&Reingresos="+1+"&";
        ModalOpen="div#mdImprimirReingreso";

        $.ajax({
            type: 'POST',
            url:  'php/controlador.php',
            data: dat,
            success: function(res) {
                // alert(res);
                $("div#mdImprimirReingreso div#ControlPrintR").append(res);

            }
        });
        QR(2);

    }*/

        /** F.G <<< */



        /**
         *  Armado de Fallas
         *
         * */

        function ArmadoFallas(ContFallas,val){

            CantFallas=0;
            $(ContFallas).each(function(pos,valor){
                var n=$(this).val();


                if($(this).attr("type")=="checkbox"){

                    if($(this).is(':checked')){

                        val+=$(this).attr("name")+",";
                        CantFallas++;
                    }
                }


            });

            return val;


        }



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

