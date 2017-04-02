<?php
function diffBetweenTwoDays($day1, $day2) {
	$second1 = strtotime($day1);
	$second2 = strtotime($day2);

	if ($second1-$second2 < 0) {return 0;
	} else {
		return ($second1-$second2)/86400;
	}
}

session_start();
include ('../../conn.php');
$conn = new conn("SET NAMES UTF8");
$conn->execute_sql();

$isbn = $_POST['bno'];
$rno  = $_POST['sno'];

$conn->sql  = "SELECT rname FROM reader WHERE rno='".$rno."'";
$res_reader = $conn->fetch_res();
if ($res_reader[0]['rname'] == "") {
	echo "-1";
} else {
	$conn->sql = "SELECT bname FROM book WHERE ISBN='".$isbn."'";
	$res_book  = $conn->fetch_res();
	if ($res_book[0]['bname'] == "") {
		echo "-2";
	} else {
		$conn->sql  = "SELECT enddate FROM borrow WHERE rno='".$rno."' AND ISBN='".$isbn."'";
		$res_borrow = $conn->fetch_res();
		if (empty($res_borrow[0]['enddate'])) {
			echo "-3";
		} else {
			$enddate   = date("Y-m-d");
			$fine      = diffBetweenTwoDays($enddate, $res_borrow[0]['enddate'])*0.2;
			$conn->sql = "INSERT INTO returnd VALUES(null,'".$isbn."','".$rno."','".$enddate."',".$fine.")";
			$status    = $conn->execute_sql();
			if ($status == true) {echo "1";} else {echo "0";}
		}
	}
}

?>