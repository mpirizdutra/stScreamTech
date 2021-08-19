<?php
//verificar las mac de equipos permitidos


if(true){//isset($_POST["notificar"])){
    if(true){//mac_Validas($_POST["notificar"])) {

        $enviar=0;
       include "../core/autoload.php";
       include "../core/app/model/clsEquipo.php";
       include "../core/app/model/clsFunciones.php";
       include "../core/app/model/clsNotificar.php";
       include "phpmailer/class.phpmailer.php";
       include "phpmailer/class.smtp.php";

       $enviar= preparar(1);

       $enviar= preparar(4);

       $enviar= preparar(7);

       $enviar= preparar(13);



        echo $enviar;
       //fin
   }
}
else{echo 0;}




function table($Ingresados,$id){
    $estado=clsNotificar::$estado_name;
    $id_Estado=$id;
    $table="<table border='1'>";
    $table.="<td>Nr. Orden</td>";
    $table.="<td>Dia vencidos</td>";

    $table.="<tbody>";


    for($i=0;$i < count($Ingresados);$i++){
        $dat= explode("#", $Ingresados[$i]);


        $table.="<tr>
                    <td>$dat[0]</td>
                    <td>$dat[1] </td>
                  </tr>";


    }


    $table.="</tbody> </table>";

    return $table;
}


//configurado para hostin
function enviar_mail($table){


    $email_user = "servicio.tecnico.notifica@screamtech.com.ar";
    $email_password = "screamtech2020";
    //$the_subject = "Equipos ingresado";
    $address_to = "mpirizdutra@ulp.edu.ar";
    $from_name = "Servicio Tecnico";
    $phpmailer = new PHPMailer();

    // ---------- datos de la cuenta de Gmail -------------------------------
    $phpmailer->Username = $email_user;
    $phpmailer->Password = $email_password;
    //-----------------------------------------------------------------------
    // $phpmailer->SMTPDebug = 1;
    $phpmailer->SMTPSecure = 'ssl';
    $phpmailer->Host = "mail.screamtech.com.ar"; // GMail
    $phpmailer->Port = 465;
    $phpmailer->IsSMTP(); // use SMTP
    $phpmailer->SMTPAuth = true;

    $phpmailer->setFrom($phpmailer->Username,$from_name);
    $phpmailer->AddAddress($address_to); // recipients email
    $phpmailer->AddAddress('djdalsanto@gmail.com');
    $name_estado=clsNotificar::$estado_name;

    $phpmailer->Subject = "Equipos $name_estado";
    $phpmailer->Body .="<h1 style='color:#3498db;'>Equipos $name_estado </h1>";
    $phpmailer->Body .= "<h4>Listado de equipo con ".clsNotificar::$dias_vencidos." dias sin cambiar su estado de $name_estado.</h4>";
    $phpmailer->Body .="<br/><br/>";
    $phpmailer->Body .= $table;
    $phpmailer->IsHTML(true);

    $phpmailer->Send();
}



function mac_Validas($mac){
    $list_mac=array("408D5CBE1684");
    $res=false;
    for($i=0;$i<count($list_mac);$i++){
        if($list_mac[$i]==$mac){
            $res=true;
        }
    }
    return $res;
}


function estados_generales($id_estado){
    $estado="Ingresado";
    switch ($id_estado){

        case 1:{$estado="Ingresado";break;}
        case 4:{$estado="Presupuesto_Diagnostico";break;}
        case 7:{$estado="Listo";break;}
        case 13:{$estado="No reparado";;break;}
        default:{break;}
    }
    return $estado;
}
//dias segun el estado del equipo
function dias_notificar($id_estado){
    $dias=4;
    switch ($id_estado){
        //Ingresado
        case 1:{$dias=4;break;}
        //Presupuesto_Diagnostico
        case 4:{$dias=10;break;}
        //Listo
        case 7:{$dias=14;break;}
        //No reparado
        case 13:{$dias=20;break;}
        default:{break;}
    }
    return $dias;
}

    function preparar($id_estado){

        $enviado = 0;
        $Ingresados = array();
        $grupos=array();
        clsNotificar::$dias_vencidos=dias_notificar($id_estado);
        clsNotificar::$estado_name=estados_generales($id_estado);



        $Ingresados = clsNotificar::vencidos($id_estado);




        if (count($Ingresados) > 0) {

            $grupos=grupos($Ingresados,$id_estado);

            $table = table($Ingresados,$id_estado);

            $table=$table."<br/><br/>".$grupos;



            enviar_mail($table);
            $enviado = 1;


        }

        return $enviado;

    }

//array con numero de orden # dias
function grupos($orden,$id_estado){
    $cant=count($orden);


    $item=5;
    $li="";
    $j=1;
    $c=0;
    $tr="";
    $lista="";$ul="";
    $cont_fila=0;
    for($i=0;$i < $cant;$i++) {

        //posicion 0 esta el numero de orden
        $dat = explode("#", $orden[$i]);


            if($j<$item){
               $li.=$dat[0]."-";
            }
            else{
                $li.=$dat[0];
            }
            $j++;
            if($j==6){

                $c++;
                $lista.="<td> <a href='http://serviciotecnico.screamtech.com.ar/?view=grupos&equipo2=$li&estado=$id_estado' >Grupo nr. $c</a></td>";
                $j=1;

                $li="";
                $cont_fila++;

            }
            if($cont_fila==4){
                $tr.="<tr>$lista</tr>";
                $lista="";
                $cont_fila=0;
            }




    }
    $inf="<h4>Los grupos contienen 5 equipo (de la lista de  arriba), para revisar.</h4>";
    $ul="<table border='1'>".$tr."</table>";
    return $inf."<br/>".$ul;

}





?>




