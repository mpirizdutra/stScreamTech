<?php 
/** require_once "Autenticacion.php";
require_once "Clases.php";

$auth = new Auth();
$db_handle = new DBController();
$util = new Util();
*/
class ValidacionSesion {
// Get Current date, time
    
    public static $current_time="";
    public static $cookie_expiration_time="";
    public static $current_date="";
    public static $isLoggedIn=false;
   
  

    public static  function Validar(){
        self::cargarValor();
            // Check if loggedin session and redirect if session exists
        if (! empty($_SESSION["user_id"])) {
           self::$isLoggedIn = true;
        }
        // Check if loggedin session exists
        else if (! empty($_COOKIE["login_usuario"]) && ! empty($_COOKIE["random_password"]) && ! empty($_COOKIE["random_selector"])) {
            // Initiate auth token verification diirective to false
            $isPasswordVerified = false;
            $isSelectorVerified = false;
            $isExpiryDateVerified = false;
            
            // Get token for username
            $userToken = clsToken::getTokenByUsername($_COOKIE["login_usuario"],0);
            
            // Validate random password cookie with database
            if (password_verify($_COOKIE["random_password"], $userToken->password_hash)) {
                $isPasswordVerified = true;
            }
            
            // Validate random selector cookie with database
            if (password_verify($_COOKIE["random_selector"], $userToken->selector_hash)) {
                $isSelectorVerified = true;
            }
            
            // check cookie expiration by date
            if($userToken->expiry_date >= ValidacionSesion::$current_date) {
                $isExpiryDareVerified = true;
            }
            
            // Redirect if all cookie based validation retuens true
            // Else, mark the token as expired and clear cookies
            if (!empty($userToken->id) && $isPasswordVerified && $isSelectorVerified && $isExpiryDareVerified) {
                self::$isLoggedIn = true;
            } else {
                if(!empty($userToken->id)) {
                  clsToken::markAsExpired($userToken->id);
                }
                // clear cookies
                clsUtil::clearAuthCookie();
            }
        }
        
        
    }
    
    
    public static function cargarValor(){
           self::$current_time = time();
           self::$current_date = date("Y-m-d H:i:s", self::$current_time);
        // Set Cookie expiration for 1 month
          self::$cookie_expiration_time = self::$current_time + (30 * 24 * 60 * 60);  // for 1 month
          //self::$isLoggedIn = false;
          
    }


}
?>