<?php 
//SELECT `id_Presupuesto`, `nr_orden`, `fecha`, `detalle`, `presupuesto`, `aprobado` FROM `presupuesto` WHERE 1
$idEquipo=0;
$presupuesto=NULL;
$ok=0;
    if(isset($_SESSION["qrnrOrden"])){
        $idEquipo=$_SESSION["qrnrOrden"];
        $presupuesto= clsEquipo::Haypresupuesto($idEquipo);
        if(count($presupuesto)>0){$ok=1;}
        
    }
    else{
        print "<script>window.location='./logout.php';</script>";
    }





?>

<div class="row">
	<div class="col-xs-12 col-md-12">
    
      <h1><i class="glyphicon glyphicon-list-alt"></i> Presupuesto</h1>
		<div class="clearfix"></div>
	<br/>
<form class="form-horizontal" method="post" id="presupuesto" name="presupuesto" action="index.php?view=updatePresupuesto" role="form">


  

  
    <div class="form-group">
    
    <div class="col-lg-offset-2 col-xs-12 col-md-6">

     <textarea required="required" id="Descripcion" name="Descripcion" placeholder="Descripcion" class="form-control" rows="3" ><?php if($ok){echo $presupuesto->detalle;}?></textarea>
    </div>
  </div>
  
 
  
  <div class="form-group">
     
     <div class="col-lg-offset-2 col-xs-12 col-md-6">
        <input type="number" min="0" class="form-control" maxlength="6" name="PresupuestoTotal" required="required" id="PresupuestoTotal" placeholder="Presupuesto $" value="<?php if($ok){ echo $presupuesto->presupuesto;} ?>" />
    </div>
 </div>
     <input type="hidden"  name="nrOrden" required="required" id="nrOrden"  value="<?php echo $idEquipo; ?>" />
   
  
 <br />
<!--div class="form-group">
    <label for="telefono" class="col-xs-2 control-label"></label>
    <div class="col-xs-12 col-md-3">
        <p class="alert alert-danger" ><strong style="color: red;">*</strong> <strong>Campos obligatorios</strong></p>
     </div>
</div-->


    
    
      <div class="form-group">
        <div class="col-lg-offset-2 col-xs-10">
          <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar&nbsp;&nbsp;</button>
        </div>
      </div>
      
      <?php 
        if(isset($_SESSION["errorP"])){
    
    ?>
    <div class="form-group" style="margin-top: 45px;">
        <label for="telefono" class="col-lg-2 control-label"></label>
        <div class="col-xs-6" style="text-align: center;">
            <?php echo $_SESSION["errorP"]; ?>
        </div>
    </div>
    <?php
        unset($_SESSION["errorP"]); 
        }
    ?>
    
       <?php 
        if(isset($_SESSION["msj"])){
    
    ?>
    <div class="form-group" style="margin-top: 45px;">
        <label for="telefono" class="col-lg-2 control-label"></label>
        <div class="col-xs-6" style="text-align: center;">
            <?php echo $_SESSION["msj"]; ?>
        </div>
    </div>
    <?php
        unset($_SESSION["msj"]); 
        }
    ?>
      
</form>


	</div>
</div>


