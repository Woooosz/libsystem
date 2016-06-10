<?php
	session_start();
	include('../../conn.php');
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();

	$isbn=$_POST['bno'];
	$rno=$_POST['sno'];

	$conn->sql="SELECT rname FROM reader WHERE rno='".$rno."'";
	$res_reader=$conn->fetch_res();
	if($res_reader[0]['rname']=="") {
		echo "-1";
	} else {
		$conn->sql="SELECT bname FROM book WHERE ISBN='".$isbn."'";
		$res_book=$conn->fetch_res();
		if($res_book[0]['bname']=="") {
			echo "-2";
		} else {
			$conn->sql="SELECT returndate,fine FROM ls_return_date WHERE rno='".$rno."' AND ISBN='".$isbn."'";
			$res_borrow=$conn->fetch_res();
			if($res_borrow[0]['returndate']=="") {
				echo "-3";
			} else {
				$enddate=date("Y-m-d");
				$conn->sql="INSERT INTO returnd VALUES(null,'".$isbn."','".$rno."','".$enddate."',".$res_borrow[0]['fine'].")";
				$status=$conn->execute_sql();
				if($status==true) {
					echo "1";
				} else {
					echo "0";
				}
			}
		}
	}

?>