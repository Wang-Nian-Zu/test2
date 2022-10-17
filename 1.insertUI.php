<?php
require("dbconfig.php"); //執行另一個程式
if( !checkAccess()){ //如果是true(登入過)，就不用往下方程式跑
    header("Location: 0.loginUI.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> <!-- 表頭 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>input form</title>
</head>
<body>
<p>my guest book !! </p>
<hr />

<table width="200" border="1"> <!-- 表格 -->
  <tr>  <!-- 一行 -->
    <td>title</td>
    <td>message</td>
    <td>name</td>
  </tr>  <!-- 一行 -->
  <tr><form method="post" action="2.insert.php"> <!-- 使用post方式送資料，action: 表示要送的對象是一個php-->
    <td><label>
      <input name="title" type="text" id="title" /> <!--格子中放了一個文字方塊，名字是title-->
    </label></td>
    <td><label>
      <input name="msg" type="text" id="msg" /> <!--格子中放了一個文字方塊，名字是msg-->
    </label></td>
    <td><label>
      <input name="myname" type="text" id="myname" /> <!--格子中放了一個文字方塊，名字是myname-->
      <input type="submit" name="Submit" value="送出" /> <!--送出按鈕-->
    </label></td>
	</form>
  </tr>  
</table>
</body>
</html>
