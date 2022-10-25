<?php 

	class Asociados extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(2);
		}

		public function Asociados()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}			
			$data['page_tag'] = "Asociados ";
			$data['page_title'] = "Asociados - <small>Datos Generales";	
            $data['page_name'] = "Asociados";
			$data['page_functions_js'] = "functions_asociados.js";				
			$this->views->getView($this,"asociados",$data);
		}
		public function setAsociados(){
			if($_POST){			
				if(empty($_POST['txtIdentificacion']) || empty($_POST['txtPrimerNombre']) || empty($_POST['txtPrimerApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$idAsociado = intval($_POST['idAsociado']);
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strPrimerNombre = ucwords(strClean($_POST['txtPrimerNombre']));
					$strPrimerApellido = ucwords(strClean($_POST['txtPrimerApellido']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strEmail = strtolower(strClean($_POST['txtEmail']));
					$intTipoId = intval(strClean($_POST['listRolid']));
					$intStatus = intval(strClean($_POST['listStatus']));
					$request_user = "";
					if($idAsociado == 0)
					{
						$option = 1;
						$strPassword =  empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);

						if($_SESSION['permisosMod']['w']){
							$request_user = $this->model->insertAsociado($strIdentificacion,
																				$strPrimerNombre, 
																				$strPrimerApellido, 
																				$intTelefono, 
																				$strEmail,
																				$strPassword, 
																				$intTipoId, 
																				$intStatus );
						}
					}else{
						$option = 2;
						$strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);
						if($_SESSION['permisosMod']['u']){
							$request_user = $this->model->updateAsociado($idAsociado,
																		$strIdentificacion, 
																		$strPrimerNombre,
																		$strPrimerApellido, 
																		$intTelefono, 
																		$strEmail,
																		$strPassword, 
																		$intTipoId, 
																		$intStatus);
						}

					}

					if($request_user > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_user == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getAsociados()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectAsociados();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn btn-info btn-sm btnViewAsociado" onClick="fntViewAsociado('.$arrData[$i]['id_asociado'].')" title="Ver Asociado"><i class="far fa-eye"></i></button>';
					}
					if($_SESSION['permisosMod']['u']){
						if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
							($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) ){
							$btnEdit = '<button class="btn btn-primary  btn-sm btnEditAsociado" onClick="fntEditAsociado(this,'.$arrData[$i]['id_asociado'].')" title="Editar Asociado"><i class="fas fa-pencil-alt"></i></button>';
						}else{
							$btnEdit = '<button class="btn btn-secondary btn-sm" disabled ><i class="fas fa-pencil-alt"></i></button>';
						}
					}
					if($_SESSION['permisosMod']['d']){
						if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
							($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) and
							($_SESSION['userData']['id_asociado'] != $arrData[$i]['id_asociado'] )
							 ){
							$btnDelete = '<button class="btn btn-danger btn-sm btnDelAsociado" onClick="fntDelAsociado('.$arrData[$i]['id_asociado'].')" title="Eliminar Asociado"><i class="far fa-trash-alt"></i></button>';
						}else{
							$btnDelete = '<button class="btn btn-secondary btn-sm" disabled ><i class="far fa-trash-alt"></i></button>';
						}
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getAsociado($id_asociado){
			if($_SESSION['permisosMod']['r']){
				$idAsociado = intval($id_asociado);
				if($idAsociado > 0)
				{
					$arrData = $this->model->selectAsociado($idAsociado);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function delAsociado()
		{
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intid_asociado = intval($_POST['idAsociado']);
					$requestDelete = $this->model->deleteAsociado($intid_asociado);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Asociado');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Asociado.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function perfil(){
			$data['page_tag'] = "Perfil";
			$data['page_title'] = "Perfil de Asociado";
			$data['page_name'] = "perfil";
			$data['page_functions_js'] = "functions_Asociados.js";
			$this->views->getView($this,"perfil",$data);
		}

		public function putPerfil(){
			if($_POST){
				if(empty($_POST['txtIdentificacion']) || empty($_POST['txtPrimerNombre']) || empty($_POST['txtPrimerApellido']) || empty($_POST['txtTelefono']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					$idAsociado = $_SESSION['idUser'];
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strPrimerNombre = strClean($_POST['txtPrimerNombre']);
					$strPrimerApellido = strClean($_POST['txtPrimerApellido']);
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strPassword = "";
					if(!empty($_POST['txtPassword'])){
						$strPassword = hash("SHA256",$_POST['txtPassword']);
					}
					$request_user = $this->model->updatePerfil($idAsociado,
																$strIdentificacion, 
																$strPrimerNombre,
																$strPrimerApellido, 
																$intTelefono, 
																$strPassword);
					if($request_user)
					{
						sessionUser($_SESSION['idUser']);
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function putDFical(){
			if($_POST){
				if(empty($_POST['txtNit']) || empty($_POST['txtNombreFiscal']) || empty($_POST['txtDirFiscal']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					$idAsociado = $_SESSION['idUser'];
					$strNit = strClean($_POST['txtNit']);
					$strNomFiscal = strClean($_POST['txtNombreFiscal']);
					$strDirFiscal = strClean($_POST['txtDirFiscal']);
					$request_datafiscal = $this->model->updateDataFiscal($idAsociado,
																		$strNit,
																		$strNomFiscal, 
																		$strDirFiscal);
					if($request_datafiscal)
					{
						sessionUser($_SESSION['idUser']);
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}



	}
 ?>