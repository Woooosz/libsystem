 <?php 
	session_start();
	include('../../conn.php');
	$user_id=$_POST['id'];
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();
	$conn->sql="SELECT btype FROM type WHERE typeid=".$user_id;
	$res=$conn->fetch_res();
	//$_SESSION['user_id']=$user_id;

	$data=array(
		'tname'=>$res[0]['btype']
		);
	echo json_encode($data);
?>