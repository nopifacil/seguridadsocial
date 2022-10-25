<?php headerAdmin($data); 
getModal('modalAsociados',$data);
?>
    <main class="app-content">
      <div class="app-title">
        <div>
                         
            <?php if($_SESSION['permisosMod']['w']){ ?>
                <button class="btn btn-primary mb-2" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button>
              <?php } ?>            
              <a href="<?= BASE_URL ?>/Configuracion" rel="nuevo.php">Iniciar sesion</a>

        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/asociados"><?= $data['page_tag'] ?></a></li>
        </ul>
      </div>      
      <div class="row">
      <div class="col-md-12">
        <div class="tile">
         <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableAsociados">
                      <thead>
                       <tr>
                          <th>ID</th>
                          <th>Primer Nombre</th>
                          <th>Segundo Nombre</th>
                          <th>Primer Apellido</th>
                          <th>Segundo Apellido</th>
                          <th>Teléfono</th>
                          <th>Rol</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>                        
                      </tbody>
                    </table>
                  </div>
                </div>
                </div>
                </div>
             </div>
     </main>
    
<?php footerAdmin($data); ?>
    