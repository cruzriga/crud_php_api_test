<?php

	Class MainModel {
		public $db;

		public function __construct() {
			$this->db = $this->con();
		}

		protected function con() {

			$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE, DB_PORT);
			if($db->connect_errno > 0){
				die('No se puede conectar a la Base de Datos [' . $db->connect_error . ']');
			}

			$db->set_charset('utf8');
			$db->query("SET COLLATION_CONNECTION = '".DB_COLLATION."';");

			return $db;
		}

		protected function get($sql){
			if($consult = $this->db->query($sql)){
				if($consult->num_rows > 0){
					$result = $consult->fetch_object();
					$consult->close();
					return($result);
				}

				return [];
			}

			return false;
		}

		protected function query($sql){
			if($consult = $this->db->query($sql)){
				$data = array();
				if($consult->num_rows > 0){
					while ($row = $consult->fetch_object()){
						$data[] = $row;
					}
					$consult->close();
				}
				return($data);
			}
			//echo $this->db->error;

			return false;
		}

		protected function update($table, $data = [], $conditions = '', $scape = true){
			$SQL = "UPDATE ".$table." SET ";
			$FIELDS = [];
			foreach ($data as $campo => $valor){
				if($scape){
					$valor  = ($valor == null) ? 'NULL' :  '"'.$valor.'"';
				}

				$FIELDS[]= $campo ."=".$valor."";
			}
			$SQL .= implode(', ', $FIELDS);
			if(!empty($conditions)){
				$SQL .= " \nWHERE ".$conditions;
			}

			return $this->db->query($SQL);
		}

		protected function insert($table, $data = []) {
			$COLS   = [];
			$VALUES = [];
			foreach ($data as $col => $val) {
				$COLS[]   = $col;
				$VALUES[] = "'" . $val . "'";
			}

			$COLS   = implode(',', $COLS);
			$VALUES = implode(",", $VALUES);
			$SQL    = "INSERT INTO $table ($COLS) VALUES ($VALUES)";

			if ($this->db->query($SQL)) {
				return $this->db->insert_id;
			}

			return FALSE;
		}

	}