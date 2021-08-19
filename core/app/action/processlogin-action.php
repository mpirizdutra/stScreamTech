<body style="background-color: #222d32;color: #fff; text-align: center; margin-top: 150px;font-size: 50px;">

<?php


    if(isset($_POST["username"])&&$_POST["username"]!="" && isset($_POST['password'])){
        if(!isset($_SESSION["user_id"])) {
            $key="screamtech161718";
            
            
            
            
            
            
            $usuario=$_POST['username'];
            $clave=$_POST['password'];
            
            
           
           
            if(!(clsSeguridad::validarUsuario($usuario)) || !(clsSeguridad::validarClave($clave)))
        	{	
        	  $_SESSION['error_ingreso']="<div class='alert alert-info' role='alert' style='margin:0;'>Los datos ingresados no son validos.</div>" ;
        	 
              //print "<script>window.location='index.php';</script>"; 
              core::redir("index.php");
                
        	}
        	else
        	{   
        	  
               
                $clave=clsSeguridad::cifrarClave($clave,$key);
                //echo $clave;
                $base = new Database();
                $con = $base->connect();
                
                $usuario = clsUsuario::obtenerUsuario($usuario,$clave);

                $userid = null;
                if(count($usuario)>0){

                        $userid=$usuario->idUsuario;
                        $nombreUser=$usuario->nombreUsuario;
                        
                        
                        //session_start(); No hace falta ya que el index prinsipal ya esta instanciado session_start
                        if($userid!=null && $usuario->estado==1){
                                
                             $_SESSION['user_id']=$userid ;
                             $_SESSION['user_name']=$nombreUser;
                             $_SESSION["permiso"]=$usuario->permiso;
                             $_SESSION["editarSesionFecha"]=1;
                             
                             //sleep(2);
                             core::redir("index.php");; 
                           
                        }
                        
                         else{
                            $_SESSION['error_ingreso']="<div class='alert alert-info' role='alert' style='margin:0;'>No se puede iniciar secion.</di>" ;
                            core::redir("index.php");
                        }
                 
                       
                }
                //
                else{
                            $_SESSION['error_ingreso']="<div class='alert alert-info' role='alert' style='margin:0;'>No se puede iniciar secion.</di>" ;
                           core::redir("index.php");
                }
                
                
              
            }
        
        }
        else{ print "<script>window.location='index.php?e=1';</script>";  
        
        }
    }
    else{
        print "<script>window.location='index.php?e=2';</script>"; 
    }
    



/** Tengo que usar esta funcion ya que los signos + me lo toma como espacio y cuando  desifro la clave me trea problemas */
function limpia_espacios($cadena){
	$cadena = str_replace(' ', '+', $cadena);
	return $cadena;
}

 ?>
 </body>