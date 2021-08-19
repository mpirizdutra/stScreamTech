<?php

class clsToken {
    //`id`, `usuario`, `password_hash`, `selector_hash`, `is_expired`, `expiry_date`
    /** 
    $query = Executor::doit($sql);
        return Model::one($query[0],new clsUsuario());
    */
  public  function __construct(){
        $this->id="";
        $this->usuario="";
        $this->password_hash="";
        $this->selector_hash="";
        $this->is_expired="";
        $this->expiry_date="";
        
    }
    
  public static	function getTokenByUsername($username,$expired) {
	    
	    $sql = "Select * from login_token where usuario ='$username' and is_expired = $expired";
        
        $query = Executor::doit($sql);
        return Model::one($query[0],new clsToken());
    }
    
   
    public static function markAsExpired($tokenId) {
        
        $sql = "UPDATE login_token SET is_expired = 1 WHERE id = $tokenId";
        return  Executor::doit($sql);
    }
    
     public static function insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date) {
        
        $sql = "INSERT INTO login_token (usuario, password_hash, selector_hash, expiry_date) values ('$username', '$random_password_hash', '$random_selector_hash','$expiry_date')";
        return  Executor::doit($sql);
    }
    
   
}
?>