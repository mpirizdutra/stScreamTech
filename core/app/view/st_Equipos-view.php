<?php
$Equipo=0;
$EquipoBuscar=0;
/*if(isset($_GET["orden"])){
    if(clsValidar::validarID($_GET["orden"])){
        $Equipo=3;
        $EquipoBuscar=$_GET["orden"];
    }
}*/
if(isset($_SESSION["EquipoNR"])){

    $Equipo=$_SESSION["EquipoNR"];
     unset($_SESSION["EquipoNR"]);
}
if(isset($_SESSION["EquipBuscar"])){
    $EquipoBuscar=$_SESSION["EquipBuscar"]; 
}
//  div#TextBuscar input#Buscar

?>
<div class="row">
	<div class="col-md-12 col-xs-12">

		<h1><i class="glyphicon glyphicon-phone"></i>Equipos</h1>
		<div class="clearfix"></div>
        

<!-- ## Clientes INF -->
<div class="row">
     <div class="form-group" style="margin-top: 10px;">
            
                 <div class="col-xs-12 col-xs-12">
                       <div id="inf" class="col-md-4 col-xs-12">
                        
                       </div>

                 </div>
         <div class="col-md-12 col-xs-12">
             <div class="col-md-8 col-xs-12">
                 <?php
                 if(isset($_SESSION["msj"])){
                     echo $_SESSION["msj"];
                     unset($_SESSION['msj']);
                 }

                 ?>

             </div>

         </div>
             
    </div>  
</div>



     <hr />
      
 <!-- ##########  BUSCADOR  CONTENIDO ############-->     

    <?php include("parte/buscador.php"); ?>

<!-- Fin del Buscador -->

    
        






<br/><br/><br/><br/><br/>
	</div>

    <div class="modal fade" id="mdEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content" id="mdfondoColor" style="background-color: #222d32;">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-12">
                            <!--button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button-->
                            <h4 class="modal-title" id="myModalLabel" style="color: #fff;"><strong id="TextMov"> Seleccionar si es un equipo o si esta garantizado</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row" id="ContEstado">
                        <form id="FormEstado">
                            <div class='col-md-12' >


                                <div class="row">

                                    <div class="col-md-12 col-xs-12">

                                        <div class="col-md-8 col-xs-12" >
                                            <div class="input-group form-group " >
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-sort"></span>
                                                </span>
                                                <select class="form-control" name="Selecttipo" id="Selecttipo">
                                                    <option value="-1" checked="checked"  >Seleccionar</option>
                                                    <option value="0">Equipo</option>

                                                    <option disabled="" >---- Garantizados por: ----</option>

                                                    <?php
                                                    $garantia=clsGarantiza::getAll();
                                                    foreach ($garantia as $g){
                                                        ?>
                                                        <option value="<?php echo $g->id_garantia; ?>"><?php echo $g->nombre; ?></option>
                                                        <?php

                                                    }

                                                    ?>


                                                </select>
                                            </div>
                                            <p class="alert alert-info"><strong>La idea es corregir si no emos equivocado al ingresar un equipo.</strong> </p>


                                        </div>




                                    </div>
                                </div>





                            </div>
                            <br/><br/><br/><br/>
                            <div class="col-md-12 col-xs-12" style="clear: both;padding-bottom: 10px;" >
                                <div class="modal-footer">
                                    <div class="form-group">
                                        <div class="col-md-8 col-xs-12" id="inf" style="padding-left: 0;text-align: center;"></div>
                                        <div class="col-md-8 col-xs-12" id="imgGuardar" style="padding-left: 0px; text-align: center; display: none;">
                                            <img src="plugins/dist/img/guardar.gif" />
                                        </div>
                                        <button type="submit"  id="btnGuardarEs" data-loading-text="Guardando..." class="btn pull-right"  style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="md_nr_Garantia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content" id="mdfondoColor" style="background-color: #222d32;">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-12">
                            <!--button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button-->
                            <h4 class="modal-title" id="myModalLabel" style="color: #fff;"><strong id="TextMov"> Orden de servicio de las garantias</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row" id="nr_Garantia">
                        <form id="FormGarantia">
                            <div class='col-md-12' >


                                <div class="row">

                                    <div class="col-md-12 col-xs-12">

                                        <div class="col-md-8 col-xs-12" >
                                            <div class="input-group form-group " >
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-sort"></span>
                                                </span>
                                                 <input type="number" class="form-control" min="1" name="nr_garantia" id="nr_garantia" />
                                            </div>
                                            <p class="alert alert-info"><strong>La idea es agregar un numero seguimiento de la garantia.</strong> </p>


                                        </div>




                                    </div>
                                </div>





                            </div>
                            <br/><br/><br/><br/>
                            <div class="col-md-12 col-xs-12" style="clear: both;padding-bottom: 10px;" >
                                <div class="modal-footer">
                                    <div class="form-group">
                                        <div class="col-md-8 col-xs-12" id="inf" style="padding-left: 0;text-align: center;"></div>
                                        <div class="col-md-8 col-xs-12" id="imgGuardar" style="padding-left: 0px; text-align: center; display: none;">
                                            <img src="plugins/dist/img/guardar.gif" />
                                        </div>
                                        <button type="submit"  id="btnGuardarEs2" data-loading-text="Guardando..." class="btn pull-right"  style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>



</div>


<script>

$(document).ready(function(){


    /** VAriables */
    var TABLE="#tbEquipo";
    var Buscar=0;var SelectBuscar=0;
    var NrOrdenEstado=0;





    function isMobile() {
        try{
            document.createEvent("TouchEvent");
            return true;
        }
        catch(e){
            return false;
        }
    }


    /** button garantia oficial */

    $("ul#oficial li a.btn_g").click(function(){
        var id=$(this).attr("id");
        ListarClietes(TABLE,id);
    });

    /** Estado */
    $("div#TabEqRe").on("click","table tr td a.btn_Editar_equipo_garantia",function () {
        nrOrden=$(this).attr('id');


        NrOrdenEstado=nrOrden;


        $("div#inf").empty();
        $("div#mdEstado").modal("show");
    });







    var nr_garantiza=0;
    $("div#TabEqRe").on("click","td a.btn_Nr_garantiza",function(){
        NrOrdenEstado= $(this).attr("id");
        $("div#inf").empty();

        var num=$("span", this).attr("id");
        $("form#FormGarantia input").val(num);

        $("div#md_nr_Garantia").modal("show");
    });



    $("form#FormGarantia").submit(function() {

        $("div#inf").empty();
        nr_garantiza=$("form#FormGarantia input").val();
        if(nr_garantiza>0){
            var dat="Cambiar_Orden_garantiza="+NrOrdenEstado+"&";




            dat+=$(this).serialize();//aca guardo todo el form

            $.ajax({
                type: 'POST',
                url:  './?action=st_Equipos',
                data: dat,
                beforeSend: function () {

                    LoadingGif("form#FormGarantia button#btnGuardarEs","form#FormGarantia div#imgGuardar","form#FormEstado div#inf",1);
                },
                success: function(res) {
                    //alert("resultado:"+res);
                    if(res>0){

                        //$("div#infBuscar").append("<div class='alert alert-success'>Se guardo correctamente.</div>");


                        LoadingGif("form#FormGarantia button#btnGuardarEs","form#FormGarantia div#imgGuardar","form#FormEstado div#inf",0);

                        SelectBuscar=3;
                        $("div#TextBuscar input#Buscar").val(NrOrdenEstado);
                        $("div#md_nr_Garantia").modal("hide");
                        fnBuscar();


                    }
                    else{
                        $("div#inf").append("<div class='alert alert-warning'>Ocurri&oacute; un error. Problemas para conectarse.</div>");
                        LoadingGif("form#FormGarantia button#btnGuardarEs","form#FormGarantia div#imgGuardar","form#FormEstado div#inf",0);
                    }

                }
            });
            //LoadingGif("form#FormAddMasE button#btnMasEquipo","form#FormAddMasE div#imgGuardar","form#FormAddMasE div#inf",0);
        }
        else{$("div#inf").append("<div class='alert alert-warning'>Ocurri&oacute; un error. </div>");}



        return false;
    });





    /** ################# */

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


    $("form#FormEstado").submit(function() {

        $("div#inf").empty();
        if(NrOrdenEstado>0){
            var dat="Cambiar_equipo_garantia="+NrOrdenEstado+"&";




            dat+=$(this).serialize();//aca guardo todo el form

            $.ajax({
                type: 'POST',
                url:  './?action=st_Equipos',
                data: dat,
                beforeSend: function () {

                    LoadingGif("form#FormEstado button#btnGuardarEs","form#FormNuevos div#imgGuardar","form#FormEstado div#inf",1);
                },
                success: function(res) {
                    // alert("resultado:"+res);
                    if(res>0){

                        //$("div#infBuscar").append("<div class='alert alert-success'>Se guardo correctamente.</div>");


                        LoadingGif("form#FormEstado button#btnGuardarEs","form#FormNuevos div#imgGuardar","form#FormEstado div#inf",0);

                        SelectBuscar=3;
                        $("div#TextBuscar input#Buscar").val(NrOrdenEstado);
                        $("div#mdEstado").modal("hide");
                        fnBuscar();


                    }
                    else{
                        $("div#inf").append("<div class='alert alert-warning'>Ocurri&oacute; un error. Problemas para conectarse.</div>");
                        LoadingGif("form#FormEstado button#btnGuardarEs","form#FormEstado div#imgGuardar","form#FormEstado div#inf",0);
                    }

                }
            });
            //LoadingGif("form#FormAddMasE button#btnMasEquipo","form#FormAddMasE div#imgGuardar","form#FormAddMasE div#inf",0);
        }
        else{$("div#inf").append("<div class='alert alert-warning'>Ocurri&oacute; un error. </div>");}



        return false;
    });






    //$("div#TextBuscar input#Buscar").val("123");
    //fnBuscar();


    /** ####### Trae los datos del equipo editado o agregado reciente mente ####### */
    var BuscarSESS=<?php echo $Equipo; ?>;
    var BuscarEqu =<?php echo $EquipoBuscar; ?>;
    var ultimo=0;

    if(BuscarEqu>0){
        $("div#TextBuscar input#Buscar").val(BuscarEqu);
        SelectBuscar=3; //donde el 3 es  del select nr_orden
        
        fnBuscar();

    }
    else{
        $("div#TextBuscar input#Buscar").empty();
        //la idea es que esto funcione solo cuando se cierra la secion
        cargarBusqueda();
    }
    if(BuscarSESS>0){    
        $("div#infBuscar").append("<div class='alert alert-success' role='alert'><strong>#"+BuscarSESS+"! <strong/> Los datos para el equipo seleccionado se guardaron correctamente..</div>");

    }



    /**  <<<<<<<<< */

    /**
     *
     * ############## F_BUSCAR ##################
     * */


    desabilitarInput(0,"div#SelectBuscarEstado select#SlBuscarEstado");
    selectDefault();

    $("div#SelectBuscarEstado select#SlBuscarEstado").change(function(){


        $("div#infBuscar").empty();
        if(SelectBuscar==4&&$(this).val()>0){
            Buscar=SelectBuscar+"=>"+$(this).val();
            ListarClietes(TABLE,0);//donde table es el idiv#tbEquipo
            Buscar=0;
        }
        else{
            $("div#SelectBuscarEstado select#SlBuscarEstado").focus();
            $("div#infBuscar").append("<div class='alert alert-info' role='alert'>Faltan datos, para pode realizar la busqueda.</div>");
        }




    });

    $("div button#btn_ultimo").click(function(){
        ListarClietes(TABLE,10);
    });

    $("div button#btn_ultimo_5").click(function(){
        //alert("aa")
        ListarClietes(TABLE,11);
    });

    function selectDefault(){


        desabilitarInput(0,"div#SelectBuscarEstado select#SlBuscarEstado");
        desabilitarInput(1,"div#TextBuscar input#Buscar");
    }

    $("div#SelectBuscar select#SlBuscar").change(function(){

        SelectBuscar=$(this).val();
        $("div#infBuscar").empty();
        //alert(SelectBuscar)
        if(SelectBuscar==4){
            desabilitarInput(1,"div#SelectBuscarEstado select#SlBuscarEstado");
            desabilitarInput(0,"div#TextBuscar input#Buscar");
            $("div#TextBuscar input#Buscar").empty();
        }
        else{   desabilitarInput(0,"div#SelectBuscarEstado select#SlBuscarEstado");
            desabilitarInput(1,"div#TextBuscar input#Buscar");
        }
    });

    $(" div#TextBuscar span#BtnBuscar").click(function(){

        fnBuscar();
    });

    $("div#TextBuscar input#Buscar").keypress(function(e) {
        if(e.which == 13) {
            fnBuscar();
        }
    });




    function fnBuscar(){

        //if(TABLE!=""&&TABLE!=" "){

        $("div#infBuscar").empty();
        if($("div#TextBuscar input#Buscar").val()!=""&&SelectBuscar!=0){
            Buscar=SelectBuscar+"=>"+$("div#TextBuscar input#Buscar").val();

            Guardar_busqueda(Buscar);
            ListarClietes(TABLE,0);
            Buscar=0;

        }
        else{
            $("div#TextBuscar input#Buscar").focus();
            $("div#infBuscar").append("<div class='alert alert-info' role='alert'>Faltan datos, para pode realizar la busqueda.</div>");
        }

        /* }
          else{$("div#infBuscar").append("<div class='alert alert-info' role='alert'>El buscador no puede saber si es para equipo o reingreso.</div>");

          }*/
    }

    /** <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<   FIN BUSCAR  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< */


    /**
     * ######### LISTAR CLIENTE ###################
     *
     * */
    var B_todos=0;
//alert(<?php //echo clsCliente::user_id(); ?>);

    function ListarClietes(Tab,ultimo){
        //tab identifica si en un reingreso o Equipo lo que se busca
        //buscar  es la variable que contine codigo de busqueda

        $(Tab).empty();//borra el contenido de los tabs

        if ($("input#E_estados").is(':checked')){B_todos=1;}else{B_todos=0;}
        var dat="ListarClietes="+B_todos+"&Buscar="+Buscar+"&ultimo="+ultimo;

        //alert(dat)
        /**  @@@##@@@##@@@##@@@##@@@##@@@##@@@##@@@##@@@##@@@##@@@##@@@##*/



        $.ajax({
            url : './?action=st_Equipos',
            type : 'POST',
            data :dat,
            beforeSend: function () {
                $(Tab).append(" <div class='col-md-8' id='imgGuardar' style='padding-left: 0;text-align: center;padding-top: 10px;'><img src='plugins/dist/img/guardar.gif' /></div> ");
            },
            success : function(res){
               // alert(res);

                $(Tab).empty();
                if(res!=0){

                    $(Tab).append(res);
                }
                else{$(Tab).append("<div class='alert alert-warning' role='alert'>No se encontraron resultados.</div>");}
                //------------
                $(function () {
                    $("[data-toggle='tooltip']").tooltip();
                });

            }
        });
    }


    /** ########### L.C <<< ############ */





      /** Persistencia de la busqueda.  */


      function Guardar_busqueda(buscar){
        /** Donde dat va hacer la variable  Buscar=SelectBuscar+"=>"+$("div#TextBuscar input#Buscar").val();*/
        /** Es la combinacion del select y el imput del buscar */

        crearCookie('busqueda',buscar,1);




      }

      function cargarBusqueda(){
          if(exiteCookie('busqueda')){
              var res=leerCookie('busqueda');
              var dat=res.split("=>");
              var tipo=dat[0];
              var contenido=dat[1];


              $("select#SlBuscar").val(tipo);
              SelectBuscar=tipo;
              $("input#Buscar").val(contenido);

              fnBuscar();
          }
          else{
              SelectBuscar=3
          }

      }
        // name dat son strin y dias enteros
      function crearCookie(name,dat,dias){
          if(exiteCookie('name')){
              Cookies.set(name,dat);
          }
          else{
              Cookies.set(name,dat,{expires: dias});
          }

      }

      function leerCookie(name){
          return Cookies.get(name);
      }

      function borrarBorrar(name){
          Cookies.remove(name);
      }

      function exiteCookie(name){
          var res=true;

          var cookieExist = leerCookie(name);

            //alert(cookieExist)
          if(cookieExist==undefined ){
                res=false;
          }

          return res;
      }

    /** Funciones generales */
     
    //LoadingGif("form#FormIngreso button#btnAddIngreso","form#FormIngreso div#imgGuardar","form#FormIngreso div#inf",1);  
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
     
     function desabilitarInput(op,elem){
        if(op){$(elem).prop('disabled', false);}
        else{$(elem).prop('disabled', true);}
    }



     function inputVacio(dat){
        var res=0
        if(dat!=""&&dat!=" "){
            res=1
        }
        
        return res;
    }
     
     /** ######## FIN ######*/

    
     });

</script>