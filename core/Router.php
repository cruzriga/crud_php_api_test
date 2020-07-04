<?php

	Class Router extends  MainController {

		public  $uri;
		public  $method;

		public function __construct() {

			parent::__construct();
			$this->uri 	= $_SERVER['REQUEST_URI'];
			$this->method = $_SERVER['REQUEST_METHOD'];
			$this->loadComponentController();
		}

		private function loadComponentController(){
			$segments= $this->getMapRute()->segments;
			$controllerName = $segments[0];
			$controller = ($controllerName == '' || $controllerName == '/') ? $this->loadDefaultController(): $this->loadController($controllerName);

			if (gettype($controller) == 'object') {
				$method = (count($segments)>1) ? $segments[1] : 'index';
				if(method_exists($controller,$method)){
					call_user_func([$controller, $method]);
					exit;
				}
			}

			http_response_code(404);
			$this->render('404');
		}

		public function getMapRute(){
			$ruta = explode('?', $this->uri);
			$segments = explode('/', $ruta[0]);
			(count($segments) > 1) ? array_shift($segments) : $segments;
			return (object)[
				'url' => $ruta[0],
				'segments' => $segments
			];
		}

		public function get($rute){


	}

}


