<?php
    $Idcliente=0;

    if(isset($_GET["cliente"])&&(clsSeguridad::validarID($_GET["cliente"]))){

        $Idcliente=$_GET["cliente"];

    }
    else{
        $_SESSION["msj"]="<div class='alert alert-warning' role='alert'> <strong>Alerta!</strong> Se perdio la referencia del cliente. </div>";
        print "<script>window.location='index.php?view=st_Equipos';</script>";

    }

$cliente=clsCliente::getById($Idcliente);
if(!count($cliente)>0){
    $_SESSION["msj"]="<div class='alert alert-warning' role='alert'><strong>El cliente no exite !</strong></div>";
    Core::redir("./?view=st_Equipos");
}

$equipo=clsEquipo::ListarEquipo_Cli($Idcliente);

if(count($equipo)>0){


    $i=0;
    foreach($equipo as $e){
       if($i==count($equipo)-1){
           $nr_orden=$e->nr_orden;
       }
        $i++;
    }
    $_SESSION["EquipBuscar"]=$nr_orden;
}



?>


<div class="row">

        <div class="col-md-12 col-xs-12">
            <a href="./"><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
            <hr>

            <div class="col-md-12 col-xs-12">
                <h4>Escanea el codigo para agregar el contacto rapidamente.. </h4>
                <p> Puedes usar la camara de tu celular (algunos modelo leen el QR) o con una aplicacion para leer QR.</p>
            </div>



                <div class="col-md-12 col-xs-12" id="QR">
                    <br />
                    <?php
                        /** Armado del QR */
                        $dato="MECARD:N:".$cliente->nombre." ".$cliente->apellido.";TEL:".$cliente->telefono.";EMAIL:".$cliente->email.";;";

                        if($cliente->email=="NULL"){
                          $dato="MECARD:N:".$cliente->nombre." ".$cliente->apellido.";TEL:".$cliente->telefono.";;";
                        }


                         clsFunciones::CodigoQR($dato);


                    ?>


                </div>

    
    </div>

</div>



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

