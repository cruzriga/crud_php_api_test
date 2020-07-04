<?php

	class homeController  extends MainController {

		public function __construct() {
			parent::__construct();
			$this->check_session();
		}

		public function index(){
			$template = ($this->user->role == 'cliente')? 'user_dashboard' : 'main';
			$this->loadModel('pqrs');
			$this->render('header');
			$pqrs = $this->pqrs->get_pqrs();
			$this->render($template, [
				'body' => 'Panel administrador',
				'pqrs' => $pqrs->data
			]);
			$this->render('footer');
		}


	}