 <?php
 $intech=0;
 if(isset($_SESSION["permiso"])){

     if($_SESSION["permiso"]!=10){
         $intech=1;
     }
 }


 ?>
        
 <div class="col-md-12 col-xs-12">
             <h4 style="font-weight: bold;">Buscar equipos</h4>
             <hr />
            <div class="row">
                   
                    
                     
                    <div class="col-md-3 col-xs-12" >
                         <div class="input-group form-group " id="SelectBuscar">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <select class="form-control" name="SlBuscar" id="SlBuscar">    
                                <!--option value="" disabled="" selected="">Seleccione - Busqueda</option-->
                                <option value="3" >Nr Orden</option>
                                <option value="1">Nombre</option>
                                <option value="2">D.N.I</option>
                                <?php 
                                    if($_SESSION["user_id"]==1){
                                ?>
                                <option value="6">Telefono</option>
                                <option value="4">Estado</option>
                                <option value="5">Tipo equipo</option>
                                <?php } ?>
                                
                             </select>
                          </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="input-group form-group "id="TextBuscar" >
                            
                            <input type="text" class="form-control" name="buscar" id="Buscar"/>
                            <span class="input-group-addon" style="color: #fff;background-color: #3276b1;border-color: #285e8e; cursor:pointer" id="BtnBuscar">
                                <span class="glyphicon glyphicon-search"></span>
                            </span>
                            
                        </div>
                     </div>
                     <div class="col-md-3 col-xs-12">       
                            <div class="input-group form-group " id="ChekEstados">       
                                <div class="checkbox">
                                    <label>
                                      <input type="checkbox" id="E_estados"/> Todo los estados.
                                      
                                    </label>
                                  </div>
                            </div>   
                     </div>     
                    
            
            </div>
            
            <div class="row"> 
                <div class="col-md-6 col-xs-12">
                     <div class="input-group form-group " id="SelectBuscarEstado">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <select class="form-control" name="SlBuscarEstado" id="SlBuscarEstado" >    
                                <option value="" disabled="" selected="">Seleccione-Estados</option>
                                <option value="3">Fabrica</option>
                                <option value="7">Listo</option>
                                <option value="5">Entregado</option> 
                             </select>
                        </div>
                </div>
            </div>
            
<div class="row">
            <div class="col-md-8 col-xs-12" id="infBuscar" style="text-align: center;"></div>
            
            <!-- >>> btn -->
           
            <div class="row">
                   <div class="col-md-12 col-xs-12" >
                        
                        <a href="./index.php?view=st_ingreso" style="margin-bottom:10px;font-size: 15px;" class="btn btn-primary btn-sm pull-right btn_acciones_rapidos" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ingreso nuevo cliente">
                       	                 <span class="glyphicon glyphicon-user" style="margin-right: 5px;"></span>Ingreso | Cliente
                        </a>
                    </div>
                <div class="col-md-12 col-xs-12">
                    <button name="btn_ultimo" type="button" id="btn_ultimo" data-loading-text="Guardando..." class="btn btn-success pull-right btn_acciones_rapidos" style="margin-bottom: 10px;" ><span style="margin-right: 10px;font-size: 15px;" class="glyphicon glyphicon-list"></span>Ultimo | Cliente</button>

                </div>

                <div class="col-md-12 col-xs-12">
                    <button name="btn_ultimo_5" type="button" id="btn_ultimo_5" data-loading-text="Guardando..." class="btn btn-success pull-right btn_acciones_rapidos" style="margin-bottom: 10px;    background-color: #008ba6;border-color: #008ba6;" ><span style="margin-right: 10px;font-size: 15px;" class="glyphicon glyphicon-list"></span>Ultimos 5 Equi..</button>

                </div>



                <div class="col-md-12 col-xs-12">
                    <?php

                        if($intech!=1){
                    ?>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-primary dropdown-toggle btn_acciones_rapidos" style="    background-color: #503cbc;border-color: #503cbc;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-send" style="margin-right: 5px"></span> Equipo|Garantia
                        </button>
                        <?php

                            $saga=clsGarantiza::getAll();
                        ?>
                        <ul class="dropdown-menu" id="oficial">
                            <?php
                            foreach($saga as $s){
                            ?>
                            <li><a class="btn_g" id="<?php echo $s->id_garantia ;  ?>" style="cursor: pointer"><?php echo $s->nombre; ?> </a></li>


                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <?php } ?>

                </div>

           </div> 
           <hr/> <br />      
           <!-- btn <<< -->
           
           <div style="display: none;" id="EsRe"></div>
           <div role="tabpanel" id="TabCont" style="margin-bottom: 50px;">

              <!-- Tabs Equipos  -->
              <ul class="nav nav-tabs" role="tablist" id="TabsAB">
                <li role="presentation" class="active"><a class="tabs" href="#tbEquipo" aria-controls="tbEquipo" role="tab" data-toggle="tab">Equipos</a></li>
                <!--li role="presentation"><a class="tabs" href="#TbReingresos" aria-controls="TbReingresos" role="tab" data-toggle="tab">Reingresos</a></li-->
              </ul>
            
              <!-- Tabs Contenido -->
              <div class="tab-content" id="TabEqRe">
                <div role="tabpanel" class="tab-pane fade in active" id="tbEquipo">
               


                
                </div>
                
                
              </div>
            
           </div>
           
           
           
          
           
        </div>
  
  
  </div> 
  
    


