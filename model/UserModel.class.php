<?php
	class UserModel {

		public $mysqli;
		function __construct() {
			$this->mysqli = new mysqli("127.0.0.1","root","","ztstu");
		}

		function addUser($name , $age, $password) {
			$sql = "insert into user(name,age,password) value ('{$name}', {$age}, '{$password}')";
			$res = $this->mysqli->query($sql);
			return $res;
		}

		function getUserLists() {
			$sql = "select * from user";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
		}
	}