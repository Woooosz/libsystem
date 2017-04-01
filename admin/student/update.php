<?php
session_start();
include ('../../conn.php');
$conn = new conn("SET NAMES UTF8");
$conn->execute_sql();

$id       = $_POST['id'];
$sname    = $_POST['sname'];
$password = sha1($_POST['password']);
$type     = $_POST['type'];
//$booknum=$_POST['booknum'];
$sno   = $_POST['sno'];
$mail  = $_POST['mail'];
$phone = $_POST['phone'];

$conn->sql = "UPDATE reader SET rname='".$sname."',password='".$password."',rdept='".$type."',borrownum='".$booknum."', phone='".$phone."', email='".$mail."' where rno='".$sno."'";
$status    = $conn->execute_sql();
if ($status == 1) {
	echo "1";
}
?>