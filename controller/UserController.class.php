<?php
	class UserController {
		public function add() {
			include "./view/user/add.html";
		}

		public function doAdd() {
			$name = $_POST['username'];
			$age  = $_POST['age'];
			$password = $_POST['password'];

			if (empty($name) || empty($age) ||empty($password)) {
				header('Refresh:3,Url=index.php?c=User&a=lists');
				echo '参数错误发布失败，3秒后跳转到list';
				die();
			}

			$userModel = new UserModel();
			$status = $userModel->addUser($name, $age, $password);
			if ($status) {
				header('Refresh:1,Url=index.php?c=User&a=lists');
				echo '发布成功，1秒后跳转到list';
				die();
			} else {
				header('Refresh:3,Url=index.php?c=User&a=lists');
				echo '发布失败，3秒后跳转到list';
				die();
			}
		}

		public function lists() {
			if (!isset($_SESSION['me']['id']) || $_SESSION['me']['id'] <= 0) {
				header('Refresh:3,Url=index.php?c=UserCenter&a=login');
				die('please login');
			}
			echo '你好 '.$_SESSION['me']['name'];
			$userModel = new UserModel();
			$data = $userModel->getUserLists();
			include "./view/user/lists.html";
		}

		public function setSession() {
			session_start();
			$_SESSION['a'] = '1111';
			$_SESSION['b'] = '222';
			
		}
		public function getSession() {
			var_dump($_SESSION);
		
		}
	}