<?php

	function getName() {
		echo '123';
	}

	//$name = "Upload";
	function L ($name) {
		include "./library/{$name}.class.php";
		$upload = new $name();
		return $upload;
	}

	//自动加载
	function __autoload($class) {
		if (strpos($class, "Controller") !== false) {
			$dir = 'controller';
		} elseif (strpos($class, "Model") !== false) {
			$dir = 'model';
		} else {
			die($class."not exist");
		}
		include "./{$dir}/{$class}.class.php";
	}