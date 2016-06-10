<?php 
	session_start();
	include('../../conn.php');
	$id=$_POST['id'];
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();
	$conn->sql="SELECT * FROM department";
	$res=$conn->fetch_res();
	$_SESSION['id']=$id;
	if($id==1) {
		$name='本科生最多借阅天数';
		$value=$res[1]['borrowdate'];
	} else if($id==2) {
		$name="本科生最多借阅本数";
		$value=$res[1]['maxborrownum'];
	} else if($id==3) {
		$name="研究生最多借阅天数";
		$value=$res[2]['borrowdate'];
	} else if($id==4) {
		$name="研究生最多借阅本数";
		$value=$res[2]['maxborrownum'];
	} else if($id==5) {
		$name="教师最多借阅天数";
		$value=$res[0]['borrowdate'];
	} else if($id==6) {
		$name="教师最多借阅本数";
		$value=$res[0]['maxborrownum'];
	}
	$data=array(
		'id'=>$id,
		'name'=>$name,
		'value'=>$value,
		'cdate'=>'null',
		'ndate'=>'null',
		'yn'=>'null'
		);
	echo json_encode($data);

?>