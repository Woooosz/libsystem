<?php
	session_start();
	include('../../conn.php');
	$username=$_POST['username'];
	$password=sha1($_POST['password']);
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();
	//$sql="SELECT password,rdept FROM ls_login WHERE rdept='".$role."' and rno='".$username."'";
	$conn->sql="SELECT password,rdept FROM ls_login WHERE rno='".$username."'";
	$res=$conn->fetch_res();
	$_SESSION['rno']=$username;
	if(empty($res[0]['password'])) {
		echo "-1";
	} else if($res[0]['password'] != $password) {
		echo "-2";
	}	else if($res[0]['password'] == $password) {
		if($res[0]['rdept']=="管理员") {
			echo "9";
		} else {
			echo "1";
		}
	} 
?> 