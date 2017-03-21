<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-CN" class="ax-vertical-centered">
<head>
    <title>图书馆管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/libsystem/plugins/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/libsystem/plugins/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/libsystem/plugins/bootstrap-3.3.5/css/bootstrap-admin-theme.css">
    <link rel="stylesheet" href="/libsystem/plugins/datatables-1.10.8/css/dataTables.bootstrap.css">
    <script src="/libsystem/plugins/jquery-1.11.3/jquery.min.js"></script>
    <script src="/libsystem/plugins/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <script src="/libsystem/plugins/bootstrap-3.3.5/js/bootstrap-dropdown.min.js"></script>
    <script src="/libsystem/plugins/datatables-1.10.8/js/jquery.dataTables.zh_CN.js"></script>
    <script src="/libsystem/plugins/datatables-1.10.8/js/dataTables.bootstrap.js"></script>
    <script src="/libsystem/js/setting.js"></script>
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
                                    <li><a href="/logout">退出</a></li>
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
             <?php  include("../left_frame.php");?>
            <!-- content -->
            <div class="col-md-10">
                <div class="row">
                    <div class="col-lg-12">
                        <table id="data_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>设置项名称</th>
                                <th>设置项值</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="updateModalLabel">修改</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form class="form-horizontal" id="form_update">
                            <input type="hidden" id="update_id">
                            <div class="row">
                                <div class="col-lg-12 form-group has">
                                    <label class="col-lg-3 control-label" for="update_name"><label class="text-danger">*&nbsp;</label>设置项名称</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_name" type="text" value="" disabled>
                                        <label class="control-label" for="update_name"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="update_value"><label class="text-danger">*&nbsp;</label>设置项值</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_value" type="text" value="">
                                        <label class="control-label" for="update_value"></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn_update_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="btn_update_save" onclick="update()">保存</button>
                </div>
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