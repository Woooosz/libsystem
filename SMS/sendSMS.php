<?php
include "TopSdk.php";
require ("../conn.php");
$conn = new conn("SET NAMES UTF8");
$conn->execute_sql();
$conn->sql    = "select bname, reader.rname, timeout,phone from ls_borrow_date join reader on reader.rno = ls_borrow_date.rno where bid = '".$_POST['id']."'";
$res          = $conn->fetch_res();
$c            = new TopClient;
$c->appkey    = "23732455";
$c->secretKey = "1c41d9be505c52425b90d7a8cee8568b";
$req          = new AlibabaAliqinFcSmsNumSendRequest;
$req->setExtend("");
$req->setSmsType("normal");
$req->setSmsFreeSignName("silenx站");
$money = 0.2*$res[0]['bname'];
$req->setSmsParam("{user:'".$res[0]['rname']."',book:'《".$res[0]['bname']."》',days:'".$res[0]['timeout']."天',m:'".$money."'}");
$req->setRecNum($res[0]['phone']);
$req->setSmsTemplateCode("SMS_59735097");
$resp = $c->execute($req);
if ($resp) {
	echo "1";
} else {
	echo "0";
}

?>