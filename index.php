<!DOCTYPE html>
<html lang="zh-CN" class="bootstrap-admin-vertical-centered">
<head>
    <title>凌志图书管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/libsystem/plugins/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/libsystem/plugins/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/libsystem/plugins/bootstrap-3.3.5/css/bootstrap-admin-theme.css">
    <script src="/libsystem/plugins/jquery-1.11.3/jquery.min.js"></script>
    <script src="/libsystem/plugins/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <script src="js/login.js"></script>

    <style type="text/css">
        .alert{
            margin: 0 auto 20px;
            text-align: center;
        }
    </style>
</head>

<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="alert alert-info">
                <h2>欢迎使用凌志图书管理系统</h2>
                <h4>管理员帐号：10000 密码：123456</h4>
                <h4>用户帐号：201437001 密码：123456</h4>
            </div>
            <form class="bootstrap-admin-login-form">
                <div class="form-group">
                    <label class="control-label" for="username">账&nbsp;号</label>
                    <input type="text" class="form-control" id="username" placeholder="帐号"/>
                    <label class="control-label" for="username" style="display:none;"></label>
                </div>
                <div class="form-group">
                    <label class="control-label" for="password">密&nbsp;码</label>
                    <input type="password" class="form-control" id="password" placeholder="密码"/>
                    <label class="control-label" for="username" style="display:none;"></label>
                </div>
                <div align="center">
                <input type="button" class="btn btn-large btn-block btn-success" id="login_submit" value="登&nbsp;&nbsp;&nbsp;&nbsp;录"/>
                <input type="button" class="btn btn-large btn-block btn-warning" data-toggle="modal" data-target="#modal_reg" id="login_reg" value="注&nbsp;&nbsp;&nbsp;&nbsp;册"/>
                </div>
            </form>
        </div>
    </div>
</div>
    <div class="modal fade" id="modal_reg" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">用户注册</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                            <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label class="col-lg-3 control-label" for="add_bno"><label class="text-danger">*&nbsp;</label>读者编号</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" id="add_bno" type="text" value="">
                                                <label class="control-label" for="add_bno"></label>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-12 form-group has">
                                            <label class="col-lg-3 control-label" for="add_bname"><label class="text-danger">*&nbsp;</label>读者姓名</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" id="add_bname" type="text" value="">
                                                <label class="control-label" for="add_bname"></label>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label class="col-lg-3 control-label" for="add_password" ><label class="text-danger">*&nbsp;</label>密码</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" id="add_password" type="password" value="">
                                                <label class="control-label" for="add_password"></label>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label class="col-lg-3 control-label" for="add_email"><label class="text-danger">*&nbsp;</label>邮箱</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" id="add_email" type="text" value="">
                                                <label class="control-label" for="add_email"></label>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label class="col-lg-3 control-label" for="add_phone"><label class="text-danger">*&nbsp;</label>手机</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" id="add_phone" type="text" value="">
                                                <label class="control-label" for="add_phone"></label>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label class="col-lg-3 control-label" for="add_tid"><label class="text-danger">*&nbsp;</label>所属部门</label>
                                            <div class="col-lg-9">
                                                <select class="form-control" id="add_tid">
                                                    <option value="">请选择</option>
<?php
include_once ('./conn.php');
$conn = new conn("SET NAMES UTF8");
$conn->execute_sql();
$conn->sql = "SELECT rdept FROM department WHERE rdept != '管理员'";
$res       = $conn->fetch_res();
for ($i = 0; $i < count($res); ++$i) {
	echo "<option value=\"".$res[$i]['rdept']."\">".$res[$i]['rdept']."</option>";
}
?>

                                                </select>
                                                <label class="control-label" for="add_tid"></label>
                                            </div>
                                        </div>
                                    </div>

                            </div>

                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-success" onclick="reg()">提交</button>
                </div>
            </div>
        </div>
    </div>

<body class="bootstrap-admin-without-padding">
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
</div>


</body>
</html>