<?php

//  echo "<h1>".$_SESSION["qrnrOrden"]."</h1>"; 
$idEquipo=0;
    $idEquipo=3000;
   // echo $idEquipo;
    //echo "<h1>".$idEquipo."</h1>";



?>
<div class="row">
	<div class="col-md-12">

		<h1><i class="glyphicon glyphicon-transfer"></i> Estado del Equipo</h1>
		<div class="clearfix"></div>
        


<div class="row">
     <div class="form-group" style="margin-top: 10px;">
            
                 <div class="col-xs-12 col-md-6">
                       <div id="inf" class="col-md-4 col-xs-6">
                        
                       </div>
                 </div>
             
    </div>  
</div>




<div class="row">
     
</div>



<br/><br/><br/><br/><br/>
	</div>
</div>

<script>

$(document).ready(function(){
             
     var IDestado=0;
     var idEquipo=<?php echo $idEquipo; ?>;
      $("button#btnDiag").click(function(){
            IDestado=2;
            Estados();
      });
     
      $("button#btnListo").click(function(){
            IDestado=7;
            Estados();
      });
     
      $("button#btnEntregado").click(function(){
            IDestado=5;
            Estados();
      });
     
     
     
     
        //FormReingreso ####################################
function Estados(){
            $("div#inf").empty();
            $("div span#txtEstadoActual").empty();
            
            var dat="ActualizarEstado=1&";
          
           if(IDestado>0 && idEquipo>0){
            
            
                 dat+="idEstado="+IDestado+"&idEquipo="+idEquipo+"&"; 
            
            
                $.ajax({
                        type: 'POST',
                        url:  './?action=actualizarEstado',
                        data: dat,
                        beforeSend: function () { 
                            
                            desabilitarInput(0,"div button.btnEstado");
                        },
                        success: function(res) {
                            //alert(res);
                            if(res!=""||res!=" "){
                                 $("div span#txtEstadoActual").append(res);
                                  $("div#inf").append("<div class='alert alert-success'>Se actualizo correctamente.</div>");
                                 
                                
                                 
                            }
                            else{
                                 $("div#inf").append("<div class='alert alert-warning'>Ups! algo salio mal...</div>");
                                 
                                 
                            }
                    
                        }
                });
                desabilitarInput(1,"div button.btnEstado");
            }
                
            else{$("div div#inf").append("<div class='alert alert-warning'>Faltan datos. </div>"); }
            
             
           
          
}//fin
    
     
     
     
       
       /** Funciones generales */    
     
    //LoadingGif("form#FormIngreso button#btnAddIngreso","form#FormIngreso div#imgGuardar","form#FormIngreso div#inf",1);  
    function LoadingGif(btn,gif,inf,op){
        if(op){
            $(inf).css("display","none");
            $(gif).css("display","block");
            desabilitarInput(0,btn); 
        }
        else{
             $(inf).css("display","block");
             $(gif).css("display","none");
             desabilitarInput(1,btn); 
        }
    
    } 
     
     function desabilitarInput(op,elem){
        if(op){$(elem).prop('disabled', false);}
        else{$(elem).prop('disabled', true);}
    }
     
     function inputVacio(dat){
        var res=0
        if(dat!=""&&dat!=" "){
            res=1
        }
        
        return res;
    }
     
     /** ######## FIN ######*/

    
     });

</script>