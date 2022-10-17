<?php
require("dbconfig.php");
if(isset($_GET['id'])) {
	$id=(int)$_GET['id'];
} else {
	$id=0;
}

if ($id>0) {
	$sql = "update guestbook set dislikes=dislikes+1 where id=?;";
	$stmt = mysqli_prepare($db, $sql );
	mysqli_stmt_bind_param($stmt, "i", $id);
	mysqli_stmt_execute($stmt);

	//echo "disliked.";
	header("Location: 1.listUI.php");
} else {
	echo "empty id, cannot dislike.";
}
?>