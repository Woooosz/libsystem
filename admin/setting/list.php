<?php 
	session_start();
	include('../../conn.php');
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();
	$conn->sql="SELECT * FROM department";
	$res=$conn->fetch_res();
	//echo $res[0]['rdept'];
	//echo $res[1]['rdept'];
	//echo $res[2]['rdept'];
	$data=array( 'data'=>array(
		array (
		'cdate'=>'null',
		'id'=>1,
		'name'=>'本科生最多借阅天数',
		'ndate'=>'null',
		'value'=>$res[1]['borrowdate'],
		'yn'=>'null'
			),
		array(
		'cdate'=>'null',
		'id'=>2,
		'name'=>'本科生最多借阅本数',
		'ndate'=>'null',
		'value'=>$res[1]['maxborrownum'],
		'yn'=>'null'
			),
		array(
		'cdate'=>'null',
		'id'=>3,
		'name'=>'研究生最多借阅天数',
		'ndate'=>'null',
		'value'=>$res[2]['borrowdate'],
		'yn'=>'null'
			),
		array(
		'cdate'=>'null',
		'id'=>4,
		'name'=>'研究生最多借阅本数',
		'ndate'=>'null',
		'value'=>$res[2]['maxborrownum'],
		'yn'=>'null'
			),
		array(
		'cdate'=>'null',
		'id'=>5,
		'name'=>'教师最多借阅天数',
		'ndate'=>'null',
		'value'=>$res[0]['borrowdate'],
		'yn'=>'null'
			),
		array(
		'cdate'=>'null',
		'id'=>6,
		'name'=>'教师最多借阅本数',
		'ndate'=>'null',
		'value'=>$res[0]['maxborrownum'],
		'yn'=>'null'
			),
			)
		);
	//var_dump(json_encode($data));
	echo json_encode($data);
	
?>