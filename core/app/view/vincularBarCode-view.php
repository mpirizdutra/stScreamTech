<?php
$equipo=0;
$titulo="Scream Tech";
$nrEquipo=0;
$volver_si=false;
$url="";
$Equipos=null;
if(isset($_GET["volver"])){
    $volver_si=true;
    $url=$_GET["volver"]."&equipo2=".$_GET["equipo2"]."&estado=".$_GET["estado"];
}

if(isset($_GET["equipo"]) && clsSeguridad::validarID($_GET["equipo"])){
    $equipo=$_GET["equipo"];
    $c=clsEquipo::getById($equipo);
    $nrEquipo=$equipo;
    $Equipos=$c;
    if(!count($c)>0){
        $_SESSION["msj"]="<div class='alert alert-warning' role='alert'><strong> Ne. #$equipo !</strong> de equipo no exite.</div>";
       // Core::redir("./?view=st_Equipos");
    }
    else{$_SESSION["EquipBuscar"]=$nrEquipo;}
}


?>


<div class="row" id="ControlPrint">
    <div class="col-md-12" id="imprimirTodo">
       <hr>
        <h1><i class="glyphicon glyphicon-phone"></i>Imprimir </h1>
        <div class="clearfix"></div>


        <!-- ## imrpimir -->

        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div id="inf" class="col-md-6 col-xs-6">

                </div>

            </div>
        </div>
        <div class="row">




            <div class="col-md-8 col-xs-12">


            </div>

            <div class="row">

                <br/>
                <br/>
                <div class="col-md-12 col-xs-12" >
                    <form id="form">
                        <div class="col-md-4 col-xs-12">
                            <div class="input-group form-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-barcode"></span>
                                </span>

                                <input type="text" autocomplete="off" class="form-control" maxlength="7" name="barCode" id="barCode" required="required" pattern="[0-9]+" title="caracteres permitidos 0-9" placeholder="Codigo de barra" value="<?php if($Equipos->barCode!=null){echo $Equipos->barCode;} ?>">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success pull-right" id="Btnimprimir"  data-loading-text="Precesando..." style="margin-bottom: 10px; "><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-barcode"></span>Vincular Codigo</button>
                            </div>
                        </div>
                    </form>


                </div>
                <div class="col-md-12 " id="inf">
                    <div class="col-md-4 col-xs-12">
                        <?php

                            if(isset($_SESSION["msj"])){
                                echo $_SESSION["msj"];
                                unset($_SESSION["msj"]);
                            }
                        ?>
                    </div>

                    <div class="col-md-4 col-xs-12">

                        <?php if($Equipos->barCode!=null){ ?>
                            <h4>Codigo de barra generado.</h4>
                            <svg style="border: 1px solid black" id='<?php  echo "barcode".clsFunciones::completar_ceros($Equipos->barCode); ?>'>
                        <?php } ?>

                    </div>

                </div>


            </div>









            <br/><br/><br/><br/><br/>
        </div>
    </div>
    <script src="plugins/dist/JsBarcode.all.min.js"></script>
    <script>

        $(document).ready(function() {

            $("input#barCode").focus();

            var Nr_orden=<?php echo $nrEquipo; ?>;

            $("button#Btnimprimir").click(function(){


                var barCode=$("input#barCode").val();

                if(Nr_orden>0&&barCode.length>0&&$.isNumeric(barCode)) {
                    $("button#Btnimprimir").prop('disabled', true);
                    $("div#inf").empty();
                    var dat = "vincular_codigo="+barCode+"&nr_orden="+Nr_orden;
                    $.ajax({
                        type: 'POST',
                        url: './?action=barCodes',
                        data: dat,
                        success: function (res) {

                            location.reload();

                        }

                    });
                }

                $("button#Btnimprimir").prop('disabled', false);

            });


         var codeNull=<?php if($Equipos->barCode!=null){echo 1;}else{echo 0;} ?>

             if(codeNull==1) {
                 jsonvalor = '<?php echo clsFunciones::completar_ceros($Equipos->barCode) ?>';


                 JsBarcode("#barcode" + jsonvalor, jsonvalor.toString(), {
                     format: "codabar",
                     lineColor: "#000",
                     width: 2,
                     height: 30,
                     displayValue: true
                 });
             }

            //
        });


    </script>




