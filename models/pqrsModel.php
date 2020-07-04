<?php
    class pqrsModel extends MainModel {
        public function __construct() {
        	parent::__construct();
		}



		function get_pqrs($id){

        	$WHERE = '';

        	if(!empty($id)){
        		$WHERE = "WHERE p.pqr_id = '$id'";
			}

        	$list = "
				SELECT  
					p.pqr_id,
					p.tipo_id,
					t.nombre as tipo,
					p.user_id,
					u.nombre as usuario,
					p.estado,
					p.asunto,
					p.creado,
					p.vence
				FROM pqrs p
				JOIN tipo_pqr t ON t.tipo_id = p.tipo_id
				JOIN usuarios u ON u.user_id = p.user_id
				$WHERE
			";


        	$total = "SELECT COUNT(*) total FROM pqrs p $WHERE";


        	return (object)[
        		'total' => (int) $this->query($total)[0]->total,
				'data' => $this->query($list)
			];


		}

		function get_tipo($tipo){



		}


		function  create($data){

		/*
			`tipo_id`,
			`estado`,
			`asunto`,
		*/


		}

	}