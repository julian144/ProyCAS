<?php
  $page_title = 'Agregar ganado';
  require_once('includes/load.php');
  $userid = $_SESSION['userSession'];
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add_product'])){

   $req_fields = array('userSession','noarete','especraza','fechacoloc','fechanac', 'precioventa','edad','sexo','raza','empadre','madre','estado','preciocompra');
   validate_fields($req_fields);
   if(empty($errors)){
    
     $p_noarete  = remove_junk($db->escape($_POST['noarete']));
     $p_cat   = remove_junk($db->escape($_POST['especraza']));
     $p_fechacoloc   = remove_junk($db->escape($_POST['fechacoloc']));
     $p_fechanac   = remove_junk($db->escape($_POST['fechanac']));
     $p_precio_venta  = remove_junk($db->escape($_POST['precioventa']));
     $p_edad  = remove_junk($db->escape($_POST['edad']));
     $p_sexo  = remove_junk($db->escape($_POST['sexo']));
     $p_raza  = remove_junk($db->escape($_POST['raza']));
     $p_empadre  = remove_junk($db->escape($_POST['empadre']));
     $p_madre  = remove_junk($db->escape($_POST['madre']));
     $p_estado  = remove_junk($db->escape($_POST['estado']));
     $p_precio_compra  = remove_junk($db->escape($_POST['preciocompra']));
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO registro (";
     $query .=" id,noarete,fechacoloc,fechanac,edad,sexo,raza,especraza,empadre,madre,estado,precio_venta,precio_compra";
     $query .=") VALUES (";
     $query .=" '{$userid}','{$p_noarete}', '{$p_fechacoloc}', '{$p_fechanac}', '{$p_edad}', '{$p_sexo}', '{$p_raza}','{$p_cat}','{$p_empadre}','{$p_madre}','{$p_estado}','{$p_precio_venta}','{$p_precio_compra}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE noarete='{$p_noarete}'";
     if($db->query($query)){
       $session->msg('s',"Agregado exitosamente. ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Lo siento, el registro falló.');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar ganado</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-barcode"></i>
                  </span>
                  <input type="text" class="form-control" name="noarete" placeholder="No. arete">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="especraza">
                      <option value="">Raza especifica del animal</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product-photo">
                      <option value="">Selecciona una imagen</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-pencil"></i>
                     </span>
                     <select type="text" class="form-control" name="sexo" placeholder="Sexo del animal">
                       <option value="" selected disabled hidden>Sexo del animal</option>
                       <option value="Macho">Macho</option>
                       <option value="Hembra">Hembra</option>
                     </select>
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="number" class="form-control" name="preciocompra" placeholder="Precio compra">
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="precioventa" placeholder="Precio venta">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
               </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-5">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-calendar"></i>
                     </span>
                     <input type="date" class="form-control" name="fechanac" placeholder="Fecha de nacimiento">

                  </div>
                 </div>
                 <div class="col-md-5">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-calendar"></i>
                     </span>
                     <input type="date" class="form-control" name="fechacoloc" placeholder="Fecha colocación arete">
                  </div>
                 </div>
               </div>
              </div>
              <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-indent-right"></i>
                     </span>
                     <input type="text" class="form-control" name="edad" placeholder="Edad">
                  </div>
                 </div>
                 <div class="col-md-6">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-list-alt"></i>
                     </span>
                     <select type="text" class="form-control" name="raza" placeholder="Raza">
                       <option value="" selected disabled hidden>Raza del animal</option>
                       <option value="Pura">Pura</option>
                       <option value="Cruza">Cruza</option>
                        <option value="Criollo">Criollo</option>
                     </select>
                  </div>
                 </div>
               </div>
              </div>
              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-list-alt"></i>
                     </span>
                     <select type="text" class="form-control" name="estado" placeholder="Estado">
                       <option value="" selected disabled hidden>Estado del animal</option>
                       <option value="Vendido">Vendido</option>
                       <option value="Muerto">Muerto</option>
                        <option value="Muerto">Extraviado</option>
                         <option value="En existencia">En existencia</option>
                     </select>
                  </div>
               </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-list-alt"></i>
                     </span>
                     <select type="text" class="form-control" name="empadre" placeholder="Empadre del animal">
                       <option value="" selected disabled hidden>Empadre del animal</option>
                       <option value="Monta natural">Monta natural</option>
                       <option value="Transferencia">Transferencia</option>
                       <option value="Inseminación artificial">Inseminación artificial</option>
                     </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-list-alt"></i>
                    </span>
                    <input type="number" class="form-control" name="madre" placeholder="No. arete de la madre">
                 </div>
               </div>
               </div>
              </div>
              <button type="submit" name="add_product" class="btn btn-danger">Agregar</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
