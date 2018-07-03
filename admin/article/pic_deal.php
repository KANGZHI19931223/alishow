<?php 
// 1\ 接收前端传递的数据
$img = $_FILES['file'];
// print_r($img);
// 2\ 更改上传图片的名字
// (1)\ 获取图片名字中最后一个点'.' 的坐标
$index = strrpos($img['name'], '.');
// (2)\ 截取.以及以后的字符串
$ext = substr($img['name'], $index);
// (3)\ 拼接随机名字
$newname = time().rand(10000, 99999).$ext;
// (4)\ 得到移动的路径
$path = '../upload/' . $newname;

// 3\ 将上传的图片移动到upload文件夹中
$result = move_uploaded_file($img['tmp_name'], $path);
if ($result) {
	echo $path;
} else {
	echo '上传失败';
}
 


?>