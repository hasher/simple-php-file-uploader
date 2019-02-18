<?php 

	require('class.upload.php'); 

	try {

		if ( isset($_POST['submit'])) {

			$upload = new upload;

			$upload->path = './uploads/';
			$upload->file = $_FILES['file'];
			$upload->allow_ext = ['.jpg','.png','.mp4'];
			$upload->maxsize = 1048576;
			$upload->filename = '';

			$status = $upload->_upload();

			if ( $status['status'] == false ) {

				throw new Exception("Error => Message : " . $status['message']);
				exit();

			} else{

				echo "File uploaded with success !";

			}

		}

	} catch (Exception $e) {

		die('ERROR : ' . $e->getMessage());

	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Simple PhP File Uploader</title>
	<style type="text/css">
		* {margin: 0;padding: 0;}
		body {background: #343d46;color: #fff; text-align: center; font-size: 20px;}
		h4 { margin: 80px 0px; }
		button {margin: 20px 0px; padding: 10px;cursor: pointer; border: 2px solid navy; background-color: blue; color: #fff;}
	</style>
</head>
<body>
	<h4>Simple PhP File Uploader</h4>
	<br>
	<form method="POST" enctype="multipart/form-data">
		<div id="wrapper">
			<input type="file" name="file" required />
			<br>
			<button class="btn" name="submit">Upload a file</button>
		</div>
	</form>
</body>
</html>