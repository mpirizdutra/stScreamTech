<?php
class clsFunciones
{


    public function __construct()
    {
        $this->fecha = "";
    }


    /**
     * Funcion fecha - cambia el orden
     * @param string $fecha 2010/01/25 | int $tipo : 1 Y-m-d o  0: d/m/Y  -- $hs 0 o 1
     * @return string, fecha
     */
    public static function fecha($fecha, $tipo, $hs)
    {
        if ($fecha != "") {
            if ($tipo) {
                if ($hs) {
                    $fecha = date("Y-m-d H:i:s", strtotime($fecha));
                } else {
                    $fecha = date("Y-m-d", strtotime($fecha));
                }

            } else {
                if ($hs) {
                    $fecha = date("d/m/Y H:i:s", strtotime($fecha));
                } else {
                    $fecha = date("d/m/Y", strtotime($fecha));
                }


            }
        }
        return $fecha;

    }

     /**
     * Funcion fecha - cambia el orden
     * @param string $fecha 2010/01/25 | int $tipo : 1 Y-m-d o  0: d/m/Y  -- $hs 0 o 1
     * @return string, fecha
     */
    public static function fecha3($fecha, $tipo, $hs)
    {
        if ($fecha != "") {
            if ($tipo) {
                if ($hs) {
                    $fecha = date("Y-m-d H:i:s", strtotime($fecha));
                } else {
                    $fecha = date("Y-m-d", strtotime($fecha));
                }

            } else {
                if ($hs) {
                    $fecha = date("d/m/Y H:i:s", strtotime($fecha));
                } else {
                    $fecha = date("d/m/YYYY", strtotime($fecha));
                }


            }
        }
        return $fecha;

    }


    /**
     * Funcion AcortarCadena - acorta una cadena de carateres
     * @param $cadena - $numCar : cantidad de caracteres a mostrar
     * @return string, fecha
     */
    public static function AcortarCadena($cadena, $numCar)
    {


        $cant = strlen($cadena);
        if ($cant > $numCar) {

            $cadena = substr($cadena, 0, $numCar);
            $cadena .= " ...";
        }


        return $cadena;
    }

    /**
     * Funcion explode2 - funciona igual que el explodecon la diferencia que no cuenta el ultimo valor ej: 3#3#  $R(3,3) y no $R(3,3,'')
     * @param $dat array()  - $separador  string ej: # o => o ->
     * @return string, fecha
     */

    public static function explode2($dat, $separador)
    {
        $res = "";
        $j = 0;
        for ($i = 0; $i < count($dat); $i++) {

            if ($i < count($dat) - 2) {
                $res .= $dat[$i] . $separador;
            } else {
                $res .= $dat[$i];
            }
        }
        return $res;
    }

    public static function fallaPrint($fallas){
        $val="";$i=0;


            $count=mysqli_num_rows($fallas[0]);
            if($count>0){

                while($row=mysqli_fetch_assoc($fallas[0])){

                    $val.=" - ".$row["falla"];


                }



            }



        return $val;

    }


    public static function whatsapp($msj,$celular){
        //https://wa.me/?texto=Quisiera%20consultar%20sobre%20la%20oferta%20de%20departamento
        $url="https://wa.me/54".$celular."?text=".self::Escapar_espacioVacio_url($msj);
        return $url;
    }

    public static function Escapar_espacioVacio_url($cadena)
    {
        $cadena = str_replace(' ', '%20', $cadena);
        return $cadena;
    }

    /**
     * Funcion limpia_espacios - ej: HOLA MUNDO -> HOLAMUNDO
     * @param  una cadena de catacteres
     * @return string sin espacios
     */

    public static function limpia_espacios($cadena)
    {
        $cadena = str_replace(' ', '', $cadena);
        return $cadena;
    }


    /**
     * Funcion pone en mayuscula la primera letra
     * @param  una cadena de catacteres
     * @return string con la primera letra mayuscula
     */
    public static function MayusculaPrimera($cadena)
    {
        $cadena = ucwords(strtolower($cadena));
        return $cadena;
    }

    /**
     * Funcion pone en minuscula todo
     * @param  una cadena de catacteres
     * @return string en minuscula
     */
    public static function minusculaTODO($cadena)
    {
        $cadena = strtolower($cadena);
        return $cadena;
    }

    /** Funcion que cuenta la cantidad de archivos en un didrectorio
     * @param  una cadena de catacteres
     * @return retorna un objeto con la informacion de los archivos
     */
    public static function leerDirectorio($dir)
    {//$dir=ruta de los direcorios y $cant=0 devuelve todas las img
        $datos = array();
        $i = 0;
        $j = 0;
        $datos[0] = '';
        $directorio = opendir($dir);

        if ($directorio) {
            while ($archivo = readdir($directorio)) {

                if ($archivo != '..' && $archivo != '.') {
                    $datos[$j] = $archivo;
                    $j++;
                }
            }

        } else {
            $datos[0] = '';
        }

        closedir($directorio);
        return $datos;
    }

    /** Funcion que limpiar o remplasa caracteres espesciales como � por i
     * @param  una cadena de catacteres
     * @return retorna un objeto con la informacion de los archivos
     */
    public static function limpiar_caracteres_especiales($s)
    {
        $Seteo =array('á' => 'a', 'à' => 'a', 'Á' => 'A', 'À' => 'A', 'é' => 'e', 'è' => 'e'
        , 'É' => 'E', 'È' => 'E', 'í' => 'i', 'ì' => 'i', 'Í' => 'I', 'Ì' => 'I',
            'ó' => 'o', 'ò' => 'o', 'Ó' => 'O', 'Ò' => 'O'
        , 'ú' => 'u', 'ù' => 'u', 'Ú' => 'U', 'Ù' => 'U', '/' => '', ':' => '-');

        foreach ($Seteo as $item => $value) {
            $bus = strpos($s, $item);
            if (!$bus === false) {
                $s = str_replace($item, $value, $s);
            }
        }

        return $s;
    }




    public static function fechaHOY()
    {
        $sql = "SELECT CURRENT_TIMESTAMP() as fecha;";
        $query = Executor::doit($sql);
        return Model::one($query[0], new clsFunciones());

    }

    public static function CompararFechas($fecha1, $fecha2)
    {
        $res = false;
        $fechaActual = strtotime($fecha1);
        $fecha_entrada = strtotime($fecha2);

        if ($fechaActual > $fecha_entrada) {
            $res = true;
        }
        return $res;
    }

    public static   function fecha2($fecha,$tipo)
        { if($fecha!=""){
            if($tipo){

                $fecha=date("Y-m-d", strtotime($fecha));
            }
            else{$fecha=date("d/m/Y", strtotime($fecha));}
        }
            return $fecha;
        }
        
        
    public static function CodigoQR($inf){
                            
                            $qr="";
                            
                            /** QR parametros*/ 
                            //set it to writable location, a place for temp generated PNG files
                            $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
                            //html PNG location prefix
                            //esta en el mismo lugar de donde esta el codigo sin importar de dodne se intancia
                            $PNG_WEB_DIR = 'core/app/model/temp/';
                            include_once "phpqrcode/qrlib.php";
                            //ofcourse we need rights to create temp dir
                            if (!file_exists($PNG_TEMP_DIR))
                               { mkdir($PNG_TEMP_DIR);}
                            
                            
                            $filename = "";//$PNG_TEMP_DIR.'test.png';
                            /** Calidad del QR */
                            $errorCorrectionLevel = 'H';//'L','M','Q','H' 
                            
                            $datos=$inf;
                            /** Tamaño QR */
                            $matrixPointSize = 6;
                          
                             $filename = $PNG_TEMP_DIR.'QRcliente.png';
    
                            QRcode::png($datos, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
                                
                            /**  IMG QR*/    
                            $qr= '<img class="img-thumbnail" alt="Responreresive  image" src="'.$PNG_WEB_DIR.basename($filename).'" />';  
                             
                            
                            echo $qr;
    }



    public static function bot_notifica($msj){

        $bot = new botTelegram();


        try {
            //$bot->sendMessage("Ingreso un equipo de exo en garantia. Orden:2020\n Hola");
            $bot->sendMessage("hola");

        }
        catch (Exception $e) {
            echo "error";
        }
    }



    public static function emoticones($val){
        $res="";
        switch ($val){
            case "pc":{$res="\xF0\x9F\x92\xBB";break;}
            case "cel":{$res="\xF0\x9F\x93\xB2";break;}
            default:{break;}
        }

        return $res;
    }


    public static function Tipo_equipo($tipo){
        $res="";
        switch ($tipo){
            case 1:{$res="Celular";break;}
            case 2:{$res="Table";break;}
            case 3:{$res="Notbook-Netbook";break;}
            case 4:{$res="Aio-PC";break;}
            case 5:{$res="Aio-PC";break;}
            case 7:{$res="Parlantes bluetooth";break;}
            default:{$res="otros";break;}
        }

        return $res;
    }


    public static function garantiza($tipo){
        $res="";
        switch ($tipo){
            case 1:{$res="Coradir";break;}
            case 2:{$res="Exo";break;}
            case 3:{$res="Numeral 9";break;}
            case 4:{$res="TecnoStores";break;}
            case 5:{$res="PcBox";break;}
            case 6:{$res="MultiRadio";break;}
            default:{$res="no";break;}
        }

        return $res;
    }


    public static function fecha_estado($estado){
        $res="";
        switch ($estado){
            case 1:{$res="fecha_ingreso";break;}
            case 4:{$res="fecha_presupuesto";break;}
            case 7:{$res="fecha_listo";break;}
            case 13:{$res="fecha_no_reparado";break;}

            default:{$res="fecha_ingreso";break;}
        }

        return $res;
    }

    public static function name_estado($estado){
        $res="";
        switch ($estado){
            case 1:{$res="INGRESADOS";break;}
            case 4:{$res="PRESUPUESTO | DIAGNOSTICO";break;}
            case 7:{$res="LISTO";break;}
            case 13:{$res="NO REPARADO";break;}

            default:{$res="INGRESADOS";break;}
        }

        return $res;
    }

    public static function json_cookie($name,$val,$segundos){
        $expiry = time() + $segundos;
        $caduca=date("Y-m-d H:i:s", $expiry);
        //$data = (object) array( "val" => "1", "value2" => "i'll save whatever I want here" );
        $cookieData = (object) array( "val" => "1", "caduca" => $caduca );
        setcookie($name, json_encode( $cookieData ), $expiry );
    }

    public static function json_cookie_descode($val){
        $r=json_decode($val);
        return $r->caduca;
    }


    public static function completar_ceros($number){
        $length = 7;
        return  substr(str_repeat(0, $length).$number, - $length);
    }
    public static  function remplazar_espacio_caracter($text){
        return str_replace(' ', '-', $text);
    }

//fin
}

?>