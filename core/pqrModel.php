<?php
    class pqrModel extends MainModel{

		public function __construct() {
			parent::__construct();
		}


		function get_all_pqr(){

			$sql = "
				SELECT p. pqr_id ,
					p. tipo_id ,
					p. estado ,
					p. asunto ,
					p. creado ,
					p. fecha_limite 
				FROM  pqr_test  p;
			";

			return $this->query($sql);

		}

	}