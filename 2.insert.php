<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>

<p>insert new message</p> <!-- 段落 -->
<hr /> <!-- 一整段橫線 -->
<?php
require('dbconfig.php'); //連線資料庫

$title=$_POST['title']; //把在insertUI.php打得字加入參數
$msg=$_POST['msg']; //把在insertUI.php打得字加入參數
$name=$_POST['myname']; //把在insertUI.php打得字加入參數

if ($title) { //如果title這個變數不是空的就是true
	$sql = "insert into guestbook (title, msg, name) values (?, ?, ?)"; //sql指令中需要套進去的我們用?替代
	$stmt = mysqli_prepare($db, $sql); //先compile過，prepare sql statement物件
	mysqli_stmt_bind_param($stmt, "sss", $title, $msg,$name); //bind parameters with variables
    //用指定格式包好，第一到三的參數它們的型態是字串(sss)，s是字串(ex日期...) ，d 浮點數 i 數字，並且還對應三個變數$title, $msg,$name
	mysqli_stmt_execute($stmt);  //執行SQL
	echo "message added."; //印出"message added."
} else {
	echo "empty title, cannot insert."; //如果title是空的，就給錯誤訊息
}
?>
<hr>
<a href="1.listUI.php">Home</a> <!-- 超連結，回到listUI.php程式介面 -->

</body>
</html>
