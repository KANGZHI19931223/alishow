<?php 
header('content-type:text/html;charset=utf-8');
// 1\ 接收数据
$inf = $_FILES['f'];

// 2\ 更改名字
// (1) 先查找图片名字中最后一个点的索引
$index = strrpos($inf['name'], '.');
// (2) 截取图片的后缀
$ext = substr($inf['name'], $index);
// (3) 拼接新名字
$newname = time().rand(10000, 99999).$ext;

// 3\ 移动图片到目标路径
$path = './upload/'.$newname; // 拼接新路径
$move_result = move_uploaded_file($inf['tmp_name'], $path);


// 4\ 在数据表中将对应的admin_pic更新
// 拼接数据表中对应admin_pic的内容字符串
$str = '../upload/' . $newname;

session_start();
$id = $_SESSION['id'];
include_once './include/mysql.php';
$sql = "update ali_admin set admin_pic = '$str' where admin_id = $id";
$result = mysqli_query($conn, $sql);

// 5 \ 判断图片移动结果和数据表更新结果
if ($move_result) {
	if ($result) {
		// 成功的时候要将图片的路径返回
		echo $str;
		// echo 1;
	} else {
		echo 3;
	}
	
} else {
	echo 2;
}


?>