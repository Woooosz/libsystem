<?php 
	session_start();
	include('../../conn.php');
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();
	$sno=$_POST['sno'];
	$bname=$_POST['bname'];
	$sqls="SELECT null as id,rname as sname,fine,null as udate,null as yn,null as sid,bauthor as author,rdept as bdate,null as bid,bname,ISBN as bno,bprice as price,returndate as rdate,rno as sno from ls_return_all";
	if(empty($sno)) {
		$conn->sql=$sqls;
		$res=$conn->fetch_res();
		$str= json_encode($res);
		if(empty($res[0])) {
			echo "{\"data\":[]}";
		} else {
			echo "{\"data\":".$str."}";
		}	
	} else  {
		$conn->sql=$sqls." where bname like '%".$bname."%' AND ISBN like '%".$bno."%'";
		$res=$conn->fetch_res();
		if(empty($res[0])) {
			echo "{\"data\":[]}";	
		} else {
			$str= json_encode($res);
			echo "{\"data\":".$str."}";	
		}		
	}
?>