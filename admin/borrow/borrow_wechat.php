<?php
session_start();
include ('../../conn.php');
$conn = new conn("SET NAMES UTF8");
$conn->execute_sql();

$isbn = $_POST['bno'];
if ($_POST['sno'] == "-1") {
	$rno = $_SESSION['rno'];
} else {

	$rno = $_POST['sno'];
}

$conn->sql = "SELECT bname,bnum,isbn FROM book WHERE bname='".$isbn."'";
$resbook   = $conn->fetch_res();

if (empty($resbook[0]['bname'])) {
	echo "-2";
} else {
	$conn->sql = "SELECT rname FROM reader WHERE rno='".$rno."'";
	$resrno    = $conn->fetch_res();
	if (empty($resrno[0]['rname'])) {
		echo "-1";
	} else {
		$conn->sql = "SELECT bid FROM borrow WHERE ISBN='".$isbn."' AND rno='".$rno."'";
		$resborrow = $conn->fetch_res();
		if ($resborrow[0]['bid'] != "") {
			echo "-4";
		} else {
			if ($resbook[0]['bname'] == "") {
				echo "-2";
			} else {
				$conn->sql = "SELECT rname FROM reader WHERE rno='".$rno."'";
				$resrno    = $conn->fetch_res();
				if ($resrno[0]['rname'] == "") {
					echo "-1";
				} else {
					$conn->sql = "SELECT bid FROM borrow WHERE ISBN='".$isbn."' AND rno='".$rno."'";
					$resborrow = $conn->fetch_res();
					if ($resborrow[0]['bid'] != "") {
						echo "-4";
					} else {
						if ($resbook[0]['bnum'] == 0) {
							echo "-3";
						} else {
							$conn->sql  = "SELECT borrownum,maxborrownum,borrowdate FROM ls_reader_department WHERE rno='".$rno."'";
							$resborrow2 = $conn->fetch_res();
							if ($resborrow2[0]['borrownum'] == $resborrow2[0]['maxborrownum']) {
								echo "-5";
							} else {
								$isbn    = $resbook[0]['isbn'];
								$date    = date('Y-m-d');
								$datestr = "+".$resborrow2[0]['borrowdate']." day";
								$enddate = date("Y-m-d", strtotime($datestr));
								//echo $enddate;
								$conn->sql = "INSERT INTO borrow VALUES(null,'".$isbn."','".$rno."','".$date."','".$enddate."')";
								$status    = $conn->execute_sql();
								if ($status == true) {
									echo "1";
								} else {
									echo "0";
								}
							}
						}
					}
				}
			}
		}
	}
}

?>