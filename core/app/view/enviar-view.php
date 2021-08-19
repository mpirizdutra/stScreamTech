<?php
include "phpmailer/class.phpmailer.php";
include "phpmailer/class.smtp.php";

$email_user = "servicio.tecnico.screamtech";
$email_password = "Nicolas8989";
$the_subject = "prueba ";
$address_to = "mpirizdutra@ulp.edu.ar";
$from_name = "martin";
$phpmailer = new PHPMailer();

$phpmailer->FromName="Scream Tech";
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

$phpmailer->Body .="<h1 style='color:#3498db;'>Hola Mundo!</h1>";
$phpmailer->Body .= "<p>Mensaje personalizado</p>";
$phpmailer->Body .= "<p>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";
$phpmailer->IsHTML(true);

echo $phpmailer->Body;

 $phpmailer->Send();
?>