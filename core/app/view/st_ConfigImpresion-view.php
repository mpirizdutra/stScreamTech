<?php
$idHTML=0;
if(isset($_SESSION["user_id"])){
    $idHTML=$_SESSION["user_id"];
    if(isset($_POST["SlID"])){
        $idHTML=$_POST["SlID"];
        $print=clsImprimir::getByUser_id($idHTML);
    }
    else{
        $print=clsImprimir::getByUser_id($idHTML);
    }

}
else{Core::redir("index.php");}

?>

<div class="row">
    <div class=" col-md-12 col-xs-12">
        <a href="./"><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
        <hr>
        <h1><i class="glyphicon glyphicon-edit"></i> Edicion | Hoja de servicio</h1>


        <div class='row' id="SeccionPrincipal" >

            <div class="col-md-12 col-xs-12" >
                <h4  style="color: #428bca !important;">Seleccione HTML <strong></strong></h4>
                <br />
                <form name="FormSelect" method="post">
                    <div class="col-md-3 col-xs-12">
                        <div class="input-group form-group " >
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                            <select class="form-control" name="SlID" id="SlID" >
                                <!--option value="" disabled="" selected="">Seleccione - Busqueda</option-->
                                <option value="1" <?php if(isset($_POST["SlID"])){if($_POST["SlID"]==1){?>  selected="selected" <?php }} ?> >screamtech</option>
                                <option value="2" <?php if(isset($_POST["SlID"])){if($_POST["SlID"]==2){?>  selected="selected" <?php }} ?> >Intech</option>


                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-12">

                        <button name="mysubmit" type="submit" id="btnGuardarCliente" data-loading-text="Guardando..." class="btn btn-primary " style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-repeat"></span>Cargar</button>
                    </div>

                </form>


            </div>

        </div>
        <br /><br />


        <form id="FormNuevos"  >

            <div class='col-md-12 col-xs-12' >


                 <br />
                 <hr />




            <div class='row' id="SeccionPrincipal" >

                <div class="col-md-12 col-xs-12" >
                    <h4  style="color: #428bca !important;">Seccion Principal <strong style="color: #0c0c0c"># <?php if(isset($_POST["SlID"])){if($_POST["SlID"]==1){ echo "Scream Tech"; }else{echo "In Tech"; }} ?>   </strong></h4>
                    <br />

                    <div class="col-md-6 col-xs-12">

                           <div class="input-group form-group" >
                               <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pencil"></span>
                               </span>
                                <input type="text"  class="form-control" maxlength="150" name="sec1" required="required" id="sec1" placeholder="Titulo" value="<?php echo $print->sec1; ?>"  />
                            </div>
                            
                            <div class="input-group form-group ">
                                 <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                 </span>
                                <input type="email" class="form-control" name="sec2" id="sec2" placeholder="E-mail" required="required" value="<?php echo $print->sec2; ?>"/>
                            </div>
                            
                            <div class="input-group form-group" >
                               <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pencil"></span>
                               </span>
                                <input type="text"  class="form-control" maxlength="150" name="sec3" required="required" id="sec3" placeholder="Direccion" value="<?php echo $print->sec3; ?>"  />
                            </div>
                            
                            <div class="input-group form-group" >
                               <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pencil"></span>
                               </span>
                                <input type="text"  class="form-control" maxlength="150" name="sec4" required="required" id="sec4" placeholder="horarios" value="<?php echo $print->sec4; ?>"  />
                            </div>

                       

                    </div>
                </div>

            </div>

            <hr />
            
              <div class='row' id="SeccionLeyenda" >

                <div class="col-md-12 col-xs-12" >
                    <h4  style="color: #428bca !important;">Seccion Secundaria <strong></strong></h4>
                    <br />
                </div>

                  <div class="col-md-12 col-xs-12">
                      <div class="form-group">
                          <label for="pagina_contenido">Contenido</label>
                          <textarea class="ckeditor" name="contenido" id="pagina_contenido" cols="30" rows="10">
                                <?php echo $print->sec5; ?>
                          </textarea>
                      </div>
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
                        <button name="mysubmit" type="submit" id="btnguardar" data-loading-text="Guardando..." class="btn btn-primary pull-right"  style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
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
<script type="text/javascript" src="plugins/dist/js/ckeditor/ckeditor.js"></script>
<!--script type="text/javascript" src="plugins/dist/js/ckfinder/ckfinder.js"></script-->
<script type="text/javascript" src="plugins/dist/js/ckscript.js"></script>

<script>

    $(document).ready(function(){



        function validarvacio(){
            res=0;
            sec1=$("input#sec1").val().length;
            sec2=$("input#sec2").val().length;
            sec3=$("input#sec3").val().length;
            sec4=$("input#sec4").val().length;
            sec5=$("textarea#pagina_contenido").text().length;

            if(sec1>5&&sec2>5&&sec3>5&&sec4>5&&sec5>50){
                res=1;
            }
            return res;

        }



        /** ##############################
         *  
         *  #############################
         *  */


        var idHTML=0;
        idHTML=<?php echo $idHTML; ?>;
        $('form#FormNuevos').submit(function() {

            $("div#inf").empty();

            /** varaibles contenido */




            if(idHTML>0&&(validarvacio()>0)){
                var dat="EditarHTML="+idHTML+"&";

                

                    
                    dat+=$(this).serialize();//aca guardo todo el form

                    $.ajax({
                        type: 'POST',
                        url:  './?action=st_Imprimir',
                        data: dat,
                        beforeSend: function () {

                            LoadingGif("form#FormNuevos button#btnguardar","form#FormNuevos div#imgGuardar","form#FormNuevos div#inf",1);
                        },
                        success: function(res) {
                            //alert("resultado:"+res);
                            if(res>0){


                                LoadingGif("form#FormNuevos button#btnguardar","form#FormNuevos div#imgGuardar","form#FormNuevos div#inf",0);
                                $("div#inf").append("<div class='alert alert-success'>Guardado correctamente. </div>");


                            }
                            else{
                                $("div#inf").append("<div class='alert alert-warning'>Ocurri&oacute; un error .</div>");
                                LoadingGif("form#FormNuevos button#btnguardar","form#FormNuevos div#imgGuardar","form#FormNuevos div#inf",0);
                            }

                        }
                    });
                    //LoadingGif("form#FormAddMasE button#btnguardar","form#FormAddMasE div#imgGuardar","form#FormAddMasE div#inf",0);
           }
            else{$("div#inf").append("<div class='alert alert-warning'>Todo los campos son obligatorios.(5 o mas caracteres)  </div>");}



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

