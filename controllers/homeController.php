<?php

	class homeController  extends MainController {

		public function __construct() {
			parent::__construct();
			$this->check_session();
		}

		public function index(){
			$template = ($this->user->role == 'cliente')? 'user_dashboard' : 'main';

			$this->render('header');
			$this->render($template, [
				'body' => 'Panel administrador',
				'pqrs' => []
			]);
			$this->render('footer');
		}


	}