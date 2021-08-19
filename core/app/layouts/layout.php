<?php
$movil=false;
ValidacionSesion::Validar();


$err="";
if (isset($_POST["login"])) {

    /** Verifica si la fecha actual es mas granda a la de la cookie y borra  */
   $err=informe();

    $isAuthenticated = false;
    
    $username = $_POST["usuario_nombre"];
    $password = $_POST["usuario_password"];
    
    
    if(clsUtil::validarUsuario($username)&&clsUtil::validarClave($password)){
        //valido tanto user y password para que solo ingrese letras y numeros -_ y que el password tenga 6 longitud
        
            $user = clsUsuario::getMemberByUsername($username);
            if (password_verify($password, $user->usuario_password)) {
                $isAuthenticated = true;
            }
            
            if ($isAuthenticated) {
                /** *#~### */
                $_SESSION["user_id"] = $user->usuario_id;
                $_SESSION["permiso"]=$user->permiso;

                /** Buscar orden */
                if(isset($_GET["orden"])) {
                    if (clsValidar::validarID($_GET["orden"])) {
                        $_SESSION["EquipoNR"] = 3;
                        $_SESSION["EquipBuscar"] = $_GET["orden"];
                    }
                }
                /**
                 *
                 *Aca si no esta setiada la cookie
                 * Entra la crea por 4 horas y armamos el informe
                 * y luego en el load:: del layaout (linea 258)
                 * no redirecciona a telegram (solo cuando no este setiada)
                 */







                     if (!isset($_COOKIE["informe_estado"])) {


                            $informe=clsEquipo::informe();
                            /** Entra si no hay datos informe (fecha_caduca de la cookie) */
                            if(!count($informe)>0) {

                                 $time_caduca=86400;
                                //setcookie("informe_estado", "1", time() + 86400);
                                clsFunciones::json_cookie("informe_estado",1,$time_caduca) ;
                                $_SESSION["msj_telegram2"] = "";
                                $_SESSION["msj_telegram"] = "";
                                $time_caduca=time() + $time_caduca;
                                clsEquipo::add_informe(date("Y-m-d H:i:s",$time_caduca));

                                $fechas_estados = array(1, 4, 7, 13);
                                $Ingresados = array();

                                clsNotificar::$dias_vencidos = 5;
                                for ($i = 0; $i < count($fechas_estados); $i++) {
                                    $Ingresados = clsNotificar::vencidos($fechas_estados[$i]);


                                    $cant = count($Ingresados);

                                    if ($cant > 0) {
                                        //armo el msj
                                        // echo "<h1>HOLAAAAAAAAA</h1>";
                                        clsBotTelegram::send_msj_informe($Ingresados, $fechas_estados[$i], $cant);


                                    }
                                }



                            }
                     }



                // Set Auth Cookies if 'Remember Me' checked
                if (! empty($_POST["remember"])) {
                    setcookie("login_usuario", $username, ValidacionSesion::$cookie_expiration_time);
                    
                    $random_password = clsUtil::getToken(16);
                    setcookie("random_password", $random_password, ValidacionSesion::$cookie_expiration_time);
                    
                    $random_selector = clsUtil::getToken(32);
                    setcookie("random_selector", $random_selector, ValidacionSesion::$cookie_expiration_time);
                    
                    $random_password_hash = password_hash($random_password, PASSWORD_DEFAULT);
                    $random_selector_hash = password_hash($random_selector, PASSWORD_DEFAULT);
                    
                    $expiry_date = date("Y-m-d H:i:s", ValidacionSesion::$cookie_expiration_time);
                    
                    // mark existing token as expired
                    $userToken =clsToken::getTokenByUsername($username, 0);
                    if (! empty($userToken->id)) {
                       clsToken::markAsExpired($userToken->id);
                    }
                    // Insert new token
                    clsToken::insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date);
                } 
                else{
                   clsUtil::clearAuthCookie();
                }
                ValidacionSesion::$isLoggedIn=true;

                /** Telegram */



                /** #### FIN */
            } 
            else{
                $mensaje = "Credenciales incorrecto.";
            }
            
    }
}


/** Si exite un informe y la fecha axtual es mas grande que la de la bd enonteces borra todo */
function informe(){
    $Hay_informe=clsEquipo::informe();
    $err=count($Hay_informe);
    if(count($Hay_informe)>0){
        $fecha_actual=date_create($Hay_informe->fecha);
        $fecha_caduca=date_create($Hay_informe->fecha_informe);

        //echo "actual:".date_format($fecha_actual,"Y-m-d H:i:s")." >  caduca:".date_format($fecha_caduca,"Y-m-d H:i:s");;
        //echo "<br/>";
        if($fecha_actual>$fecha_caduca){
            clsEquipo::del_informe();
           // setcookie('informe_estado','',time()-100);
        }
    }
    //else{setcookie('informe_estado','',time()-100);}

    return $err;

}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"/>
    <title>.: ScreamTech :.</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport' />
      <!--meta http-equiv="refresh" content="10"-->
    <link rel="shortcut icon" href="plugins/dist/img/png/servicio_tecnico48x48ico.ico" type="image/x-icon"/>
         
      <link rel="icon" href="plugins/dist/img/png/servicio_tecnico32x32png.png" sizes="32x32"/>
      <link rel="icon" href="plugins/dist/img/png/servicio_tecnico48x48png.png" sizes="32x32"/>
      <link rel="icon" href="plugins/dist/img/png/96-96png.png" sizes="96x96"/>
      <link rel="icon" href="plugins/dist/img/png/servicio_tecnico144x144png.png" sizes="144x144"/>
    <!-- Bootstrap 3.3.4 -->
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="plugins/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
     
    <link href="plugins/dist/css/skins/style/skin-black.css" rel="stylesheet" type="text/css" />
    <link href="plugins/bootstrap/css/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
   
    
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="plugins/jquery/jquery-2.1.4.min.js"></script>

    <script src="plugins/morris/raphael-min.js"></script>
    <script src="plugins/morris/morris.js"></script>

    <link rel="stylesheet" href="plugins/morris/morris.css"/>
    <link rel="stylesheet" href="plugins/morris/example.css"/>
  
    <script src="plugins/jspdf/jspdf.min.js"></script>
    <script src="plugins/jspdf/jspdf.plugin.autotable.js"></script>
    <script src="plugins/jquery/jquery.number.js"></script>
    <script src="plugins/jquery/jquery.printarea.js"></script>
    <!--script src="plugins/dist/js/inactividad.js"></script!-->
    
   

  </head>
<?php 


?>
<body class="<?php if(ValidacionSesion::$isLoggedIn){?>  skin-black sidebar-mini <?php } else{?>login-page<?php } ?>  sidebar-collapse" >
 <div class="wrapper">
      <!-- Main Header -->
      <?php if(ValidacionSesion::$isLoggedIn){?>
      <header class="main-header">
        <!-- Logo
        <a href="./index.php?view=st_Equipos" class="logo">

          <span class="logo-mini"><b>S</b><b>T</b></span>

          <span class="logo-lg"><b>Scream</b>Tech</span>
        </a>
 -->
        <!-- Header Navbar -->
        <nav class=" navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu" style="padding-right: 20px;">
            <ul class="nav navbar-nav">

              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="./logout.php" class="dropdown-toggle" >
                      <!-- The user image in the navbar-->
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="glyphicon glyphicon-new-window"></span>Salir

                </a>
                
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">


          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <!--li class="header">ADMINISTRACION</li-->
            <?php  if(ValidacionSesion::$isLoggedIn){
                        
                   // if(isset($_SESSION["editarSesionFecha"])){clsUsuario::editarSesion($_SESSION["user_id"]);unset($_SESSION['editarSesionFecha']);}

                ?>
            
            <li> <a href="./index.php?view=st_ingreso"><i class='glyphicon glyphicon-user'></i> <span>Ingreso | Cliente</span> </a></li>
             
            <li><a href="./index.php?view=st_Equipos"><i class='glyphicon glyphicon-phone'></i> <span>Equipos</span></a></li>
                <?php

                if(isset($_SESSION["permiso"])&&$_SESSION["permiso"]==10){ ?>
                <li class="treeview">
                    <a href="#"><i class='fa fa-database'></i> <span>Configuraciones</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="./index.php?view=descarga">Descargas</a></li>
                        <li><a href="./index.php?view=barCode">BarCode</a></li>
                        <li><a href="./index.php?view=st_ConfigImpresion">impresi&oacute;n</a></li>
                        <li><a href="./index.php?view=st_respaldo">Respaldo B.D</a></li>
                        <li><a href="./index.php?view=st_sistema">Sistema</a></li>
                        <li><a href="./index.php?view=st_usuarios">Usuarios</a></li>
                    </ul>
                </li>

                <?php }?>
            
          <?php } ?>

          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
    <?php } ?>

      <!-- Content Wrapper. Contains page content -->
      <?php if(ValidacionSesion::$isLoggedIn){?>
      <div class="content-wrapper">
          <div class="content" id="cont_webMovil">
              <?php

                    //Esto  buscar el archivos index-view.php que lo que ahce es redireccionar a la pagina prinsipal
                    View::load("index");


              
              ?>           
          </div>
      </div>
      
      <!-- /.content-wrapper -->
        
      
       
<?php } else{ ?>
<!--  LOGIN -->
<?PHP

          if(isset($_GET["movil"])){
              $moviles= $_GET["movil"];

              if( strlen($moviles)>3 && $moviles=="screamtech1989"){
                  $movil=true;
              }
          }
          ?>
<div class="login-box">
      <div class="login-logo">
        <a href="./">Scream<b>Tech </b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <form id="formUsuario" action="" method="post" >
          <div class="form-group has-feedback">
            
            <input name="usuario_nombre" id="usuario_nombre" type="text" placeholder="Usuario" required value="<?php //if($movil) { echo "admin"; } ?>" class="form-control"/>

            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          
          <div class="form-group has-feedback">
            
            <input name="usuario_password" id="usuario_password" type="password" placeholder="Clave" name="password" required value="<?php //if($movil) { echo "screamtech1920"; } ?>" class="form-control"/>
  
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>


            <input type="hidden" name="login" />
          <div class="row">
             <div class="col-xs-12" style="margin-top: 10px;">
             <?php if(isset($mensaje)) {?>
                        <div class="alert alert-info"><?php  echo $mensaje;?></div>
             <?php } ?>
            </div>
            <div class="col-xs-12">
              <button type="submit" id="submitbutton"  class="btn btn-primary btn-block btn-flat">Acceder</button>
            </div><!-- /.col -->
          </div>
          
          
           
          
        </form>
      </div><!-- /.login-box-body -->
</div><!-- /.login-box -->   
<?php } ?>


</div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <!-- Bootstrap 3.3.2 JS -->
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
     <script type="text/javascript" src="plugins/bootstrap/js/bootstrap-toggle.js"></script>
    <script type="text/javascript" src="plugins/bootstrap/js/jquery.printarea.js"></script>
    <script type="text/javascript" src="plugins/bootstrap/js/jquery.autocomplete.min.js"></script>
    <!-- AdminLTE App -->
    <script src="plugins/dist/js/app.min.js" type="text/javascript"></script>

    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/dist/js.cookie.js"></script>

   
    <script type="text/javascript">
      $(document).ready(function(){
        $(".datatable").DataTable({
          "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
        });



       /*var movil=0;
       movil= //if($movil){echo true;}else{ echo false;}

         if(movil){
            var dat=$('#formUsuario').serialize();
            $.ajax({
                 type: "post",
                 url: "index.php",
                 data: dat,
                 success: function() {

                     location.reload();

                 }
             });
         }*/



      });
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
 <?php if(ValidacionSesion::$isLoggedIn){ ?> 
        <footer class="main-footer" style="background-color: #222d32;text-align: center;">
          <strong style="color: #355567;font-size: 20px;"> ####  Scream Tech  ###</strong>
        </footer>   
 <?php } ?>       
  </body>
  
</html>

