# Simple PhP File Uploader


## How to use
* _path_ :
You must define relative path to the upload directory
* _file_ :
Here is the $_FILE['name']. `name` is the choosen name on <input type="file" name="my_custom_name" />
* _allow_ext_ :
Set here un an array the allowed file extension you want to upload
* _maxsize_ :
Your upload file maxsize must be set here in octet. If you want to upload an 1mb file, it make 1 * 1024 * 1024
* _filename_ :
It's optionnal. You can set up the final filename uploaded.




## Example

```php
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

