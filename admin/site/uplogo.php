<?php 
// 1\ 接收前端传递的图片信息
$file = $_FILES['file'];
// print_r($file);
// 2\ 更改图片名
$index = strrpos($file['name'], '.');
$ext = substr($file['name'], $index);
$new = time() . rand(1000, 9999) . $ext;
// 3\ 移动图片
$path = '../upload/' . $new;
$result = move_uploaded_file($file['tmp_name'], $path);
if ($result) {
	echo $path;
} else {
	echo 2;
}


?>