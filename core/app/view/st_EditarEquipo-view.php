<?php
$Idcliente=0;
$nrEquipo=0;
if(isset($_GET["cliente"])&&$_GET["equipo"]&&(clsSeguridad::validarID($_GET["equipo"])&&clsSeguridad::validarID($_GET["cliente"]))){

    $Idcliente=$_GET["cliente"];
    $nrEquipo=$_GET["equipo"];
    $Equipo=clsEquipo::getById($nrEquipo);


    if(!count($Equipo)>0){
        $_SESSION["msj"]="<div class='alert alert-warning' role='alert'><strong>El equipo nr. #$nrEquipo !</strong> no exite.</div>";
        Core::redir("./?view=st_Equipos");
    }else{$_SESSION["EquipBuscar"]=$nrEquipo;}

    $c=clsCliente::getById($Idcliente);

    if(!count($c)>0){
        $_SESSION["msj"]="<div class='alert alert-warning' role='alert'><strong>El siguiente numero #$Idcliente !</strong> de cliente no exite.</div>";
        Core::redir("./?view=st_Equipos");
   }
    error_reporting(0);
    $idGarantia=$Equipo->id_garantia_garantia;
}
else{
    $_SESSION["msj"]="<div class='alert alert-warning' role='alert'> <strong>Alerta!</strong> Se perdio la referencia del cleinte. </div>";
    Core::redir("./?view=st_Equipos");

}





?>

<div class="row">
    <div class="col-md-12">
        <a href="./"><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
        <hr>
        <h1><i class="glyphicon glyphicon-phone"></i> Editar Equipo</h1>

        <form id="FormEquipos"  >

            <div class='col-md-12 col-xs-12' >


                <div class="row">


                    <div class="col-md-6 col-xs-12" >
                        <label for="fecha" >Fecha de ingreso</label>
                        <div class="input-group form-group" >
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                                 </span>
                            <input type="date" class="form-control" name="fecha" id="fecha" required="required"  value="<?php  echo clsFunciones::fecha3($Equipo->fecha_ingreso,1,0); ?>"  />
                        </div>
                    </div>
                    <br />
<h1><?php  //echo $Equipo->fecha_ingreso."-";echo " - ".clsFunciones::fecha3($Equipo->fecha_ingreso,1,0); ?></h1>


                </div>
                <br />
                <div class="row">
                    <?php $cliente=clsCliente::getById($Idcliente); ?>
                    <h4 style="color: #428bca !important;">Datos del Cliente <strong> <?php echo "#".$cliente->id_cliente ?></strong></h4>
                    <br />
                    <div class="col-md-12">
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
                    <h4 style="margin-left: 5px;color: #428bca !important;" id="DEh4">Datos del Equipo <strong><?php echo "#".$nrEquipo; ?></strong></h4>
                    <br />


                    <div class="col-md-6 col-xs-12">

                        <div class="input-group form-group  ">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </span>
                            <select class="form-control" name="selectTipo" id="selectTipo">
                                <?php

                                $tipoE=clsTipoEquipo::getAll();
                                if(count($tipoE)>0){

                                    ?>
                                    <option value="" disabled="" selected="">Seleccione - Equipo</option>
                                    <?php
                                    foreach($tipoE as $tipo){
                                        ?>
                                        <option value="<?php echo $tipo->id_tipo; ?>"><?php echo $tipo->equipo; ?></option>
                                        <?php

                                    }

                                }


                                ?>
                            </select>
                        </div>

                        <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-search"></span>
                                                                     </span>
                            <input type="text" disabled="disabled" class="form-control biginput" maxlength="100" name="tipoEquipo" required="required" id="tipoEquipomodelo" placeholder="Equipo modelo" value="<?php echo  $Equipo->tipoEquipo; ?>"  />

                        </div>

                        <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
                                                                     </span>

                            <input type="text"   disabled="disabled" class="form-control" maxlength="15" name="imei" id="imei"  pattern="[0-9]+" title="caracteres permitidos 0-9" placeholder="Imei equipo" value="<?php if($Equipo->imei!="NULL"){ echo  $Equipo->imei;} ?>" />
                        </div>

                        <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-sort-by-order"></span>
                                                                     </span>

                            <input type="text" maxlength="30" class="form-control"  name="serie" id="serie"  placeholder="Nr. Serie equipo" value="<?php if($Equipo->Nserie!="NULL"){echo $Equipo->Nserie;} ?>"/>
                        </div>

                    </div>
                </div>

            </div>

            <hr />
            <div class="row">
                <div class="col-md-12 col-xs-12" id="ContGarantia">
                    <h4 style="margin-left: 5px;color: #428bca !important;">Garantia</h4>
                    <br />
                    <div class="col-md-6 col-xs-12" >
                        <label class="radio-inline">
                            <input type="radio" name="Garantia" class="chekGarantia" value="1"  <?php if($idGarantia==1){ echo "checked='checked'";} ?>/> No
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="Garantia" class="chekGarantia" value="2" <?php if($idGarantia==2){ echo "checked='checked'";} ?>/> Fabrica
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="Garantia" class="chekGarantia" value="3" <?php if($idGarantia==3){ echo "checked='checked'";} ?>/> Extendida
                        </label>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <hr />
                        <br />
                        <h4 style="margin-left: 5px; color: #428bca !important;">Posible Fallas</h4>
                        <br />
                    </div>
                    <div class="col-md-12 col-xs-12" id="ContEquipos" style="clear: both;padding-bottom: 10px;">


                    </div>
                </div>


            <!--Datos del Equipo<<<<-->
            <div class="col-md-12 col-xs-12" style="clear: both;padding-bottom: 10px;" >
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-md-8 col-xs-12" id="inf" style="padding-left: 0;text-align: center;">

                        </div>
                        <div class="col-md-8 col-xs-12" id="imgGuardar" style="padding-left: 0;text-align: center;display:none">
                            <img  src="plugins/dist/img/guardar.gif" />
                        </div>
                        <button name="mysubmit" type="submit" id="btnGuardarCliente" data-loading-text="Guardando..." class="btn btn-primary pull-right"  style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
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
        /**
         * Arma las fallas segun el tipo de equipo
         * */

        $("form#FormEquipos div#DatosEquipo").on("change"," select#selectTipo",function(){

            desabilitarInput(1,"div#DatosEquipo input#tipoEquipomodelo");
            var tipo=$(this).val();
            TIPO_EQUIPO=tipo;
            if(tipo==1){
                desabilitarInput(1,"div#DatosEquipo input#imei");

            }else{
                $("div#DatosEquipo input#imei").val("");
                desabilitarInput(0,"div#DatosEquipo input#imei");

            }

            //FAllas y oserbaciones

            AddEquipos("form#FormEquipos div#ContEquipos");


        });

       



        /** ##############################
         *   Se manda los datos de Cliente | Equipo
         *  #############################
         *  */

        //Insertar Cliete | Equipo
        var Nr_Orden=0;var observaciones="";
        observaciones="<?php echo $Equipo->descripcion; ?>";
        Nr_Orden=<?php echo $nrEquipo; ?>;
        
        $('form#FormEquipos').submit(function() {

            $("div#inf").empty();
            var dat="EnviarEditarEquipo="+Nr_Orden;
            var  val="";
            val=ArmadoFallas("form#FormEquipos div#ContEquipos .tipo",val);


            if(CantFallas>0 && TIPO_EQUIPO>0 && Nr_Orden>0){
                //alert(CantFallas);
                dat+="&Equipos="+val+"&";
                dat+=$(this).serialize();

                $.ajax({
                    type: 'POST',
                    url:  './?action=st_Equipos',
                    data: dat,
                    beforeSend: function () {
                        LoadingGif("form#FormEquipos button#btnGuardarCliente","form#FormEquipos div#imgGuardar","form#FormEquipos div#inf",1);
                    },
                    success: function(res) {
                        //alert(res);
                        if(res>0){

                            $("div#inf").append("<div class='alert alert-success'>Se Edito correctamente.</div>");
                            reset("form#FormEquipos");
                            //$("div#mdCargarCont").modal("hide");

                            //Imprimir donde res es el nr orden
                            //ControlPrint(res); //res si no es cero es el idCliente
                            LoadingGif("form#FormEquipos button#btnGuardarCliente","form#FormEquipos div#imgGuardar","form#FormEquipos div#inf",0);
                            window.location='index.php?view=st_Equipos';
                        }
                        else{

                            $("div#inf").append("<div class='alert alert-warning'>Ocurri&oacute; un error o el numero de telefono ya se registro.</div>");
                            LoadingGif("form#FormEquipos button#btnGuardarCliente","form#FormEquipos div#imgGuardar","form#FormEquipos div#inf",0);
                        }

                    },
                    error : function(xhr, status) {
                        LoadingGif("form#FormEquipos button#btnGuardarCliente","form#FormEquipos div#imgGuardar","form#FormEquipos div#inf",0);

                        $("form#FormEquipos div#inf").append("<div class='alert alert-warning'>La peticion a la base de datos fallo.</div>");

                    }
                });


            }
            else{$("div#inf").append("<div class='alert alert-warning'>Faltan las fallas. Faltan Datos.</div>"); }



            return false;
        });



        /** ####### Cargar datos y habiltar o desabilitar input segun el tipo */
        var tipoEquipoEdit=0;
        tipoEquipoEdit=<?php echo $Equipo->id_tipo_equipo; ?>;
         $('form#FormEquipos  select#selectTipo  option[value="'+tipoEquipoEdit+'"]').attr('selected', 'selected');
        //alert('form#FormEquipos  select#selectTipo  option[value="'+tipoEquipoEdit+'"]');
        if(tipoEquipoEdit>0){
            desabilitarInput(1,"form#FormEquipos input#tipoEquipomodelo");
            if(tipoEquipoEdit==1 || tipoEquipoEdit==2){
                desabilitarInput(1,"form#FormEquipos input#imei");
            }
            TIPO_EQUIPO=tipoEquipoEdit
            AddEquipos("form#FormEquipos div#ContEquipos");
            
            
        }

        /** <<<<<I.C.E */
        
        
        
        
         /** <<< */

        /**
         * AddEquipos Inserta las fallas al formulario
         *
         * */

        var CantEquipo=1;

        function AddEquipos(contenedor){

            $(contenedor).empty();
            if(Nr_Orden>0){
                var dat="EditarFallas="+Nr_Orden+"&TipoEquipo="+TIPO_EQUIPO+"&";


                $.ajax({
                    type: 'POST',
                    url:  './?action=st_Equipos',
                    data: dat,
                    success: function(res) {
                        //alert(res+" "+Nr_Orden+" --"+TIPO_EQUIPO );
                        $(contenedor).append(res);
                        //Esta le da la funcionalidad falas
                        $(contenedor+" input.fallas").bootstrapToggle();
                        $("#FormEquipos #descripcion").val(observaciones);
                        
                    }
                });

            }
            else{
                $(contenedor).append("<div class='alert alert-warning' role='alert'>No hay fallas</div>");
            }

            CantEquipo++;

        }
        
 

        /** <<< */
        
        
        
        

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

