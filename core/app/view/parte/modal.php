<div class="modal fade" id="mdCargarCont" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 60%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="color: #3a87ad;">Cliente | Equipos</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                            <!-- Contenido -->
                         <div class="row" id='contenedor'>
                               
                              
                                <!-- >>>Datos del cliente --> 
                                 <div class="row">
                                     <div class="col-md-12">
                                       <form id="FormEquipos"> 
                                   
                                        <div class='col-md-12' >
                                                
                                                
                                                <div class="row">
                                                    
                                                    
                                                        <div class="col-md-6" >
                                                            <label for="fecha" >Fecha de ingreso</label>
                                                             <div class="input-group form-group" >
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                                 </span>
                                                                 <input type="date" class="form-control" name="fecha" id="fecha" required="required"  value="<?php  echo date('Y-m-d'); ?>"  />
                                                             </div>
                                                        </div>
                                                        
                                                         <div class="col-md-6" >
                                                            <label for="fecha" >Fecha de entrega</label>
                                                             <div class="input-group form-group" >
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                                 </span>
                                                                 <input type="date" class="form-control" name="fechaEntrega" id="fechaEntrega" required="required"    />
                                                             </div>
                                                        </div>
                                                        
                                                     </div>
                                                     <br />
                                                  <div class="row">  
                                                     <h4>Datos del Cliente</h4>
                                                     <br />
                                                    <div class="col-md-12"> 
                                                            
                                                        <div class="col-md-6" style="padding-left: 0;">
                                                          
                                                             <div class="input-group form-group" >
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-pencil"></span>
                                                                 </span>
                                                                 <input type="text" class="form-control" maxlength="100" name="nombre" required="required" id="nombre" placeholder="Nombre"  />
                                                             </div>
                                                        </div>
                                                        
                                                         <div class="col-md-6" style="padding-right: 0;">
                                                            
                                                             <div class="input-group form-group" >
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-pencil"></span>
                                                                 </span>
                                                                 <input type="text" class="form-control" maxlength="100" name="apellido" required="required" id="apellido" placeholder="Apellido"  />
                                                             </div>
                                                        </div>
                                                    
                                                 
                                                </div>
                                               </div> 
                                                <div class="row">
                                                    
                                                    
                                                     <div class="input-group form-group col-md-6" >
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-phone"></span>
                                                                </span>
                                                                 <input type="text" class="form-control" maxlength="20" name="telefono" required="required" id="telefono" pattern="[0-9]+" title="caracteres permitidos 0-9" placeholder="Telefono" />
                                                     </div>
                                                     
                                                     <div class="input-group form-group col-md-6" >
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-envelope"></span>
                                                                </span>
                                                                 <input type="email" class="form-control"  name="email"  id="email"  placeholder="E-mail" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                     <div class="input-group form-group col-md-6" >
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-sort-by-order"></span>
                                                                </span>
                                                                 <input type="text" class="form-control" maxlength="15" name="dni"  id="dni"  pattern="[0-9]+" title="caracteres permitidos 0-9"  placeholder="D.N.I" />
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                             
                                         
                                         </div>
                                      <!-- Datos del cliente<<< --> 
                                      
                                       
                                      <!-- >>> Datos del Equipo --> 
                                      <hr />
                                      <h4 style="margin-left: 5px;color: #428bca !important;" id="DEh4">Datos de los Equipos</h4>
                                      <br />
                                      
                                      
                                    <div class='col-md-12' id="DatosEquipo" >
                                                
                                                
                                                <div class="row" >
                                                
                                                    <div class="input-group form-group col-md-6 ">
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-pencil"></span>
                                                        </span>
                                                        <select class="form-control" name="selectTipo" id="selectTipo">
                                                                
                                                        </select>
                                                    </div>
                                                    
                                                     <div class="col-md-6 " >
                                                                
                                                                 <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-search"></span>
                                                                     </span>
                                                                     <input type="text" disabled="disabled" class="form-control" maxlength="40" name="prestadora" required="required" id="prestadora" placeholder="claro, movistar, personal, libre"  />
                                                                 </div>
                                                    </div>
                                                
                                                
                                                </div>
                                                <div class="row">
                                                
                                                      <div class="col-md-6" >
                                                                
                                                                 <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-search"></span>
                                                                     </span>
                                                                     <input type="text" disabled="disabled" class="form-control biginput" maxlength="100" name="tipoEquipo" required="required" id="tipoEquipomodelo" placeholder="Equipo modelo"  />
                                                                     
                                                                 </div>
                                                    </div>
                                                    <div class="col-md-6" >
                                                                
                                                                 <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
                                                                     </span>
                                                                     
                                                                      <input type="text"   disabled="disabled" class="form-control" maxlength="15" name="imei" id="imei"  pattern="[0-9]+" title="caracteres permitidos 0-9" placeholder="Imei equipo"/>
                                                                  </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                        
                                                            <div class="col-md-6" >
                                                                
                                                                 <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-sort-by-order"></span>
                                                                     </span>
                                                                     
                                                                     <input type="text" maxlength="30" class="form-control"  name="serie" id="serie"  placeholder="Nr. Serie equipo"/>
                                                                 </div>
                                                        </div>
                                                        
                                                </div>
                                                
                                                 <hr />
                                      
                                    
                                    
                                    </div>  
                                    
                                    <div class="col-md-12" id="ContGarantia">
                                        <h4 style="margin-left: 5px;color: #428bca !important;">Garantia</h4>
                                        <br />
                                        
                                           <div class="row">
                                                
                                                      <div class="col-md-6" >
                                                            <label class="radio-inline">
                                                              <input type="radio" name="Garantia" class="chekGarantia" value="1" checked="checked"/> No
                                                            </label>
                                                            <label class="radio-inline">
                                                              <input type="radio" name="Garantia" class="chekGarantia" value="2"/> Fabrica
                                                            </label>
                                                            <label class="radio-inline">
                                                              <input type="radio" name="Garantia" class="chekGarantia" value="3"/> Extendida
                                                            </label>
                                                    </div>
                                                    
                                                     
                                                   
                                                </div>
                                              
                                        
                                    </div>
                                    
                                    <div class="col-md-12">
                                    <hr />
                                    <br />
                                          <h4 style="margin-left: 5px; color: #428bca !important;">Posible Fallas</h4>
                                          <br />
                                    </div>
                                    <div class="col-md-12" id="ContEquipos" style="clear: both;padding-bottom: 10px;">
                                         
                                             
                                    </div>
                                    
                                     
                                       
                                       <!--Datos del Equipo<<<<-->
                                        <div class="col-md-12" style="clear: both;padding-bottom: 10px;" >   
                                            <div class="modal-footer">
                                                 <div class="form-group">
                                                   <div class="col-md-8" id="inf" style="padding-left: 0;text-align: center;">
                                                        
                                                   </div>
                                                   <div class="col-md-8" id="imgGuardar" style="padding-left: 0;text-align: center;display:none">
                                                        <img  src="img/guardar.gif" />
                                                   </div>
                                                   <button name="mysubmit" type="submit" id="btnGuardarCliente" data-loading-text="Guardando..." class="btn btn-primary pull-right"  style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
                                                </div>
                                            </div>
                                           
                                         </div>
                                         <!-- objectivo audiencia detalle inscripcion<<< -->
                                       </form> 
                                        
                                    </div>
                                 </div>
                          
                                
                           </div>
                            <!-- Fin Contenido -->
                    
                    </div>
            </div>
        </div>
      </div>
      
      
  <!-- mdEstado -->
<div class="modal fade" id="mdEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="color: #3a87ad;">Cambiar tipo de equipo</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="ContEstado">
                            <form id="FormEstado"> 
                                    <div class="col-md-12"> 
                                            <div class="input-group form-group col-md-12" >
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                </span>
                                                <select class="form-control" name="Selecttipo" id="Selecttipo">
                                                        <option value="0">Equipo</option>
                                                    <?php
                                                        $garantia=clsGarantiza::getAll();
                                                        foreach ($garantia as $g){
                                                     ?>
                                                                <option value="<?php echo $g->id_garantia; ?>"><?php echo $g->nombre; ?></option>
                                                    <?php

                                                        }

                                                    ?>


                                                </select>
                                            </div>  
                                              
                                     </div>
                                     <div class="col-md-12" style="clear: both;padding-bottom: 10px;" >   
                                                    <div class="modal-footer">
                                                         <div class="form-group">
                                                           <div class="col-md-8" id="inf" style="padding-left: 0;text-align: center;"></div>
                                                           <div class="col-md-8" id="imgGuardar" style="padding-left: 0px; text-align: center; display: none;">
                                                                <img src="img/guardar.gif" />
                                                           </div>
                                                           <button name="btnEstado" type="submit" id="btnEstado" data-loading-text="Guardando..." class="btn btn-primary pull-right"  style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
                                                        </div>
                                                    </div>
                                                   
                                     </div>
                             </form>
                       </div>
                    
                    </div>
            </div>
        </div>
      </div>
      
    
      <!-- Modal Si o no -->
      <div class="modal fade" id="mdSioNo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="color: #3a87ad;"> <span class="glyphicon glyphicon-warning-sign" style="color: orange;"></span> Atenci&oacute;n</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="ContSioNo">
                            
                                    <div class="col-md-12"> 
                                           <p id="TextSioNo"> 
                                               
                                           </p>
                                              
                                     </div>
                                     <div class="col-md-12" style="clear: both">   
                                                    <div class="modal-footer" style="padding-bottom: 0;">
                                                         <div class="form-group">
                                                                <button  type="button" id="btnDel" class="btn btn-primary pull-right"  ><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Cancelar</button>
                                                                <button  type="button" id="btnOk"  class="btn btn-primary pull-right"  style="margin-right:20px"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Aceptar</button>
                                                       </div>
                                                    </div>
                                                   
                                     </div>
                             
                       </div>
                    
                    </div>
            </div>
        </div>
      </div>
      
      
      <!-- mdCargarEquipos -->
       <div class="modal fade" id="mdCargarEquipos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 60%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="color: #3a87ad;">Equipos</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                            <!-- Contenido -->
                         <div class="row" id='contenedor'>
                               
                              
                               
                                 <div class="row">
                                     <div class="col-md-12">
                                       <form id="FormAddMasE"> 
                                   
                            
                                      
                                       
                                      <!-- >>> Datos del Equipo --> 
                                      
                                      
                                      
                                         <div class="row">
                                                    
                                                    
                                                        <div class="col-md-6" >
                                                            <label for="fecha" >Fecha de ingreso</label>
                                                             <div class="input-group form-group" >
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                                 </span>
                                                                 <input type="date" class="form-control" name="fecha" id="fecha" required="required"  value="<?php  echo date('Y-m-d'); ?>"  />
                                                             </div>
                                                        </div>
                                                        
                                                         <div class="col-md-6" >
                                                            <label for="fecha" >Fecha de entrega</label>
                                                             <div class="input-group form-group" >
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                                 </span>
                                                                 <input type="date" class="form-control" name="fechaEntrega" id="fechaEntrega" required="required"    />
                                                             </div>
                                                        </div>
                                                        
                                                     </div>
                                                  
                                      
                                  
                                         <!-- >>> Datos del Equipo --> 
                                      <hr />
                                      <h4 style="margin-left: 5px;color: #428bca !important;" id="DEh4">Datos de los Equipos</h4>
                                      <br />
                                      
                                      
                                    <div class='col-md-12' id="DatosEquipoMas" >
                                                
                                                
                                                   <div class="row" >
                                                
                                                    <div class="input-group form-group col-md-6 ">
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-pencil"></span>
                                                        </span>
                                                        <select class="form-control" name="selectTipo" id="selectTipo">
                                                                
                                                        </select>
                                                    </div>
                                                    
                                                     <div class="col-md-6 " >
                                                                
                                                                 <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-search"></span>
                                                                     </span>
                                                                     <input type="text" disabled="disabled" class="form-control" maxlength="40" name="prestadora" required="required" id="prestadora" placeholder="claro, movistar, personal, libre"  />
                                                                 </div>
                                                    </div>
                                                
                                                
                                                </div>
                                                <div class="row">
                                                
                                                      <div class="col-md-6" >
                                                                
                                                                 <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-search"></span>
                                                                     </span>
                                                                     <input type="text" disabled="disabled" class="form-control" maxlength="100" name="tipoEquipo" required="required" id="tipoEquipomodelo" placeholder="Equipo modelo"  />
                                                                     
                                                                 </div>
                                                    </div>
                                                    <div class="col-md-6" >
                                                                
                                                                 <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
                                                                     </span>
                                                                     
                                                                      <input type="text"   disabled="disabled" class="form-control" maxlength="15"  name="imei" id="imei"  pattern="[0-9]+" title="caracteres permitidos 0-9" placeholder="Imei equipo"/>
                                                                  </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                        
                                                            <div class="col-md-6" >
                                                                
                                                                 <div class="input-group form-group" >
                                                                     <span class="input-group-addon">
                                                                     <span class="glyphicon glyphicon-sort-by-order"></span>
                                                                     </span>
                                                                     
                                                                     <input type="text" maxlength="30" class="form-control"  name="serie" id="serie"  placeholder="Nr. Serie equipo"/>
                                                                 </div>
                                                        </div>
                                                        
                                                </div>
                                                
                                                 <hr />
                                      
                                    
                                    
                                    </div>  
                                    
                                    <div class="col-md-12" id="ContGarantia">
                                        <h4 style="margin-left: 5px;color: #428bca !important;">Garantia</h4>
                                        <br />
                                        
                                           <div class="row">
                                                
                                                      <div class="col-md-6" >
                                                            <label class="radio-inline">
                                                              <input type="radio" name="Garantia" class="chekGarantia" value="1" checked="checked"/> No
                                                            </label>
                                                            <label class="radio-inline">
                                                              <input type="radio" name="Garantia" class="chekGarantia" value="2"/> Fabrica
                                                            </label>
                                                            <label class="radio-inline">
                                                              <input type="radio" name="Garantia" class="chekGarantia" value="3"/> Extendida
                                                            </label>
                                                    </div>
                                                    
                                                     
                                                   
                                                </div>
                                              
                                        
                                    </div>
                                    
                                    <div class="col-md-12">
                                    <hr />
                                    <br />
                                          <h4 style="margin-left: 5px; color: #428bca !important;">Posible Fallas</h4>
                                          <br />
                                    </div>
                                    <div class="col-md-12" id="ContEquipos" style="clear: both;padding-bottom: 10px;">
                                         
                                             
                                    </div>
                                     
                                       
                                       <!--Datos del Equipo<<<<-->
                                        <div class="col-md-12" style="clear: both;padding-bottom: 10px;" >   
                                            <div class="modal-footer">
                                                 <div class="form-group">
                                                   <div class="col-md-8" id="inf" style="padding-left: 0;text-align: center;"></div>
                                                   <div class="col-md-8" id="imgGuardar" style="padding-left: 0px; text-align: center; display: none;">
                                                        <img src="img/guardar.gif" />
                                                   </div>
                                                   <button name="btnMasEquipo" id="btnMasEquipo" data-loading-text="Guardando..." type="submit" class="btn btn-primary pull-right"  style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
                                                </div>
                                            </div>
                                           
                                         </div>
                                         
                                       </form> 
                                        
                                    </div>
                                 </div>
                          
                                
                           </div>
                            <!-- Fin Contenido -->
                    
                    </div>
            </div>
        </div>
      </div>
      
      
        <!-- Editar | Equipos -->
      <div class="modal fade" id="mdEditarEquipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 60%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="color: #3a87ad;">Editar | Equipos</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                            <!-- Contenido -->
                         <div class="row" id='contenedor'>
                               
                              
                               
                                 <div class="row">
                                 
                                 
                                        
                                 
                                     <div class="col-md-12">
                                       <form id="EditarEquipo"> 
                                        <!-- >>> Editar del Equipo -->
                                        <div class="col-md-12"  id="ContEditarEquipo">
                            
                                        </div>
                                       <!--Editar del Equipo<<<<-->
                                        <div class="col-md-12" style="clear: both;padding-bottom: 10px;" >   
                                            <div class="modal-footer">
                                                 <div class="form-group">
                                                   <div class="col-md-8" id="inf" style="padding-left: 0;text-align: center;"> </div>
                                                      <div class="col-md-8" id="imgGuardar" style="padding-left: 0;text-align: center;display:none">
                                                        <img  src="img/guardar.gif" />
                                                      </div>
                                                   
                                                   <button name="btnEditarEquipo" id="btnEditarEquipo" data-loading-text="Guardando..." type="submit" class="btn btn-primary pull-right"  style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
                                                </div>
                                            </div>
                                           
                                         </div>
                                         
                                       </form> 
                                        
                                    </div>
                                 </div>
                          
                                
                           </div>
                            <!-- Fin Contenido -->
                    
                    </div>
            </div>
        </div>
      </div>
      
      
      <!-- mdImprimir -->
      <div class="modal fade" id="mdImprimir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 60%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="color: #3a87ad;">Equipos</h4>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                         
                         <div class="row"  id="ContCtrlPrint">
                                <div class="col-md-12" style="margin-bottom: 20px;" id="ControlPrint">
                                    
                                    
                                    
                                    
                                </div>
                                
                                <div class="col-md-12">
                                        <div class="col-md-6" id="inf" style="text-align: center;"></div>
                                        <button class="btn btn-primary pull-right" id="btnCargarPrint" data-loading-text="Cargando..." style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-download"></span>Cargar</button>
                           
                                </div>
                                 
                                
                                
                                
                         </div>
                         <hr/> <br />
                         <div class="row">
                            
                            
                            <div class="col-md-12">
                                    <button class="btn btn-success pull-right" id="Btnimprimir" data-loading-text="Guardando..." style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-print"></span>Imprimir</button>
                            </div>
                            
                            
                         </div>
                           
                            <!-- Contenido -->
                         <div class="row" id='imprimirTodo'>
                                
                              
                                
                                        
                         </div>
                                
                    </div>
                           
                    
                    </div>
            </div>
        </div>
        
        
        
         <!-- mdImprimir Reingreso-cliente -->
      <div class="modal fade" id="mdImprimirReingreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 60%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="color: #3a87ad;">Imprimir reingreso</h4>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                         
                         <div class="row"  id="ControlReingreso">
                                <div class="col-md-12" style="margin-bottom: 20px;" id="ControlPrintR">
                                    
                                    
                                    
                                    
                                </div>
                                
                                <div class="col-md-12">
                                        <div class="col-md-6" id="inf" style="text-align: center;"></div>
                                        <button class="btn btn-primary pull-right" id="btnCargarPrint" data-loading-text="Cargando..." style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-download"></span>Cargar</button>
                           
                                </div>
                                 
                                
                                
                                
                         </div>
                         <hr/> <br />
                         <div class="row">
                            
                            
                            <div class="col-md-12">
                                    <button class="btn btn-success pull-right" id="Btnimprimir" data-loading-text="Guardando..." style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-print"></span>Imprimir</button>
                            </div>
                            
                            
                         </div>
                           
                            <!-- Contenido -->
                         <div class="row" id='imprimirTodo'>
                                
                              
                                
                                        
                         </div>
                                
                    </div>
                           
                    
                    </div>
            </div>
        </div>
        
        <!-- PRESUPUESTO -->
        
        
         <div class="modal fade" id="mdPresupuesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 60%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="color: #3a87ad;">Presupuesto</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                            <!-- Contenido -->
                         <div class="row" id='contenedorPresupuesto'>
                               
                              
                               
                                 <div class="row">
                                     <div class="col-md-12">
                                       <form id="FormPresupuesto"> 
                                   
                                        <div class="col-md-12">
                                                
                                                <div class="row">
                                                
                                                    <div class="col-md-6">
                                                            <label for="fecha">Fecha</label>
                                                             <div class="input-group form-group">
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                                 </span>
                                                                 <input type="date" class="form-control" name="fechaPRE" id="fechaPRE"  value="<?php  echo date('Y-m-d'); ?>"/>
                                                             </div>
                                                        </div>
                                                
                                                </div>
                                                <div class="row">
                                                        <br /><br />
                                                         <h4>Agregar repuestos</h4>
                                                        
                                                        
                                                         <div class="col-md-6">
                                                            
                                                             <div class="input-group form-group">
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-pencil"></span>
                                                                 </span>
                                                                 <input type="text" class="form-control" maxlength="15" name="codigoPRE" required="required" id="codigoPRE" placeholder="Codigo del Stock"/>
                                                             </div>
                                                        </div>
                                                        
                                                     </div>
                                                     <br/>
                                                  <div class="row">  
                                                     
                                                    <div class="col-md-12"> 
                                                            
                                                        <div class="col-md-6" style="padding-left: 0;">
                                                          
                                                             <div class="input-group form-group">
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-pencil"></span>
                                                                 </span>
                                                                 <input type="text" class="form-control" maxlength="100" name="detallePRE" required="required" id="detallePRE" placeholder="detalle"/>
                                                             </div>
                                                        </div>
                                                        
                                                         <div class="col-md-6" style="padding-right: 0;">
                                                               
                                                               <a id="btnAgregar" style="margin-right:3px;cursor:pointer" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Agregar">
                                                                	<span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-plus"></span>Agregar
                                                                </a>
                                                               
                                                        </div>
                                                    
                                                    
                                                </div>
                                               </div>
                                               <div class="row">
                                                    <div class="col-md-4" id="infAdd" style="text-align: center;">
                                                        
                                                   </div>
                                               </div>
                                                
                                                <div class="row">
                                                        <br/>
                                                        <h4>Agregados</h4>
                                                        <div class="col-md-12"> 
                                                            
                                                              <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                       
                                                                        <th>Detalle</th>
                                                                        <th>Codigo</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="BodyPRE">
                                                                    
                                                               </tbody>
                                                             </table>
                                                    
                                                 
                                                        </div>
                                                     
                                                </div>
                                                <?php 
                                                       $ListEstaPres=$oBD->EstadoPresupuesto();
                                                       if($ListEstaPres[0] && mysqli_num_rows($ListEstaPres[1])>0){
                                                            
                                                ?>
                                                
                                                <div class="row">
                                                        <hr/>
                                                        <br />
                                                        <br />
                                                        <h4>Estado del equipo</h4>
                                                        <div class="col-md-12"> 
                                                                <div class="col-md-6">
                                                                <?php 
                                                                    while($row=mysqli_fetch_assoc($ListEstaPres[1])){
                                                                ?>
                                                                         <label class="radio-inline">
                                                                          <input type="radio" name="EstadoPresupuesto" class="chekEstadoPresupuesto" value="<?php echo $row["idEs_pre"]; ?>" /> <?php echo $row["nombre"]; ?>
                                                                        </label>
                                                                <?php 
                                                                    }
                                                                ?>
                                                                    
                                                                </div>
                                                        </div>
                                                </div>
                                                
                                                 <?php 
                                                      }
                                                ?>
                                                <div class="row">
                                                        <hr/>
                                                        <br />
                                                        <br />
                                                        <h4>Descripcion detallada del trabajo</h4>
                                                        <div class="col-md-12"> 
                                                            
                                                              <div class="form-group">
                                                                  
                                                                  <textarea class="form-control" rows="5" maxlength="3500" name="detallePRE" id="detallePRE" placeholder="Detalle"></textarea> 
                                                               </div>
                                                               
                                                               <div class="form-group">
                                                                   <input type="text" class="form-control" maxlength="6" name="PresupuestoTotal" required="required" id="PresupuestoTotal" placeholder="Presupuesto $"/>
                                                              </div>
                                                    
                                                 
                                                        </div>
                                                     
                                                </div>
                                                
                                                
                                                
                                                
                                             
                                         
                                         </div>
                                      
                                       
                                     
                                       
                                       <!-- sssss   <<<<-->
                                        <div class="col-md-12" style="clear: both;padding-bottom: 10px;" >   
                                            <div class="modal-footer">
                                                 <div class="form-group">
                                                   <div class="col-md-8" id="inf" style="padding-left: 0;text-align: center;"></div>
                                                    <div class="col-md-8" id="imgGuardar" style="padding-left: 0;text-align: center;display:none">
                                                        <img  src="img/guardar.gif" />
                                                   </div>
                                                   
                                                   <a id="btnPresupuesto" style="margin-right:3px;cursor:pointer" data-loading-text="Guardando..." class="btn btn-primary"  data-placement="bottom" >
                                                                	<span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar
                                                     </a>
                                                
                                                </div>
                                            </div>
                                           
                                         </div>
                                         
                                       </form> 
                                        
                                    </div>
                                 </div>
                          
                                
                           </div>
                            <!-- Fin Contenido -->
                    
                    </div>
            </div>
        </div>
      </div>
      
      
      
      
          <!-- MD REingresos de quipos -->
       <div class="modal fade" id="mdReingreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 60%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="color: #3a87ad;">Reingresos</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                            <!-- Contenido -->
                         <div class="row" id='contenedor'>
                               
                              
                               
                                 <div class="row">
                                     <div class="col-md-12">
                                       <form id="FormReingreso"> 
                                   
                            
                                      
                                       
                                      <!-- >>> Datos del Equipo --> 
                                      
                                      
                                      
                                         <div class="row">
                                                    
                                                    
                                                        <div class="col-md-6" >
                                                            <label for="fecha" >Fecha de ingreso</label>
                                                             <div class="input-group form-group" >
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                                 </span>
                                                                 <input type="date" class="form-control" name="fecha" id="fecha" required="required"  value="<?php  echo date('Y-m-d'); ?>"  />
                                                             </div>
                                                        </div>
                                                        
                                                         <div class="col-md-6" >
                                                            <label for="fecha" >Fecha de entrega</label>
                                                             <div class="input-group form-group" >
                                                                 <span class="input-group-addon">
                                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                                 </span>
                                                                 <input type="date" class="form-control" name="fechaEntrega" id="fechaEntrega" required="required"    />
                                                             </div>
                                                        </div>
                                                        
                                                     </div>
                                                  
                                      
                                  
                                        <br />
                                        <h4 style="margin-left: 5px;">Datos de los Equipos</h4>
                                        <br />
                                        <div class="col-md-12" id="ContEquipos" style="clear: both;padding-bottom: 10px;"></div>
                                     
                                        <div class="col-md-12" >
                                             
                                             <div class="alert alert-info" role="alert"> 
                                                <div class="checkbox" >
                                                    <label>
                                                            <input type="checkbox" id="garantia" /> <strong>En garantia.</strong>
                                                    </label>
                                                 </div>
                                                 <div class="form-group">
                                                    <label for="requisitos">Detalles</label>
                                                    <textarea class="form-control tipo textarea" rows="3" maxlength="500" name="detalleGar" id="detalleGar" placeholder="Detalle de la garantia" ></textarea> 
                                                 </div>
                                                                      
                                             </div>
                                        </div>
                                        
                                        
                                       
                                       <!--Datos del Equipo<<<<-->
                                        <div class="col-md-12" style="clear: both;padding-bottom: 10px;" >   
                                            <div class="modal-footer">
                                                 <div class="form-group">
                                                   <div class="col-md-8" id="inf" style="padding-left: 0;text-align: center;"></div>
                                                   <div class="col-md-8" id="imgGuardar" style="padding-left: 0px; text-align: center; display: none;">
                                                        <img src="img/guardar.gif" />
                                                   </div>
                                                   <button name="btnReingreso" id="btnReingreso" data-loading-text="Guardando..." type="submit" class="btn btn-primary pull-right"  style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
                                                </div>
                                            </div>
                                           
                                         </div>
                                         
                                       </form> 
                                        
                                    </div>
                                 </div>
                          
                                
                           </div>
                            <!-- Fin Contenido -->
                    
                    </div>
            </div>
        </div>
      </div>
      
      
      
             <!-- LISTADOS REingresos de quipos -->
       <div class="modal fade" id="mdLISTReingreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 60%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="color: #3a87ad;">Equipos de reingresos</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                            <!-- Contenido -->
                         <div class="row" id='contenedor'>
                               
                              
                               
                                 <div class="row">
                                     <div class="col-md-12">
                                       <form id="FormListadoReingreso"> 
                                   
                            
                                      
                                       
                                      <!-- >>> Datos del cliente --> 
                                      
                                      
                                       
                                         
                                             <br />
                                             <h4 style="margin-left: 5px;">Datos de los Cliente</h4>
                                             <br />        
                                                    
                                                <div class="col-md-12" style="clear: both;" id="ContReingreso"></div>
                                                        
                                                       
                                        <!-- Datos del cliente <<<<<-->           
                                      
                                       
                                        <br />
                                        <h4 style="margin-left: 5px;">Datos de los Equipos</h4>
                                        <br />
                                        <div class="col-md-12" id="ContEquipos" style="clear: both;padding-bottom: 10px;"></div>
                                     
                                      
                                        
                                        
                                       
                                       <!--Datos del Equipo<<<<-->
                                        <div class="col-md-12" style="clear: both;padding-bottom: 10px;" >   
                                            <div class="modal-footer">
                                                 <div class="form-group">
                                                   <div class="col-md-8" id="inf" style="padding-left: 0;text-align: center;"></div>
                                                   <div class="col-md-8" id="imgGuardar" style="padding-left: 0px; text-align: center; display: none;">
                                                        <img src="img/guardar.gif" />
                                                   </div>
                                                   <!--button name="btnReingreso" id="btnReingreso" data-loading-text="Guardando..." type="submit" class="btn btn-primary pull-right"  style="margin-bottom: 10px;"><span style="margin-right: 5px;font-size: 15px;" class="glyphicon glyphicon-floppy-saved"></span>Guardar</button -->
                                                </div>
                                            </div>
                                           
                                         </div>
                                         
                                       </form> 
                                        
                                    </div>
                                 </div>
                          
                                
                           </div>
                            <!-- Fin Contenido -->
                    
                    </div>
            </div>
        </div>
      </div>
      