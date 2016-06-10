<?php
	session_start();
	include('../../conn.php');
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();

    $id=$_POST['bno'];
    $bname=$_POST['bname'];
    $author=$_POST['author'];
    $price=$_POST['price'];
    $total=$_POST['total'];
    $date=$_POST['date'];
    $brief=$_POST['brief'];
    $tid=$_POST['tid'];
    if(empty($date)) {
    	$date=date('Y-m-d');
    }

	$conn->sql="SELECT * FROM book WHERE ISBN='".$id."'";
	$res=$conn->fetch_res();
	if(!empty($res[0]['bname'])) {
		echo "-1";
	} else {
		$conn->sql="INSERT INTO book VALUES ('".$id."','".$bname."','".$author."',".$total.",".$total.",".$tid.",".$price.",'".$brief."','".$date."')";
		$status=$conn->execute_sql();
		if($status==1) {
			echo "1";
		} else {
			echo "0";
		}
	}

?>