<?php
	class UserCenterController {
		public function login() {
			include "./view/usercenter/login.html";
		}
		public function doLogin() {
			$name = $_POST['name'];
			$password = $_POST['password'];

			$userModel =  new UserModel();
			$userInfo = $userModel->getUserInfoByName($name);

			if ($userInfo['password'] == $password) {
				unset($userInfo['password']);
				$_SESSION['me'] = $userInfo;
				header('Refresh:3,Url=index.php?c=User&a=lists');
				echo '登录成功';
				die();
			} else {
				header('Refresh:3,Url=index.php?c=User&a=lists');
				echo '登录不成功';
				die();
			}
		}

		public function logout () {
			unset($_SESSION['me']);
			header('Refresh:3,Url=index.php?c=User&a=lists');
			echo 'logout';
			die();
		}	
	}