<?php
	class Upload {
		public function run($name) {
			echo "<pre>";
			var_dump($_FILES);
			echo "</pre>";
			$oldName = $_FILES[$name]["name"];
			$pos = strrpos($oldName, '.');
			$ext = substr($oldName, $pos);
			$fileName = 'img_'.time().rand(1,1000000) . $ext;			
			move_uploaded_file($_FILES[$name]["tmp_name"], "./public/upload/" . $fileName);
			return $fileName;
		}
	}