<?php
    class usersModel extends MainModel {

    	function __construct() {
    		parent::__construct();
		}


		function checkPass($userId, $pass) {
			$sql = "SELECT * FROM usuarios WHERE user_id = '$userId' AND password = '$pass'";
			if(count($user = $this->query($sql)) == 1){
				return  $user[0];
			}
			return false;
		}

		function checkUser($user, $pass) {
			$sql = "SELECT 
					u.user_id,
       				u.username,
       				u.nombre,
       				u.role
       				FROM usuarios u
					WHERE u.username = '$user' AND u.password  = '$pass'
				";

			if(count($user = $this->query($sql)) == 1){
				return  $user[0];
			}

			return false;
		}

		function loadUsers(){
			$sql = "SELECT 
					u.user_id,
       				u.username,
       				u.nombre,
       				u.role
       				FROM usuarios u
       				";

			return $this->query($sql);
		}

		function checkApikey($key){
			$key = $this->db->real_escape_string($key);
				$sql = "SELECT 
					u.user_id,
       				u.username,
       				u.nombre,
       				u.role
       				FROM usuarios u
					WHERE u.token = '$key'
				";

			if(count($user = $this->query($sql)) == 1){
				return  $user[0];
			}

			return false;
		}

	}