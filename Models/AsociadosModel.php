<?php 

	class AsociadosModel extends Mysql
	{
		private $intidAsociado;
		private $strIdentificacion;
		private $strPrimerNombre;
		private $strPrimerApellido;
		private $intTelefono;
		private $strEmail;
		private $strPassword;
		private $strToken;
		private $intTipoId;
		private $intStatus;
		

		
		public function __construct()
		{
			parent::__construct();
		}	

		public function insertAsociado(string $identificacion, string $primernombre, string $primerapellido, int $telefono, string $email, string $password, int $tipoid, int $status){

			$this->strIdentificacion = $identificacion;
			$this->strPrimerNombre = $primernombre;
			$this->strPrimerApellido = $primerapellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;
			$return = 0;

			$sql = "SELECT * FROM asociados WHERE 
					email_user = '{$this->strEmail}' or identificacion = '{$this->strIdentificacion}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO asociados(identificacion,primer_nombre,segundo_nombre,primer_apellido,segudo_apellido,generoide,fecha_expedicion,lugar_expedicion,fecha_nacimiento,direccion_residencia,ciudad_residencia ,celular,email_user,edad,escolaridad,estado_civil,total_hijos,password,rolid,status) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strIdentificacion,
        						$this->strPrimerNombre,
        						$this->strPrimerApellido,
        						$this->intTelefono,
        						$this->strEmail,
        						$this->strPassword,
        						$this->intTipoId,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function selectAsociados()
		{
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " and p.id_asociado  != 1 ";
			}
			$sql = "SELECT p.id_asociado,p.identificacion,p.primer_nombres,p.primer_apellidos,p.celular,p.email_user,p.status,r.idrol,r.nombrerol 
					FROM asociados p 
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.status != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}
		public function selectAsociado(int $id_asociado){
			$this->intidAsociado = $id_asociado;
			$sql = "SELECT p.id_asociado,p.identificacion,p.primer_nombres,p.primer_apellidos,p.celular,p.email_user,p.nit,p.nombrefiscal,p.direccionfiscal,r.idrol,r.nombrerol,p.status, DATE_FORMAT(p.datecreated, '%d-%m-%Y') as fechaRegistro 
					FROM asociados p
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.id_asociado = $this->intidAsociado";
			$request = $this->select($sql);
			return $request;
		}

		public function updateAsociado(int $idAsociado, string $identificacion, string $primernombre, string $primerapellido, int $telefono, string $email, string $password, int $tipoid, int $status){

			$this->intidAsociado = $idAsociado;
			$this->strIdentificacion = $identificacion;
			$this->strPrimerNombre = $primernombre;
			$this->strprimerApellido = $primerapellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;

			$sql = "SELECT * FROM asociados WHERE (email_user = '{$this->strEmail}' AND idasociado != $this->intIdAsociado)
										  OR (identificacion = '{$this->strIdentificacion}' AND idasociado != $this->intIdAsociado) ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				if($this->strPassword  != "")
				{
					$sql = "UPDATE asociados SET identificacion=?, primer_nombre=?, primer_apellido=?, celular=?, email_user=?, password=?, rolid=?, status=? 
							WHERE id_asociado = $this->intidAsociado ";
					$arrData = array($this->strIdentificacion,
	        						$this->strPrimerNombre,
	        						$this->strPrimerApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->strPassword,
	        						$this->intTipoId,
	        						$this->intStatus);
				}else{
					$sql = "UPDATE asociados SET identificacion=?, primer_nombre=?, primer_apellido=?, celular=?, email_user=?, rolid=?, status=? 
							WHERE id_asociado = $this->intidAsociado ";
					$arrData = array($this->strIdentificacion,
	        						$this->strPrimerNombre,
	        						$this->strPrimerApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->intTipoId,
	        						$this->intStatus);
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		
		}
		public function deleteAsociado(int $intid_asociado)
		{
			$this->intidAsociado= $intid_asociado;
			$sql = "UPDATE asociados SET status = ? WHERE idasociado = $this->intidAsociado ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function updatePerfil(int $idAsociado, string $identificacion, string $primernombre, string $primerapellido, int $telefono, string $password){
			$this->intidAsociado = $idAsociado;
			$this->strIdentificacion = $identificacion;
			$this->strPrimerNombre = $primernombre;
			$this->strPrimerApellido = $primerapellido;
			$this->intTelefono = $telefono;
			$this->strPassword = $password;

			if($this->strPassword != "")
			{
				$sql = "UPDATE asociados SET identificacion=?, primer_nombre=?, primer_apellido=?, celular=?, password=? 
						WHERE id_asociado = $this->intidAsociado ";
				$arrData = array($this->strIdentificacion,
								$this->strPrimerNombre,
								$this->strPrimerApellido,
								$this->intTelefono,
								$this->strPassword);
			}else{
				$sql = "UPDATE asociados SET identificacion=?, primer_nombre=?, primer_apellido=?, celular=? 
						WHERE id_asociado = $this->intidAsociado ";
				$arrData = array($this->strIdentificacion,
								$this->strPrimerNombre,
								$this->strPrimerApellido,
								$this->intTelefono);
			}
			$request = $this->update($sql,$arrData);
		    return $request;
		}

		

	}
 ?>