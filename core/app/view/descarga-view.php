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
        <h4>Descargas</h4>
        <br />
    </div>
    <div class="col-md-12 col-xs-12" >
        <form id="FormDescarga" method="post" >
            <div class="col-md-12 col-xs-12" >


                <div class="col-md-4 col-xs-12">
                    <div class="input-group form-group" >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                        <input type="text"  class="form-control" maxlength="150" name="name" required="required" id="name" placeholder="Nombre Link"  />

                    </div>

                </div>

            </div>

            <div class="col-md-12 col-xs-12">
                <div class="col-md-4 col-xs-12">
                    <div class="input-group form-group" >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-globe"></span>
                            </span>
                        <input type="text"   autocomplete="off" class="form-control" min="5" maxlength="250" name="url" required="required" id="url" placeholder="Link"  />

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
        <h4>Lista</h4>
        <br />

        <?php
               $descarga=clsDescarga::getAll();

        if(count($descarga)>0){
        ?>

            <table class="table table-bordered table-hover	">
                <thead>
                <th>Links</th>
                <th>Fecha|Modificacion</th>
                <th>Acciones</th>

                </thead>

                <tbody id="cont">
                <?php
                    foreach ($descarga as $des){

                ?>
                    <tr>
                        <td><a href="<?php echo  $des->url;  ?>" target="_blank"><?php echo $des->name; ?></a></td>
                        <td><?php echo $des->fecha; ?></td>
                        <td class="acciones">
                            <a id="<?php echo $des->idDescarga; ?>" class="btn btn-xs btn-primary btnBorrar"><i class="glyphicon glyphicon-pencil"></i></a>

                        </td>
                    </tr>

                <?php
                    }
                ?>

                </tbody>
            </table>

    <?php } ?>
    </div>




    <script>
        $(document).ready(function(){




            $('form#FormDescarga').submit(function() {



                var dat="descarga=1"+"&";




                dat+=$(this).serialize();//aca guardo todo el form

                $.ajax({
                    type: 'POST',
                    url:  './?action=descarga',
                    data: dat,
                    beforeSend: function () {
                        $("img#imgGuardar").css("display","block");
                        desabilitarInput("#btnGuardar",0);
                    },
                    success: function(res) {
                        alert(res);
                        //location.reload();

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









