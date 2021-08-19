<?php
    $Idcliente=0;

    if(isset($_GET["cliente"])&&(clsSeguridad::validarID($_GET["cliente"]))){

        $Idcliente=$_GET["cliente"];

    }
    else{
        $_SESSION["msj"]="<div class='alert alert-warning' role='alert'> <strong>Alerta!</strong> Se perdio la referencia del cliente. </div>";
        Core::redir("./?view=st_Equipos");

    }


?>
<?php $cliente=clsCliente::getById($Idcliente);

      if(!count($cliente)>0){
          $_SESSION["msj"]="<div class='alert alert-warning' role='alert'> <strong>Alerta!</strong> Cliente no exite. </div>";
          Core::redir("./?view=st_Equipos");



      }

?>
<script>
    var IDcliente=<?php echo $cliente->id_cliente; ?>;
</script>
<div class="row">
    <div class=" col-md-12 col-xs-12">
        <a href="./"><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
        <hr>

        <h1><i class="glyphicon glyphicon-user"></i> Edicion | cliente</h1>

        <form id="FormNuevos"  >

            <div class='col-md-12 col-xs-12' >


                <br />
                

            <hr />



            <div class='row' id="DatosEquipo" >

                <div class="col-md-12 col-xs-12" >
                    <h4  style="color: #428bca !important;">Datos del Cliente <strong> <?php echo "#".$cliente->id_cliente ?></strong></h4>
                    <br />


                    <div class="col-md-6 col-xs-12">

                        

                        <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-pencil"></span>
                                                                     </span>
                            <input type="text"  class="form-control" maxlength="50" name="nombre" required="required" id="nombre" placeholder="Nombre" value="<?php echo $cliente->nombre; ?>"  />

                        </div>

                        <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-pencil"></span>
                                                                     </span>

                                      <input type="text"  class="form-control" maxlength="50" name="apellido" required="required" id="apelido" placeholder="Apellido" value="<?php echo $cliente->apellido; ?>"  />
                        </div>
                        
                        <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-phone"></span>
                                                                     </span>

                                <input type="text" class="form-control" maxlength="20" name="telefono" id="telefono" required="required" pattern="[0-9]+" title="caracteres permitidos 0-9" placeholder="Telefono" value="<?php echo $cliente->telefono; ?>"/>
                         </div>
                        

                        <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-sort-by-order"></span>
                                                                     </span>

                                <input type="text" class="form-control" maxlength="15" name="dni" id="dni" pattern="[0-9]+" required="required" title="caracteres permitidos 0-9" placeholder="D.N.I" value="<?php echo $cliente->dni; ?>"/>
                         </div>
                         
                         <div class="input-group form-group ">
                             <span class="input-group-addon">
                             <span class="glyphicon glyphicon-envelope"></span>
                             </span>
                            <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" />
                         </div>

                    </div>
                </div>

            </div>

            <hr />
            

            


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

