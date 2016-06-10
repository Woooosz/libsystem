<?php
	session_start();
	include('../../conn.php');
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();
	$id=$_SESSION['id'];
	$param=$_POST['value'];
	if($id==1) {
		//$name='本科生最多借阅天数';
		//$value=$res[1]['borrowdate'];
		$sql="UPDATE department SET borrowdate=".$param." where rdept='本科生'";
	} else if($id==2) {
		//$name="本科生最多借阅本数";
		//$value=$res[1]['maxborrownum'];
		$sql="UPDATE department SET maxborrownum=".$param." where rdept='本科生'";
	} else if($id==3) {
		//$name="研究生最多借阅天数";
		//$value=$res[2]['borrowdate'];
		$sql="UPDATE department SET borrowdate=".$param." where rdept='研究生'";
	} else if($id==4) {
		//$name="研究生最多借阅本数";
		//$value=$res[2]['maxborrownum'];
		$sql="UPDATE department SET maxborrownum=".$param." where rdept='研究生'";
	} else if($id==5) {
		//$name="教师最多借阅天数";
		//$value=$res[0]['borrowdate'];
		$sql="UPDATE department SET borrowdate=".$param." where rdept='教师'";
	} else if($id==6) {
		//$name="教师最多借阅本数";
		//$value=$res[0]['maxborrownum'];
		$sql="UPDATE department SET maxborrownum=".$param." where rdept='教师'";
	}
	$conn->sql=$sql;
	$status=$conn->execute_sql();
	echo $param;
?>