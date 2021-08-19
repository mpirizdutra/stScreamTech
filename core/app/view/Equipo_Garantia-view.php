<?php
$Idcliente=0;

if(isset($_GET["cliente"])&&(clsSeguridad::validarID($_GET["cliente"]))){

    $Idcliente=$_GET["cliente"];

}
else{
    $_SESSION["msj"]="<div class='alert alert-warning' role='alert'> <strong>Alerta!</strong> Se perdio la referencia del cliente. </div>";
    print "<script>window.location='index.php?view=st_Equipos';</script>";

}


?>
<?php
$cliente=clsCliente::getById($Idcliente);
if(!count($cliente)>0){
    $_SESSION["msj"]="<div class='alert alert-warning' role='alert'><strong>El cliente no exite !</strong></div>";
    Core::redir("./?view=st_Equipos");
}

?>
<script>
    var IDcliente=<?php echo $cliente->id_cliente; ?>;
</script>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <a href="./"><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
        <hr>
        <h1><i class="glyphicon glyphicon-phone"></i> Garantia</h1>

        <form id="FormNuevos"  >

            <div class='col-md-12 col-xs-12' >


                <div class="row">


                    <div class="col-md-6 col-xs-12" >
                        <label for="fecha" >Fecha de ingreso</label>
                        <div class="input-group form-group" >
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                                 </span>
                            <input type="date" class="form-control" name="fecha" id="fecha" required="required"  value="<?php  echo date('Y-m-d'); ?>"  />
                        </div>
                    </div>



                </div>
                <br />
                <div class="row">

                    <h4  style="color: #428bca !important;">Datos del Cliente <strong> <?php echo "#".$cliente->id_cliente ?></strong></h4>
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

                <div class='row' id="Seleccione_garantia">
                    <div class="col-md-12 col-xs-12" >
                        <h4 style="margin-left: 5px;color: #428bca !important;" id="DEh4">Seleccione quien garantiza.</h4>
                        <br />


                         <div class="col-md-6 col-xs-12">



                             <div class="input-group form-group  ">

                                 <table>
                                     <?php
                                     $cant=1;
                                     $fila=false;
                                     $saga=clsGarantiza::getAll();
                                     foreach($saga as $s){
                                         if($cant==1){
                                             $fila=false;
                                             ?>
                                             <tr>
                                             <?php
                                         }
                                         if($cant<=3){
                                             ?>
                                             <td style="padding-right: 10px">
                                                 <label style="cursor: pointer">
                                                     <input type="radio" class="garantiza" id="garantiza" name="garantiza" value="<?php echo $s->id_garantia ; ?>"

                                                     > <?php echo $s->nombre ;?>
                                                 </label>
                                             </td>
                                             <?php
                                         }
                                         if($cant==3){
                                             $cant=1;
                                             $fila=true;
                                             ?>
                                             </tr>

                                             <?php
                                         }
                                         ?>



                                         <?php
                                            if(!$fila){$cant++;}
                                     }

                                     ?>

                                 </table>




                         </div>


                    </div>
                </div>
                </div>
                <hr />
                <div class='row' id="DatosEquipo" >

                    <div class="col-md-12 col-xs-12" >
                        <h4 style="margin-left: 5px;color: #428bca !important;" id="DEh4">Datos del Equipo</h4>
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
                                <input type="text" disabled="disabled" class="form-control biginput" maxlength="100" name="tipoEquipo" required="required" id="tipoEquipomodelo" placeholder="Equipo modelo"  />

                            </div>

                            <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
                                                                     </span>

                                <input type="text"   disabled="disabled" class="form-control" maxlength="15" name="imei" id="imei"  pattern="[0-9]+" title="caracteres permitidos 0-9" placeholder="Imei equipo"/>
                            </div>

                            <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-sort-by-order"></span>
                                                                     </span>

                                <input type="text" maxlength="30" class="form-control"  name="serie" id="serie"  placeholder="Nr. Serie equipo"/>
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
                                <input type="radio" name="Garantia" class="chekGarantia" value="1" /> No
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="Garantia" class="chekGarantia" value="2" checked="checked"/> Fabrica
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="Garantia" class="chekGarantia" value="3"/> Extendida
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

                    <div class="col-md-12 col-xs-12" id="ContEquipos" style="clear: both;padding-bottom: 10px;" >


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
        var Garantiza=0;



        /** Garantiza */


        function garantiza_select(){
            Garantiza=$("input#garantiza:checked").val();
        }



        /**
         * Arma las fallas segun el tipo de equipo
         * */

        $("form#FormNuevos div#DatosEquipo").on("change"," select#selectTipo",function(){

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

            AddEquipos("form#FormNuevos div#ContEquipos");


        });

        /** <<< */

        /**
         * AddEquipos Inserta las fallas al formulario
         *
         * */

        var CantEquipo=1;

        function AddEquipos(contenedor){

            //$(contenedor).empty();
            BorrarMsj(contenedor);
            BorrarMsj("form div#inf");
            if(TIPO_EQUIPO!=0){
                var dat="AddEquipos="+TIPO_EQUIPO;


                $.ajax({
                    type: 'POST',
                    url:  './?action=st_Equipos',
                    data: dat,
                    success: function(res) {
                        //alert(res);
                        $(contenedor).append(res);
                        //Esta le da la funcionalidad falas
                        $(contenedor+" input.fallas").bootstrapToggle();
                    }
                });

            }
            else{
                $(contenedor).append("<div class='alert alert-warning' role='alert'>No hay fallas</div>");
            }

            CantEquipo++;

        }

        /** <<< */



        /** ##############################
         *   Nuevo equipo
         *  #############################
         *  */


        $('form#FormNuevos').submit(function() {

            $("div#inf").empty();
            garantiza_select();

            if(IDcliente>0 && Garantiza>0){
                var dat="MasEquipos="+IDcliente+"&";

                //desabilita el boton


                var  m="";
                var  val="";
                val=ArmadoFallas("form#FormNuevos div#ContEquipos .tipo",val);

                if(CantFallas>0 && TIPO_EQUIPO>0){
                    //HabilitarBtn("form#FormAddMasE button#btnMasEquipo",1);

                    dat+="&Equipos="+val+"&";
                    dat+=$(this).serialize();//aca guardo todo el form

                    $.ajax({
                        type: 'POST',
                        url:  './?action=st_Equipos',
                        data: dat,
                        beforeSend: function () {

                            LoadingGif("form#FormNuevos button#btnMasEquipo","form#FormNuevos div#imgGuardar","form#FormNuevos div#inf",1);
                        },
                        success: function(res) {
                            //alert(res);
                            if(res>0){

                                $("div#inf").append("<div class='alert alert-success'>Se guardo correctamente.</div>");
                                reset("form#FormNuevos");

                                LoadingGif("form#FormNuevos button#btnMasEquipo","form#FormNuevos div#imgGuardar","form#FormNuevos div#inf",0);
                                window.open('index.php?view=telegram', '_blank');
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
                else{$("div#inf").append("<div class='alert alert-warning'>Faltan las fallas o Falta eleguir un tipo de equipo. </div>"); }
            }
            else{$("div#inf").append("<div class='alert alert-warning'>Ocurri&oacute; un error. (no hay cliente o quien garantize) </div>");}



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



        //ControlPrint




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

