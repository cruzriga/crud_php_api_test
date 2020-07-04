<?php
    class loginController extends MainController {

    	public function __construct() {
    		parent::__construct();
    		$this->loadModel('users');

		}

		function index() {
			$this->render('login', []);
		}

		function logout(){
    		session_destroy();
    		header('Location: '.BASE_URL);
    	}

		function  validate() {
			$response['status'] = 'error';
			$response['msg']    = 'Por favor complete todos los campos e intente nuevamente';

			if(!empty($_POST['pass']) && !empty($_POST['user'])){

				$user = $this->users->db->real_escape_string($_POST['user']);
				$pass = $this->users->db->real_escape_string($_POST['pass']);
				$pass = md5(base64_decode($pass));
				if($user = $this->users->checkUser($user, $pass)){
						$_SESSION["user_id"]   	= $user->user_id;
						$_SESSION["username"]  	= $user->username;
						$_SESSION["names"]     	= $user->nombre;
						$_SESSION["auth"]      	= true;
						$_SESSION["role"] 		= $user->role;

						$response['status'] = 'ok';
						$response['msg'] = '';
					}else{
						$response['status'] = 'error';
						$response['msg']    = 'Usuario o constraseña invalida';
				}
			}

			die(json_encode($response));

		}
	}