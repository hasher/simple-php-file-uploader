<?php 

/**
 * Simple PhP File uploader
 *
 * @package    Simple PhP File Uploader
 * @author     Judicael AHYI <judicael.ahyi.pro@gmail.com>
 * @copyright  Copyright (c) 2018 Judicael AHYI
 * @license    MIT Licence (See Licence file)
 * @version    2
 * @link       https://github.com/hasher/simple-php-file-uploader
 */



class upload {

	public $path;
	public $file = [];
	public $allow_ext = [];
	public $maxsize;
	public $filename;



	/**
	* Function : Check if the parth exit, else create it, and add an 'index.php' in it for security
	* @param string $path relative path to upload the file
	*/
	private function _init($path) {

		if ( !is_dir($path) ) {
			mkdir($path, 0755, true);
		}

		$index = fopen($path . 'index.php', 'w');
		fwrite($index , 'You are not allow to access to this directory.');
		fclose($index);

	}

	/**
	* Function : Upload function
	* @return array 
	*/	
	public function _upload() {

		$this->_init($this->path);

		$ext = substr($this->file["name"], strripos($this->file["name"], '.')); // This returns file ext
		
		if ( in_array(strtolower($ext), $this->allow_ext) && ($this->file["size"] < $this->maxsize) ) {	

			if ( !empty($this->filename) ) {
				$target = $this->path . $this->filename . strtolower($ext) ;
			} else {
				$target = $this->path . $this->file["name"] ;
			}
			
			move_uploaded_file($this->file["tmp_name"], $target);

			$return = [ 
				'status' => true , 
				'message' => $target
			];

		} elseif ( $this->file["size"] > $this->maxsize ) {	

			$return = [ 
				'status' => false , 
				'message' => 'The file you are trying to upload is too large. Max allowed is :' . $this->maxsize/1024/1024 . ' mo.'
			];

		} else {

			$return = [ 
				'status' => false , 
				'message' => 'Your ' . $ext . ' is not allow. Only these file types are allowed for upload : ' . (' <strong>' . implode( $this->allow_ext ) . '</strong> ')
			];

			unlink($this->file["tmp_name"]);

		}

		return $return;

	}

}

