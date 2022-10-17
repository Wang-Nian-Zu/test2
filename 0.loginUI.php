<?php
	//Session 使用範例
	session_start(); //啟用session 功能, 必須在php程式還沒輸出任何訊息之前啟用
    $_SESSION["userID"] = "" ; //重置session這個變數  
?>
<hr>
<form method="post" action="0.login.php"> <!-- form表單 (在表單裡面的input等一下都要送到action的程式中 -->
<!--method有兩種 : 1. get: 當你傳送出去，會將表單裡的input的東西放在網址後面，是很危險的 2. post就不會-->
ID <input type="text" name="id"> <br>
Password <input type="text" name="pwd"> <br>
<input type="submit"> <!--送出按鈕-->
</form>