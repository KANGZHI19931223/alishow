<?php 
// 1\ 接收前端发送的数据(上传图片的信息)
$img = $_FILES['img'];

// 2\ 修改上传图片的名字

// (1)\ 获取图片名字中的最后一个点的索引
$index = strrpos($img['name'], '.');
// (2)\ 截取后缀
$ext = substr($img['name'], $index);
// (3)\ 创建新名字
$new = time() . rand(1000, 9999) . $ext;

// 3\ 将图片移动到目标位置
$path = '../upload/' . $new;
$result = move_uploaded_file($img['tmp_name'], $path);
if ($result) {
	echo $path;
} else {
	echo 2;
}



?>