<?php
	class BlogController {
		public function __construct() {
		}
		public function add () {
			if (!isset($_SESSION['me']) || $_SESSION['me']['id'] <=0) {
				header('Location:index.php?c=UserCenter&a=login');
			}
			include "./view/blog/add.html";
		}

		public function doAdd() {
			include "./library/Upload.class.php";
			$upload = new Upload();
			$filename = $upload->run('image');
			$content = $_POST['content'];
			$user_id = $_SESSION['me']['id'];

			$blogModel = new BlogModel();
			$status = $blogModel->addBlog($user_id, $content, $filename);

			if ($status) {
				header('Refresh:1,Url=index.php?c=Blog&a=lists');
				echo '发布成功，1秒后跳转到list';
				die();
			}
		}

		public function image () {
			include "./view/blog/image.html";
		}

		public function doImage() {
			include "./library/Upload.class.php";
			$upload = new Upload();
			$filename = $upload->run('photo');
			echo $filename;
			echo $upload->returnSize();
			// echo "<pre>";
			// var_dump($_FILES);
			// echo "</pre>";
		}

		public function lists() {

			/*
				get p 当前第几页
				每页显示的个数  $pageNum =  3; 
				通过 p + pageNum  求偏移量  
				获取列表的方法支持 offset  limit 

				获取总条数 / pageNum ceil 向上取整 为了页面中显示页码
			 */
			$blogModel = new BlogModel();
			$userModel = new UserModel();

			$p = isset($_GET['p']) ? $_GET['p'] : 1;
			$pageNum =  3; 
			$offset = ($p - 1) * $pageNum;
			$count = $blogModel->getBlogCount();
			$allPage = ceil($count/$pageNum);
			
			$data = $blogModel->getBlogLists($offset, $pageNum);

			// foreach ($data as $key => &$value) {
			// 	$user_info = $userModel->getUserInfoById($value['user_id']);
			// 	//$data[$key]['user_name'] = $user_info['name'];
			// 	$value['user_name'] = $user_info['name'];
			// }
			foreach ($data as $key => $value) {
				$user_info = $userModel->getUserInfoById($value['user_id']);
				$data[$key]['user_name'] = $user_info['name'];
			}

			include "./view/blog/lists.html";
		}
	}