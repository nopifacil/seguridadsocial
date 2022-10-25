<?php headerAdmin($data); ?>



    <main class="app-content">
      <div class="app-title">
        <div>

        <?php if($_SESSION['permisosMod']['w']){ ?>
          <a class="collapse-item" href="<?= base_url(); ?>/nuevaempr">Nueva</a>
              <?php } ?>
        
        </div>        
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/roles"><?= $data['page_tag'] ?></a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableEmpresa">
                      <thead>
                        <tr>
                          <th>Tipo</th>
                          <th>Nombre Razón Social</th>
                          <th>Ciudad</th>
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