<?php





class clsNotificar
{

     public static  $dias_vencidos=0;
     public static  $estado_name="";

    public static  function vencidos($id){


        $dat_orden= array();

        $equipo=clsEquipo::Equipo_estado_id($id);
        $j=0;

        foreach ($equipo as $e){



            $fecha_actual=date_create($e->fecha);
            $fecha_bd=date_create($e->fecha_estado);

            $contador = date_diff($fecha_actual, $fecha_bd);
            $differenceFormat = '%a';
            $cant_dias=$contador->format($differenceFormat);

            if($cant_dias >= self::$dias_vencidos){
                $dat_orden[$j]=$e->nr_orden."#".$cant_dias;

                $j++;
            }


        }
        return $dat_orden;
    }


    /** recibe el */
    public static function vencido_estado_P_G(){

}




    /** vencido */

}

?>