<?php
    class pqrsModel extends MainModel {
        public function __construct() {
        	parent::__construct();
		}



		function get_pqrs($id = ''){

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
        	$data = $this->query($list);

        	$data = array_map(function ($p){
				$p->nombre_estado = $this->get_estado($p->estado);
				return $p;
			}, $data);

        	return (object)[
        		'total' => (int) $this->query($total)[0]->total,
				'data' => $data
			];


		}

		function get_tipo($tipo = ''){
			$tipo = $this->db->real_escape_string($tipo);
			$WHERE = '';
			if(!empty($tipo)){
				$WHERE = "WHERE t.tipo_id = '$tipo'";
			}

			$sql = "SELECT 
					t.tipo_id,
					t.nombre,
					t.dias
				FROM tipo_pqr t
				$WHERE
				";

			if(count($tipo = $this->query($sql)) > 0){
				return  $tipo;
			}

			return false;

		}


		function  create($data){
		return $this->insert('pqrs', $data);
		/*
			`tipo_id`,
			`estado`,
			`asunto`,
		*/


		}

		function get_estado($estado){
        	switch ($estado){
				case 1 : return 'NUEVO';break;
				case 2 : return 'EN EJECUCION';break;
				case 3 : return 'CERRADO' ;break;
			}
		}

	}