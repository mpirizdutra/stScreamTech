<?php
class clsValidar {
    
    
    /**
	* Funcion para validar cualquier id
	* @param int $id Numero entero positivo
	* @return boolean, true - si es valido, false - si no es correcto
	*/
    public static function validarID($id){
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
	public static function validarTitulo($title)
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
	* @return boolean, true - si es valido, false - si no es correcto
	o tiene codigo malicioso
	*/
    public static function validarUsuario($usuario)
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
                 return FALSE; 
              } 
           }
		   
		   /*Chequeo la longitud del usuario de usuario(min&max requerido)*/
           if(strlen($usuario) < 3 || strlen($usuario) >= 16)
           {
               /*Si es así, devuelvo que el usuario es invalido*/
               return FALSE;
           }
		   
		   /*Finalmente, el usuario paso todos los filtros, es valido (su estructura)*/
		   return TRUE;
		}
		else
		{
			/*Si lo tiene, aviso que el usuario no es valido*/
			return FALSE;
		}	
	}
    
    /**
	* Funcion para validar clave
	* @param string $clave Contraseña
	* @return boolean, true - si es valido, false - si no es correcto
	*/
	public static function validarClave($clave)
    {
	   /*Chequeo la longitud de la contraseña(min&max requerido)*/
       if(strlen($clave) < 6 || strlen($clave) > 20)
	   {
          return FALSE;
       }
	   
	   /*Chequeo que la contraseña tenga al menos una letra minúscula*/
       /*if (!preg_match('`[a-z]`',$clave))
	   {
          return false;
       }*/
	   
	   /*Chequeo que la contraseña tenga al menos una letra mayuscula*/
       /*if (!preg_match('`[A-Z]`',$clave))
	   {
          return false;
       }*/
	   
	   /*Chequeo que la contraseña tenga al menos un numero*/
       /*if (!preg_match('`[0-9]`',$clave))
	   {
          return false;
       }*/
       
	   /*Chequeo si la clave tiene otros caracteres especiales*/
	   /*$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_"; 
	   for ($i=0; $i<strlen($clave); $i++)
	   { 
			if (strpos($permitidos, substr($clave,$i,1)) === false)
			{ 
				return FALSE; 
			} 
	    }*/
	   
	   /*html_entities(mysql_real_escape_string($clave));
	   Para contraseñas con caracteres especiales habria que guardarlas codificadas
	   y despues para leerlas decodificarlas y comparar los strings*/
	   
	   /*Finalmente, la clave paso todos los filtros, es valida (su estructura)*/
       return TRUE;
    } 
    
    /**
	* Funcion para cifrar una contraseña usando mcrypt()
	* @param string $clave Clave
	* @param string $key Key (php ver.5 en adelante la key tiene que tener 16,24 o 32 caracteres  )
	* @return string, con la contraseña cifrada
	*/
	public static function cifrarClave($clave,$key) {
	   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	   $claveCifrada = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $clave, MCRYPT_MODE_ECB, $iv);
	   $claveCifrada = base64_encode($claveCifrada);
	   $claveCifrada = clsValidar::intercambiarCaracteres($claveCifrada);
	   $claveCifrada = clsValidar::invertirCaracteres($claveCifrada);
	   return $claveCifrada;
	}
	
	/**
	* Funcion para descifrar una contraseña usando mcrypt()
	* @param string $clave Clave
	* @param string $key Key
	* @return string, con la contraseña descifrada
	*/
	public static function descifrarClave($clave,$key) {
	   $clave = clsValidar::invertirCaracteres($clave);
	   $clave = clsValidar::intercambiarCaracteres($clave);
	   $clave = base64_decode($clave);
	   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	   $claveDescifrada = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $clave, MCRYPT_MODE_ECB, $iv);
	   return trim($claveDescifrada);
	}
	
	/**
	* Funcion para invertir caracteres
	* @param string $cadena Informaci?n
	* @return string, con una cadena invertida Ej: hola - aloh
	*/
	private static function invertirCaracteres($cadena)
	{
		$array = array_reverse(str_split($cadena));
        $cadena_final = "";
		
		foreach($array as $c)
		{
			$cadena_final = $cadena_final.$c;
		}
		
		return $cadena_final;
	}
	
	/**
	* Funcion para intercambiar caracteres
	* @param string $cadena Informaci?n
	* @return string, con una cadena con caracteres reemplazados Ej: hola - ubyn
	*/
	private static function intercambiarCaracteres($cadena)
	{
		$array = str_split($cadena);
		$cadena_final = "";
        foreach ($array as $c)
        {
            if (ord($c) <= 109 && ord($c) >= 97)
            {
				$num = ord($c) + 13;
				$cadena_final = $cadena_final.chr($num);
				
            }
            else if (ord($c) >= 110 && ord($c) <= 122)
            {
                $num = ord($c) - 13;
				$cadena_final = $cadena_final.chr($num);
            }
            else if (ord($c) <= 77 && ord($c) >= 65)
            {
                $num = ord($c) + 13;
				$cadena_final = $cadena_final.chr($num);
            }
            else if (ord($c) >= 78 && ord($c) <= 90)
            {
                $num = ord($c) - 13;
				$cadena_final = $cadena_final.chr($num);
            }
            else
            {
			   $cadena_final = $cadena_final.$c;
            }			
        }
        return $cadena_final;
	}
	/**
	* Funcion para tranformar a fecha latina o inglesa
	* @param string $fecha
	* @return string, $tipo valor 0 (false) - 1 (true)
	*/
  public static function fecha($fecha,$tipo)
      { if($fecha!=""){
          if($tipo){
            
            $fecha=date("Y-m-d", strtotime($fecha));
          }
          else{$fecha=date("d/m/Y", strtotime($fecha));}
        }
          return $fecha;
      } 	

  }
?>