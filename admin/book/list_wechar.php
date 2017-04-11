<?php
session_start();
include ('../../conn.php');
$conn = new conn("SET NAMES UTF8");
$conn->execute_sql();
$bname      = $_POST['bname'];
$sqls       = "SELECT ISBN AS bno,ISBN AS id,bname,bauthor AS author,binventory AS total,date as cdate,btype AS tname,bprice AS price,bnum AS remain FROM ls_book_all";
$sql        = "select count(*) as mum from ls_book_all";
$conn->sql  = $sql." where bname like '%".$bname."%'";
$res        = $conn->fetch_res();
$booksTotal = $res[0]['mum'];
$conn->sql  = $sqls." where bname like '%".$bname."%'";
$res        = $conn->fetch_res();
if (empty($res[0])) {
	echo "{\"booksTotal\":".$booksTotal.",\"data\":[]}";
} else {
	$str = json_encode($res);
	echo "{\"booksTotal\":".$booksTotal.",\"data\":".$str."}";
}
?>