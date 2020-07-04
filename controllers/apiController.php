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

		public  function  actualizar_estado(){

			if ($this->method == 'POST') {
				$key = $_POST['key'];
				$id = (!empty($_POST['id'])) ? $_POST['id'] : '';
				$estado   = (!empty($_POST['estado'])) ? $_POST['estado'] : '';
				$id = (int)$id;
				if ($user = $this->auth()) {
					$r = (object)[
						'status' => 'error',
						'message' => 'token no authorizado para relaizar esa accion',
						'code' => 401
					];

					if ($user->role == 'administrador') {
						$error = false;
						if(empty($id) || $id == 0){
							$r = (object)[
								'status' => 'error',
								'message' => 'el valor de id se espera que sea numerico entero ',
								'code' => 400
							];

							$error = true;
						}


						if(!$error) {

							$r = (object)[
								'status' => 'error',
								'message' => 'se encotraron errores al intentar procesar la solicitud ',
								'code' => 400,
								'data' =>[]
							];

							if(!in_array($estado, ['1','2','3'])){
								$r->data[] = 'estado invalido';
								$error = true;
							}

							$pqr = $this->pqrM->get_pqrs($id);

							if($pqr->total < 1 ){
								$r->data[] = 'no se encontro la pqr';
								$error = true;
							}

							if(!$error){
								$pqr = $pqr->data[0];
								if(($pqr->estado  == '1' && $estado != '2' ) || ($pqr->estado  == '2' && $estado != '3' )){
									$r->data[] = 'estado invalido para esta pqr';
									$error = true;
								}

								if(!$error){
									$this->pqrM->actualizar_estado($id, $estado);
									$r    = (object)[
										'status' => 'ok',
										'data'   => $this->pqrM->get_pqrs($id),
										'code'   => 200
									];
								}
							}
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
							if (empty($tipo_data = $this->pqrM->get_tipo($tipo))) {
								$r->data[] = 'no se reconoce el tipo de pqr';
								$error = true;
							}

							if (empty($user= $this->users->get_user_by_id($usuario))) {
								$r->data[] = 'no se reconoce el tipo de pqr';
								$error = true;
							}
						}

						if(!$error) {
							$dias = $tipo_data[0]->dias;
							$vence = date('Y-m-d', strtotime("now + $dias days"));


							$id = $this->pqrM->create([
									'tipo_id' => $tipo,
									'user_id' => $user->user_id,
									'asunto'  => $asunto,
									'creado'	  => date('Y-m-d H:i:s'),
									'vence'   => $vence,
									'estado'  => 1,

								]);

							if(!empty($id)) {
								$data = $this->pqrM->get_pqrs($id);

								$r = (object)[
									'status' => 'ok',
									'data'   => $data,
									'code'   => 200
								];
							}

						}
					}
				}

				http_response_code($r->code);
				die(json_encode($r));
			}

			http_response_code(403);

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

		private function post($index){
			return (isset($_POST[$index])) ? $_POST[$index] : null;
		}
	}