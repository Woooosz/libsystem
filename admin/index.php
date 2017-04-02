<?php
session_start();
header("Content-type:text/html;charset=utf-8");

include ('../conn.php');
$rno  = $_SESSION['rno'];
$sql  = "SET NAMES UTF8";
$conn = new conn($sql);
$conn->execute_sql();
$conn->sql = "SELECT rname, rdept FROM reader where rno='".$rno."'";
$res       = $conn->fetch_res();
$name      = $res[0]['rname'];
$rdept     = $res[0]['rdept'];
if ($res[0]['rdept'] != "管理员") {
	Header("HTTP/1.1 303 See Other");
	Header("Location: ../index.php");
}
$_SESSION['rname'] = $name;
$_SESSION['rdept'] = $rdept;
$conn->sql         = "select * from ls_basicinfo";
$res               = $conn->fetch_res();
?>
<!DOCTYPE html>
<html lang="zh-CN" class="ax-vertical-centered">
<head>
<?php require_once '../frame/header.php';?>
</head>
<body class="bootstrap-admin-with-small-navbar">
    <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-under-small" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="collapse navbar-collapse main-navbar-collapse">
                        <a class="navbar-brand" href="#"><strong>欢迎使用凌志图书管理系统</strong></a>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> 欢迎您，<?php echo $_SESSION['rname']?><i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../logout">退出</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">
            <!-- left, vertical navbar -->
<?php include ("./left_frame.php");?>
            <!-- content -->
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">用户信息</h3>
                    </div>
                    <div class="panel-body">
                        <p>当前用户总数为<mark><?php echo $res[0]['totalPeople'];
?></mark>人，其中本科生用户<mark><?php echo $res[0]['benke'];
?></mark>人，研究生用户<mark><?php echo $res[0]['yanjiu'];
?></mark>人，教师用户<mark><?php echo $res[0]['teacher'];
?></mark>人。</p>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">图书信息</h3>
                    </div>
                    <div class="panel-body">
                        <p>系统当前图书有<mark><?php echo $res[0]['bookTypeNum'];
?></mark>个门类，一共有<mark><?php echo $res[0]['bookKinds'];
?></mark>本图书，藏书量一共<mark><?php echo $res[0]['bookTotalNum'];
?></mark>本，当前可借阅数目共<mark><?php echo $res[0]['bookAvailableNum'];
?></mark>本。</p>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">借阅信息</h3>
                    </div>
                    <div class="panel-body">
                        <p>自从系统运行以来，一共发生借阅<mark><?php echo $res[0]['totalBorrowNum'];
?></mark>次，归还<mark><?php echo $res[0]['totalReturnNum'];
?></mark>次。</p>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">财务欠款</h3>
                    </div>
                    <div class="panel-body">
                        <p>当前图书超期一共<mark><?php echo $res[0]['oweNum'];
?></mark>人次，总共欠款<mark><?php if (empty($res[0]['totalFine'])) {echo "0";
} else {

	echo $res[0]['totalFine'];
}

?></mark>元</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>