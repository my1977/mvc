<?php
	class Upload {
		public function run($name) {
			// echo "<pre>";
			// var_dump($_FILES);
			// echo "</pre>";
			$ext = $this->getExt($_FILES[$name]["name"]);
			$fileName = 'img_'.time().rand(1,1000000) . $ext;			
			move_uploaded_file($_FILES[$name]["tmp_name"], "./public/upload/" . $fileName);
			return $fileName;
		}

		public function getExt($name) {
			$pos = strrpos($name, '.');
			$ext = substr($name, $pos);
			return $ext;
		}
	}