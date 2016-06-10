<?php
    session_start();
    header("Content-type:text/html;charset=utf-8"); 
    include('../conn.php');
    $rno=$_SESSION['rno'];
    $sql="SET NAMES UTF8";
    $conn=new conn($sql);
    $conn->execute_sql();
    $conn->sql="SELECT rname FROM reader where rno='".$rno."'";
    $res=$conn->fetch_res();
    $name=$res[0]['rname'];
    $_SESSION['rname']=$name;
?>
<!DOCTYPE html>
<html lang="zh-CN" class="ax-vertical-centered">
<head>
    <title>图书馆管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/library/plugins/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/plugins/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/library/plugins/bootstrap-3.3.5/css/bootstrap-admin-theme.css">
    <script src="/library/plugins/jquery-1.11.3/jquery.min.js"></script>
    <script src="/library/plugins/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <script src="/library/plugins/bootstrap-3.3.5/js/bootstrap-dropdown.min.js"></script>
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
                                <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> 欢迎您, <?php echo $_SESSION['rname']; ?><i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/library/logout">退出</a></li>
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
            <div class="col-md-2 bootstrap-admin-col-left">
                <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                    <li>
                        <a href="/library/admin/book"><i class="glyphicon glyphicon-chevron-right"></i> 图书管理</a>
                    </li>
                    <li>
                        <a href="/library/admin/bookType"><i class="glyphicon glyphicon-chevron-right"></i> 图书分类管理</a>
                    </li>
                    <li>
                        <a href="/library/admin/borrow"><i class="glyphicon glyphicon-chevron-right"></i> 图书借阅</a>
                    </li>
                    <li>
                        <a href="/library/admin/return"><i class="glyphicon glyphicon-chevron-right"></i> 图书归还</a>
                    </li>
                    <li>
                        <a href="/library/admin/borrowInfo"><i class="glyphicon glyphicon-chevron-right"></i> 借阅查询</a>
                    </li>
                    <li>
                        <a href="/library/admin/student"><i class="glyphicon glyphicon-chevron-right"></i> 帐户管理</a>
                    </li>
                    <li>
                        <a href="/library/admin/setting"><i class="glyphicon glyphicon-chevron-right"></i> 系统设置</a>
                    </li>
                </ul>
            </div>

            <!-- content -->
            <div class="col-md-10">
                
                    
                        
                            
                        
                    
                

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">图书管理</div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <ul>
                                    <li>根据图书编号、图书名称查询图书基本信息</li>
                                    <li>添加、修改、删除图书</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">图书分类管理</div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <ul>
                                    <li>根据分类名称查询图书分类信息</li>
                                    <li>添加、修改、删除图书分类</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">图书借阅</div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <ul>
                                    <li>根据学号、图书编号借阅图书</li>
                                    <li>展示此学号的借阅信息</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">图书归还</div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <ul>
                                    <li>根据学号、图书编号归还图书</li>
                                    <li>展示此学号的借阅信息</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">借阅查询</div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <ul>
                                    <li>展示所有学生的图书借阅信息</li>
                                    <li>可根据图书编号、图书名称、学号、姓名进行查询</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">管理员管理</div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <ul>
                                    <li>根据管理员编号、管理员名称查询管理员基本信息</li>
                                    <li>添加、修改、删除管理员基本信息</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">学生管理</div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <ul>
                                    <li>根据学号、姓名查询学生基本信息</li>
                                    <li>添加、修改、删除学生信息</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">系统设置</div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <ul>
                                    <li>设置最多借阅天数</li>
                                    <li>设置最多借阅本数</li>
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