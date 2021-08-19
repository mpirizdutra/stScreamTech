<div class="row" >

	<div class="col-md-12 col-xs-12" >
        <a href="./"><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
        <hr>
        <h4>Respaldo de la base de datos</h4>
        <br />
            
                <div class="col-md-4">
                    <button type="button" id="respaldo" class="btn btn-default"><span style="margin-right: 10px;" class="glyphicon glyphicon-floppy-saved"></span>Hacer respaldo</button>
                </div>
   </div>
    
  
    <br/><br/>
    <div class="col-md-12"  style="margin-top: 50px">
        
        <div class="panel panel-info" style="border-color: #222d32;;">
          <!-- Default panel contents -->
          <div class="panel-heading" style="border-color: #222d32;background-color: #222d32;text-align: right;">

          </div>
          <div class="panel-body">
                
                
                   
                
                <div class="col-md-12" id="inf" style="padding-left: 0;text-align: center;">
                
                </div>
          </div>
        
         
        </div>
    
    </div>
    
    
    
    
    
    <!-- ###################################################################################################################################################### -->
    
    <!-- Modales -->
   
      

    
    <!-- fin de modales -->
<script>
    $(document).ready(function(){
          
      
        $("button#respaldo").click(function(){
            
            HacerRespaldo();
            
        });
        
        function HacerRespaldo(){
              var dat="BaseDatosRespaldo=1";
                $("div#inf").empty();
                $.ajax({
                    type: 'POST',
                    url:  './?action=BDbackUP',
                    data: dat,
                    success: function(res) {

                        
                       $("div#inf").append(res);
                         
                    }
                     
                });
            
        }
        
    });
     
    
    
 </script>
    
    
    
    
    
  
</div>









