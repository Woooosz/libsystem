<?php
include ('../conn.php');
$conn = new conn("SET NAMES UTF8");
$conn->execute_sql();

$id         = $_POST['bno'];
$bname      = $_POST['name'];
$password   = sha1($_POST['password']);
$email      = $_POST['email'];
$phone      = $_POST['phone'];
$department = $_POST['department'];

$conn->sql = "SELECT * FROM reader WHERE rno='".$id."'";
$res       = $conn->fetch_res();
if (!empty($res[0]['rname'])) {
	echo "-1";
} else {
	$conn->sql = "INSERT INTO reader VALUES ('".$id."','".$bname."',0,'".$password."','".$department."','".$phone."','".$email."')";
	$status    = $conn->execute_sql();
	if ($status == 1) {
		echo "1";
	} else {
		echo "0";
	}
}

?>