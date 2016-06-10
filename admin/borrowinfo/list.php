<?php 
	session_start();
	include('../../conn.php');
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();
	$rno=$_POST['sno'];
	$bname=$_POST['bname'];
	$ISBN=$_POST['bno'];
	$rname=$_POST['sname'];
	
	$sqls="SELECT null as id,rname as sname,timeout,null as udate,null as yn,bid as sid,bauthor as author,borrowdate as bdate,bid,bname,ISBN as bno,bprice as price,returndate as rdate,rno as sno from ls_borrow_date  WHERE rno like '%".$rno."%' AND bname like '%".$bname."%' AND ISBN like '%".$ISBN."%' AND rname like '%".$rname."%'";
	
	$conn->sql=$sqls;
	$res=$conn->fetch_res();
	if(empty($res[0])) {
		echo "{\"data\":[]}";	
	} else {
		$str= json_encode($res);
		echo "{\"data\":".$str."}";	
	}		
	
?>