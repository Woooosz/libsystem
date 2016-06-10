<?php
	session_start();
	include('../../conn.php');
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();
	$rno=$_POST['tname'];
	$conn->sql="SELECT * FROM type WHERE btype='".$rno."'";
	$res=$conn->fetch_res();
	if(!empty($res[0]['btype'])) {
		echo "-1";
	} else {
		$conn->sql="INSERT INTO type(btype) VALUES ('".$rno."')";
		$status=$conn->execute_sql();
		if($status==1) {
			echo "1";
		} else {
			echo "0";
		}
	}

?>