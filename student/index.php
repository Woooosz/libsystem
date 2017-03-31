<?php
session_start();
header("Content-type:text/html;charset=utf-8");

include ('../conn.php');
$rno  = $_SESSION['rno'];
$sql  = "SET NAMES UTF8";
$conn = new conn($sql);
$conn->execute_sql();
$conn->sql = "SELECT rname FROM reader where rno='".$rno."'";
$res       = $conn->fetch_res();
$name      = $res[0]['rname'];

if (empty($_SESSION['rno'])) {
	Header("HTTP/1.1 303 See Other");
	Header("Location: ../index.php");
}
$_SESSION['rname'] = $name;
$_SESSION['rdept'] = $rdept;
$conn->sql = "select count(*) as totalBook, sum(fine) as totalFine from ls_return_all where rno = ".$rno;
$res       = $conn->fetch_res();

$conn->sql = "select * from ls_basicinfo";
$resd       = $conn->fetch_res();
?>
<!DOCTYPE html>
<html lang="zh-CN" class="ax-vertical-centered">
<head>
<?php include ('../frame/header.php');?>
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
                            <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> 欢迎您，<?php echo $_SESSION['rname'];?> <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="/libsystem/student/student">修改</a></li>
                                <li role="presentation" class="divider"></li>
                                <li><a href="/libsystem/logout">退出</a></li>
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
        <div class="col-md-10">
            <div class="row">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">我的当前借阅情况</h3>
                        </div>
                        <div class="panel-body">
                            <p>当前在借<mark><?php echo $res[0]['totalBook']; ?></mark>本书，共产生欠费<mark><?php if(empty($res[0]['totalBook'])) echo "0";
                            else echo $res[0]['totalBook'];
                            ?></mark>元</p>
                        </div>
                    </div>
                </div>
        <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">图书统计信息</h3>
                    </div>
                    <div class="panel-body">
                        <p>系统当前图书有<mark><?php echo $resd[0]['bookTypeNum'];
?></mark>个门类，一共有<mark><?php echo $resd[0]['bookKinds'];
?></mark>本图书，藏书量一共<mark><?php echo $resd[0]['bookTotalNum'];
?></mark>本，当前可借阅数目共<mark><?php echo $resd[0]['bookAvailableNum'];
?></mark>本。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>