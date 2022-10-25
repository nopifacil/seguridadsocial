<?php 

	class Empresas extends Controllers{
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

		public function Empresas()
		{
			$data['page_id'] = 3;
			$data['page_tag'] = "Empresas - Tienda Virtual";
			$data['page_name'] = "Empresas";
			$data['page_title'] = "Empresas - Tienda Virtual";
			$this->views->getView($this,"empresas",$data);
			
			
		}

	}
 ?>

 