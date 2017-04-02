<?php
session_start();
include ('../../conn.php');
$conn = new conn("SET NAMES UTF8");
$conn->execute_sql();
$tname = $_POST['tname'];
$sqls  = "SELECT typeid AS id,btype AS tname FROM type";
if (empty($tname)) {
	$conn->sql = $sqls;
	$res       = $conn->fetch_res();
	$str       = json_encode($res);
	if (empty($res[0])) {
		echo "{\"data\":[]}";
	} else {
		echo "{\"data\":".$str."}";
	}
} else {
	$conn->sql = $sqls." where btype like '%".$tname."%'";
	$res       = $conn->fetch_res();
	if (empty($res[0])) {
		echo "{\"data\":[]}";
	} else {
		$str = json_encode($res);
		echo "{\"data\":".$str."}";
	}
}

?>