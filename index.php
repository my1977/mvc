<?php
	header("Content-type: text/html; charset=utf-8");
	//获取控制器名 方法名
	$controller = isset($_GET['c']) ? $_GET['c'] : 'Blog';
	$action 	= isset($_GET['a']) ? $_GET['a'] : 'lists';
	session_start();
	include "./common/function.php";

	

	//拼类名
	$className = "{$controller}Controller";  //UserController 控制器

	//实例化并调用
	$con = new $className();
	$con->$action();