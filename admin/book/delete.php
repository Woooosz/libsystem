<?php
	session_start();
	include('../../conn.php');
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();

	$id=$_POST['id'];
	//echo $id;
	$status=$conn->sql="DELETE FROM book WHERE ISBN='".$id."'";
	$conn->execute_sql();
	if($status==true) {
		echo "1";
	}
?>