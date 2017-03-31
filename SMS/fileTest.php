<?php
    include "TopSdk.php";
    date_default_timezone_set('Asia/Shanghai'); 

    $c = new TopClient;
    $c->appkey = '23281640';
    $c->secretKey = '6f30dad95e3d96f8596fa50af9f8f83d';
    // $req = new TradeVoucherUploadRequest;
    // $req->setFileName("example");
    // $req->setFileData("@/Users/xt/Downloads/1.jpg");
    // $req->setSellerNick("奥利奥官方旗舰店");
    // $req->setBuyerNick("101NufynDYcbjf2cFQDd62j8M/mjtyz6RoxQ2OL1c0e/Bc=");
    // var_dump($c->execute($req));

    $req2 = new TradeVoucherUploadRequest;
    $req2->setFileName("example");

    $req2->setSellerNick("silenx站");
    $req2->setBuyerNick("SMS_59735097");
    var_dump($c->execute($req2));
?>