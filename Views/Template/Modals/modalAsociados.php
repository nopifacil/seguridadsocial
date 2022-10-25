<!-- Modal -->

<div class="modal fade" id="modalFormAsociado" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Asociado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formAsociado" name="formAsociado" class="form-horizontal">
              <input type="hidden" id="id_asociado" name="id_asociado" value="">
              <p class="text-primary">Todos los campos son obligatorios.</p>

			  <div class="form-row"> 
			  <div class="form-group col-md-6">
                    <label for="listTipoidentificacion">Tipo identificacion</label>
                    <select class="form-control" data-live-search="true" id="listTipoidentificacion" name="listTipoidentificacion" required >
                    </select>
                </div>
              
                <div class="form-group col-md-6">
                  <label for="txtIdentificacion">Identificación</label>
                  <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" required="">
                </div>              
			  </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtPrimerNombre">Primer Nombre</label>
                  <input type="text" class="form-control valid validText" id="txtPrimerNombre" name="txtPrimerNombre" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtSegundoNombre">Segundo Nombre</label>
                  <input type="text" class="form-control valid validText" id="txtSegundoNombre" name="txtSegundoNombre" required="">
                </div>
              </div>

			  <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtPrimerApellido">Primer Apellido</label>
                  <input type="text" class="form-control valid validText" id="txtPrimerApellido" name="txtPrimerApellido" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtSegundoApellido">Segundo Apellido</label>
                  <input type="text" class="form-control valid validText" id="txtSegundoApellido" name="txtSegundoApellido" required="">
                </div>
              </div>

			  <div class="form-row"> 
			  <div class="form-group col-md-6">
                    <label for="listGenero">Genero</label>
                    <select class="form-control" data-live-search="true" id="listGenero" name="listGenero" required >
                    </select>
                </div>
              
                <div class="form-group col-md-6">
                  <label for="txtFechaexpedicion">Fecha Expedicion doc</label>
                  <input type="text" class="form-control" id="txtFechaexpedicion" name="txtFechaexpedicion" required="">
                </div> 
			  
				  <div class="form-group col-md-6">
                  	  <label for="listLugarnacimiento">Lugar de Nacimiento</label>
                   	 <select class="form-control" data-live-search="true" id="listLugarnacimiento" name="listLugarnacimiento" required >
                   	 </select>
                	</div>
				</div>


				<div class="form-row"> 
                	<div class="form-group col-md-6">
                 		 <label for="listDireccionresidencia">Direccion residencia</label>
                 		 <input type="text" class="form-control" id="listDireccionresidencia" name="listDireccionresidencia" required="">
              		  </div>
					  
					<div class="form-group col-md-6">
                  	  <label for="listCiudadresidencia">Ciudad residencia</label>
                   	 <select class="form-control" data-live-search="true" id="listCiudadresidencia" name="listCiudadresidencia" required >
                   	 </select>
                	</div>
				</div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtCelular">Celular</label>
                  <input type="text" class="form-control valid validNumber" id="txtCelular" name="txtCelular" required="" onkeypress="return controlTag(event);">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtEmail">Email</label>
                  <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                </div>
              </div>

			  <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtEdad">Edad</label>
                  <input type="text" class="form-control valid validNumber" id="txtEdad" name="txtEdad" required="" onkeypress="return controlTag(event);">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtEscolaridad">escolaridad</label>
                  <input type="text" class="form-control"" id="txtEscolaridad" name="txtEscolaridad" required="">
                </div>
              </div>

			  <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="listEstadocivil">Estado Civil</label>
                    <select class="form-control" data-live-search="true" id="listEstadocivil" name="listEstadocivil" required >
                    </select>
                </div>
				<div class="form-group col-md-6">
                  <label for="txtTotalhijos">Total Hijos</label>
                  <input type="text" class="form-control valid validNumber" id="txtTotalhijos" name="txtTotalhijos" required="" onkeypress="return controlTag(event);">
                </div>

				</div>
              <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="listRolid">Tipo Asociado</label>
                    <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required >
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="listStatus">Status</label>
                    <select class="form-control selectpicker" id="listStatus" name="listStatus" required >
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>
             </div>
             <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtPassword">Password</label>
                  <input type="password" class="form-control" id="txtPassword" name="txtPassword" >
                </div>
             </div>
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del asociado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Identificación:</td>
              <td id="celIdentificacion"></td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celNombre">Jacob</td>
            </tr>
            <tr>
              <td>Apellidos:</td>
              <td id="celApellido">Jacob</td>
            </tr>
            <tr>
              <td>Teléfono:</td>
              <td id="celTelefono">Larry</td>
            </tr>
            <tr>
              <td>Email (Asociado):</td>
              <td id="celEmail">Larry</td>
            </tr>
            <tr>
              <td>Tipo Asociado:</td>
              <td id="celTipoAsociado">Larry</td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celEstado">Larry</td>
            </tr>
            <tr>
              <td>Fecha registro:</td>
              <td id="celFechaRegistro">Larry</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

