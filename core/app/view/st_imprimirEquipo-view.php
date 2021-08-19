<?php
$equipo=0;
$titulo="Scream Tech";

$volver_si=false;
$url="";
if(isset($_GET["volver"])){
    $volver_si=true;
    $url=$_GET["volver"]."&equipo2=".$_GET["equipo2"]."&estado=".$_GET["estado"];
}

if(isset($_GET["equipo"]) && clsSeguridad::validarID($_GET["equipo"])){
    $equipo=$_GET["equipo"];
    $c=clsEquipo::getById($equipo);
    $nrEquipo=$equipo;
    if(!count($c)>0){
        $_SESSION["msj"]="<div class='alert alert-warning' role='alert'><strong> Ne. #$equipo !</strong> de equipo no exite.</div>";
        Core::redir("./?view=st_Equipos");
    }
    else{$_SESSION["EquipBuscar"]=$nrEquipo;}
}
else{
    $_SESSION["msj"]="<div class='alert alert-warning' role='alert'> <strong>Alerta!</strong> Se perdio la referencia del cliente. </div>";
    Core::redir("./?view=st_Equipos");

}



//Traigo el cliente desde el nr orden
$cliente=clsCliente::getById(clsCliente::idCliente2($equipo));
$equipos=clsEquipo::getById($equipo);

$titulo=$_GET["equipo"]."_".$cliente->apellido;
?>


<div class="row" id="ControlPrint">
    <div class="col-md-12" id="imprimirTodo">
        <a href=" <?php if(!$volver_si){ ?> ./ <?php } else{ ?> ./?view=<?php echo $url; } ?> "><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
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

            <br/><br/><br/>
            <div class="col-md-12 col-xs-12">
                <button class="btn btn-success pull-right" id="Btnimprimir"  data-loading-text="Precesando..." style="margin-bottom: 10px; margin-right: 50px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-print"></span>Imprimir</button>
            </div>
            <br/>
            <br/>
            <div class="col-md-12 col-xs-12" id="ContImprimir">

                        <?php

                            $row="";$row2="";$row3="";

                               $Cabecera=clsImprimir::getById(1);
                                if($_SESSION["user_id"]==2){
                                    $Cabecera=clsImprimir::getById(2);
                                }
                            
                            
                            
                                $sec1="";$sec2="";$sec3="";$sec4="";$sec5="";
                                $sec1=$Cabecera->sec1;$sec2=$Cabecera->sec2;$sec3=$Cabecera->sec3;$sec4=$Cabecera->sec4;$sec5=$Cabecera->sec5;$foto1=$Cabecera->foto1;$foto2=$Cabecera->foto2;







                            $fallas="";$tipoEquipo="";$OrdenS="";
                                


                            if(count($cliente)){


                        ?>
                                <div class="col-md-12  TablaPrint printEquipo"  id="Ultimo">

                                    <table class="table table-bordered" style="vertical-align: middle;border-collapse: collapse;margin-bottom: 5px;">
                                        
                                        <thead >
                                            <tr>
                                                <td colspan="1" rowspan="4" style="width: 120px;"><img class="img-responsive center-block" alt="Responsive image" src="<?php echo $foto1; ?>" style="    margin-top: 15px;"/></td>
                                                <td colspan="4" rowspan="4" style="text-align: center;">
                                                    <h4><?php echo $sec1; //utf8_decode se va usar hasta hacer el formulario para la modificacion y depues de eso hay que sacar esa funcion ?></h4>
                                                    <h4><?php echo $sec2; ?></h4>
                        
                                                    <p><?php echo $sec3; ?></p>
                                                    <p><?php echo $sec4; ?></p>
                        
                                                </td>
                                                <td colspan="1" rowspan="4" style="width: 120px;"><img class="img-responsive center-block" alt="Responsive image" src="<?php echo $foto2; ?>" style="    margin-top: 15px;"></td>
                                            </tr>
                                            </thead>
                                        
                                        
                                        <tbody >
                                        <tr>
                                            <td colspan="1"><strong>Fecha fecha ingreso</strong></td>
                                            <td colspan="6"  class="centrar"><?php echo clsFunciones::fecha2($equipos->fecha_ingreso,0);?></td>


                                        </tr>

                                        <tr>
                                            <td colspan="1"><strong>cliente</strong></td>
                                            <td colspan="2" class="centrar"><?php echo clsFunciones::MayusculaPrimera($cliente->apellido." ".$cliente->nombre); ?></td>
                                            <td colspan="1" style="text-align: center;"><strong>D.N.I</strong></td>
                                            <td colspan="2" ><?php echo $cliente->dni; ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="1"><strong>Telefono</strong></td>
                                            <td colspan="2" class="centrar"><?php echo $cliente->telefono; ?></td>
                                            <td colspan="1" style="text-align: center;"><strong>E-mail</strong></td>
                                            <td colspan="2" ><?php  if($cliente->email!=""){echo $cliente->email;} ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="1"><strong>Equipo</strong></td>
                                            <td colspan="5"  class="centrar"> <?php echo $equipos->tipoEquipo; ?> </td>


                                        </tr>
                                        <tr>
                                            <td colspan="1"  ><strong style="font-size: 14px;color: #006ef6;border-bottom: 1px solid red;">N. Orden</strong></td>
                                            <td colspan="5"  style="font-size: 16px;padding-left:5px "><?php echo $equipos->nr_orden; ?>  </td>
                                        </tr>

                                        <tr >
                                            <td colspan="1" ><strong>Falla</strong></td>
                                            <td colspan="5" style="text-align: left;" > <?php  echo clsFunciones::fallaPrint(clsEquipo::FallasActivaeInactivas($equipos->nr_orden,$equipos->id_tipo_equipo,1)); ?></td>
                                        </tr>

                                        <tr >
                                            <td colspan="1" ><strong>Observaciones</strong></td>
                                            <td colspan="5" style="text-align: left;" >Estado del Hardware y funcionamiento a verificar. <?php echo $equipos->descripcion; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" style="height: 50px;"><strong>Diagnostico</strong></td>
                                            <td colspan="5"  style="text-align: left;">  </td>
                                        </tr>


                                        <tr>
                                            <td colspan="6">
                                                <p style="padding: 4px;font-size: 12px;">
                                                    <?php
                                                    echo $sec5;

                                                    ?>

                                                </p>


                                            </td>

                                        </tr>

                                        
                                        

                                        </tbody>
                                    </table>

                                </div>



                        <?php
                            }

                        ?>

            </div>

        </div>









        <br/><br/><br/><br/><br/>
    </div>
</div>

 <script>

        $(document).ready(function() {


            var titulo="<?php echo $titulo; ?>";

              $("title").text("Nr.Orden "+titulo);

            $("button#Btnimprimir").click(function() {

                  var modal="div#ContImprimir";

                $(modal+" div.TablaPrint table").removeClass("table table-bordered");
                $(modal+" div.TablaPrint table").css({"border":"1px solid #000"});
                $(modal+" div.TablaPrint table tr td").css({"border":"1px solid #000"});
                $(modal+" div.TablaPrint table tr td.centrar").css({"text-align":"center"});

                $(modal+" div.printEquipo table tbody").css({"font-size":"12px"});





                $(modal).printArea();

            });




        //FIn


        });


 </script>




