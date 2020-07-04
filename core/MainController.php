<?php

	Class MainController {
		private  $config;
		public $user;
		public function __construct() {
			if(session_status() == PHP_SESSION_NONE)  session_start();
			$this->user = $this->getSessionUser();
		}

		function index(){

		}

		function loadController($controller, $alias = "", $parametros = []){
			$controller = $controller.'Controller';

			if(!is_readable($path = CONTROLLERS.$controller.'.php')) {
				return false;
			}

			require_once $path;
			// se crea una instancia el modelo
			$name = (!empty($alias))? $alias : $controller;
			$controller = new $controller(...$parametros);
			// retorna el modelo como objeto;
			$this->{$name} = &$controller;
			return $controller;
		}


		protected function loadModel($model=false, $alias = '')
		{

			$name = (!empty($alias))? $alias : $model;
			$model = $model.'Model';

			//se crea la ruta del modelo
			$rutaModelo = MODELS.$model.'.php';
			// se comprueba que el modelo exista

			if(!is_readable($rutaModelo)) {
				return false;
			}

			require_once $rutaModelo;
			$modelObject = new $model;
			$this->{$name} = &$modelObject;
			return $modelObject;
		}


		public function render($template, $data = array(), $return = false){

			$path = VIEWS.$template.".phtml";
			// application/views/emails/timeline_email_new.php
			if($template == 'header'){ $data['user'] = $this->user;}
			if(file_exists($path)) {
				ob_start();
				foreach ($data as $key => $value) {
					$$key = $value;
				}

				include $path;

				$html = ob_get_contents();
				ob_end_clean();

				if(!empty($return)) return $html;
				echo $html;
			}

			return false;

		}

		protected  function loadDefaultController(){
			return $this->loadController(DEFAULT_CONTROLLER);
		}

		private   function getSessionUser(){
			$user                   = array();
			$user['id']             = (!empty($_SESSION["user_id"])) ? $_SESSION["user_id"] : NULL;
			$user['username']       = (!empty($_SESSION["username"])) ? $_SESSION["username"] : NULL;
			$user['names']          = (!empty($_SESSION["names"])) ? $_SESSION["names"] : NULL;
			$user['auth']           = (!empty($_SESSION["auth"])) ? $_SESSION["auth"] : NULL;
			$user['role']			= (!empty($_SESSION["role"])) ? $_SESSION["role"] : NULL;

			return (object)$user;
		}

		protected function check_session(){
			if(empty($this->user->id)){
				$this->render('login');
				exit;

			}
		}


	}