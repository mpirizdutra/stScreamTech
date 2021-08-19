<?php
ValidacionSesion::Validar();
if(ValidacionSesion::$isLoggedIn) {


if(isset($_POST["imprimirHTML"])){

    $nrOrden=0;
    $nr_Orden=$_POST["imprimirHTML"];
    $idCliente=$_POST["idCliente"];
    $soloCliente=$_POST["SoloCliente"];
//echo $nr_Orden."-".$idCliente."-".$soloCliente;
    if($nr_Orden!=""){

    //armado de nr_orden para consulta
    //clsFunciones::explode2()

    $dat="(".clsFunciones::explode2(explode("#",$nr_Orden),",").")";

//echo $dat;



    //ARMADO DE HTML imprimir
    $FechaIngreso="";
    $row="";$row2="";$row3="";
    $CantEquipos=0;
    $cliente=clsCliente::getById($idCliente);
    $FI=clsCliente::FechaUltimoEquipo($idCliente);
    $r=mysqli_fetch_assoc($FI[0]);
    $FechaIngreso=$r["fecha"];

    if(count($cliente)>0){

    }


    $obser="";
    $fallas="";$tipoEquipo="";$OrdenS="";

    $equipo=clsEquipo::ListarEquipo3($dat);

    $equipo2=clsEquipo::ListarEquipo3($dat);

    $Cabecera=clsImprimir::getById(1);
    if($_SESSION["user_id"]==2){
        $Cabecera=clsImprimir::getById(2);
    }



    $sec1="";$sec2="";$sec3="";$sec4="";$sec5="";


        $sec1=$Cabecera->sec1;$sec2=$Cabecera->sec2;$sec3=$Cabecera->sec3;$sec4=$Cabecera->sec4;$sec5=$Cabecera->sec5;$foto1=$Cabecera->foto1;$foto2=$Cabecera->foto2;

//echo mysqli_num_rows($equipo[0]);
    if(count($cliente)&& mysqli_num_rows($equipo[0])>0){

        if(count($cliente)>0&& mysqli_num_rows($equipo[0])>0){

            $CantEquipos=mysqli_num_rows($equipo[0]);
            ?>
            <!-- >>> Tabla para cliente -->

            <div class="table-responsive TablaPrint "  <?php if($CantEquipos==1){?> id="Ultimo" <?php }?> >

                <table class="table table-bordered" style=" margin-bottom:">
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
                    <tbody style="border-collapse: inherit;">

                    <tr>
                        <td colspan="1" ><strong>Fecha ingreso</strong></td>
                        <td colspan="2"  class="centrar"><?php echo clsFunciones::fecha2($FechaIngreso,0); ?></td>

                        <td colspan="1" class="centrar"><strong>Fecha entrega</strong></td>
                        <td colspan="2"  class="centrar">&ensp;/&ensp;&ensp; &ensp;/</td>
                    </tr>
                    <tr>
                        <td colspan="1"><strong>cliente</strong></td>
                        <td colspan="2" class="centrar"><?php echo clsFunciones::MayusculaPrimera($cliente->apellido." ".$cliente->nombre); ?></td>
                        <td colspan="1" style="text-align: center;"><strong>D.N.I</strong></td>
                        <td colspan="2"><?php echo $cliente->dni ; ?></td>
                    </tr>

                    <tr>
                        <td colspan="1"><strong>Telefono</strong></td>
                        <td colspan="2" class="centrar"><?php echo $cliente->telefono; ?></td>
                        <td colspan="1" style="text-align: center;"><strong>E-mail</strong></td>
                        <td colspan="2"><?php if($cliente->email!="NULL"){echo $cliente->email;} ?></td>
                    </tr>

                    <?php

                    //cliente id_tipo_equipo,`id_garantia_garantia`, `Nserie`, `imei`, `prestadora`,
                    $imei="";$Nserie="";
                    while($row2=mysqli_fetch_assoc($equipo[0])){
                        $tipoEquipo.= "-".$row2["tipoEquipo"]." ";
                        $OrdenS.=$row2["nr_orden"]."- ";

                        $Nserie.="-".$row2["Nserie"]." ";
                        //$Tequipo=IdTipoEquipo($row2["id_tipo_equipo"]);


                        if( $row2["imei"]!="NULL"){
                            $imei.="-".$row2["imei"]." ";
                        }



                        $v=fallaPrint(clsEquipo::FallasActivaeInactivas($row2["nr_orden"],$row2["id_tipo_equipo"],1));
                        if($v!=""){
                            $fallas.="Nr $row2[nr_orden]: ".$v."<br/>";
                        }
                        $obser.="Nr $row2[nr_orden]: ".$row2["descripcion"]."<br/>";


                    }

                    ?>


                    <tr>
                        <td colspan="1" ><strong>Equipo</strong></td>
                        <td colspan="5" class="centrar"><?php echo $tipoEquipo; ?>  </td>

                    </tr>
                    <tr>
                        <td colspan="1"  ><strong style="font-size: 14px;color: #006ef6;border-bottom: 1px solid red;">N. Orden</strong></td>
                        <td colspan="5"  ><?php echo $OrdenS; ?>  </td>
                    </tr>

                    <tr>
                        <td colspan="1" ><strong>Nr. Serie</strong></td>
                        <td colspan="2" class="centrar"><?php echo $Nserie; ?>  </td>
                        <td colspan="1" ><strong>IMEI</strong></td>
                        <td colspan="2" class="centrar" ><?php echo $imei; ?>  </td>
                    </tr>





                    <tr style="text-align: center;">
                        <td colspan="1"><strong>Falla</strong></td>
                        <td colspan="5" style="text-align: left;"><?php echo $fallas; ?> </td>
                    </tr>
                    <tr>
                    <tr style="text-align: center;">
                        <td colspan="1"><strong>Observaciones</strong></td>
                        <td colspan="5" style="text-align: left;">Estado del Hardware y funcionamiento a verificar. <?php echo $obser; ?> </td>
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

                <?php
                if($CantEquipos==1&&$soloCliente==0){

                    //$row2["prestadora"] $row2["imei"] $row2["Nserie"]

                    $total=mysqli_num_rows($equipo2[0]);
                    while($row2=mysqli_fetch_assoc($equipo2[0])){
                        $imei=$row2["imei"];$serie=$row2["Nserie"];
                        if($imei=="NULL"){$imei="";}if($serie=="NULL"){$serie="";}
                        ?>
                        <div class="col-xs-12" style="padding: 5px;border-bottom: 2px dashed #000;margin-bottom: 10px;"></div>

                        <table class="table table-bordered" style="vertical-align: middle;margin-bottom: 20px;">

                            <tbody >
                            <tr>
                                <td colspan="1"><strong>Fecha ingreso</strong></td>
                                <td colspan="2"  class="centrar"><?php echo clsFunciones::fecha2($row2["fecha_ingreso"],0);?></td>
                                <td colspan="1"><strong>Fecha entrega</strong></td>
                                <td colspan="2"  class="centrar"><?php echo clsFunciones::fecha2($row2["fecha_entrega"],0);?></td>

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
                                <td colspan="2" ><?php  if($cliente->email!="NULL"){echo $cliente->email;} ?></td>
                            </tr>



                            <tr>
                                <td colspan="1" ><strong>Equipo</strong></td>
                                <td colspan="5" class="centrar"><?php echo $row2["tipoEquipo"]; ?>  </td>

                            </tr>
                            <tr>
                                <td colspan="1" ><strong style="font-size: 14px;color: #006ef6;border-bottom: 1px solid red;">N. Orden</strong></td>
                                <td colspan="5" ><?php echo $row2["nr_orden"]; ?>  </td>
                            </tr>


                            <tr>
                                <td colspan="1" ><strong>Nr. Serie</strong></td>
                                <td colspan="2" class="centrar"><?php echo $serie; ?>  </td>
                                <td colspan="1" ><strong>IMEI</strong></td>
                                <td colspan="2" class="centrar" ><?php echo $imei; ?>  </td>
                            </tr>




                            <tr >
                                <td colspan="1" ><strong>Falla</strong></td>
                                <td colspan="5" style="text-align: left;" > <?php echo fallaPrint(clsEquipo::FallasActivaeInactivas($row2["nr_orden"],$row2["id_tipo_equipo"],1)); ?></td>
                            </tr>
                            <tr >
                                <td colspan="1" ><strong>Observaciones</strong></td>
                                <td colspan="5" style="text-align: left;" >Estado del Hardware y funcionamiento a verificar. <?php echo $row2["descripcion"]; ?></td>
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

                            <tr>
                                <td colspan="3" style="text-align: center;"><strong>Conforme al cliente</strong></td>
                                <td colspan="1" style="border-right: 1px solid transparent;text-align: right;"><strong>Fecha</strong> </td>
                                <td colspan="2"  style="text-align: center;">&ensp;/&ensp;&ensp; &ensp;/</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="">Firma</td>
                                <td colspan="2"  style=""> Aclaraci&oacute;n</td>
                                <td colspan="2"  style="">  D.N.I</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="height: 50px;"></td>
                            </tr>

                            </tbody>
                        </table>





                        <?php

                    } //cierre while


                }
                ?>

            </div>
            <!-- Tabla para cliente <<< -->

            <?php
            if($CantEquipos>1&$soloCliente==0){
                $cont=0;
                $i=1;
                $j=0;
                $total=mysqli_num_rows($equipo2[0]);
                while($row2=mysqli_fetch_assoc($equipo2[0])){
                    $imei=$row2["imei"];$serie=$row2["Nserie"];
                    if($imei=="NULL"){$imei="";}if($serie=="NULL"){$serie="";}
                    ?>


                    <?php

                    if(($total%2)==0){

                        if($i==1){ ?>
                            <div class="col-md-12  TablaPrint printEquipo" <?php if($j==$total-2){?> id="Ultimo" <?php }?>>
                        <?php  }

                    }
                    else{

                        if($i==1){ ?>
                            <div class="col-md-12  TablaPrint printEquipo" <?php if($j==$total-1){?> id="Ultimo" <?php }?>>
                            <?php
                        }
                    }
                    ?>
                    <table class="table table-bordered" style="vertical-align: middle;border-collapse: collapse;margin-bottom: 5px;">

                        <tbody >
                        <tr>
                            <td colspan="1"><strong>Fecha ingreso</strong></td>
                            <td colspan="2"  class="centrar"><?php echo clsFunciones::fecha2($row2["fecha_ingreso"],0);?></td>
                            <td colspan="1" class="centrar"><strong>Fecha entrega</strong></td>
                            <td colspan="2"  class="centrar"><?php echo clsFunciones::fecha2($row2["fecha_entrega"],0);?></td>

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
                            <td colspan="2" ><?php if($cliente->email!="NULL"){echo $cliente->email;} ?></td>
                        </tr>



                        <tr>
                            <td colspan="1" ><strong>Equipo</strong></td>
                            <td colspan="5" class="centrar"><?php echo $row2["tipoEquipo"]; ?>  </td>

                        </tr>
                        <tr>
                            <td colspan="1" ><strong style="font-size: 14px;color: #006ef6;border-bottom: 1px solid red;">N. Orden</strong></td>
                            <td colspan="5" ><?php echo $row2["nr_orden"]; ?>  </td>
                        </tr>



                        <tr>
                            <td colspan="1" ><strong>Nr. Serie</strong></td>
                            <td colspan="2" class="centrar"><?php echo $serie; ?>  </td>
                            <td colspan="1" ><strong>IMEI</strong></td>
                            <td colspan="2" class="centrar" ><?php echo $imei; ?>  </td>
                        </tr>

                        <tr >
                            <td colspan="1" ><strong>Falla</strong></td>
                            <td colspan="5" style="text-align: left;" > <?php echo fallaPrint(clsEquipo::FallasActivaeInactivas($row2["nr_orden"],$row2["id_tipo_equipo"],1)); ?></td>
                        </tr>

                        <tr >
                            <td colspan="1" ><strong>Observaciones</strong></td>
                            <td colspan="5" style="text-align: left;" >Estado del Hardware y funcionamiento a verificar. <?php echo $row2["descripcion"]; ?></td>
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

                        <tr>
                            <td colspan="3" style="text-align: center;"><strong>Conforme al cliente</strong></td>
                            <td colspan="1" style="border-right: 1px solid transparent;text-align: right;"><strong>Fecha</strong> </td>
                            <td colspan="2"  style="text-align: center;">&ensp;/&ensp;&ensp; &ensp;/</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="">Firma</td>
                            <td colspan="2"  style=""> Aclaraci&oacute;n</td>
                            <td colspan="2"  style="">  D.N.I</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="height: 50px;"></td>
                        </tr>

                        </tbody>
                    </table>

                    <?php
                    if($i==1){echo "<div class='col-xs-12' style='padding: 5px;border-bottom: 2px dashed #000;margin-bottom: 10px;''></div>";}
                    if($i==2){
                        ?>
                        </div>

                    <?php } else{
                        if($cont==$total){?> </div> <?php }
                    }
                    ?>




                    <?php
                    if($i==2){$i=1;}
                    else{$i++;}
                    $cont++;
                    $j++;
                }
            }





        }
    }
    }
else{ echo 0;}
}


/**  Maneja los equipo que se seleccioana para imprimir */

if(isset($_POST["ControlPrint_Select"])){

    //sleep(5);
    $nrOrden=$_POST["ControlPrint_Select"];
    $res=clsImprimir::EquipoPrintselect($nrOrden);
    if(mysqli_num_rows($res[0])>0){

        $row=mysqli_fetch_assoc($res[0]);
        ?>
        <tr id="T<?php echo $row["nr_orden"]; ?>">

            <td><?php echo $row["nr_orden"];?></td>
            <td><?php echo $row["tipoEquipo"];?></td>
            <td><?php echo $row["descripcion"];?></td>
            <td><?php echo $row["fecha_ingreso"];?></td>
            <td><?php echo $row["estado"];?></td>
            <td id="A<?php echo $row["nr_orden"];?>">
                <a id="Borrar" style="margin-right:3px;" class="btn btn-danger btn-sm acciones" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Borrar">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
            </td>

        </tr>
        <?php

    }


}
 



if(isset($_POST["EditarHTML"])){
        $res=0;
        $id=$_POST["EditarHTML"];
        $sec1=$_POST["sec1"];
        $sec2=$_POST["sec2"];
        $sec3=$_POST["sec3"];
        $sec4=$_POST["sec4"];
        $sec5=$_POST["contenido"];

       $res= clsImprimir::Update($sec1,$sec2,$sec3,$sec4,$sec5,$id);

       if($res>0){$res=1;}
       echo $res;

    }
}else{Core::redir("./");}

/** Funciones */
function fallaPrint($fallas){
    $val="";$i=0;
    if($fallas[0]){

        $count=mysqli_num_rows($fallas[0]);
        if($count>0){

            while($row=mysqli_fetch_assoc($fallas[0])){

                $val.=" - ".$row["falla"];


            }



        }


    }
    return $val;

}

?>