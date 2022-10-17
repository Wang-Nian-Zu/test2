<?php
require("dbconfig.php"); //執行另一個程式
if( !checkAccess()){ //如果是true(登入過)，就不用往下方程式跑
    header("Location: 0.loginUI.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- html的表頭(下5行)-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>
<!-- body: 文件主要內容-->
<body>
<!-- p: 段落，文件的開頭--> <!-- a: 超連結 Add是超連結的文字，1.insertUI.php是點擊後要去的畫面-->
<!-- 先印一段登入後，跟使用者hello-->
<p> <?php echo "hello! ",$_SESSION['userID']; ?> <a href='1.insertUI.php'>Add</a></p>
<hr />
<table width="200" border="1"><!-- table:表格的長跟寬 -->
  <tr>  <!-- tr 第一個row ，th 標題topic heading -->
    <td>id</td>
    <td>title</td>
    <td>message</td>
    <td>name</td>
    <td>讚</td>
    <td>倒讚</td>
	<td>-</td>
  </tr>
<?php
$sql = "select * from guestbook order by id desc;"; 
//先寫一個sql指令，從guestbook查出所有的資料，依照留言的流水號遞減排序，遞減代表大的，也就是新的留言會排前面
//盡量用statement物件($stat)會比較安全
$stmt = mysqli_prepare($db, $sql );//$db是另一個程式生成的資料庫連線物件,  prepare:表示用這個資料庫($db)把sql指令compile好
mysqli_stmt_execute($stmt);//執行一個sql指令
$result = mysqli_stmt_get_result($stmt);  //將執行完的結果放到$result裏頭

// mysqli_query($db, $sql)，也是在資料庫下指令，在更新、新增的安全較弱，不會對參數做encoding

while (	$rs = mysqli_fetch_assoc($result)) { //欄位名稱當作駐標的陣列抓一筆資料放入$rs，如果他不是空值的話，跑下面的程式
    $id = $rs['id']; //先設好變數
	echo "<tr><td>" , $rs['id'] ,       //echo印字串，$rs['id']，資料$rs裏頭的欄位id
	"</td><td><a href='3.viewPost.php?id=$id'>" , $rs['title'],"</a>", //將title變成超連結(並在其中傳id到下一次php程式)，為了跳轉到裏頭該主題的留言
	"</td><td>" , $rs['msg'], 
	"</td><td>", $rs['name'], "</td>",
    "</td><td>", $rs['likes'], "</td>",
    "</td><td>", $rs['dislikes'], "</td>",
    "<td><a href='2.like.php?id=", $rs['id'], "'>Like</a> ", //按讚(like)的超連結，傳一個主題的id到下一個php
    "<a href='2.dislike.php?id=", $rs['id'], "'>Dislike</a> ", //倒讚(dislike)的超連結，傳一個主題的id到下一個php
	"<td><a href='2.delete.php?id=", $rs['id'], "'>Delete</a> ", //echo印字串，超連結delete，?表示後面接參數，留言的id等於後面傳進來的欄位值，典型傳參數給php的方式
	"<a href='1.editUI.php?id=", $rs['id'], "'>Edit</a></td></tr>"; //echo印字串，超連結add
}
?>
</table>
</body>
</html>
