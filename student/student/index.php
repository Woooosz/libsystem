<?php
    session_start();
    header("Content-type:text/html;charset=utf-8"); 
    include('../../conn.php');
    $rno=$_SESSION['rno'];
    $sql="SET NAMES UTF8";
    $conn=new conn($sql);
    $conn->execute_sql();
    $conn->sql="SELECT * FROM reader where rno='".$rno."'";
    $res=$conn->fetch_res();
?>
<!DOCTYPE html>
<html lang="zh-CN" class="ax-vertical-centered">
<head>
    <title>图书馆管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/plugins/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/plugins/bootstrap-3.3.5/css/bootstrap-admin-theme.css">
    <link rel="stylesheet" href="/plugins/datatables-1.10.8/css/dataTables.bootstrap.css">
    <script src="/plugins/jquery-1.11.3/jquery.min.js"></script>
    <script src="/plugins/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <script src="/plugins/bootstrap-3.3.5/js/bootstrap-dropdown.min.js"></script>
    <script src="/plugins/datatables-1.10.8/js/jquery.dataTables.zh_CN.js"></script>
    <script src="/plugins/datatables-1.10.8/js/dataTables.bootstrap.js"></script>
    <script src="/js/student_sx.js"></script>
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
                                <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> 欢迎您，<?php echo $_SESSION['rname'];?><i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/student/student">修改</a></li>
                                    <li role="presentation" class="divider"></li>
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
            <div class="col-md-2 bootstrap-admin-col-left">
                <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                    <li>
                        <a href="/student/book"><i class="glyphicon glyphicon-chevron-right"></i> 图书查询</a>
                    </li>
                    <li>
                        <a href="/student/borrowInfo"><i class="glyphicon glyphicon-chevron-right"></i> 借阅信息</a>
                    </li>
                    
                        
                    
                    
                        
                    
                </ul>
            </div>
            <!-- content -->
            <div class="col-md-10">
                
                    
                        
                            
                        
                    
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default bootstrap-admin-no-table-panel">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">基本信息</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" id="form_update">
                                    <input type="hidden" id="update_id">
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label class="col-lg-3 control-label" for="update_sno"><label class="text-danger">*&nbsp;</label>学号</label>
                                            <div class="col-lg-7">
                                                <input class="form-control" id="update_sno" type="text" value="<?php  echo $rno;  ?>" disabled>
                                                <label class="control-label" for="update_sno"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 form-group has">
                                            <label class="col-lg-3 control-label" for="update_sname"><label class="text-danger">*&nbsp;</label>姓名</label>
                                            <div class="col-lg-7">
                                                <input class="form-control" id="update_sname" type="text" value="<?php  echo $res[0]['rname'];  ?>">
                                                <label class="control-label" for="update_sname"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label class="col-lg-3 control-label" for="update_password"><label class="text-danger">*&nbsp;</label>原密码</label>
                                            <div class="col-lg-7">
                                                <input class="form-control" id="update_password" type="text" value="<?php  echo $res[0]['password'];  ?>">
                                                <label class="control-label" for="update_password"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label class="col-lg-3 control-label" for="update_password_new"><label class="text-danger">*&nbsp;</label>新密码</label>
                                            <div class="col-lg-7">
                                                <input class="form-control" id="update_password_new" type="text" value="">
                                                <label class="control-label" for="update_password_new"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label class="col-lg-3 control-label" for="update_password_confirm"><label class="text-danger">*&nbsp;</label>确认密码</label>
                                            <div class="col-lg-7">
                                                <input class="form-control" id="update_password_confirm" type="text" value="">
                                                <label class="control-label" for="update_password_confirm"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 form-group" style="text-align: center;">
                                            <button type="button" class="btn btn-lg btn-primary" id="btn_update_save" onclick="update()">保&nbsp;&nbsp;存</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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