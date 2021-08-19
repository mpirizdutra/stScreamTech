<?php


class clsIngreso_edit
{

    public static  function Fallas($res, $cant)
    {
        $count = 0;

            $count = mysqli_num_rows($res[0]);
            if ($count > 0) {

                $dat = self::armadoDatEquipo($res);
                $col = 2;
                $filas = round($count / $col);
                if (is_float($count / $col)) {
                    $filas += 1;
                }
                $i = 0;
                $c = $i;


                ?>



                        <table class="table table-striped">

                            <?php

                            for ($f = 0; $f < $filas; $f++) {
                                ?>

                                <tr>
                                    <?php
                                    for (; $c < count($dat); $c++) {
                                        if ($i < $col) {
                                            $val = explode("=>", $dat[$c]);

                                            ?>
                                            <td><label for='<?php echo $val[0]; ?>'
                                                       style="cursor: pointer;  margin-top: 7px;"><?php echo $val[0]; ?></label>
                                            </td>
                                            <td>

                                                <input type='checkbox' class="fallas tipo" data-onstyle="success"
                                                       data-offstyle="danger" name='<?php echo $val[1]; ?>'
                                                       id='<?php echo $val[0]; ?>' data-off-color='warning'/>

                                            </td>

                                            <?php
                                            $i++;
                                        } else {
                                            $i = 0;
                                            break;
                                        }
                                    }
                                    ?>

                                </tr>
                                <?php
                            }
                            ?>


                        </table>

                    <br/>
                    <div class="form-group">
                        <label for="requisitos">Observaciones</label>
                        <textarea class="form-control tipo textarea" rows="3" maxlength="500" name="descripcion"
                                  id="descripcion<?php echo $cant; ?>" placeholder="Falla y observaciones"></textarea>
                    </div>
                    <hr />


                <?php


            }



    }
    /*
    public static  function ArmarFallas($post,$pos){
        $fallas="";$i=0;$j=0;$value="";
        $dat=array();
        foreach($post as $clave => $val){
            if($i>$pos){
                //INSERT INTO `falla_equipo`(`id_falla`, `nr_orden`) VALUES
                $dat[$j]=$clave;
            }
            $i++;

        }
        for($i=0;$i<count($dat);$i++)
        {  $val=explode(";",$dat[$i]);
            if($i!=count($dat)-1){
                //`id_cliente`, `fecha_ingreso`, `tipoEquipo`, `descripcion`
                $value.="(".$idCliente.","."'".$fecha."','".$val[0]."','".$val[1]."'),";
            }
            else{$value.="(".$idCliente.","."'".$fecha."','".$val[0]."','".$val[1]."');";}
        }
        return $fallas;

    }
*/
    public static function armadoDatEquipo($res)
    {   $dat=array();$i=0;

            $count=mysqli_num_rows($res[0]);
            if($count>0){

                while($row=mysqli_fetch_assoc($res[0])){
                    $dat[$i]=$row["falla"]."=>".$row["id_falla"];$i++;
                }
            }

        return $dat;

    }
    
    
  public static  function InputsFallas($dat,$chek,$count){
            $col=2;
            $filas=round($count/$col);
            if(is_float($count/$col)){$filas+=1;}
            $i=0;$c=$i;
            
            
                    
             for($f=0;$f<$filas;$f++){
                ?>
                
                    <tr>
                     <?php 
                        for(;$c<count($dat);$c++){
                            if($i<$col){
                                $val=explode("=>",$dat[$c]);
                            
                      ?>      
                               <td> <label  for='<?php echo $val[0]; ?>' style="cursor: pointer;  margin-top: 7px;"><?php echo$val[0]; ?></label></td> 
                               <td> 
                                    
                                     <input type='checkbox' class="fallas tipo" data-onstyle="success" data-offstyle="danger" name='<?php echo$val[1]; ?>' id='<?php echo $val[0]; ?>' data-off-color='warning' <?php echo $chek; ?> />
                          
                               </td> 
                            
    <?php 
                               $i++;   
                            }
                            else{$i=0;break;}
                        } 
    ?>   
                
                    </tr>    
   <?php
                }
                    
            
    
    
    
  }

    public static function EquipoDat($equipo,$orden){

        $dat=explode(",",$equipo);
        $value="";
        for($i=0;$i<count($dat);$i++){
            if($i<count($dat)-1){
                if($i<count($dat)-2){
                    $value.="(".$dat[$i].",".$orden."),";
                }
                else{$value.="(".$dat[$i].",".$orden.");";}
            }


        }
        return $value;
    }

    public static function name_fallas($equipo){
        $dat=explode(",",$equipo);
        $falla=null;
        $value="";
        for($i=0;$i<count($dat);$i++){
            if($i<count($dat)-1){
                if($i<count($dat)-2) {

                    $falla = clsEquipo::name_idfalla($dat[$i]);
                    if (count($falla) > 0) {
                        $value .= $falla->falla . " - ";
                    }
                }
                else{
                    $falla = clsEquipo::name_idfalla($dat[$i]);
                    if (count($falla) > 0) {
                        $value .= $falla->falla;
                    }
                }
            }


        }
        return $value;
    }


    public static function insertarFallas($fallas){


        return Executor::doit("INSERT INTO `falla_equipo`(`id_falla`, `nr_orden`) VALUES $fallas");

    }



    
    
    
    /** ###### FIN  class ######## */

}







?>