<?php 

	class Home extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function home()
		{
			$data['page_id'] = 1;
			$data['page_tag'] = "Home";
			$data['page_title'] = "Página principal";
			$data['page_name'] = "home";
			$data['page_content'] = "Soluciones para el manejo de Nominas y pagos de seguridad social.";
			$this->views->getView($this,"home",$data);
		}

	}
 ?>