<?php 
$conn = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($conn, 'study');
mysqli_query($conn, 'set names utf8');
?>