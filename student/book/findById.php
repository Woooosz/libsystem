 <?php 
	session_start();
	include('../../conn.php');
	$book_isbn=$_POST['id'];
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();
	$conn->sql="SELECT * FROM book WHERE ISBN='".$book_isbn."'";
	$res=$conn->fetch_res();
	//$_SESSION['user_id']=$user_id;

	$data=array(
		'author'=>$res[0]['bauthor'],
		'bname'=>$res[0]['bname'],
		'bno'=>$res[0]['ISBN'],
		'brief'=>$res[0]['brief'],
		'cdate'=>'null',
		'id'=>$res[0]['ISBN'],
		'price'=>$res[0]['bprice'],
		'remain'=>$res[0]['bnum'],
		'tid'=>'null',
		'tname'=>$res[0]['btype'],
		'total'=>$res[0]['binventory'],
		'udate'=>'null',
		'yn'=>'null'
		);
	echo json_encode($data);
?>