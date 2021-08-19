<?php 
class clsUtil {
    public static function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet) - 1;
        for ($i = 0; $i < $length; $i ++) {
            $token .= $codeAlphabet[clsUtil::cryptoRandSecure(0, $max)];
        }
        return $token;
    }
    
    public static function cryptoRandSecure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) {
            return $min; // not so random...
        }
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }
    
    public function redirect($url) {
        header("Location:" . $url);
        exit;
    }
    
    public static function clearAuthCookie() {
        if (isset($_COOKIE["login_usuario"])) {
            setcookie("login_usuario", "");
        }
        if (isset($_COOKIE["random_password"])) {
            setcookie("random_password", "");
        }
        if (isset($_COOKIE["random_selector"])) {
            setcookie("random_selector", "");
        }
    }
    
    
    	/**
	* Funcion para validar cualquier id
	* @param int $id Numero entero positivo
	* @return boolean, true - si es valido, false - si no es correcto
	*/
     public static	function validarID($id){
    	   /*Chequeo si el identificador es numerico*/
    	   $permitidos = "0123456789"; 
           for ($i=0; $i < strlen($id); $i++)
           { 
              if (strpos($permitidos, substr($id,$i,1)) === false)
              { 
                 /*Si no es así, devuelvo que el usuario es invalido*/
                 return FALSE; 
              } 
           }
    	   return TRUE;
    	}
        
        
    	/**
	* Funcion para validar el titulo de alguna iniciativa
	* @param intstring $title Una cadena que contiene el titulo
	* @return boolean, true - si es valido, false - si no es correcto
	*/
 public static	function validarTitulo($title)
	{
	  $cadena = htmlentities($title,ENT_QUOTES,"UTF-8");
	  if($title == $cadena)
	  	return TRUE;
	  else
	  	return FALSE;
	}
	
	/**
	* Funcion para validar un usuario
	* @param string $usuario nombre de usuario
	* @return boolean, true - si es valido, false - si no es correcto   (retorna 0))
	o tiene codigo malicioso
	*/
  public static	function validarUsuario($usuario)
	{
	   
       		/*Chequeo si el usuario no tiene html malicioso*/
        if (htmlentities($usuario, ENT_QUOTES) == $usuario)
		{
			/*Chequeo si el usuario tiene otros caracteres especiales*/
           $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_"; 
           for ($i=0; $i < strlen($usuario); $i++)
           { 
              if (strpos($permitidos, substr($usuario,$i,1)) === false)
              { 
                 /*Si lo tiene, devuelvo que el usuario es invalido*/
                 return 0; 
              } 
           }
		   
		   /*Chequeo la longitud del usuario de usuario(min&max requerido)*/
           if(strlen($usuario) < 3 || strlen($usuario) >= 16)
           {
               /*Si es así, devuelvo que el usuario es invalido*/
               return 0;
           }
		   
		   /*Finalmente, el usuario paso todos los filtros, es valido (su estructura)*/
		   return 1;
		}
		else
		{
			/*Si lo tiene, aviso que el usuario no es valido*/
			return 0;
		}
       
       
       
	}
	
	/**
	* Funcion para validar clave
	* @param string $clave Contraseña
	* @return boolean, true - si es valido, false - si no es correcto
	*/
    public static	function validarClave($clave)
    {
	   /*Chequeo la longitud de la contraseña(min&max requerido)*/
       if(strlen($clave) < 6 || strlen($clave) > 20)
	   {
          return 0;
       }
	  
       return 1;
    }     
    
    
    
}
?>