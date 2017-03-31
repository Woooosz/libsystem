<?php
    include "TopSdk.php";
    echo $_POST['id'];
	$c = new TopClient;
	$c ->appkey = "23732455" ;
	$c ->secretKey = "1c41d9be505c52425b90d7a8cee8568b" ;
	$req = new AlibabaAliqinFcSmsNumSendRequest;
	$req ->setExtend( "" );
	$req ->setSmsType( "normal" );
	$req ->setSmsFreeSignName( "silenx站" );
	$req ->setSmsParam( "{user:'吴世哲',book:'javascrpit精编',days:'5天',m:'0.4'}" );
	$req ->setRecNum( "15566015057" );
	$req ->setSmsTemplateCode( "SMS_59735097" );
	//$resp = $c ->execute( $req );

?>