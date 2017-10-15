<?php
	class BlogModel {

		public $mysqli;
		function __construct() {
			$this->mysqli = new mysqli("127.0.0.1","root","","ztstu");
			$this->mysqli->query('set names utf8');
		}

		function addBlog($user_id, $content, $image='') {
			$sql = "insert into blog(content,user_id,image) value ('{$content}', {$user_id}, '{$image}')";
			$res = $this->mysqli->query($sql);
			return $res;
		}

		function getBlogLists($offset=0, $limit=20) {
			$sql = "select id,content,user_id,image from blog limit {$offset},{$limit}";
			//select * from blog limit 10,10
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
		}

		function getBlogCount () {
			$sql = "select count(*) as num from blog";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0]['num'];
		}
	}