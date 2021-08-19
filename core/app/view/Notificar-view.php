<?php


if(isset($_GET["notificar"])){



    /**  Ingresados value 1 */
        clsNotificar::$dias_vencidos=5;
        $Ingresados=clsNotificar::vencidos(1);



    /** Notifica si hay ingresado con 5 dias vencidos */
    if(count($Ingresados)>0){
            $_SESSION["msj_telegram"]=clsFunciones::table($Ingresados);

    }














/*
         function enviar_mail($table){
                include "phpmailer/class.phpmailer.php";
                include "phpmailer/class.smtp.php";

                $email_user = "servicio.tecnico.screamtech";
                $email_password = "Nicolas8989";
                $the_subject = "Equipos ingresado";
                $address_to = "mpirizdutra@ulp.edu.ar";
                $from_name = "Servicio Tecnico";
                $phpmailer = new PHPMailer();

        // ---------- datos de la cuenta de Gmail -------------------------------
                $phpmailer->Username = $email_user;
                $phpmailer->Password = $email_password;
        //-----------------------------------------------------------------------
        // $phpmailer->SMTPDebug = 1;
                $phpmailer->SMTPSecure = 'ssl';
                $phpmailer->Host = "smtp.gmail.com"; // GMail
                $phpmailer->Port = 465;
                $phpmailer->IsSMTP(); // use SMTP
                $phpmailer->SMTPAuth = true;

                $phpmailer->setFrom($phpmailer->Username,$from_name);
                $phpmailer->AddAddress($address_to); // recipients email

                $phpmailer->Subject = $the_subject;
                $phpmailer->Body .="<h1 style='color:#3498db;'>Equipos ingresado </h1>";
                $phpmailer->Body .= "<h4>Listado de equipo con ".clsNotificar::$dias_vencidos." dias sin cambiar su estado de ingresado.</h4>";
                $phpmailer->Body .="<br/><br/>";
                $phpmailer->Body .= $table;
                $phpmailer->IsHTML(true);

                $phpmailer->Send();
        }

*/


    //fin

}





?>




