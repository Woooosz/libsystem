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
                    <a class="navbar-brand" href="#"><strong>欢迎使用图书馆管理系统</strong></a>
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
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">图书查询</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <ul>
                                <li>根据图书编号、图书名称查询图书信息</li>
                                <li>可查询图书的编号、名称、分类、作者、价格、在馆数量等</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">借阅信息</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <ul>
                                <li>根据图书编号、图书名称查询自己借阅的图书信息</li>
                                <li>可查询除图书的基本信息、借阅日期、截止还书日期、超期天数等</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>