<?php
    class usuariosController extends MainController {
    	public function __construct() {
    		parent::__construct();

		}

		public function index(){

    		$this->loadModel('users');
    		$data = [
    			'usuarios' => $this->users->loadUsers()
			];

    		$this->render('header');
    		$this->render('usuarios', $data);
    		$this->render('footer');
    	}

	}