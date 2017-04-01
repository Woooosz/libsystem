 <?php
session_start();
include ('../../conn.php');
$user_id = $_POST['id'];
$conn    = new conn("SET NAMES UTF8");
$conn->execute_sql();
$conn->sql           = "SELECT * FROM reader WHERE rno=".$user_id;
$res                 = $conn->fetch_res();
$_SESSION['user_id'] = $user_id;

$data = array(
	'id'          => $user_id,
	'sno'         => $res[0]['rno'],
	'sname'       => $res[0]['rname'],
	'password'    => $res[0]['password'],
	'passwordNew' => 'null',
	'cdate'       => 'null',
	'udate'       => 'null',
	'yn'          => 'null',
	'type'        => $res[0]['rdept'],
	'booknum'     => $res[0]['borrownum'],
	'mail'        => $res[0]['email'],
	'phone'       => $res[0]['phone'],
);
echo json_encode($data);
?>