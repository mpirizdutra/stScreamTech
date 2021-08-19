<div class="row" >


    <div class="col-md-12 col-xs-12">
        <?php
            if(isset($_SESSION["msj"])){
                echo $_SESSION["msj"];
                unset($_SESSION["msj"]);
            }
        ?>

    </div>
    <div class="col-md-12 col-xs-12" >
        <h4>Usuarios</h4>
        <br />
    </div>
    <div class="col-md-12 col-xs-12" >
            <form id="FormUser" method="post" >
                <div class="col-md-12 col-xs-12" >


                    <div class="col-md-4 col-xs-12">
                        <div class="input-group form-group" >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input type="text"  class="form-control" maxlength="15" name="nombre" required="required" id="nombre" placeholder="Nombre" value="<?php echo ""; ?>"  />

                        </div>

                    </div>

                </div>

                <div class="col-md-12 col-xs-12">
                    <div class="col-md-4 col-xs-12">
                        <div class="input-group form-group" >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-asterisk"></span>
                            </span>
                            <input type="text"   autocomplete="off" class="form-control" maxlength="15" name="clave" required="required" id="clave" placeholder="Clave" value="<?php echo ""; ?>"  />

                        </div>

                    </div>

                </div>

                <div class="col-md-12 col-xs-12">
                    <div class="col-md-4 col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="activo">Activar
                            </label>
                        </div>

                    </div>

                </div>


                <div class="col-md-12 col-xs-12" >

                        <div class="col-md-12 col-xs-12">
                            <div class="col-md-8 col-xs-12" id="inf" style="padding-left: 0;text-align: center;margin-bottom: 10px;">

                            </div>
                            <div class="col-md-8 col-xs-12" id="imgGuardar" style="margin-bottom: 10px;padding-left: 0;text-align: center;display:none">
                                <img src="plugins/dist/img/guardar.gif">
                            </div>
                        </div>
                    <div class="col-md-4 col-xs-12">
                        <button  type="submit" id="btnGuardar" data-loading-text="Guardando..." class="btn btn-primary pull-right" style="margin-bottom: 10px;" ><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>

                    </div>



                </div>



            </form>
    </div>


    <div class="col-md-12 col-xs-12">
        <br/>
        <hr  />

    </div>




    <script>
        $(document).ready(function(){




            $('form#FormUser').submit(function() {

               // $("div#inf").empty();

                var dat="Usuarios=1"+"&";




                dat+=$(this).serialize();//aca guardo todo el form

                $.ajax({
                    type: 'POST',
                    url:  './?action=Usuarios',
                    data: dat,
                    beforeSend: function () {

                    },
                    success: function() {
                        location.reload();

                    }
                });



                return false;
            });




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


            //FIN
        });



    </script>






</div>









