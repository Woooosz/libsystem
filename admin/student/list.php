<?php
session_start();
include ('../../conn.php');
$conn = new conn("SET NAMES UTF8");
$conn->execute_sql();
$rno   = $_POST['rno'];
$rname = $_POST['rname'];
if (empty($rno) && empty($rname)) {
	$conn->sql = "SELECT rno,rname,password,rno AS id,email as mail, phone FROM reader";
	$res       = $conn->fetch_res();
	//echo $res[1]['rdept'];
	//echo $res[2]['rdept'];
	//$data=array( 'data'=>array());
	$str = json_encode($res);
	echo "{\"data\":".$str."}";
} else if (!empty($rno)) {
	$conn->sql = "SELECT rno,rname,password,rno AS id,email as mail, phone FROM reader where rno like '%".$rno."%'";
	$res       = $conn->fetch_res();
	if (empty($res[0])) {
		echo "{\"data\":[]}";
	} else {
		$str = json_encode($res);
		echo "{\"data\":".$str."}";
	}
} else if (!empty($rname)) {
	$conn->sql = "SELECT rno,rname,password,rno AS id,email as mail, phone FROM reader where rname like '%".$rname."%'";
	$res       = $conn->fetch_res();
	if (empty($res[0])) {
		echo "{\"data\":[]}";
	} else {
		$str = json_encode($res);
		echo "{\"data\":".$str."}";
	}
} else if (!empty($rname) && !empty($rno)) {
	$conn->sql = "SELECT rno,rname,password,rno AS id,email as mail, phone FROM reader where rname like '%".$rname."%' AND rno like '%".$rno."%'";
	$res       = $conn->fetch_res();
	if (empty($res[0])) {
		echo "{\"data\":[]}";
	} else {
		$str = json_encode($res);
		echo "{\"data\":".$str."}";
	}
}
?>