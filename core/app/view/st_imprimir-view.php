<?php
$titulo="Scream Tech";
    $Idcliente=0;
    if(isset($_GET["cliente"])&& clsSeguridad::validarID($_GET["cliente"])){
        $Idcliente=$_GET["cliente"];
    }
     else{
        $_SESSION["msj"]="<div class='alert alert-warning' role='alert'> <strong>Alerta!</strong> Se perdio la referencia del cliente. </div>";
         Core::redir("./?view=st_Equipos");

    }

    $c=clsCliente::getById($Idcliente);

    if(!count($c)>0){
        $_SESSION["msj"]="<div class='alert alert-warning' role='alert'> <strong>Alerta!</strong> Cliente no exite. </div>";
        Core::redir("./?view=st_Equipos");



    }
$equipo=clsEquipo::ListarEquipo2($Idcliente);


?>

<div class="row" id="ControlPrint">
	<div class="col-md-12" id="imprimirTodo">
        <a href="./"><i class="glyphicon glyphicon-share-alt"></i> Volver/</a>
        <hr>
		<h1><i class="glyphicon glyphicon-phone"></i>Imprimir</h1>
		<div class="clearfix"></div>
        

<!-- ## imrpimir -->

<div class="row">
      <div class="col-xs-12 col-md-6">
                       <div id="inf" class="col-md-6 col-xs-6">
                        
                       </div>

                 </div>
</div>
<div class="row">
     
            
               
         
    <div class="col-md-8 col-xs-12">
<?php   
        
        
        

        $cant=count($equipo);

        $tabla=array(5);
        $i=0;$entra=0;
        
        /** Tamao de papel */
        $AlturaPapel=clsEquipo::AlturaPapel();
   ?>
   
   
   
       
   
   
        <div class='input-group form-group col-md-6 col-xs-6' id='SelectBuscar'>
            <span class='input-group-addon'>
                <span class='glyphicon glyphicon-pencil'></span>
            </span>
            <select class='form-control' name='Slprint' id='Slprint'>   
                <option value="" disabled="" selected="">Seleccione - Equipo  </option>
   <?php
        
        if(count($equipo)>0){

            if($cant>1){
                foreach ($equipo as $e){
                    if($i<($cant-1)){ //no carga el ultimo item (nr orden, ya que el ultimo va a la tabla)
   ?>                 
   
                        <option value="<?php echo $e->nr_orden; ?>"><?php echo "#".$e->nr_orden." ".$e->tipoEquipo; ?></option>
   <?php  
                    }
                    else{
                        //
                        $_SESSION["EquipBuscar"]=$e->nr_orden;
                        //
                        $tabla[0]=$e->nr_orden;
                        $tabla[1]=$e->tipoEquipo;
                        $tabla[2]=$e->descripcion;
                        $tabla[3]=$e->fecha_ingreso;
                        $tabla[4]=$e->estado;
                        $entra=1;
                    }
                    $i++; 
                } 
                
            }
            //tiene un solo equipo
            else{

                //
                $_SESSION["EquipBuscar"]=$equipo->nr_orden;
                //
                   $tabla[0]=$equipo->nr_orden;
                   $tabla[1]=$equipo->tipoEquipo;
                   $tabla[2]=$equipo->descripcion;
                   $tabla[3]=$equipo->fecha_ingreso;
                   $tabla[4]=$equipo->estado;
            }
   }
        
    ?>
            </select>
        </div>
        
        <!-- Altura del papel -->
        
        <div class="input-group form-group col-md-6 col-xs-6" id="SelectAltura">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-text-height"></span>
            </span>
            <select class="form-control" name="AlturaPapel" id="AlturaPapel">   
                
   
   <?php            
            if(mysqli_num_rows($AlturaPapel[0])>0){
                
                while($row=mysqli_fetch_assoc($AlturaPapel[0])){
                        if($row["activo"]==0){
    ?>
                            
                            <option value="<?php echo $row["pixel"]; ?>" ><?php echo $row["nombre"]; ?></option>  
    <?php           
                        }
                        else{
   ?>
                            <option value="<?php echo $row["pixel"]; ?>" selected=""><?php echo $row["nombre"]; ?></option> 
   <?php
                            
                        }      
                }
            }        
                    
   ?>
                   
                   
               </select>
        </div>
   
        
        <!-- Tabla de equipos -->
        
        <table class='table'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Equipo</th>
                    <th>Descripcion</th>
                    <th>Fecha ingreso</th>
                    <th>Estado</th>
                    <th>Acciones </th>
                </tr>
            </thead>
            <tbody id='contEquiposPrint'>
<?php
    $j=0;
    if($tabla[0]!=""){ ?>
                <tr id="T<?php echo $tabla[0]; ?>">
    <?php 
        
            for($i=0;$i<count($tabla);$i++){
    ?>
        
                    <td class="orden<?php echo $j; ?>"><?php echo $tabla[$i]; ?></td>
            
    <?php        
            $j++;
            }
                
    ?>
                   <td id="<?php echo "A".$tabla[0];?>">
                        <a id="Borrar" style="margin-right:3px;cursor: pointer;" class="btn btn-danger btn-sm acciones" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Borrar">
                                            	<span class="glyphicon glyphicon-remove"></span>
                        </a>
                   </td>
               </tr>
<?php } ?>
           </tbody>
        </table>
        <br /><br />
      </div>

  </div> 
  
  <div class="row">
  
       
         
         <div class="col-mds-12">
         <hr />
             <div class='checkbox ' style="margin-left: 10px;"  >
                            <label>
                                    <input type='checkbox' id='soloCliente' checked="checked"  /> Imprimir solo cliente
                            </label>
                         </div>
         </div>
         <div class="col-md-12 col-xs-12">
                       
                        
                        <a id="btnCargarDatos" style="margin-bottom:10px;font-size: 15px;" class="btn btn-primary btn-sm "  >
                       	                 <span class="glyphicon glyphicon-repeat" style="margin-right: 5px;"></span>Cargar Datos
                        </a>
         
         </div>
      <div class="col-md-12 col-xs-12">
          <button class="btn btn-success pull-right" id="Btnimprimir"  data-loading-text="Precesando..." style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-print"></span>Imprimir</button>
      </div>
        <br/>
      <br/>
         <div class="col-md-12 col-xs-12" id="ContImprimir">
         
         
         
         </div>
             
    </div> 




     




<br/><br/><br/><br/><br/>
	</div>
</div>



<script>

    $(document).ready(function(){

           // alert(<?php //echo $cant; ?>);

     var IDcliente=<?php echo $Idcliente; ?>;
     var soloCliente=1;

     desabilitarInput(0,"button#Btnimprimir");


        $("div a#btnCargarDatos").click(function () {

             ControlPrint(IDcliente);

         });




        $("div input#soloCliente").on( 'change', function() {
            soloCliente=0;
            if( $(this).is(':checked') ) {
                soloCliente=1;
            }

        });

        //ControlPrint

        function ControlPrint(IDcliente){

            $("div#ContImprimir").empty();

            $("div#inf").empty();
            desabilitarInput(0,"button#Btnimprimir");
            //NR ORDEN:
            var Nrorden="";var cant=0;
            $(" div table tbody#contEquiposPrint tr").each(function(){
                id=$(this).attr("id");
                dat=id.split('T');
                cant++;
                Nrorden+=dat[1]+"#";
            });


            var dat="imprimirHTML="+Nrorden+"&SoloCliente="+soloCliente+"&idCliente="+IDcliente+"&";


            $.ajax({
                type: 'POST',
                url:  './?action=st_Imprimir',
                data: dat,
                success: function(res) {
                    //alert(res);
                    if(res!=0){
                        $("div#ContImprimir").append(res);
                        desabilitarInput(1,"button#Btnimprimir");
                        //manda a imprimir
                        ImprimirHTML("div#ContImprimir");
                    }
                    else{$("div#inf").append(" <div class='alert alert-danger' role='alert'> <strong>Error!</strong> Seleccione un equipo. </div>\n");}

                }
            });


        }





        $("button#Btnimprimir").on("click",function()
        {
            ImprimirHTML("div#ContImprimir");
        });

        function ImprimirHTML(modal){

            papelPixel=$("select#AlturaPapel").val();
            // alert(papelPixel)
            $(modal+" div.TablaPrint").css({"height":papelPixel+"px"});

            $(modal+" div.TablaPrint table").removeClass("table table-bordered");
            $(modal+" div.TablaPrint table").css({"border":"1px solid #000"});
            $(modal+" div.TablaPrint table tr td").css({"border":"1px solid #000"});
            $(modal+" div.TablaPrint table tr td.centrar").css({"text-align":"center"});
            style="font-size: 12px;"
            $(modal+" div.printEquipo table tbody").css({"font-size":"12px"});

            $($(modal+" div.TablaPrint table tr td p strong.importante").css({"color":"red"}));

            //$("#orderedlist3 li:last")Ultimo
            $(modal+" div#Ultimo").css({"height":"auto"});



            $(modal).printArea();
        }


        /**  Select equipo para imprimir BORRAR */


        //BORRAR
        //Esta funsionalidad es tanto para el imprimir todo normal como para los ingresos

        $("div#ControlPrint").on("click","tbody#contEquiposPrint a#Borrar",function(){

            BorrarItemTabla($(this).parent().attr('id'),"div#ControlPrint");

            desabilitarInput(0,"button#Btnimprimir");
        });


        function BorrarItemTabla(idTD,control){

            dat=idTD.split('A');
            nrOrden=dat[1];

            tr=$("td#"+idTD).parent();
            idTr=$(tr).attr('id');
            TipoEquipo= $("tr#"+idTr+" td:nth-child(2)").text();

            //inserta el elemento en el select

            $(control+" select#Slprint").append("<option value="+nrOrden+">#"+nrOrden +" "+ TipoEquipo +"</option>");

            //borra el elemento de la tabla
            $(tr).remove();
        }



        //ADD item tabla
        //Esta funsionalidad es tanto para el imprimir todo normal como para los ingresos
        $("div#ControlPrint").on("change","select#Slprint",function(){
            desabilitarInput(0,"button#Btnimprimir");
            AddItemTable($(this).val(),"div#ControlPrint");

        });



        function AddItemTable(Sp_nrOrden,modal){

            $("div#mdImprimir div#inf").empty();
            var dat="ControlPrint_Select="+Sp_nrOrden+"&";


            $.ajax({
                type: 'POST',
                url:  './?action=st_Imprimir',
                data: dat,
                beforeSend: function () {
                    desabilitarInput(0,modal+" select#Slprint");
                },
                success: function(res) {
                    //alert(res);
                    desabilitarInput(1,modal+" select#Slprint");
                    $(modal+" table tbody#contEquiposPrint").append(res);

                },
                error : function(xhr, status) {
                    desabilitarInput(1,modal+" select#Slprint");
                    $("div#mdImprimir div#inf").append("<div class='alert alert-warning'>La peticion a la base de datos fallo.</div>");
                }
            });

            //elimina option
            $(modal+" select#Slprint").find("option[value='"+Sp_nrOrden+"']").remove();
            //Resete seleccion
            var myselect = $(modal+" select#Slprint");
            myselect[0].selectedIndex = 0;

        }




        /** <<< */



        /**
         *  Armado de Fallas
         *
         * */

        function ArmadoFallas(ContFallas,val){

            CantFallas=0;
            $(ContFallas).each(function(pos,valor){
                var n=$(this).val();


                if($(this).attr("type")=="checkbox"){

                    if($(this).is(':checked')){

                        val+=$(this).attr("name")+",";
                        CantFallas++;
                    }
                }


            });

            return val;


        }


        var Titulo="Nr.Orden_"+$("tbody tr td.orden0").text();
        $("title").text(Titulo);


        /** A.F <<<*/

        /**
         *  LoadingGif
         * */

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

        /** L.G <<< */

        /** ######## FIN ######*/


    });

</script>


