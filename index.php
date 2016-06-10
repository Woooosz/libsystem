<!DOCTYPE html>



<html lang="zh-CN" class="bootstrap-admin-vertical-centered">
<head>
    <title>图书馆管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/library/plugins/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/plugins/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/library/plugins/bootstrap-3.3.5/css/bootstrap-admin-theme.css">
    <script src="/library/plugins/jquery-1.11.3/jquery.min.js"></script>
    <script src="/library/plugins/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <script src="js/login.js"></script>

    <style type="text/css">
        .alert{
            margin: 0 auto 20px;
            text-align: center;
        }
    </style>
</head>
<body class="bootstrap-admin-without-padding">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                    <h2>欢迎使用图书管理系统</h2>
                    <p>2016-06-01 && 电商1402班</p>
                    <p>WEB数据库设计课程作业小组<p>
            </div>
            <form class="bootstrap-admin-login-form">
                <div class="form-group">
                    <label class="control-label" for="username">账&nbsp;号</label>
                    <input type="text" class="form-control" id="username" placeholder="学号"/>
                    <label class="control-label" for="username" style="display:none;"></label>
                </div>
                <div class="form-group">
                    <label class="control-label" for="password">密&nbsp;码</label>
                    <input type="password" class="form-control" id="password" placeholder="密码"/>
                    <label class="control-label" for="username" style="display:none;"></label>
                </div>
                <input type="button" class="btn btn-lg btn-primary" id="login_submit" value="登&nbsp;&nbsp;&nbsp;&nbsp;录"/>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="infoModalLabel">提示</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12" id="div_info"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="btn_info_close" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>