<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>

<p>delete message</p>
<hr />
<?php
require("dbconfig.php");
if(isset($_GET['id'])) { //取得要刪除的id
	$id=(int)$_GET['id'];
} else {
	$id=0; //沒有id就設成0
}

if ($id>0) { //如果大於0做刪除
	$sql = "delete from guestbook where id=?;"; //sql指令
	$stmt = mysqli_prepare($db, $sql ); // compile，建立statement物件
	mysqli_stmt_bind_param($stmt, "i", $id); //id強制是integar
	mysqli_stmt_execute($stmt);//執行

	echo "message deleted."; //印出message deleted
} else {
	echo "empty id, cannot delete.";
}
?>
<hr>
<a href="1.listUI.php">Home</a> <!--超連結-->
</body>
</html>
