<?php





    if(isset($_POST["Generar_codigos"])){
        clsBarCode::addBarcode();
        echo 1;
    }

    if(isset($_POST["vincular_codigo"])){
        $nr_orden=$_POST["nr_orden"];
        $barcode=$_POST["vincular_codigo"];
        $barcode=(int)$barcode;
       //echo $nr_orden."  ".$barcode;
        $res= clsBarCode::vincular_barra($barcode,$nr_orden);
        $_SESSION["msj"]="<div class='alert alert-warning'>No vinculado</div>";
        if($res>0){
            $_SESSION["msj"]="<div class='alert alert-info'>Vinculado</div>";
        }
    }

    if(isset($_POST["GenerarCodigoNrOrden"])){

        if(isset($_POST["desde"]) && isset($_POST["hasta"])){

            $desde=(int)$_POST["desde"];
            $hasta=(int)$_POST["hasta"];
            $total=$hasta-$desde;
            $numeros=array();


                for ($i=$desde;$i<=$hasta;$i++){
                    $numeros[$i]=clsFunciones::completar_ceros($i);


                }
                echo json_encode($numeros);



        }
        else{
            echo "";
        }
    }




?>