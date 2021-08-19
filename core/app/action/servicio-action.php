<?php 

if(isset($_GET["nrOrden"]) && $_GET["nrOrden"]!=""&& clsValidar::validarID($_GET["nrOrden"])){
    $res=0;
       
    $key="ScreamTech1716_servicioS";
    $dat=clsValidar::cifrarClave($_GET["nrOrden"],$key);
    $habilitado="stventas";
    //$habilitado=clsValidar::cifrarClave($habilitado,$key);
    $ch = curl_init('http://serviciotecnico.screamtech.com.ar/php/servicio.php');
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, "nrOrden=$dat&permitido=$habilitado");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $res = clsValidar::descifrarClave(curl_exec ($ch),$key);
    $error = curl_error($ch);
    curl_close ($ch);
    if($res!=""&&$res!="0"){
        $dat=explode("=>",$res);
        $_SESSION['servicio']=array("nrOrden"=>$dat[0],"nombre"=>$dat[1],"fecha"=>$dat[2]);
         unset($_SESSION["servicio_error"]);
?>

       
           
<?php            

    }
    else{
        $_SESSION['servicio_error']=array("error"=>1,"msj"=>"Debe ingresar los datos manualmente.");
    }
 
 }
 else{
        $_SESSION['servicio_error']=array("error"=>2,"msj"=>"Solo estan permitidos 0-9.");
  } 

?>
