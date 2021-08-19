<?php

class clsBotTelegram{


    public static $token ="1586559877:AAF-7YbFQB8YHRHIv6r_xRNb2sDRCCSfs84";
    public static $chat_id ="-1001262004293";

    public function __construct()
    {
        $this->fecha = "";
    }
    public static function send_msj_informe($Ingresados,$estado,$cant){
        $name=clsFunciones::name_estado($estado);
        $table="\xF0\x9F\x93\x82 EQUIPOS $name  \xE2\x80\xBC \n\n";
        $table.="\xF0\x9F\x93\x8C Los dias indican la cantidad de atrazo.\n";
        $table.="Seguramente hay equipo a los que nunca se le hizo seguimiento.\n\n\n";
        $mostrar=10;
        $total=count($Ingresados);
        $ordenes="";$j=0;
        if($mostrar>$total){
            $mostrar=$total;
        }

            $table.="Lista de equipos:\n";
            for($i=0;$i < $total;$i++){
                if($j<=$mostrar){
                    $dat= explode("#", $Ingresados[$i]);

                    $url_orden="<a href='http://serviciotecnico.screamtech.com.ar/notificar/telegramUrl.php?telegram=$dat[0]'>#$dat[0]</a>";

                    $table.=$url_orden." | ".$dat[1]." dias.\n";
                }
                else{
                    $d= explode("#", $Ingresados[$i]);
                    if($i<$total-1){
                        $ordenes.=$d[0]."-";
                    }
                    else{
                        $ordenes.=$d[0];
                    }

                }

                $j++;

            }
            if($ordenes!=""){
                $ordenes=$estado."-".$ordenes;
                $table.="\n\n";
                $table.="\xF0\x9F\x98\xB1 \xF0\x9F\x99\x80 \xE2\x80\xBC \n";
                //index.php?view=ListadoTelegram
               $table.=" <a href='http://serviciotecnico.screamtech.com.ar/notificar/Listado_telegramUrl.php?telegram=$ordenes'>Ver mas equipos</a>";


            }

        //return $table;
        $_SESSION["msj_telegram2"].=$table."->";
    }




}