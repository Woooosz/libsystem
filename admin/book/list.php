<?php 
	session_start();
	include('../../conn.php');
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();
	$bno=$_POST['bno'];
	$bname=$_POST['bname'];
	$sqls="SELECT ISBN AS bno,ISBN AS id,bname,bauthor AS author,binventory AS total,date as cdate,btype AS tname,bprice AS price,bnum AS remain FROM ls_book_all";
	if(empty($bno) && empty($bname)) {
		$conn->sql=$sqls;
		$res=$conn->fetch_res();
		$str= json_encode($res);
		if(empty($res[0])) {
			echo "{\"data\":[]}";
			} else {
						echo "{\"data\":".$str."}";
		}	
	}  else if(!empty($bno)) {
		$conn->sql=$sqls." where ISBN like '%".$bno."%'";
		$res=$conn->fetch_res();
		if(empty($res[0])) {
			echo "{\"data\":[]}";	
		} else {
			$str= json_encode($res);
			echo "{\"data\":".$str."}";	
		}
	} else if(!empty($bname)) {
		$conn->sql=$sqls." where bname like '%".$bname."%'";
		$res=$conn->fetch_res();
		if(empty($res[0])) {
			echo "{\"data\":[]}";	
		} else {
			$str= json_encode($res);
			echo "{\"data\":".$str."}";	
		}
	} else if(!empty($bname) && !empty($bno)) {
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