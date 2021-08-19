<?php

/**
 *
 * La idea es:
 * Poner entregado a todos lo equipo menos 6 mes atras en adelante mas o menos desde
 * agosto.
 * Correguir los datos: presupuesto\diagnostico
 *  No reparado
 * Listo -> podria dar aviso de avisar al cliente
 *
 * Donde el la tabla equipo tenga su fecha correspondiente para que el sistema
 * pueda notificar. de esa manera el mismo cuenta 5 o menos dias y avisa.
 *
 *
 *
 *
 * Para crear un bot
 * Buscar en el chat a botfather
 * escribri /newbot
 *  name del boot
 *  name idBot (hola_bot) teminado con la palabra bot (se crea @hola_bot)
 * Para iniciar el bot hay  que buscarlo como un contacto y darle "INICIAR".
 * Se puede jugar con el parametro botseting -> bot privasidad (mandar msj a los grupos)
 *
 *
 *
 * Tener en cuenda el chat_id que cambia si es para un grupo o una persona
 * https://api.telegram.org/bot1586559877:AAF-7YbFQB8YHRHIv6r_xRNb2sDRCCSfs84/getUpdates
 * token del bot:  1586559877:AAF-7YbFQB8YHRHIv6r_xRNb2sDRCCSfs84
 * chat_id( lo obtenemos id bot @hola_bot)
 *otra forma es armando la url  : https://api.telegram.org/botxxxTOKENxxxx/getUpdates
 * Lo ponemos en el navegador y nos deve devolver algo como esto->
 *
 *{"ok":true,"result":{"message_id":4,"from":{"id":1586559877,"is_bot":true,"first_name":"screamtech_servicio_tecnico","username":"screamtech2121bot"},"chat":{"id":1523720943,"first_name":"Martin","last_name":"Piriz","username":"Mpirizdutra","type":"private"},"date":1612404671,"text":"hola mundo"}}
 *En caso de esta result{vacio} , hay que escribir al bot e ingresar la url de nuevo
 * si El bot se agrega a un grupo hay que hacer lo mismo y cambiar el chat_id para que el bot escriba al grupo y no a suchat que tiene solo con nosotros
 * Con los canales se supone que es algo parecido pero no lo prove
 *
 * Curl funciona con la vercion 7 para arriba en php
 * en el local host si lo cambio la pagina de video tiene un error que hay que rebisar deve ser alguna puta libreria de java escrib relacionado con los ultimos cambio touch id o algo asi la puta madre.
 *
 *
 */

if(isset($_SESSION["msj_telegram"])) {

    if($_SESSION["msj_telegram"]!=""){

        $apikey = clsBotTelegram::$token;

        $chatid = clsBotTelegram::$chat_id;

        $urlMsg = "https://api.telegram.org/bot{$apikey}/sendMessage";
        $msg=$_SESSION["msj_telegram"];
        /** curl envio de url a telegram */
        $res = NULL;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlMsg);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$chatid}&parse_mode=HTML&text=$msg");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);


        curl_close($ch);

    }
//echo $_SESSION["msj_telegram"];
  unset($_SESSION["msj_telegram"]);


        echo "<script type='text/javascript'>window.close();</script>";
        core::redir("./index.php?view=st_Equipos");



}
else{core::redir("./index.php?view=st_Equipos");}

/** Envio por telegram de los informes  */


    if(isset($_SESSION["msj_telegram2"])) {

        if($_SESSION["msj_telegram2"]!="") {
            $msj=explode("->",$_SESSION["msj_telegram2"]);
            if(count($msj)>0){
                for($i=0;$i<count($msj);$i++){
                    if($msj[$i]!=""){
                        //sleep(2);
                        envio($msj[$i]);
                    }

                }
            }
        }
        unset($_SESSION["msj_telegram2"]);
        core::redir("./index.php?view=st_Equipos");

    }
    else{core::redir("./index.php?view=st_Equipos");}



function envio($msg){
    $apikey = clsBotTelegram::$token;

    $chatid = clsBotTelegram::$chat_id;

    $urlMsg = "https://api.telegram.org/bot{$apikey}/sendMessage";

    /** curl envio de url a telegram */
    $res = NULL;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlMsg);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$chatid}&parse_mode=HTML&text=$msg");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);


    curl_close($ch);

 }


?>