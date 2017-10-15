<?php
	class UserCenterController {
		public function login() {
			include "./view/usercenter/login.html";
		}
		public function doLogin() {
			$name = $_POST['name'];
			$password = $_POST['password'];
			if (!$name || !$password) {
				header('Refresh:3,Url=index.php?c=UserCenter&a=login');
				echo '必填信息，登录不成功';
				die();
			}
			$verifyCode = $_POST['verify'];
			if ($verifyCode != $_SESSION['verifyCode']) {
				header('Refresh:3,Url=index.php?c=UserCenter&a=login');
				echo '验证码错误，登录不成功';
				die();
			}

			$userModel =  new UserModel();
			$userInfo = $userModel->getUserInfoByName($name);

			if ($userInfo['password'] == $password) {
				unset($userInfo['password']); //一般来说 密码对外开放
				$_SESSION['me'] = $userInfo;
				header('Refresh:3,Url=index.php?c=Blog&a=lists');
				echo '登录成功';
				die();
			} else {
				header('Refresh:3,Url=index.php?c=Blog&a=lists');
				//header('Location:index.php?c=Blog&a=lists');
				echo '登录不成功';
				die();
			}
		}

		public function reg () {
			include "./view/usercenter/reg.html";
		}

		public function doReg() {
			$name 	= $_POST['username'];
			$age 	= $_POST['age'] ? $_POST['age'] : 0;
			$password = $_POST['password'];

			if (empty($name) || empty($password)) {
				header('Refresh:3,Url=index.php?c=UserCenter&a=reg');
				echo '注册不成功';
				die();
			}

			$userModel = new UserModel();
			$status = $userModel->addUser($name , $age, $password);
			if ($status) {
				header('Refresh:1,Url=index.php?c=UserCenter&a=login');
				echo '注册成功，1秒后跳转到list';
				die();
			} else {
				header('Refresh:3,Url=index.php?c=UserCenter&a=reg');
				echo '注册失败，3秒后跳转到list';
				die();
			}
		}

		public function logout () {
			unset($_SESSION['me']);
			header('Refresh:3,Url=index.php?c=UserCenter&a=login');
			echo 'logout';
			die();
		}

		public function verifyCode() {
			header("Content-Type:image/png");

			$img = imagecreate(50, 25);

			$back = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);

			$red = imagecolorallocate($img, 255, 0, 0);


			$str = getRandom(4) ;
			$_SESSION['verifyCode'] = $str;
			imagestring($img, 5, 7, 5, $str, $red);

			imagepng($img);

			imagedestroy($img);
		}	
	}