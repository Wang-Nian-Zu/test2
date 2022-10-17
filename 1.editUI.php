<?php
require("dbconfig.php"); //執行另一個程式
if( !checkAccess()){ //如果是true(登入過)，就不用往下方程式跑
    header("Location: 0.loginUI.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>

<p>my guest book !! </p>
<hr />
<table width="200" border="1">  <!--表格-->
  <tr>
    <td>id</td>
    <td>title</td>
    <td>message</td>
    <td>name</td>
  </tr>
<?php
require("dbconfig.php");
if(isset($_GET['id'])) { //抓到id的參數
	$id=(int)$_GET['id']; //強制轉到integar，避免有人從中竄改
} else {
	$id=0; //沒有抓到id就先設成0
}
if ($id <=0) { //當小於等於0
	echo "empty ID"; //印出是空的IP
	exit(0); //結束
} 
	$sql = "select * from guestbook where id=?;"; //sql指令
	$stmt = mysqli_prepare($db, $sql ); //compile，並且prepare一個statement
	mysqli_stmt_bind_param($stmt, "i", $id); //告訴型態是integar
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt); //select裡面會有值，所以用result取得值
if ($rs=mysqli_fetch_array($result)) { //：Associative Array關聯陣列 / 一般數字array都可以，傳回值的記憶體就變成double
?>
<form method="post" action="2.update.php">
  <tr>
    <td><label>
      <input type="hidden" name="id" value="<?php echo $rs['id']; ?>" /> <!--輸入元件，是隱藏欄位-->
	  <?php echo $rs['id']; ?>
    </label></td>
    <td><label>
      <input name="title" type="text" id="title" value="<?php echo htmlspecialchars($rs['title']); ?>"/> 
      <!--一個文字方塊，名字是title，值用htmlspecialchars()包起來，為了區隔怪怪的字元，把標籤用爛掉，做編碼讓他不會與html搞混-->
      <!--使用者輸入資料要做htmlspecialchars()-->
    </label></td>
    <td><label>
      <input name="msg" type="text" id="msg" value="<?php echo $rs['msg']; ?>"/>
    </label></td>
    <td><label>
      <input name="myname" type="text" id="myname" value="<?php echo $rs['name']; ?>"/>
    </label></td>
  </tr>
</table>
<input type="submit" name="Submit" value="送出" /> <!--按鈕送出-->
</form>

<?php
} else echo "cannot find the message to edit.";
?>
</body>
</html>
