<?php
require("dbconfig.php");
	$loginID = $_POST["id"];
    $password = $_POST["pwd"];

$sql = "select loginID from user where password = PASSWORD(?);"; 
//先寫一個sql指令，將使用者輸入的值?，用PASSWORD加密過，在跟password欄位比較是否相同
//盡量用statement物件($stat)會比較安全
$stmt = mysqli_prepare($db, $sql );//$db是另一個程式生成的資料庫連線物件,  prepare:表示用這個資料庫($db)把sql指令compile好
mysqli_stmt_bind_param($stmt,"s",$password);//將使用者輸入的password，用字串的形式，去bind到$sql指令的?
mysqli_stmt_execute($stmt);//執行一個sql指令
$result = mysqli_stmt_get_result($stmt);  //將執行完的結果放到$result裏
if($rs = mysqli_fetch_assoc($result)){ //看有沒有抓到result那張select出來的表 
    if($rs['loginID'] == $loginID){ //之後再比較相同密碼欄位，他的userId有無輸入吻合
        $_SESSION["userID"] = $loginID ;
        header("Location: 1.listUI.php");
    }else{
        $_SESSION["userID"] = '';
        header("Location: 0.loginUI.php");
    }
}
