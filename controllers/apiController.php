<?php
    class apiController extends MainController
	{
		public $uri;
		public $method;

		public function __construct() {
			parent::__construct();
			header('Content-Type: application/json');
			$this->uri    = $_SERVER['REQUEST_URI'];
			$this->method = $_SERVER['REQUEST_METHOD'];
			$this->loadModel('users');
			$this->loadModel('pqrs', 'pqrM');
		}


		public function index() {

		}

		public function get() {


		}

		public function pqrs() {

			if ($this->method == 'POST') {
				$key = $_POST['key'];
				$id = (!empty($_POST['id'])) ? $_POST['id'] : '';
				$id = (int)$id;
				if ($user = $this->auth()) {
					$r = (object)[
						'status' => 'error',
						'message' => 'token no authorizado para relaizar esa accion',
						'code' => 401
					];

					if ($user->role == 'administrador') {
						$error = false;
						if(!empty($id) && $id == 0){
							$r = (object)[
								'status' => 'error',
								'message' => 'el valor de id se espera que sea numerico entero ',
								'code' => 400
							];

							$error = true;
						}


						if(!$error) {
							$data = $this->pqrM->get_pqrs($id);
							$r    = (object)[
								'status' => 'ok',
								'data'   => $data,
								'code'   => 200
							];
						}
					}
				}

				http_response_code($r->code);
				die(json_encode($r));
			}

			http_response_code(403);

		}

		public function crear_pqr() {

			if ($this->method == 'POST') {
				if ($user = $this->auth()) {
					 $r = (object)[
						'status' => 'error',
						'message' => 'token no authorizado para relaizar esa accion',
						'code' => 401
					];

					if ($user->role == 'administrador') {
						$error = false;

						$tipo 		= $this->post('tipo');
						$asunto 	= $this->post('asunto');
						$usuario 	= $this->post('usuario');

						$r = (object)[
							'status' => 'error',
							'message' => 'Error en los datos',
							'code' => 400,
							'data' => []
						];

						if(empty($tipo)){
							$r->data[] = 'el campo tipo es obligatorio ';
							$error = true;
						}

						if(empty($asunto)){
							$r->data[] = 'el campo asunto es obligatorio ';
							$error = true;
						}

						if(empty($usuario)){
							$r->data[] = 'el campo tipo es obligatorio ';
							$error = true;
						}
						if(!$error) {
							if ($this->pqrM->get_tipo($tipo)) {

							}
						}

						if(!$error) {
							$r = (object)[
								'status' => 'ok',
								'data'   => $_POST,
								'code'   => 200
							];
						}
					}
				}

				http_response_code($r->code);
				die(json_encode($r));
			}

			http_response_code(403);

		}


		private function post($index){
			return (isset($_POST[$index])) ? $_POST[$index] : null;
		}

		private function auth() {

			$key = $_POST['key'];
			$r   = [
				'status'  => 'error',
				'message' => 'Api key requerida'
			];

			if (!empty($key)) {

				$r = [
					'status'  => 'error',
					'message' => 'Api key no valida',
				];

				if (!empty($user = $this->users->checkApikey($key))) {
					return $user;
				}

				http_response_code(401);
				die(json_encode($r));
			}

			return false;
		}
	}