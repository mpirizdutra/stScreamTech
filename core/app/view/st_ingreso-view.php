<?php
$dni="";
$nombre="";
$apellido="";
$dat=array();
if(isset($_SESSION["EquipBuscar"])){
    unset($_SESSION["EquipBuscar"]);
}


        $intech=0;
        if(isset($_SESSION["permiso"])){

            if($_SESSION["permiso"]!=10){
                $intech=1;
            }
        }



  if(isset($_GET["documento"])){
      $dni=$_GET["documento"];
      $dat=explode("=>", $dni);

    if(count($dat)>0){


        $nombre=$dat[1];
        $apellido=$dat[0];
        $dni=$dat[2];
    }


  }

 ?>
<div class="row">
	<div class="col-md-12 col-xs-12 ">
        <a href="./"><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
        <hr/>
        <h3 style="color: green"><i class="glyphicon glyphicon-record"></i> Equipo | Garantia <?php //if(isset($_GET["documento"])){echo $_GET["documento"];} ?> </h3>
            <div class="input-group form-group">
                <label style="cursor: pointer;color:blue">
                    <input type="radio" class="garantiza" id="garantiza" name="garantiza" value="1" <?php if($intech==1){ ?>  <?php } ?> > Equipo
                </label>
                <?php

                if($intech!=1) {

                    ?>
                    <label style = "margin-left: 10px;cursor: pointer;color: green" >
                        <input type = "radio" class="garantiza" id = "garantiza" name = "garantiza" value = "2" > Garantia
                    </label >
                <?php
                }
                ?>
            </div>


        <hr>
		<h1><i class="glyphicon glyphicon-user"></i> Ingreso | Cliente </h1>

           <form id="ClienteNuevo"  >
                                   
                    <div class='col-md-12 col-xs-12' >
                                                <div class="row">
                                                    <h4 style="color: #428bca;font-size: 20px;">Buscar cliente</h4>
                                                     <div class="col-md-12 col-xs-12 col-xs-12">
                                                        <div class="input-group form-group col-md-3" id="TextBuscar">
                                                                <input type="number" min="0"  maxlength="10" class="form-control" name="buscar" id="buscar" value="<?php if(count($dat)>0){echo $dni;} ?>" placeholder="D.N.I" />
                                                                <span class="input-group-addon" style="color: #fff;background-color: #3276b1;border-color: #285e8e; cursor:pointer" id="BtnBuscar">
                                                                    <span class="glyphicon glyphicon-search"></span>
                                                                </span>
                                                                
                                                            </div>
                                                     </div> 
                                                     <div class="col-md-6 col-xs-12" id="imgGuardar" style="padding-left: 0;text-align: center;display:none">
                                                        <img src="plugins/dist/img/guardar.gif"/>
                                                    </div>
                                                     <div class="col-md-6 col-xs-6" id="buscarInf"></div>       
                                                    
                                                </div>
                                                
                                                <br />
                                                <div class="row">
                                                    <h4 >Fecha de ingreso: <span style="margin-left: 20px;color:#0066ff;font-size: 15px;"> <?php  echo clsFunciones::fecha2(date('Y-m-d'),0); ?></span></h4>
                                                             
                                                    <div class="col-md-12 col-xs-12">
                                                        <div class="col-md-6 col-xs-12"  style="padding-left: 0;" >
                                                            <div class="input-group form-group" >
                                                                 
                                                                 <input type="hidden" class="form-control" name="fecha" id="fecha" required="required"  value="<?php  echo clsFunciones::fecha2(date('Y-m-d'),1); ?>"  />
                                                             </div>
                                                        </div>
                                                        
                                                    </div>     
                                                        
                                                </div>
                                                     
                                                  <div class="row">  
                                                     <h4 style="color: #428bca !important;font-size: 20px;">Datos del Cliente</h4>
                                                     
                                                    <div class="col-md-12 col-xs-12"> 
                                                            
                                                       <div class="col-md-6 col-xs-12" style="padding-left: 0;">
                                                          
                                                             <div class="input-group form-group" >
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-pencil"></span>
                                                                 </span>
                                                                 <input type="text" class="form-control" maxlength="100" name="nombre" required="required" id="nombre" value="<?php if(count($dat)>0){echo $nombre;} ?>" placeholder="Nombre"   />
                                                             </div>
                                                       
                                                        
                                                         
                                                            
                                                             <div class="input-group form-group" >
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-pencil"></span>
                                                                 </span>
                                                                 <input type="text" class="form-control" maxlength="100" name="apellido" value="<?php if(count($dat)>0){echo $apellido;} ?>" required="required" id="apellido" placeholder="Apellido"  />
                                                             </div>
                                                             
                                                             <div class="input-group form-group " >
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-phone"></span>
                                                                </span>
                                                                 <input type="text" class="form-control" maxlength="20" name="telefono" required="required" id="telefono" pattern="[0-9]+" title="caracteres permitidos 0-9" placeholder="Telefono"  />
                                                            </div>
                                                            
                                                             <div class="input-group form-group " >
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-sort-by-order"></span>
                                                                </span>
                                                                  <input type="number" min="0" class="form-control" maxlength="10" name="dni" id="dni" pattern="[0-9]+" title="caracteres permitidos 0-9 " placeholder="D.N.I"/>
                                                             </div>
                                                     
                                                             <div class="input-group form-group " >
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-envelope"></span>
                                                                </span>
                                                                 <input type="email" class="form-control"  name="email"  id="email"  placeholder="E-mail"  />
                                                            </div>
                                                             
                                                       </div>
                                                    
                                                 
                                                    </div>
                                               </div> 
                                               <br /><br />
                                                
                                                
                                                
                                             
                                         
                                         </div>
                                      <!-- Datos del cliente<<< --> 
                                       
                                   
                                   <hr /> 
                                   
                                    
                                    
                                   
                                    
                                     
                                       
                                       <!--Datos del Equipo<<<<-->
                                        <div class="col-md-12" style="clear: both;padding-bottom: 10px;" >   
                                            <div class="modal-footer">
                                                 <div class="form-group">
                                                   <div class="col-md-8 col-xs-12" id="inf" style="padding-left: 0;text-align: center;">
                                                        
                                                   </div>
                                                   <div class="col-md-8 col-xs-12" id="imgGuardar" style="padding-left: 0;text-align: center;display:none">
                                                        <img  src="plugins/dist/img/guardar.gif" />
                                                   </div>
                                                   <button name="mysubmit" type="submit" id="btnGuardarCliente" data-loading-text="Guardando..." class="btn btn-primary pull-right"  style="margin-bottom: 10px;" disabled="disabled"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
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





     var Garantiza=0;



        
    habilitarinputs(0);    
    $("div input#buscar").keypress(function(e) {
        if(e.which == 13) {
            //alert("sdasdas");
           fnBuscar();
        }
    });    
        

    var BuscarText="";
    $("span#BtnBuscar").click(function(){
       
        fnBuscar();
    });
    
    function fnBuscar(){
        
        $("div#buscarText").empty();
        BuscarText=$("input#buscar").val();
        $("div#buscarInf").empty();
        
        if(BuscarText!=""){
            if(BuscarText.length>=8)
                {
                    buscarCliente();
                }
             else{
            $("div#buscarInf").append("<div class='alert alert-info' role='alert'>EL dni no esta completo</div>");
        }
        }
        else{
            $("div#buscarInf").append("<div class='alert alert-info' role='alert'>Faltan datos, para pode realizar la busqueda.</div>");
        }
    }

    function buscarCliente(){
        var dat="Buscarcliente="+BuscarText;
        garantiza_select();
            $("div#buscarInf").empty();
            $.ajax({
                type: 'POST',
                url:  './?action=st_Cliente',
                data: dat,
                beforeSend: function () {
                    $("div#buscarInf").empty();
                    LoadingGif("span#BtnBuscar","div#imgGuardar","div#buscarInf",1);
                },
                success: function(idC) {

                    if(idC>0){
                        LoadingGif("span#BtnBuscar","div#imgGuardar","div#buscarInf",0);
                        $("div#buscarInf").append("<div class='alert alert-success'>Cliente <strong>#"+idC+"  encontrado. !</strong></div>");


                        if(Garantiza==1){
                            window.location = 'index.php?view=st_NuevoEquipo&cliente=' + idC;

                        }
                        if(Garantiza==2){
                            window.location = 'index.php?view=Equipo_Garantia&cliente=' + idC;

                        }

                        if(Garantiza==0){
                            $("div#buscarInf").append("<div class='alert alert-warning'>Seleccionar Si es o no una garantia</div>");

                        }
                    }
                    else{
                        LoadingGif("span#BtnBuscar","div#imgGuardar","div#buscarInf",0);
                        $("div#buscarInf").append("<div class='alert alert-warning'>Cliente no exite! Ingrese los datos.</div>");
                        
                        habilitarinputs(1);
                        $("input#nombre").focus();
                        $("form input#dni").val($("div input#buscar").val());
                    }

                },
                error : function(xhr, status) {
                    LoadingGif("span#BtnBuscar","div#imgGuardar","div#buscarInf",0);
                        
                    $("div#buscarInf").append("<div class='alert alert-warning'>La peticion a la base de datos fallo.</div>");

                }
            });
        
    }

    $("div#TextBuscar #buscar").prop('disabled', true);
    function garantiza_select(){
        Garantiza=$("input.garantiza:checked").val();


    }

    $("input.garantiza").change(function(){
        Garantiza=$("input.garantiza:checked").val();
        $("div#TextBuscar #buscar").prop('disabled', false);
        var documento=$("input#buscar").val();
        if(documento!=""){
            //alert(documento);
            fnBuscar();
        }
    });
    
    $('form#ClienteNuevo').submit(function() {

            $("div#inf").empty();
            $("div#buscarInf").empty();

            if(Garantiza>0) {
                var dat = "ClienteNuevo=1" + "&";


                dat += $(this).serialize();//aca guardo todo el form

                $.ajax({
                    type: 'POST',
                    url: './?action=st_Cliente',
                    data: dat,
                    beforeSend: function () {

                        LoadingGif("form#ClienteNuevo button#btnMasEquipo", "form#ClienteNuevo div#imgGuardar", "form#ClienteNuevo div#inf", 1);
                    },
                    success: function (idcliente) {
                        //alert("resultado:"+res);
                        if (idcliente > 0) {

                            $("div#inf").append("<div class='alert alert-success'>Se guardo correctamente.</div>");


                            LoadingGif("form#ClienteNuevo button#btnMasEquipo", "form#ClienteNuevo div#imgGuardar", "form#ClienteNuevo div#inf", 0);

                            if(Garantiza==1){
                                window.location = 'index.php?view=st_NuevoEquipo&cliente=' + idcliente;

                            }
                            if(Garantiza==2){
                                window.location = 'index.php?view=Equipo_Garantia&cliente=' + idcliente;

                            }

                            if(Garantiza==0){
                                $("div#inf").append("<div class='alert alert-warning'>Seleccionar Si es o no una garantia</div>");

                            }

                        } else {
                            $("div#inf").append("<div class='alert alert-warning'>Ocurri&oacute; un error. Actualiza la pagina.</div>");
                            LoadingGif("form#ClienteNuevo button#btnMasEquipo", "form#ClienteNuevo div#imgGuardar", "form#ClienteNuevo div#inf", 0);
                        }

                    }
                });

            }
            else{
                $("div#inf").append("<div class='alert alert-warning'>Falta seleccionar Equipo | Garantia.</div>");

            }

            return false;
        });
   
   


    /** <<<<<I.C.E */

    /**#############################
     * ############################# */

    /** Funciones generales */
     
    //LoadingGif("form#FormIngreso button#btnAddIngreso","form#FormIngreso div#imgGuardar","form#FormIngreso div#inf",1);  
    function AccionesAjax(dat){
        $.ajax({
            url : './?view=st_Equipos',
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

    function habilitarinputs(op){
        desabilitarInput(op,"form input#nombre");
        desabilitarInput(op,"form input#apellido");
        desabilitarInput(op,"form input#telefono");
        desabilitarInput(op,"form input#dni");
        desabilitarInput(op,"form input#email");
        desabilitarInput(op,"form button#btnGuardarCliente");
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

