<?php

	class uploader {

		public $allowedImage = array(
				IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF
			);

		public function upload($file){
			if(!$file['error']){
				$destFile = "img".DIRECTORY_SEPARATOR.time().$file['name'];
				if(move_uploaded_file($file['tmp_name'], $destFile) || copy($file['tmp_name'], $destFile)){
					$filePath = $destFile;
				}
				return $filePath;
			}
		}


		public function validate($file){
			return in_array(exif_imagetype($file['tmp_name']), $this->allowedImage);
		}

		public function delete($file){
			if(file_exists($file)){
				unlink($file);
			}
		}
	}

?>