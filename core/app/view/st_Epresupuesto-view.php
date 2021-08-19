<?php
$nrEquipo=0;

if(isset($_GET["equipo"])&&clsSeguridad::validarID($_GET["equipo"])){

    $nrEquipo=$_GET["equipo"];
    $Eq=clsEquipo::getById($nrEquipo);
    if(!count($Eq)>0){
        $_SESSION["msj"]="<div class='alert alert-warning' role='alert'><strong>El equipo nr. #$nrEquipo !</strong> no exite.</div>";
        Core::redir("./?view=st_Equipos");
    }

    error_reporting(0);
    $presupuesto=clsPresupuesto::getById($nrEquipo);

}
else{
    $_SESSION["msj"]="<div class='alert alert-warning' role='alert'> <strong>Alerta!</strong> Se perdio la referencia del equipo. </div>";
    Core::redir("./?view=st_Equipos");

}






//`id_Presupuesto`, `nr_orden`, `idEs_pre`, `fecha`, `detalle`, `presupuesto`, `aprobado`

?>
<script> 
    var nrOrden=0;
    nrOrden=<?php echo $nrEquipo; ?>;
    
</script>

<div class="row">
    <div class="col-md-12">
        <a href="./"><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
        <hr>
        <h1><i class="glyphicon glyphicon-user"></i> Presupuesto</h1>

        <form id="FormNuevos"  >

            <div class='col-md-12' >

                
                <div class="row">
                                                
                   <div class="col-md-6">
                        <label for="fecha">Fecha</label>
                        <div class="input-group form-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input type="date" class="form-control" name="fecha" id="fecha"  value="<?php if(count($presupuesto)==0){echo date('Y-m-d');}else{ echo clsFunciones::fecha2($presupuesto->fecha,1);} ?>"/>
                        </div>
                    </div>
                                                    
                </div>
                
                
                <br />
                
                    
                

                <div class="row">
                    <hr/>
                    <br/>
                    <br/>
                    <h4>Estado del equipo</h4>
                    <div class="col-md-12 col-xs-12"> 
                        <div class="col-md-6 col-xs-12">
                        <label class="radio-inline">
                            <input type="radio" name="EstadoPresupuesto" class="chekEstadoPresupuesto" value="1"  <?php if(count($presupuesto)>0 && $presupuesto->idEs_pre==1){?> checked="checked" <?php } if(count($presupuesto)==0){?> checked="checked" <?php } ?>/> Presupuesto </label>
                            <label class="radio-inline">
                            <input type="radio" name="EstadoPresupuesto" class="chekEstadoPresupuesto" value="2" <?php if(count($presupuesto)>0 && $presupuesto->idEs_pre==2){?> checked="checked" <?php }?>/> Reparado</label>
                            <label class="radio-inline">
                            <input type="radio" name="EstadoPresupuesto" class="chekEstadoPresupuesto" value="3" <?php if(count($presupuesto)>0 && $presupuesto->idEs_pre==3){?> checked="checked" <?php }?>/> No Reparado</label>
                                                                                                                                        
                        </div>
                    </div>
                </div>
                <br/>
                <br/>

           

               
                
                <div class="row">
                    <hr/>
                    <br/>
                    <br/>
                    <h4>Descripcion detallada del trabajo</h4>
                    <div class="col-md-12 col-xs-12"> 
                                                                
                        <div class="form-group">
                                                                          
                            <textarea class="form-control" rows="5" maxlength="3500" name="descripcion" id="descripcion" required="required" placeholder="Detalle"><?php if(count($presupuesto)>0){echo $presupuesto->detalle;}else{echo "";} ?></textarea> 
                        </div>
                                                                       
                        <div class="form-group">
                            <input type="number" class="form-control" maxlength="6" name="PresupuestoTotal" required="required" id="PresupuestoTotal" placeholder="Presupuesto $" value="<?php if(count($presupuesto)>0){echo $presupuesto->presupuesto;}else{echo 0;} ?>"/>
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


        var CantFallas=0;//saber si ahi fallas;
        var TIPO_EQUIPO=0;
       



        /** ##############################
         *   Nuevo equipo
         *  #############################
         *  */


        $('form#FormNuevos').submit(function() {

            $("div#inf").empty();
            if(nrOrden>0){
                
                var PreTotal=$("input#PresupuestoTotal").val();
                var descrip=$("textarea#detallePRE").val();
                var dat="Presupuesto="+nrOrden+"&";

             if(PreTotal>=0&&(descrip!=""&&descrip!=" ")) {  

                    
                    dat+=$(this).serialize();//aca guardo todo el form

                    $.ajax({
                        type: 'POST',
                        url:  './?action=st_Equipos',
                        data: dat,
                        beforeSend: function () {

                            LoadingGif("form#FormNuevos button#btnMasEquipo","form#FormNuevos div#imgGuardar","form#FormNuevos div#inf",1);
                        },
                        success: function(res) {
                            //alert("resultado:"+res);
                            if(res>0){

                                $("div#inf").append("<div class='alert alert-success'>Se guardo correctamente.</div>");
                                reset("form#FormNuevos");

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
               else{$("div#inf").append("<div class='alert alert-warning'>Todo los campos son obligatorio </div>");}

           }
            else{$("div#inf").append("<div class='alert alert-warning'>Ocurri&oacute; un error. (no hay cliente) </div>");}



            return false;
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

