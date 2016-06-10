<?php session_start() ?>


<!DOCTYPE html>

<html lang="zh-CN" class="ax-vertical-centered">
<head>
    <title>图书馆管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/library/plugins/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/plugins/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/library/plugins/bootstrap-3.3.5/css/bootstrap-admin-theme.css">
    <link rel="stylesheet" href="/library/plugins/datatables-1.10.8/css/dataTables.bootstrap.css">
    <script src="/library/plugins/jquery-1.11.3/jquery.min.js"></script>
    <script src="/library/plugins/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <script src="/library/plugins/bootstrap-3.3.5/js/bootstrap-dropdown.min.js"></script>
    <script src="/library/plugins/datatables-1.10.8/js/jquery.dataTables.zh_CN.js"></script>
    <script src="/library/plugins/datatables-1.10.8/js/dataTables.bootstrap.js"></script>
    <script src="/library/js/common.js"></script>
    <script src="/library/js/borrow-info_s.js"></script>
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
                            <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> 欢迎您，<?php echo $_SESSION['rname']; ?> <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="/library/student/student">修改</a></li>
                                <li role="presentation" class="divider"></li>
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
                    <a href="/library/student/book"><i class="glyphicon glyphicon-chevron-right"></i> 图书查询</a>
                </li>
                <li class="active">
                    <a href="/library/student/borrowInfo"><i class="glyphicon glyphicon-chevron-right"></i> 借阅信息</a>
                </li>
           </ul>
        </div>
        <!-- content -->
        <div class="col-md-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default bootstrap-admin-no-table-panel">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">查询</div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-lg-5 form-group">
                                        <label class="col-lg-4 control-label" for="query_bno">图书编号</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="query_bno" type="text" value="">
                                            <label class="control-label" for="query_bno" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 form-group">
                                        <label class="col-lg-4 control-label" for="query_bname">图书名称</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="query_bname" type="text" value="">
                                            <label class="control-label" for="query_bname" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 form-group">
                                        <button type="button" class="btn btn-primary" id="btn_query" onclick="query()">查询</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table id="data_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>图书编号</th>
                            <th>图书名称</th>
                            <th>作者</th>
                            <th>价格</th>
                            <th>学号</th>
                            <th>学生姓名</th>
                            <th>借阅日期</th>
                            <th>截止还书日期</th>
                            <th>超期天数</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>