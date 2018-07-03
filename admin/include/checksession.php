<?php 
	header('content-type:text/html;charset=utf-8');
	session_start();
    if (empty($_SESSION['id'])) {
      echo '请登陆后访问';
      header('refresh:2;url=/admin/login.html');
      die;
    }
?>