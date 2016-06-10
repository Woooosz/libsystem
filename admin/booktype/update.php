<?php 
	session_start();
	include('../../conn.php');
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();

	$id=$_POST['id'];
	$sname=$_POST['tname'];


	$conn->sql="UPDATE type SET btype='".$sname."' WHERE typeid=".$id;
	$status=$conn->execute_sql();
	if($status==1) {
		echo "1";
	}
?>